<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProviderDocumentVerification;
use App\Services\ProviderDocumentVerificationService;
use App\Jobs\ProcessProviderDocumentVerification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ProviderDocumentVerificationController extends Controller
{
    protected $verificationService;

    public function __construct(ProviderDocumentVerificationService $verificationService)
    {
        $this->verificationService = $verificationService;
    }

    /**
     * Store a new document verification request.
     * 
     * POST /api/provider/verification/documents
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'document_type' => 'required|in:passport,license,european_id',
            'document_side' => 'nullable|in:front,back',
            'image' => 'required|string', // base64 image
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $user = auth()->user();
            
            // Validate document side requirement
            $documentType = $request->document_type;
            $documentSide = $request->document_side;

            if ($documentType === 'passport' && $documentSide !== null) {
                return response()->json([
                    'success' => false,
                    'message' => 'Passport should not have a side specified'
                ], 422);
            }

            if (in_array($documentType, ['license', 'european_id']) && !in_array($documentSide, ['front', 'back'])) {
                return response()->json([
                    'success' => false,
                    'message' => 'License and European ID require document_side (front or back)'
                ], 422);
            }

            // Store the image
            $imagePath = $this->verificationService->storeImage(
                $request->image,
                $documentType,
                $documentSide,
                $user->id
            );

            // Create verification record
            $verification = ProviderDocumentVerification::create([
                'user_id' => $user->id,
                'document_type' => $documentType,
                'document_side' => $documentSide,
                'image_path' => $imagePath,
                'verification_status' => 'pending',
                'retry_count' => 0
            ]);

            // Dispatch job for async processing
            ProcessProviderDocumentVerification::dispatch($verification);

            Log::channel('google-vision')->info('Document verification created', [
                'verification_id' => $verification->id,
                'user_id' => $user->id,
                'document_type' => $documentType
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Document uploaded successfully. Verification in progress...',
                'data' => [
                    'id' => $verification->id,
                    'status' => 'pending',
                    'document_type' => $documentType,
                    'document_side' => $documentSide
                ]
            ], 201);

        } catch (\Exception $e) {
            Log::channel('google-vision')->error('Failed to create document verification', [
                'user_id' => auth()->id(),
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to upload document. Please try again.'
            ], 500);
        }
    }

    /**
     * Get verification status (for polling).
     * 
     * GET /api/provider/verification/documents/{id}/status
     */
    public function status(int $id): JsonResponse
    {
        $user = auth()->user();
        
        $verification = ProviderDocumentVerification::where('id', $id)
            ->where('user_id', $user->id)
            ->first();

        if (!$verification) {
            return response()->json([
                'success' => false,
                'message' => 'Document not found'
            ], 404);
        }

        $response = [
            'success' => true,
            'status' => $verification->verification_status,
            'document_type' => $verification->document_type,
            'document_side' => $verification->document_side
        ];

        // Add additional data based on status
        switch ($verification->verification_status) {
            case 'verified':
                $response['message'] = '✅ Document verified successfully!';
                $response['confidence_score'] = $verification->confidence_score;
                $response['detected_info'] = [
                    'text_preview' => substr($verification->detected_text, 0, 100) . '...',
                    'labels' => $verification->detected_labels
                ];
                break;

            case 'rejected':
                $response['message'] = '❌ Document verification failed';
                $response['rejection_reason'] = $verification->rejection_reason;
                $response['confidence_score'] = $verification->confidence_score;
                break;

            case 'error':
                $response['message'] = '⚠️ Verification error occurred';
                if ($verification->needsRetry()) {
                    $response['message'] .= ' - Retrying automatically...';
                    $response['retry_count'] = $verification->retry_count;
                    $response['max_retries'] = config('google-vision.max_retries', 3);
                } else {
                    $response['rejection_reason'] = $verification->rejection_reason;
                }
                break;

            case 'processing':
                $response['message'] = '🔄 Verifying your document...';
                break;

            case 'pending':
            default:
                $response['message'] = '⏳ Document queued for verification...';
                break;
        }

        return response()->json($response);
    }

    /**
     * Get full document details.
     * 
     * GET /api/provider/verification/documents/{id}
     */
    public function show(int $id): JsonResponse
    {
        $user = auth()->user();
        
        $verification = ProviderDocumentVerification::where('id', $id)
            ->where('user_id', $user->id)
            ->first();

        if (!$verification) {
            return response()->json([
                'success' => false,
                'message' => 'Document not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $verification->id,
                'document_type' => $verification->document_type,
                'document_side' => $verification->document_side,
                'verification_status' => $verification->verification_status,
                'confidence_score' => $verification->confidence_score,
                'detected_text' => $verification->detected_text,
                'detected_labels' => $verification->detected_labels,
                'rejection_reason' => $verification->rejection_reason,
                'verified_at' => $verification->verified_at,
                'created_at' => $verification->created_at,
                'updated_at' => $verification->updated_at
            ]
        ]);
    }

    /**
     * Delete a document verification.
     * 
     * DELETE /api/provider/verification/documents/{id}
     */
    public function destroy(int $id): JsonResponse
    {
        $user = auth()->user();
        
        $verification = ProviderDocumentVerification::where('id', $id)
            ->where('user_id', $user->id)
            ->first();

        if (!$verification) {
            return response()->json([
                'success' => false,
                'message' => 'Document not found'
            ], 404);
        }

        // Delete physical file
        if (\Storage::exists($verification->image_path)) {
            \Storage::delete($verification->image_path);
        }

        // Delete record
        $verification->delete();

        Log::channel('google-vision')->info('Document verification deleted', [
            'verification_id' => $id,
            'user_id' => $user->id
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Document deleted successfully'
        ]);
    }

    /**
     * List all documents for the authenticated user.
     * 
     * GET /api/provider/verification/documents
     */
    public function index(): JsonResponse
    {
        $user = auth()->user();
        
        $documents = ProviderDocumentVerification::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($doc) {
                return [
                    'id' => $doc->id,
                    'document_type' => $doc->document_type,
                    'document_side' => $doc->document_side,
                    'verification_status' => $doc->verification_status,
                    'confidence_score' => $doc->confidence_score,
                    'verified_at' => $doc->verified_at,
                    'created_at' => $doc->created_at
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $documents
        ]);
    }
}