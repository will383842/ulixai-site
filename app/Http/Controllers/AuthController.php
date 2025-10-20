<?php
// app/Http/Controllers/AuthController.php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
public function checkEmailAndLogin(Request $request)
{
    $email = $request->email;
    
    // Check if user exists
    $user = User::where('email', $email)->first();
    
    if ($user) {
        // Log in the user
        Auth::login($user);
        
        return response()->json([
            'success' => true,
            'message' => 'User logged in successfully',
            'user' => [
                'name' => $user->name,
                'email' => $user->email,
                'avatar' => $user->avatar ?? null,
                'role' => 'Service Provider', // Add default role
                'id' => $user->id
            ]
        ]);
    }
    
    return response()->json([
        'success' => false,
        'message' => 'User not found'
    ]);
}
}