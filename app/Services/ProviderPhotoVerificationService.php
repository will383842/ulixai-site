<?php

namespace App\Services;

use App\Models\ProviderPhotoVerification;
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

    public function verifyProfilePhoto(ProviderPhotoVerification $verification): void
    {
        try {
            Log::channel('google-vision')->info('Starting profile photo verification', [
                'verification_id' => $verification->id
            ]);

            $verification->update(['status' => 'processing']);

            $absolutePath = Storage::path($verification->image_path);

            $googleResponse = $this->googleVisionService->analyzeProfilePhoto($absolutePath);

            $analysis = $this->analyzeFaceDetection($googleResponse);

            $status = $this->determineStatus($analysis['score']);
            $message = $this->generateFeedbackMessage($status, $analysis['score']);

            $updateData = [
                'confidence_score' => $analysis['score'],
                'google_vision_response' => $googleResponse
            ];

            if ($status === 'verified') {
                $updateData['status'] = 'verified';
                $updateData['verified_at'] = now();
                $updateData['rejection_reason'] = null;
            } else {
                $updateData['status'] = 'rejected';
                $updateData['rejection_reason'] = $message;
            }

            $verification->update($updateData);

            Log::channel('google-vision')->info('Profile photo verification completed', [
                'verification_id' => $verification->id,
                'status' => $status,
                'score' => $analysis['score']
            ]);

        } catch (Exception $e) {
            Log::channel('google-vision')->error('Profile photo verification failed', [
                'verification_id' => $verification->id,
                'error' => $e->getMessage()
            ]);

            $verification->update([
                'status' => 'error',
                'rejection_reason' => 'Verification error. Please try again.'
            ]);

            throw $e;
        }
    }

    protected function analyzeFaceDetection(array $googleResponse): array
    {
        $result = [
            'face_count' => $googleResponse['face_count'] ?? 0,
            'score' => 0,
            'face_centered' => false,
            'quality' => 'low'
        ];

        if ($result['face_count'] === 0) {
            return $result;
        }

        if ($result['face_count'] > 1) {
            $result['score'] = 40;
            $result['quality'] = 'medium';
            return $result;
        }

        $face = $googleResponse['faces'][0] ?? null;
        if (!$face) {
            $result['score'] = 30;
            return $result;
        }

        $score = 50;

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

        if (isset($face['vertices'])) {
            $vertices = $face['vertices'];
            $faceWidth = abs($vertices[1]['x'] - $vertices[0]['x']);
            $faceHeight = abs($vertices[2]['y'] - $vertices[0]['y']);
            
            if ($faceWidth > 100 && $faceHeight > 100) {
                $result['face_centered'] = true;
                $score += 20;
            }
        }

        $result['score'] = min(100, $score);

        return $result;
    }

    protected function determineStatus(int $score): string
    {
        return $score >= 60 ? 'verified' : 'rejected';
    }

    protected function generateFeedbackMessage(string $status, int $score): string
    {
        if ($status === 'verified') {
            return "✅ Photo verified successfully! (Score: {$score})";
        }

        $message = "❌ Your photo was not accepted.\n\n";
        
        if ($score < 30) {
            $message .= "We could not detect your face clearly.\n\n";
        } else {
            $message .= "Photo quality needs improvement.\n\n";
        }
        
        $message .= "📸 Please retake with:\n";
        $message .= "• Center your face in frame\n";
        $message .= "• Use good lighting\n";
        $message .= "• Face camera directly\n";
        $message .= "• Remove sunglasses/masks\n";
        $message .= "• Clear and sharp image";
        
        return $message;
    }
}