<?php

namespace App\Services;

use Google\Cloud\Vision\V1\ImageAnnotatorClient;
use Google\Cloud\Vision\V1\Image;
use Illuminate\Support\Facades\Log;
use Exception;

class GoogleVisionApiService
{
    protected $client;

    /**
     * Initialize Google Vision API client.
     */
    public function __construct()
    {
        if (!config('google-vision.enabled')) {
            throw new Exception('Google Vision API is not enabled. Set GOOGLE_VISION_ENABLED=true in .env');
        }

        $credentialsPath = config('google-vision.credentials_path');

        if (!file_exists($credentialsPath)) {
            throw new Exception("Google Vision credentials file not found at: {$credentialsPath}");
        }

        putenv('GOOGLE_APPLICATION_CREDENTIALS=' . $credentialsPath);

        try {
            $this->client = new ImageAnnotatorClient();
            Log::channel('google-vision')->info('Google Vision client initialized successfully', [
                'credentials_path' => $credentialsPath
            ]);
        } catch (Exception $e) {
            Log::channel('google-vision')->error('Failed to initialize Google Vision client', [
                'error' => $e->getMessage(),
                'credentials_path' => $credentialsPath
            ]);
            throw $e;
        }
    }

    /**
     * Analyze a document image for verification.
     */
    public function analyzeDocument(string $imagePath): array
    {
        try {
            Log::channel('google-vision')->info('Analyzing document', ['path' => $imagePath]);

            if (!file_exists($imagePath)) {
                throw new Exception("Image file not found at: {$imagePath}");
            }

            $imageContent = file_get_contents($imagePath);
            $image = (new Image())->setContent($imageContent);

            // Detect text (OCR)
            $textResponse = $this->client->textDetection($image);
            $texts = $textResponse->getTextAnnotations();

            // Detect labels
            $labelResponse = $this->client->labelDetection($image);
            $labels = $labelResponse->getLabelAnnotations();

            $result = [
                'texts' => [],
                'labels' => [],
                'full_text' => ''
            ];

            // Extract text
            if ($texts->count() > 0) {
                $result['full_text'] = $texts[0]->getDescription();
                foreach ($texts as $text) {
                    $result['texts'][] = [
                        'description' => $text->getDescription(),
                        'confidence' => $text->getConfidence()
                    ];
                }
            }

            // Extract labels
            foreach ($labels as $label) {
                $result['labels'][] = [
                    'description' => $label->getDescription(),
                    'score' => $label->getScore(),
                    'confidence' => $label->getScore() * 100
                ];
            }

            Log::channel('google-vision')->info('Document analyzed successfully', [
                'texts_found' => count($result['texts']),
                'labels_found' => count($result['labels'])
            ]);

            return $result;

        } catch (Exception $e) {
            Log::channel('google-vision')->error('Error analyzing document', [
                'error' => $e->getMessage(),
                'path' => $imagePath
            ]);
            throw $e;
        }
    }

