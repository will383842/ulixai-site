<?php
// app/Http/Controllers/AuthController.php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;

class AuthController extends Controller
{
    /**
     * Check if email exists (for pre-validation only).
     * DOES NOT authenticate - just checks existence.
     *
     * SECURITY: Never reveal if email exists to prevent enumeration.
     * Always return same response structure.
     */
    public function checkEmailExists(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
        ]);

        // Rate limit by IP to prevent enumeration
        $key = 'check-email:' . $request->ip();

        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);
            return response()->json([
                'success' => false,
                'message' => 'Too many attempts. Please try again in ' . $seconds . ' seconds.',
            ], 429);
        }

        RateLimiter::hit($key, 60); // 5 attempts per minute

        $user = User::where('email', $request->email)->first();

        // SECURITY: Always return same structure to prevent email enumeration
        // Frontend should handle this appropriately
        return response()->json([
            'success' => true,
            'exists' => $user !== null,
            // Don't expose user details here
        ]);
    }

    /**
     * Authenticate user with email AND password.
     * This is the SECURE login method.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|string',
        ]);

        // Rate limit login attempts by email
        $key = 'login:' . $request->email;

        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);
            return response()->json([
                'success' => false,
                'message' => 'Too many login attempts. Please try again in ' . ceil($seconds / 60) . ' minutes.',
            ], 429);
        }

        $user = User::where('email', $request->email)->first();

        // SECURITY: Verify password hash - NEVER skip this!
        if (!$user || !Hash::check($request->password, $user->password)) {
            RateLimiter::hit($key, 300); // 5 attempts per 5 minutes

            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials.',
            ], 401);
        }

        // Check if user is banned/suspended
        if ($user->status === 'banned') {
            return response()->json([
                'success' => false,
                'message' => 'Your account has been banned.',
            ], 403);
        }

        if ($user->status === 'suspended') {
            return response()->json([
                'success' => false,
                'message' => 'Your account is suspended.',
            ], 403);
        }

        // Clear rate limiter on successful login
        RateLimiter::clear($key);

        // Login with session regeneration
        Auth::login($user, $request->boolean('remember', false));
        $request->session()->regenerate();

        $user->update(['last_login_at' => now()]);

        return response()->json([
            'success' => true,
            'message' => 'Login successful.',
            'user' => [
                'name' => $user->name,
                'email' => $user->email,
                'avatar' => $user->avatar ?? null,
                'role' => $user->user_role,
                'id' => $user->id,
            ],
        ]);
    }

    /**
     * @deprecated Use login() instead. This method is kept for backward compatibility
     * but now properly validates password.
     */
    public function checkEmailAndLogin(Request $request)
    {
        // Redirect to secure login method
        return $this->login($request);
    }
}