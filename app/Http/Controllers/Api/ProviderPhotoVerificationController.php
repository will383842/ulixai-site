<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ProviderPhotoVerificationService;
use App\Jobs\ProcessProviderPhotoVerification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ProviderPhotoVerificationController extends Controller
{
    protected $verificationService;

    public function __construct(ProviderPhotoVerificationService $verificationService)
    {
        $this->verificationService = $verificationService;
    }

    /**
     * Upload and verify profile photo.
     * 
     * POST /api/provider/verification/photo
     */
    public function upload(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
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

            // Store the image temporarily
            $imagePath = $this->verificationService->storeProfilePhoto(
                $request->image,
                $user->id
            );

            // Dispatch job for async processing
            ProcessProviderPhotoVerification::dispatch($user, $imagePath);

            Log::channel('google-vision')->info('Profile photo verification initiated', [
                'user_id' => $user->id
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Photo uploaded successfully. Verification in progress...',
                'data' => [
                    'status' => 'pending'
                ]
            ], 201);

        } catch (\Exception $e) {
            Log::channel('google-vision')->error('Failed to upload profile photo', [
                'user_id' => auth()->id(),
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to upload photo. Please try again.'
            ], 500);
        }
    }

    /**
     * Get profile photo verification status (for polling).
     * 
     * GET /api/provider/verification/photo/status
     */
    public function status(): JsonResponse
    {
        $user = auth()->user();

        // Refresh user data from database
        $user->refresh();

        $response = [
            'success' => true,
            'has_photo' => !is_null($user->profile_photo_path),
            'verified' => $user->profile_photo_verified
        ];

        if (!$user->profile_photo_path) {
            $response['status'] = 'none';
            $response['message'] = 'No photo uploaded yet';
            return response()->json($response);
        }

        // Determine status
        if ($user->profile_photo_verified) {
            $response['status'] = 'approved';
            $response['message'] = '✅ Photo approved!';
            $response['score'] = $user->profile_photo_verification_data['score'] ?? null;
        } elseif ($user->profile_photo_rejection_reason) {
            $response['status'] = 'rejected';
            $response['message'] = $user->profile_photo_rejection_reason;
            $response['score'] = $user->profile_photo_verification_data['score'] ?? null;
        } else {
            // Check if verification data exists but not approved (pending)
            if ($user->profile_photo_verification_data) {
                $score = $user->profile_photo_verification_data['score'] ?? 0;
                if ($score >= 60 && $score < 80) {
                    $response['status'] = 'pending';
                    $response['message'] = '✔️ Photo accepted for now. We may review it later.';
                    $response['score'] = $score;
                } else {
                    // Still processing
                    $response['status'] = 'processing';
                    $response['message'] = '🔄 Analyzing your photo...';
                }
            } else {
                // No verification data yet - still processing
                $response['status'] = 'processing';
                $response['message'] = '🔄 Analyzing your photo...';
            }
        }

        // Add verification details if available
        if ($user->profile_photo_verification_data) {
            $response['verification_data'] = [
                'faces_detected' => $user->profile_photo_verification_data['faces_detected'] ?? null,
                'face_centered' => $user->profile_photo_verification_data['face_centered'] ?? null,
                'quality' => $user->profile_photo_verification_data['quality'] ?? null
            ];
        }

        return response()->json($response);
    }

    /**
     * Get profile photo details.
     * 
     * GET /api/provider/verification/photo
     */
    public function show(): JsonResponse
    {
        $user = auth()->user();

        if (!$user->profile_photo_path) {
            return response()->json([
                'success' => false,
                'message' => 'No profile photo uploaded'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'photo_path' => $user->profile_photo_path,
                'verified' => $user->profile_photo_verified,
                'verification_data' => $user->profile_photo_verification_data,
                'rejection_reason' => $user->profile_photo_rejection_reason
            ]
        ]);
    }

    /**
     * Delete profile photo.
     * 
     * DELETE /api/provider/verification/photo
     */
    public function destroy(): JsonResponse
    {
        $user = auth()->user();

        if (!$user->profile_photo_path) {
            return response()->json([
                'success' => false,
                'message' => 'No profile photo to delete'
            ], 404);
        }

        // Delete physical file
        if (\Storage::exists($user->profile_photo_path)) {
            \Storage::delete($user->profile_photo_path);
        }

        // Reset user photo fields
        $user->update([
            'profile_photo_path' => null,
            'profile_photo_verified' => false,
            'profile_photo_verification_data' => null,
            'profile_photo_rejection_reason' => null
        ]);

        Log::channel('google-vision')->info('Profile photo deleted', [
            'user_id' => $user->id
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Photo deleted successfully'
        ]);
    }
}