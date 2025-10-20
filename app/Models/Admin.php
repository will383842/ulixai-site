<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $table = 'users'; // Use the users table
    protected $guard = 'admin';

    protected $fillable = [
        'name', 'email', 'password', 'user_role'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    // Only allow users with admin roles to authenticate as admin
    public function isAdmin()
    {
        return in_array($this->user_role, ['super_admin', 'regional_admin', 'moderator']);
    }
     public function hasAdminRole($role = null)
    {
        $roles = ['super_admin', 'regional_admin', 'moderator'];
        if ($role) {
            return $this->user_role === $role;
        }
        return in_array($this->user_role, $roles);
    }
}
