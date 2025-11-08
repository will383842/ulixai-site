<?php

namespace App\Services;

use App\Models\ProviderDocumentVerification;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Exception;

class ProviderDocumentVerificationService
{
    protected $googleVisionService;

    public function __construct(GoogleVisionApiService $googleVisionService)
    {
        $this->googleVisionService = $googleVisionService;
    }

    /**
     * Verify a document (complete process).
     */
    public function verifyDocument(ProviderDocumentVerification $verification): void
    {
        try {
            Log::channel('google-vision')->info('Starting document verification', [
                'verification_id' => $verification->id,
                'user_id' => $verification->user_id,
                'document_type' => $verification->document_type
            ]);

            // Update status to processing
            $verification->update(['verification_status' => 'processing']);

            // Get absolute path to image
            $imagePath = Storage::path($verification->image_path);

            // Call Google Vision API
            $googleResponse = $this->googleVisionService->analyzeDocument($imagePath);

            // Parse results
            $parsedData = $this->parseGoogleResponse($googleResponse, $verification->document_type);

            // Calculate confidence score
            $confidenceScore = $this->calculateConfidenceScore($parsedData);

            // Determine if document should be accepted
            $shouldAccept = $this->shouldAcceptDocument($confidenceScore, $parsedData);

            // Prepare update data
            $updateData = [
                'confidence_score' => $confidenceScore,
                'detected_text' => $parsedData['detected_text'] ?? null,
                'detected_labels' => $parsedData['detected_labels'] ?? [],
                'google_response' => $googleResponse,
            ];

            if ($shouldAccept) {
                $updateData['verification_status'] = 'verified';
                $updateData['verified_at'] = now();
                $updateData['rejection_reason'] = null;

                // Move image to verified folder
                $this->moveImageToVerified($verification);
            } else {
                $updateData['verification_status'] = 'rejected';
                $updateData['rejection_reason'] = $this->generateRejectionReason($parsedData, $confidenceScore);
                
                // Move image to rejected folder
                $this->moveImageToRejected($verification);
            }

            // Update verification
            $verification->update($updateData);

            // Check if user's identity is now complete
            $this->checkUserVerificationComplete($verification->user_id);

            Log::channel('google-vision')->info('Document verification completed', [
                'verification_id' => $verification->id,
                'status' => $updateData['verification_status'],
                'confidence_score' => $confidenceScore
            ]);

        } catch (Exception $e) {
            Log::channel('google-vision')->error('Document verification failed', [
                'verification_id' => $verification->id,
                'error' => $e->getMessage()
            ]);

            $verification->update([
                'verification_status' => 'error',
                'retry_count' => $verification->retry_count + 1
            ]);

            throw $e;
        }
    }

    /**
     * Store document image.
     */
    public function storeImage(string $imageData, string $type, ?string $side, int $userId): string
    {
        // Decode base64 image
        $imageData = str_replace('data:image/jpeg;base64,', '', $imageData);
        $imageData = str_replace('data:image/png;base64,', '', $imageData);
        $imageData = str_replace(' ', '+', $imageData);
        $decodedImage = base64_decode($imageData);

        // Generate unique filename
        $filename = sprintf(
            '%s_%s_%s_%s.jpg',
            $userId,
            $type,
            $side ?? 'front',
            time()
        );

        // Storage path (pending folder)
        $path = config('google-vision.storage.documents.pending') . '/' . $filename;

        // Store image
        Storage::put($path, $decodedImage);

        return $path;
    }

