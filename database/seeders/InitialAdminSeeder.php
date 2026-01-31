<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class InitialAdminSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('email', 'williamsjullin@gmail.com')->first();

        if ($admin) {
            // Mettre à jour le mot de passe si l'admin existe déjà
            $admin->update([
                'password' => Hash::make('MJMJsblanc19522008/*%$'),
                'user_role' => 'super_admin',
                'status' => 'active',
            ]);
            $this->command->info('✅ Super Admin mis à jour : williamsjullin@gmail.com');
            return;
        }

        User::create([
            'name' => 'William Jullin',
            'email' => 'williamsjullin@gmail.com',
            'password' => Hash::make('MJMJsblanc19522008/*%$'),
            'user_role' => 'super_admin',
            'status' => 'active',
            'email_verified_at' => now(),
        ]);

        $this->command->info('✅ Super Admin créé : williamsjullin@gmail.com');
    }
}