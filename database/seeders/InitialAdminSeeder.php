<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class InitialAdminSeeder extends Seeder
{
    public function run(): void
    {
        // Récupérer les credentials depuis les variables d'environnement
        $adminEmail = env('ADMIN_EMAIL');
        $adminPassword = env('ADMIN_PASSWORD');
        $adminName = env('ADMIN_NAME', 'Super Admin');

        // Vérifier que les variables sont définies
        if (empty($adminEmail) || empty($adminPassword)) {
            $this->command->error('❌ ADMIN_EMAIL et ADMIN_PASSWORD doivent être définis dans le fichier .env');
            $this->command->info('Ajoutez ces lignes à votre .env :');
            $this->command->info('ADMIN_EMAIL=votre-email@example.com');
            $this->command->info('ADMIN_PASSWORD=votre-mot-de-passe-securise');
            return;
        }

        $admin = User::where('email', $adminEmail)->first();

        if ($admin) {
            // Mettre à jour le mot de passe si l'admin existe déjà
            $admin->update([
                'password' => Hash::make($adminPassword),
                'user_role' => 'super_admin',
                'status' => 'active',
            ]);
            $this->command->info("✅ Super Admin mis à jour : {$adminEmail}");
            return;
        }

        User::create([
            'name' => $adminName,
            'email' => $adminEmail,
            'password' => Hash::make($adminPassword),
            'user_role' => 'super_admin',
            'status' => 'active',
            'email_verified_at' => now(),
        ]);

        $this->command->info("✅ Super Admin créé : {$adminEmail}");
    }
}