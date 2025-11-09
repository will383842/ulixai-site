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

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'document_type' => 'required|in:passport,license,european_id',
            'document_side' => 'nullable|in:front,back',
            'image' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $sessionId = session()->getId();
            $userId = auth()->id();
            
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

            $imagePath = $this->verificationService->storeImage(
                $request->image,
                $documentType,
                $documentSide,
                $userId ?? 0
            );

            $verification = ProviderDocumentVerification::create([
                'session_id' => $sessionId,
                'user_id' => $userId,
                'document_type' => $documentType,
                'document_side' => $documentSide,
                'image_path' => $imagePath,
                'verification_status' => 'pending',
                'retry_count' => 0
            ]);

            ProcessProviderDocumentVerification::dispatch($verification);

            Log::channel('google-vision')->info('Document verification created', [
                'verification_id' => $verification->id,
                'session_id' => $sessionId,
                'user_id' => $userId,
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
                'session_id' => session()->getId(),
                'user_id' => auth()->id(),
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to upload document. Please try again.'
            ], 500);
        }
    }

    public function status(int $id): JsonResponse
    {
        $sessionId = session()->getId();
        $userId = auth()->id();
        
        $verification = ProviderDocumentVerification::where('id', $id)
            ->where(function($query) use ($sessionId, $userId) {
                $query->where('session_id', $sessionId);
                if ($userId) {
                    $query->orWhere('user_id', $userId);
                }
            })
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

        switch ($verification->verification_status) {
            case 'verified':
                $response['message'] = '✅ Document verified successfully!';
                $response['confidence_score'] = $verification->confidence_score;
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

    public function show(int $id): JsonResponse
    {
        $sessionId = session()->getId();
        $userId = auth()->id();
        
        $verification = ProviderDocumentVerification::where('id', $id)
            ->where(function($query) use ($sessionId, $userId) {
                $query->where('session_id', $sessionId);
                if ($userId) {
                    $query->orWhere('user_id', $userId);
                }
            })
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
                'verified_at' => $verification->verified_at
            ]
        ]);
    }

    public function destroy(int $id): JsonResponse
    {
        $sessionId = session()->getId();
        $userId = auth()->id();
        
        $verification = ProviderDocumentVerification::where('id', $id)
            ->where(function($query) use ($sessionId, $userId) {
                $query->where('session_id', $sessionId);
                if ($userId) {
                    $query->orWhere('user_id', $userId);
                }
            })
            ->first();

        if (!$verification) {
            return response()->json([
                'success' => false,
                'message' => 'Document not found'
            ], 404);
        }

        if (\Storage::exists($verification->image_path)) {
            \Storage::delete($verification->image_path);
        }

        $verification->delete();

        return response()->json([
            'success' => true,
            'message' => 'Document deleted successfully'
        ]);
    }

    public function index(): JsonResponse
    {
        $sessionId = session()->getId();
        $userId = auth()->id();
        
        $documents = ProviderDocumentVerification::where(function($query) use ($sessionId, $userId) {
                $query->where('session_id', $sessionId);
                if ($userId) {
                    $query->orWhere('user_id', $userId);
                }
            })
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($doc) {
                return [
                    'id' => $doc->id,
                    'document_type' => $doc->document_type,
                    'document_side' => $doc->document_side,
                    'verification_status' => $doc->verification_status,
                    'confidence_score' => $doc->confidence_score,
                    'verified_at' => $doc->verified_at
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $documents
        ]);
    }
}