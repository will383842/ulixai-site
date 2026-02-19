<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

/**
 * SecureFileController
 *
 * Serves files from private storage with authorization checks.
 * Files are stored in storage/app/uploads/ and accessed through this controller.
 *
 * SECURITY FEATURES:
 * - Path traversal prevention
 * - Authorization checks
 * - Rate limiting via middleware
 * - Proper MIME type headers
 */
class SecureFileController extends Controller
{
    /**
     * Allowed directories for file serving.
     * Prevents access to other storage locations.
     */
    private const ALLOWED_PREFIXES = [
        'uploads/assets/profileImages',
        'uploads/assets/userDocs',
        'uploads/assets/missionAttachments',
    ];

    /**
     * Serve a file from secure storage.
     *
     * @param Request $request
     * @param string $path Base64 encoded storage path
     * @return Response
     */
    public function serve(Request $request, string $path): Response
    {
        // Decode the path
        $decodedPath = base64_decode($path, true);

        if ($decodedPath === false) {
            abort(400, 'Invalid file path.');
        }

        // ═══════════════════════════════════════════════════════════
        // 🔐 SECURITY: Prevent path traversal attacks
        // ═══════════════════════════════════════════════════════════
        $normalizedPath = $this->normalizePath($decodedPath);

        if ($normalizedPath === null) {
            Log::warning('SecureFile: Path traversal attempt detected', [
                'path' => $decodedPath,
                'ip' => $request->ip(),
                'user_id' => auth()->id(),
            ]);
            abort(403, 'Access denied.');
        }

        // ═══════════════════════════════════════════════════════════
        // 🔐 SECURITY: Validate path is in allowed directories
        // ═══════════════════════════════════════════════════════════
        if (!$this->isAllowedPath($normalizedPath)) {
            Log::warning('SecureFile: Attempted access to non-allowed path', [
                'path' => $normalizedPath,
                'ip' => $request->ip(),
                'user_id' => auth()->id(),
            ]);
            abort(403, 'Access denied.');
        }

        // Check if file exists
        if (!Storage::exists($normalizedPath)) {
            abort(404, 'File not found.');
        }

        // ═══════════════════════════════════════════════════════════
        // 🔐 SECURITY: Authorization check
        // ═══════════════════════════════════════════════════════════
        if (!$this->canAccessFile($request, $normalizedPath)) {
            Log::warning('SecureFile: Unauthorized access attempt', [
                'path' => $normalizedPath,
                'ip' => $request->ip(),
                'user_id' => auth()->id(),
            ]);
            abort(403, 'Access denied.');
        }

        // Get file info
        $mimeType = Storage::mimeType($normalizedPath);
        $size = Storage::size($normalizedPath);
        $filename = basename($normalizedPath);

        // ═══════════════════════════════════════════════════════════
        // 🔐 SECURITY: Set secure headers
        // ═══════════════════════════════════════════════════════════
        $headers = [
            'Content-Type' => $mimeType,
            'Content-Length' => $size,
            'Content-Disposition' => 'inline; filename="' . $filename . '"',
            'X-Content-Type-Options' => 'nosniff',
            'Cache-Control' => 'private, max-age=3600',
        ];

        return response(Storage::get($normalizedPath), 200, $headers);
    }

    /**
     * Normalize and validate path to prevent traversal attacks.
     *
     * @param string $path
     * @return string|null Normalized path or null if invalid
     */
    private function normalizePath(string $path): ?string
    {
        // Remove null bytes
        $path = str_replace("\0", '', $path);

        // Normalize directory separators
        $path = str_replace('\\', '/', $path);

        // Check for path traversal patterns
        if (preg_match('/\.\./', $path)) {
            return null;
        }

        // Remove leading slashes
        $path = ltrim($path, '/');

        // Additional check: ensure no double slashes or weird patterns
        if (preg_match('/\/\/|\.\//', $path)) {
            return null;
        }

        return $path;
    }

    /**
     * Check if path is in allowed directories.
     *
     * @param string $path
     * @return bool
     */
    private function isAllowedPath(string $path): bool
    {
        foreach (self::ALLOWED_PREFIXES as $prefix) {
            if (str_starts_with($path, $prefix)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Check if the current user can access the file.
     *
     * @param Request $request
     * @param string $path
     * @return bool
     */
    private function canAccessFile(Request $request, string $path): bool
    {
        $user = $request->user();

        // Profile images are semi-public (viewable by authenticated users)
        if (str_contains($path, 'profileImages')) {
            return $user !== null; // Any authenticated user
        }

        // User documents are private - only owner or admin
        if (str_contains($path, 'userDocs')) {
            if ($user === null) {
                return false;
            }

            // Admin can access all docs
            if ($user->hasAdminRole()) {
                return true;
            }

            // Check if file belongs to user (path contains user ID)
            if (preg_match('/docs-(\d+)/', $path, $matches)) {
                return (int) $matches[1] === $user->id;
            }

            return false;
        }

        // Mission attachments - check mission ownership
        if (str_contains($path, 'missionAttachments')) {
            if ($user === null) {
                return false;
            }

            // Admin can access all
            if ($user->hasAdminRole()) {
                return true;
            }

            // Extract mission ID from path (e.g., missionAttachments/mission-42/file.pdf)
            if (preg_match('/mission[_-]?(\d+)/', $path, $matches)) {
                $missionId = (int) $matches[1];
                $mission = \App\Models\Mission::find($missionId);

                if (!$mission) {
                    return false;
                }

                // Requester can access their mission attachments
                if ($mission->requester_id === $user->id) {
                    return true;
                }

                // Selected provider can access
                if ($mission->selected_provider_id && $user->serviceProvider
                    && $mission->selected_provider_id === $user->serviceProvider->id) {
                    return true;
                }

                // Provider who made an offer can access
                $hasOffer = \App\Models\MissionOffer::where('mission_id', $missionId)
                    ->where('provider_id', optional($user->serviceProvider)->id)
                    ->exists();

                if ($hasOffer) {
                    return true;
                }

                return false;
            }

            // If no mission ID in path, deny
            return false;
        }

        // Default: deny
        return false;
    }
}