    /**
     * ✅ Analyze profile photo for face detection.
     */
    public function analyzeProfilePhoto(string $imagePath): array
    {
        try {
            Log::channel('google-vision')->info('Analyzing profile photo', [
                'path' => $imagePath,
                'file_exists' => file_exists($imagePath)
            ]);

            if (!file_exists($imagePath)) {
                throw new Exception("Image file not found at: {$imagePath}");
            }

            $imageContent = file_get_contents($imagePath);
            if ($imageContent === false) {
                throw new Exception("Failed to read image file at: {$imagePath}");
            }

            $image = (new Image())->setContent($imageContent);

            // Detect faces
            $faceResponse = $this->client->faceDetection($image);
            $faces = $faceResponse->getFaceAnnotations();

            // Detect labels
            $labelResponse = $this->client->labelDetection($image);
            $labels = $labelResponse->getLabelAnnotations();

            $result = [
                'faces' => [],
                'labels' => [],
                'face_count' => $faces->count()
            ];

            // Extract face information
            foreach ($faces as $face) {
                $vertices = $face->getBoundingPoly()->getVertices();
                $result['faces'][] = [
                    'confidence' => $face->getDetectionConfidence() * 100,
                    'joy' => $face->getJoyLikelihood(),
                    'vertices' => [
                        ['x' => $vertices[0]->getX(), 'y' => $vertices[0]->getY()],
                        ['x' => $vertices[1]->getX(), 'y' => $vertices[1]->getY()],
                        ['x' => $vertices[2]->getX(), 'y' => $vertices[2]->getY()],
                        ['x' => $vertices[3]->getX(), 'y' => $vertices[3]->getY()],
                    ]
                ];
            }

            // Extract labels
            foreach ($labels as $label) {
                $result['labels'][] = [
                    'description' => $label->getDescription(),
                    'score' => $label->getScore(),
                    'confidence' => $label->getScore() * 100
                ];
            }

            Log::channel('google-vision')->info('Profile photo analyzed successfully', [
                'faces_found' => $result['face_count'],
                'labels_found' => count($result['labels'])
            ]);

            return $result;

        } catch (Exception $e) {
            Log::channel('google-vision')->error('Error analyzing profile photo', [
                'error' => $e->getMessage(),
                'path' => $imagePath,
                'file_exists' => file_exists($imagePath)
            ]);
            throw $e;
        }
    }

    /**
     * Detect text only (OCR).
     */
    public function detectText(string $imagePath): array
    {
        try {
            if (!file_exists($imagePath)) {
                throw new Exception("Image file not found at: {$imagePath}");
            }

            $imageContent = file_get_contents($imagePath);
            $image = (new Image())->setContent($imageContent);

            $response = $this->client->textDetection($image);
            $texts = $response->getTextAnnotations();

            $result = [];
            foreach ($texts as $text) {
                $result[] = [
                    'description' => $text->getDescription(),
                    'confidence' => $text->getConfidence()
                ];
            }

            return $result;

        } catch (Exception $e) {
            Log::channel('google-vision')->error('Error detecting text', [
                'error' => $e->getMessage()
            ]);
            throw $e;
        }
    }

    /**
     * Detect faces only.
     */
    public function detectFaces(string $imagePath): array
    {
        try {
            if (!file_exists($imagePath)) {
                throw new Exception("Image file not found at: {$imagePath}");
            }

            $imageContent = file_get_contents($imagePath);
            $image = (new Image())->setContent($imageContent);

            $response = $this->client->faceDetection($image);
            $faces = $response->getFaceAnnotations();

            $result = [];
            foreach ($faces as $face) {
                $result[] = [
                    'confidence' => $face->getDetectionConfidence() * 100,
                    'joy' => $face->getJoyLikelihood(),
                    'sorrow' => $face->getSorrowLikelihood(),
                    'anger' => $face->getAngerLikelihood(),
                    'surprise' => $face->getSurpriseLikelihood(),
                ];
            }

            return $result;

        } catch (Exception $e) {
            Log::channel('google-vision')->error('Error detecting faces', [
                'error' => $e->getMessage()
            ]);
            throw $e;
        }
    }

    /**
     * Detect labels.
     */
    public function detectLabels(string $imagePath): array
    {
        try {
            if (!file_exists($imagePath)) {
                throw new Exception("Image file not found at: {$imagePath}");
            }

            $imageContent = file_get_contents($imagePath);
            $image = (new Image())->setContent($imageContent);

            $response = $this->client->labelDetection($image);
            $labels = $response->getLabelAnnotations();

            $result = [];
            foreach ($labels as $label) {
                $result[] = [
                    'description' => $label->getDescription(),
                    'score' => $label->getScore(),
                    'confidence' => $label->getScore() * 100
                ];
            }

            return $result;

        } catch (Exception $e) {
            Log::channel('google-vision')->error('Error detecting labels', [
                'error' => $e->getMessage()
            ]);
            throw $e;
        }
    }

    /**
     * Close the client connection.
     */
    public function __destruct()
    {
        if ($this->client) {
            $this->client->close();
        }
    }
}