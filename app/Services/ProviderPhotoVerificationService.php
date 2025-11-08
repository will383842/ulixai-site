<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Exception;

class ProviderPhotoVerificationService
{
    protected $googleVisionService;

    public function __construct(GoogleVisionApiService $googleVisionService)
    {
        $this->googleVisionService = $googleVisionService;
    }

    /**
     * Verify profile photo (complete process).
     */
    public function verifyProfilePhoto(User $user, string $imagePath): array
    {
        try {
            Log::channel('google-vision')->info('Starting profile photo verification', [
                'user_id' => $user->id
            ]);

            // Get absolute path
            $absolutePath = Storage::path($imagePath);

            // Call Google Vision API
            $googleResponse = $this->googleVisionService->analyzeProfilePhoto($absolutePath);

            // Analyze face detection
            $analysis = $this->analyzeFaceDetection($googleResponse);

            // Determine status
            $status = $this->determineStatus($analysis['score']);

            // Generate feedback message
            $message = $this->generateFeedbackMessage($status, $analysis['score']);

            // Prepare verification data
            $verificationData = [
                'score' => $analysis['score'],
                'faces_detected' => $analysis['face_count'],
                'face_centered' => $analysis['face_centered'],
                'quality' => $analysis['quality'],
                'google_response' => $googleResponse
            ];

            // Move image to appropriate folder
            if ($status === 'approved' || $status === 'pending') {
                $newPath = $this->moveImageToVerified($imagePath);
            } else {
                $newPath = $this->moveImageToRejected($imagePath);
            }

            // Update user
            $user->update([
                'profile_photo_path' => $newPath,
                'profile_photo_verified' => ($status === 'approved'),
                'profile_photo_verification_data' => $verificationData,
                'profile_photo_rejection_reason' => ($status === 'rejected') ? $message : null
            ]);

            // Check if identity is complete
            $this->checkUserVerificationComplete($user);

            Log::channel('google-vision')->info('Profile photo verification completed', [
                'user_id' => $user->id,
                'status' => $status,
                'score' => $analysis['score']
            ]);

            return [
                'status' => $status,
                'score' => $analysis['score'],
                'message' => $message,
                'verification_data' => $verificationData
            ];

        } catch (Exception $e) {
            Log::channel('google-vision')->error('Profile photo verification failed', [
                'user_id' => $user->id,
                'error' => $e->getMessage()
            ]);

            throw $e;
        }
    }

    /**
     * Store profile photo temporarily.
     */
    public function storeProfilePhoto(string $imageData, int $userId): string
    {
        // Decode base64 image
        $imageData = str_replace('data:image/jpeg;base64,', '', $imageData);
        $imageData = str_replace('data:image/png;base64,', '', $imageData);
        $imageData = str_replace(' ', '+', $imageData);
        $decodedImage = base64_decode($imageData);

        // Generate unique filename
        $filename = sprintf('user_%s_%s.jpg', $userId, time());

        // Storage path (pending folder)
        $path = config('google-vision.storage.profile_photos.pending') . '/' . $filename;

        // Store image
        Storage::put($path, $decodedImage);

        return $path;
    }

    /**
     * Analyze face detection results.
     */
    protected function analyzeFaceDetection(array $googleResponse): array
    {
        $result = [
            'face_count' => $googleResponse['face_count'] ?? 0,
            'score' => 0,
            'face_centered' => false,
            'quality' => 'low'
        ];

        // No face detected
        if ($result['face_count'] === 0) {
            $result['score'] = 0;
            $result['quality'] = 'low';
            return $result;
        }

        // Multiple faces detected
        if ($result['face_count'] > 1) {
            $result['score'] = 40;
            $result['quality'] = 'medium';
            return $result;
        }

        // One face detected - analyze quality
        $face = $googleResponse['faces'][0] ?? null;
        if (!$face) {
            $result['score'] = 30;
            return $result;
        }

        $score = 50; // Base score for 1 face

        // Check face confidence
        if (isset($face['confidence'])) {
            if ($face['confidence'] >= 90) {
                $score += 30;
                $result['quality'] = 'high';
            } elseif ($face['confidence'] >= 70) {
                $score += 20;
                $result['quality'] = 'medium';
            } else {
                $score += 10;
                $result['quality'] = 'low';
            }
        }

        // Check if face is centered (rough estimation)
        if (isset($face['vertices'])) {
            $vertices = $face['vertices'];
            $faceWidth = abs($vertices[1]['x'] - $vertices[0]['x']);
            $faceHeight = abs($vertices[2]['y'] - $vertices[0]['y']);
            
            // If face occupies reasonable portion of image, consider it centered
            if ($faceWidth > 100 && $faceHeight > 100) {
                $result['face_centered'] = true;
                $score += 20;
            }
        }

        $result['score'] = min(100, $score);

        return $result;
    }

    /**
     * Determine verification status based on score.
     */
    protected function determineStatus(int $score): string
    {
        if ($score >= 80) {
            return 'approved';
        } elseif ($score >= 60) {
            return 'pending';
        } else {
            return 'rejected';
        }
    }

    /**
     * Generate user-friendly feedback message.
     */
    protected function generateFeedbackMessage(string $status, int $score): string
    {
        switch ($status) {
            case 'approved':
                return "✅ Photo approved! Clear and professional. (Score: {$score})";
            
            case 'pending':
                return "✔️ Photo accepted for now. We may review it later to keep the platform safe. (Score: {$score})";
            
            case 'rejected':
                $message = "❌ Oops... Your photo was not accepted.\n\n";
                
                if ($score < 30) {
                    $message .= "We could not clearly detect your face.\n\n";
                } else {
                    $message .= "Photo quality needs improvement.\n\n";
                }
                
                $message .= "📸 Please retake with:\n";
                $message .= "• Center your face in the frame\n";
                $message .= "• Use good lighting\n";
                $message .= "• Face the camera directly\n";
                $message .= "• Remove sunglasses or masks\n";
                $message .= "• Ensure clear and sharp image";
                
                return $message;
            
            default:
                return "Photo verification in progress...";
        }
    }

    /**
     * Move image to verified folder.
     */
    protected function moveImageToVerified(string $oldPath): string
    {
        $newPath = str_replace(
            config('google-vision.storage.profile_photos.pending'),
            config('google-vision.storage.profile_photos.verified'),
            $oldPath
        );

        if (Storage::exists($oldPath)) {
            Storage::move($oldPath, $newPath);
        }

        return $newPath;
    }

    /**
     * Move image to rejected folder.
     */
    protected function moveImageToRejected(string $oldPath): string
    {
        $newPath = str_replace(
            config('google-vision.storage.profile_photos.pending'),
            config('google-vision.storage.profile_photos.rejected'),
            $oldPath
        );

        if (Storage::exists($oldPath)) {
            Storage::move($oldPath, $newPath);
        }

        return $newPath;
    }

    /**
     * Check if user's identity verification is complete.
     */
    protected function checkUserVerificationComplete(User $user): void
    {
        $hasVerifiedPhoto = $user->profile_photo_verified;
        $hasVerifiedDocument = $user->providerDocumentVerifications()
            ->where('verification_status', 'verified')
            ->exists();

        if ($hasVerifiedPhoto && $hasVerifiedDocument && !$user->identity_verified) {
            $user->update([
                'identity_verified' => true,
                'identity_verified_at' => now()
            ]);

            Log::channel('google-vision')->info('User identity fully verified', [
                'user_id' => $user->id
            ]);
        }
    }
}