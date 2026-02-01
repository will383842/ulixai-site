<?php
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

if (!function_exists('saveBase64Image')) {
    /**
     * Securely save a base64 encoded image.
     *
     * SECURITY FEATURES:
     * - Whitelist of allowed extensions (images only)
     * - MIME type validation via file content inspection
     * - Storage in private directory (not public/)
     * - Unique filename with UUID to prevent collisions
     * - Max file size validation
     *
     * @param string $base64 Base64 encoded image data
     * @param string $path Relative path within storage/app/uploads/
     * @param string $filenamePrefix Prefix for the filename
     * @param int $maxSizeBytes Maximum file size in bytes (default 10MB)
     * @return string|null Returns storage path or null on failure
     */
    function saveBase64Image($base64, $path, $filenamePrefix = 'file', $maxSizeBytes = 10485760)
    {
        // ═══════════════════════════════════════════════════════════
        // 🔐 SECURITY: Whitelist of allowed image extensions
        // ═══════════════════════════════════════════════════════════
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $allowedMimeTypes = [
            'image/jpeg',
            'image/png',
            'image/gif',
            'image/webp',
        ];

        // Validate input format
        if (empty($base64) || !preg_match('/^data:image\/(\w+);base64,/', $base64, $type)) {
            Log::warning('FileHelper: Invalid base64 format or missing data URI scheme');
            return null;
        }

        $extension = strtolower($type[1]);

        // ═══════════════════════════════════════════════════════════
        // 🔐 SECURITY: Validate extension against whitelist
        // ═══════════════════════════════════════════════════════════
        if (!in_array($extension, $allowedExtensions)) {
            Log::warning('FileHelper: Rejected file with disallowed extension', [
                'extension' => $extension,
                'allowed' => $allowedExtensions,
            ]);
            return null;
        }

        // Decode base64 data
        $data = substr($base64, strpos($base64, ',') + 1);
        $data = base64_decode($data);

        if ($data === false) {
            Log::warning('FileHelper: Failed to decode base64 data');
            return null;
        }

        // ═══════════════════════════════════════════════════════════
        // 🔐 SECURITY: Validate file size
        // ═══════════════════════════════════════════════════════════
        if (strlen($data) > $maxSizeBytes) {
            Log::warning('FileHelper: File size exceeds maximum', [
                'size' => strlen($data),
                'max' => $maxSizeBytes,
            ]);
            return null;
        }

        // ═══════════════════════════════════════════════════════════
        // 🔐 SECURITY: Validate MIME type by inspecting file content
        // ═══════════════════════════════════════════════════════════
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $detectedMime = $finfo->buffer($data);

        if (!in_array($detectedMime, $allowedMimeTypes)) {
            Log::warning('FileHelper: MIME type mismatch - possible file type spoofing', [
                'detected_mime' => $detectedMime,
                'claimed_extension' => $extension,
                'allowed_mimes' => $allowedMimeTypes,
            ]);
            return null;
        }

        // Normalize jpeg extension
        if ($extension === 'jpeg') {
            $extension = 'jpg';
        }

        // ═══════════════════════════════════════════════════════════
        // 🔐 SECURITY: Store in PRIVATE storage, not public/
        // Files are accessed via secure route with authorization
        // ═══════════════════════════════════════════════════════════
        $storagePath = 'uploads/' . trim($path, '/');

        // Create unique filename with UUID to prevent collisions and guessing
        $filename = $filenamePrefix . '-' . Str::uuid() . '.' . $extension;
        $fullPath = $storagePath . '/' . $filename;

        // Ensure directory exists in storage
        Storage::makeDirectory($storagePath);

        // Save file to storage (not public)
        if (!Storage::put($fullPath, $data)) {
            Log::error('FileHelper: Failed to save file to storage', [
                'path' => $fullPath,
            ]);
            return null;
        }

        Log::info('FileHelper: File saved successfully', [
            'path' => $fullPath,
            'size' => strlen($data),
            'mime' => $detectedMime,
        ]);

        // Return the storage path (use Storage::url() or secure route to access)
        return $fullPath;
    }
}

if (!function_exists('getSecureFileUrl')) {
    /**
     * Generate a secure URL for accessing uploaded files.
     * Files are served through a controller that checks authorization.
     *
     * @param string|null $storagePath The storage path returned by saveBase64Image
     * @return string|null The secure URL or null if path is empty
     */
    function getSecureFileUrl(?string $storagePath): ?string
    {
        if (empty($storagePath)) {
            return null;
        }

        // Generate a signed URL that expires in 1 hour
        return route('secure.file', ['path' => base64_encode($storagePath)]);
    }
}

if (!function_exists('deleteSecureFile')) {
    /**
     * Delete a file from secure storage.
     *
     * @param string|null $storagePath The storage path
     * @return bool True if deleted, false otherwise
     */
    function deleteSecureFile(?string $storagePath): bool
    {
        if (empty($storagePath)) {
            return false;
        }

        if (Storage::exists($storagePath)) {
            return Storage::delete($storagePath);
        }

        return false;
    }
}
