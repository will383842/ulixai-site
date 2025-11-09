<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProviderPhotoVerification;
use App\Jobs\ProcessProviderPhotoVerification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProviderPhotoVerificationController extends Controller
{
    public function upload(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
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

            $imagePath = $this->saveBase64Image($request->image, $userId ?? 0);

            $verification = ProviderPhotoVerification::create([
                'session_id' => $sessionId,
                'user_id' => $userId,
                'image_path' => $imagePath,
                'status' => 'pending',
            ]);

            ProcessProviderPhotoVerification::dispatch($verification);

            Log::channel('google-vision')->info('Profile photo verification initiated', [
                'verification_id' => $verification->id,
                'session_id' => $sessionId,
                'user_id' => $userId
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Photo uploaded successfully. Verification in progress...',
                'data' => [
                    'id' => $verification->id,
                    'status' => 'pending'
                ]
            ], 201);

        } catch (\Exception $e) {
            Log::channel('google-vision')->error('Failed to upload profile photo', [
                'session_id' => session()->getId(),
                'user_id' => auth()->id(),
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to upload photo. Please try again.'
            ], 500);
        }
    }

    public function status(): JsonResponse
    {
        $sessionId = session()->getId();
        $userId = auth()->id();

        $verification = ProviderPhotoVerification::where(function($query) use ($sessionId, $userId) {
                $query->where('session_id', $sessionId);
                if ($userId) {
                    $query->orWhere('user_id', $userId);
                }
            })
            ->latest()
            ->first();

        if (!$verification) {
            return response()->json([
                'success' => false,
                'message' => 'No photo uploaded yet'
            ], 404);
        }

        $response = [
            'success' => true,
            'status' => $verification->status,
        ];

        switch ($verification->status) {
            case 'verified':
                $response['message'] = '✅ Photo verified successfully!';
                $response['confidence_score'] = $verification->confidence_score;
                break;

            case 'rejected':
                $response['message'] = '❌ Photo was rejected';
                $response['rejection_reason'] = $verification->rejection_reason;
                break;

            case 'error':
                $response['message'] = '⚠️ Verification error';
                break;

            case 'processing':
                $response['message'] = '🔄 Analyzing your photo...';
                break;

            case 'pending':
            default:
                $response['message'] = '⏳ Queued for verification...';
                break;
        }

        return response()->json($response);
    }

    public function show(): JsonResponse
    {
        $sessionId = session()->getId();
        $userId = auth()->id();

        $verification = ProviderPhotoVerification::where(function($query) use ($sessionId, $userId) {
                $query->where('session_id', $sessionId);
                if ($userId) {
                    $query->orWhere('user_id', $userId);
                }
            })
            ->latest()
            ->first();

        if (!$verification) {
            return response()->json([
                'success' => false,
                'message' => 'No profile photo uploaded'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $verification->id,
                'status' => $verification->status,
                'confidence_score' => $verification->confidence_score,
                'verified_at' => $verification->verified_at
            ]
        ]);
    }

    public function destroy(): JsonResponse
    {
        $sessionId = session()->getId();
        $userId = auth()->id();

        $verification = ProviderPhotoVerification::where(function($query) use ($sessionId, $userId) {
                $query->where('session_id', $sessionId);
                if ($userId) {
                    $query->orWhere('user_id', $userId);
                }
            })
            ->latest()
            ->first();

        if (!$verification) {
            return response()->json([
                'success' => false,
                'message' => 'No profile photo to delete'
            ], 404);
        }

        if (Storage::exists($verification->image_path)) {
            Storage::delete($verification->image_path);
        }

        $verification->delete();

        return response()->json([
            'success' => true,
            'message' => 'Photo deleted successfully'
        ]);
    }

    private function saveBase64Image(string $base64Image, int $userId): string
    {
        $image = preg_replace('/^data:image\/\w+;base64,/', '', $base64Image);
        $image = base64_decode($image);
        
        if (!$image) {
            throw new \Exception('Invalid image data');
        }

        $filename = 'photo_' . $userId . '_' . uniqid() . '.jpg';
        $path = 'verifications/photos/' . $filename;
        
        Storage::disk('public')->put($path, $image);
        
        return $path;
    }
}