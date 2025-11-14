<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\ServiceProvider;
use Illuminate\Support\Facades\Hash;

class TestUsersSeeder extends Seeder
{
    public function run(): void
    {
        if (config('app.env') === 'production') {
            $this->command->error('🚨 INTERDIT EN PRODUCTION !');
            return;
        }

        // Supprimer les anciens users de test si existants
        User::whereIn('email', ['client@test.com', 'provider@test.com'])->delete();

        // 1. CLIENT DE TEST
        $client = User::create([
            'name' => 'Marie Dupont',
            'email' => 'client@test.com',
            'password' => Hash::make('11111111'),
            'user_role' => 'service_requester',
            'status' => 'active',
            'country' => 'France',
            'gender' => 'female',
            'phone_number' => '+33 6 12 34 56 78',
            'is_fake' => true,
            'email_verified_at' => now(),
        ]);

        // 2. PROVIDER DE TEST
        $providerUser = User::create([
            'name' => 'Jean Martin',
            'email' => 'provider@test.com',
            'password' => Hash::make('11111111'),
            'user_role' => 'service_provider',
            'status' => 'active',
            'country' => 'France',
            'gender' => 'male',
            'phone_number' => '+33 6 98 76 54 32',
            'is_fake' => true,
            'email_verified_at' => now(),
        ]);

        // 3. PROFIL SERVICE PROVIDER (sans is_fake)
        ServiceProvider::create([
            'user_id' => $providerUser->id,
            'first_name' => 'Jean',
            'last_name' => 'Martin',
            'email' => 'provider@test.com',
            'phone_number' => '+33 6 98 76 54 32',
            'country' => 'France',
            'native_language' => 'Français',
            'spoken_language' => json_encode(['Français', 'Anglais', 'Espagnol']),
            'services_to_offer_category' => json_encode(['Visas & Residence Permits', 'Banking Services', 'Housing rental']),
            'profile_description' => 'Expert en accompagnement des expatriés en France. Plus de 5 ans d\'expérience.',
            'profile_photo' => 'assets/profileImages/default-provider.jpg',
            'provider_address' => '123 Rue de la République, 75001 Paris',
            'communication_online' => true,
            'communication_inperson' => true,
            'provider_visibility' => true,
            'country_coords' => json_encode(['lat' => 48.8566, 'lng' => 2.3522]),
            'kyc_status' => 'verified',
            'points' => 150,
            'ulysse_status' => 'Top Ulysse',
            'slug' => 'jean-martin-paris',
        ]);

        $this->command->info('');
        $this->command->info('✅ Utilisateurs de test créés :');
        $this->command->info('');
        $this->command->info('👤 CLIENT:');
        $this->command->info('   Email: client@test.com');
        $this->command->info('   Pass: 11111111');
        $this->command->info('');
        $this->command->info('🔧 PROVIDER:');
        $this->command->info('   Email: provider@test.com');
        $this->command->info('   Pass: 11111111');
        $this->command->info('');
    }
}