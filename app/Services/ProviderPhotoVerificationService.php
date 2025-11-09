<?php

namespace App\Services;

use App\Models\ProviderPhotoVerification;
use Illuminate\Support\Facades\Log;
use Exception;

class ProviderPhotoVerificationService
{
    protected $googleVisionService;

    public function __construct(GoogleVisionApiService $googleVisionService)
    {
        $this->googleVisionService = $googleVisionService;
    }

    /**
     * ✅ Verify a profile photo using Google Vision API
     */
    public function verifyProfilePhoto(ProviderPhotoVerification $verification): void
    {
        try {
            // Update status to processing
            $verification->update(['status' => 'processing']);

            Log::channel('google-vision')->info('Starting profile photo verification', [
                'verification_id' => $verification->id,
                'image_path' => $verification->image_path,
                'file_exists' => file_exists($verification->image_path)
            ]);

            // ✅ Analyze photo with Google Vision
            $analysisResult = $this->googleVisionService->analyzeProfilePhoto($verification->image_path);

            Log::channel('google-vision')->info('Google Vision analysis completed', [
                'verification_id' => $verification->id,
                'face_count' => $analysisResult['face_count'],
                'labels_count' => count($analysisResult['labels'])
            ]);

            // Validate the results
            $validationResult = $this->validatePhotoAnalysis($analysisResult);

            if ($validationResult['is_valid']) {
                // ✅ Photo is valid
                $verification->update([
                    'status' => 'verified',
                    'confidence_score' => $validationResult['confidence_score'],
                    'google_vision_response' => json_encode($analysisResult),
                    'verified_at' => now(),
                ]);

                Log::channel('google-vision')->info('Profile photo verified successfully', [
                    'verification_id' => $verification->id,
                    'confidence_score' => $validationResult['confidence_score']
                ]);

            } else {
                // ❌ Photo rejected
                $verification->update([
                    'status' => 'rejected',
                    'rejection_reason' => $validationResult['rejection_reason'],
                    'google_vision_response' => json_encode($analysisResult),
                ]);

                Log::channel('google-vision')->warning('Profile photo rejected', [
                    'verification_id' => $verification->id,
                    'reason' => $validationResult['rejection_reason']
                ]);
            }

        } catch (Exception $e) {
            Log::channel('google-vision')->error('Error verifying profile photo', [
                'verification_id' => $verification->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            $verification->update([
                'status' => 'error',
                'rejection_reason' => '⚠️ An error occurred during verification. Please try again.'
            ]);

            throw $e;
        }
    }

    /**
     * ✅ Validate the Google Vision analysis results
     */
    protected function validatePhotoAnalysis(array $analysisResult): array
    {
        $minConfidence = config('google-vision.confidence_threshold.face', 80);

        // Check if at least one face is detected
        if ($analysisResult['face_count'] === 0) {
            return [
                'is_valid' => false,
                'rejection_reason' => '❌ No face detected in the photo. Please upload a clear photo of your face.',
                'confidence_score' => 0
            ];
        }

        // Check if multiple faces are detected
        if ($analysisResult['face_count'] > 1) {
            return [
                'is_valid' => false,
                'rejection_reason' => '❌ Multiple faces detected. Please upload a photo with only your face.',
                'confidence_score' => 0
            ];
        }

        // Get the confidence score of the detected face
        $faceConfidence = $analysisResult['faces'][0]['confidence'] ?? 0;

        // Check if confidence meets minimum threshold
        if ($faceConfidence < $minConfidence) {
            return [
                'is_valid' => false,
                'rejection_reason' => "❌ Photo quality is too low (confidence: {$faceConfidence}%). Please upload a clearer photo.",
                'confidence_score' => round($faceConfidence)
            ];
        }

        // Check labels for inappropriate content
        $inappropriateLabels = ['nude', 'nudity', 'explicit', 'adult'];
        foreach ($analysisResult['labels'] as $label) {
            $description = strtolower($label['description']);
            if (in_array($description, $inappropriateLabels)) {
                return [
                    'is_valid' => false,
                    'rejection_reason' => '❌ Photo contains inappropriate content.',
                    'confidence_score' => 0
                ];
            }
        }

        // ✅ All checks passed
        return [
            'is_valid' => true,
            'rejection_reason' => null,
            'confidence_score' => round($faceConfidence)
        ];
    }
}