    /**
     * Parse Google Vision response.
     */
    protected function parseGoogleResponse(array $response, string $documentType): array
    {
        $result = [
            'detected_text' => $response['full_text'] ?? '',
            'detected_labels' => array_column($response['labels'] ?? [], 'description'),
            'text_confidence' => !empty($response['texts']) ? $response['texts'][0]['confidence'] ?? 0 : 0,
            'has_key_fields' => false,
            'document_type_matched' => false
        ];

        // Check if detected labels match document type
        $documentKeywords = [
            'passport' => ['passport', 'travel document', 'identity'],
            'license' => ['driver license', 'driving license', 'license', 'permit'],
            'european_id' => ['identity card', 'id card', 'carte d\'identité', 'identity']
        ];

        $keywords = $documentKeywords[$documentType] ?? [];
        foreach ($keywords as $keyword) {
            foreach ($result['detected_labels'] as $label) {
                if (stripos($label, $keyword) !== false) {
                    $result['document_type_matched'] = true;
                    break 2;
                }
            }
        }

        // Check for key fields in text
        $keyFieldPatterns = [
            'name' => '/[A-Z]{2,}\s+[A-Z]{2,}/',
            'date' => '/\d{2}[\/\-\.]\d{2}[\/\-\.]\d{2,4}/',
            'number' => '/[A-Z0-9]{6,}/',
        ];

        $foundFields = 0;
        foreach ($keyFieldPatterns as $field => $pattern) {
            if (preg_match($pattern, $result['detected_text'])) {
                $foundFields++;
            }
        }

        $result['has_key_fields'] = $foundFields >= 2;

        return $result;
    }

    /**
     * Calculate confidence score (0-100).
     */
    protected function calculateConfidenceScore(array $parsedData): int
    {
        $score = 0;

        // Text detected and readable (40 points)
        if (!empty($parsedData['detected_text'])) {
            $textLength = strlen($parsedData['detected_text']);
            if ($textLength > 100) {
                $score += 40;
            } elseif ($textLength > 50) {
                $score += 30;
            } elseif ($textLength > 20) {
                $score += 20;
            } else {
                $score += 10;
            }
        }

        // Document type matched (30 points)
        if ($parsedData['document_type_matched']) {
            $score += 30;
        }

        // Key fields found (30 points)
        if ($parsedData['has_key_fields']) {
            $score += 30;
        }

        return min(100, $score);
    }

    /**
     * Determine if document should be accepted.
     */
    protected function shouldAcceptDocument(int $confidence, array $parsedData): bool
    {
        $threshold = config('google-vision.confidence_threshold.document', 70);
        return $confidence >= $threshold;
    }

    /**
     * Generate detailed rejection reason.
     */
    protected function generateRejectionReason(array $parsedData, int $confidence): string
    {
        $reasons = [];

        if (empty($parsedData['detected_text']) || strlen($parsedData['detected_text']) < 20) {
            $reasons[] = "• Text not readable or too short";
        }

        if (!$parsedData['document_type_matched']) {
            $reasons[] = "• Document type could not be confirmed";
        }

        if (!$parsedData['has_key_fields']) {
            $reasons[] = "• Required information not detected (name, date, number)";
        }

        if ($confidence < 50) {
            $reasons[] = "• Overall image quality too low";
        }

        $message = "❌ Document verification failed:\n\n" . implode("\n", $reasons);
        $message .= "\n\n📸 Please retake photo with:\n";
        $message .= "• Good lighting\n";
        $message .= "• All text clearly visible\n";
        $message .= "• No blur or reflections\n";
        $message .= "• Full document in frame";

        return $message;
    }

    /**
     * Move image to verified folder.
     */
    protected function moveImageToVerified(ProviderDocumentVerification $verification): void
    {
        $oldPath = $verification->image_path;
        
        $newPath = str_replace(
            config('google-vision.storage.documents.pending'),
            config('google-vision.storage.documents.verified') . '/' . $verification->document_type,
            $oldPath
        );

        if (Storage::exists($oldPath)) {
            Storage::move($oldPath, $newPath);
            $verification->update(['image_path' => $newPath]);
        }
    }

    /**
     * Move image to rejected folder.
     */
    protected function moveImageToRejected(ProviderDocumentVerification $verification): void
    {
        $oldPath = $verification->image_path;
        
        $newPath = str_replace(
            config('google-vision.storage.documents.pending'),
            config('google-vision.storage.documents.rejected'),
            $oldPath
        );

        if (Storage::exists($oldPath)) {
            Storage::move($oldPath, $newPath);
            $verification->update(['image_path' => $newPath]);
        }
    }

    /**
     * Check if user's identity verification is complete.
     */
    protected function checkUserVerificationComplete(int $userId): void
    {
        $user = User::find($userId);

        if (!$user) {
            return;
        }

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
                'user_id' => $userId
            ]);
        }
    }
}