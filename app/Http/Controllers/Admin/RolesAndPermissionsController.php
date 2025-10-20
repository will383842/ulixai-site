<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RolesAndPermissionsController extends Controller
{
    public function index(Request $request)
    {
        // Only super_admin can access
        if (auth()->guard('admin')->user()->user_role !== 'super_admin') {
            abort(403, 'Unauthorized');
        }

        $admins = User::whereIn('user_role', ['super_admin', 'regional_admin', 'moderator'])->get();

        return view('admin.dashboard.roles-permissions.index', compact('admins'));
    }

    public function assignRole(Request $request, $id)
    {
        if (auth()->guard('admin')->user()->user_role !== 'super_admin') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $validated = $request->validate([
            'user_role' => 'required|in:super_admin,regional_admin,moderator',
            'password' => 'nullable|string|min:6'
        ]);

        $admin = User::findOrFail($id);
        $admin->user_role = $validated['user_role'];
        if (!empty($validated['password'])) {
            $admin->password = Hash::make($validated['password']);
        }
        $admin->save();

        return response()->json(['success' => true, 'admin' => $admin]);
    }

    public function revokeRole(Request $request, $id)
    {
        if (auth()->guard('admin')->user()->user_role !== 'super_admin') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $admin = User::findOrFail($id);
        $admin->user_role = 'service_requester';
        $admin->save();

        return response()->json(['success' => true, 'admin' => $admin]);
    }

    public function createAdmin(Request $request)
    {
        if (auth()->guard('admin')->user()->user_role !== 'super_admin') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'user_role' => 'required|in:super_admin,regional_admin,moderator'
        ]);

        $admin = new User();
        $admin->name = $validated['name'];
        $admin->email = $validated['email'];
        $admin->password = Hash::make($validated['password']);
        $admin->user_role = $validated['user_role'];
        $admin->save();

        return response()->json(['success' => true, 'admin' => $admin]);
    }

}
