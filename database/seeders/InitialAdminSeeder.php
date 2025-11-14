<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class InitialAdminSeeder extends Seeder
{
    public function run(): void
    {
        if (User::where('email', 'williamsjullin@gmail.com')->exists()) {
            $this->command->warn('⚠️  Admin existe déjà.');
            return;
        }

        User::create([
            'name' => 'William Jullin',
            'email' => 'williamsjullin@gmail.com',
            'password' => Hash::make('MJ%2025%WJullin1974/*'),
            'user_role' => 'super_admin',
            'status' => 'active',
            'email_verified_at' => now(),
        ]);

        $this->command->info('✅ Super Admin créé : williamsjullin@gmail.com');
    }
}