<?php
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

if (!function_exists('saveBase64Image')) {
    function saveBase64Image($base64, $path, $filenamePrefix = 'file')
    {
        // Validate input
        if (empty($base64) || !preg_match('/^data:image\/(\w+);base64,/', $base64, $type)) {
            return null;
        }

        $extension = strtolower($type[1]); // jpg, png, etc.
        $data = substr($base64, strpos($base64, ',') + 1);
        $data = base64_decode($data);

        if ($data === false) return null;

        // Ensure directory exists
        File::ensureDirectoryExists(public_path($path));

        // Create unique filename
        $filename = $filenamePrefix . '-' . Str::random(10) . '.' . $extension;
        $fullPath = public_path($path . '/' . $filename);

        // Save image
        file_put_contents($fullPath, $data);

        return $path . '/' . $filename;
    }
}
