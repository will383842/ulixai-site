<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    public function json(Request $request)
    {
        $q        = trim((string) $request->input('q', ''));
        $perPage  = (int) $request->input('per_page', 12);

        $query = Role::query()
            ->when($q !== '', function ($qr) use ($q) {
                $qr->where(function ($w) use ($q) {
                    $w->where('title', 'like', "%{$q}%")
                      ->orWhere('short_tagline', 'like', "%{$q}%")
                      ->orWhere('accent_class', 'like', "%{$q}%");
                });
            })
            ->orderByDesc('id');

        $paginator = $query->paginate($perPage);

        return response()->json([
            'data' => $paginator->items(),
            'meta' => [
                'current_page' => $paginator->currentPage(),
                'last_page'    => $paginator->lastPage(),
                'per_page'     => $paginator->perPage(),
                'total'        => $paginator->total(),
            ],
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'         => ['required', 'string', 'max:190'],
            'emoji'         => ['nullable', 'string', 'max:16'],
            'short_tagline' => ['required', 'string', 'max:255'],
            'accent_class'  => ['required', 'string', 'max:60'],
            'is_active'     => ['nullable', 'boolean'],
        ]);

        $role = Role::create([
            'title'         => $data['title'],
            'emoji'         => $data['emoji'] ?? null,
            'short_tagline' => $data['short_tagline'],
            'accent_class'  => $data['accent_class'],
            'is_active'     => (bool) ($data['is_active'] ?? false),
        ]);

        return response()->json(['data' => $role], 201);
    }

    public function update(Request $request, Role $role)
    {
        // Allow partial updates (PATCH)
        $data = $request->validate([
            'title'         => ['sometimes', 'required', 'string', 'max:190'],
            'emoji'         => ['sometimes', 'nullable', 'string', 'max:16'],
            'short_tagline' => ['sometimes', 'required', 'string', 'max:255'],
            'accent_class'  => ['sometimes', 'required', 'string', 'max:60'],
            'is_active'     => ['sometimes', 'boolean'],
        ]);

        $role->fill($data);
        if (array_key_exists('is_active', $data)) {
            $role->is_active = (bool) $data['is_active'];
        }
        $role->save();

        return response()->json(['data' => $role]);
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return response()->json([], 204);
    }
}
