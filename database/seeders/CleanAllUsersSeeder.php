<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\ServiceProvider;
use App\Models\ProviderReview;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CleanAllUsersSeeder extends Seeder
{
    public function run()
    {
        $this->command->warn('');
        $this->command->warn('═══════════════════════════════════════════════════════');
        $this->command->warn('🧹 NETTOYAGE : Service Providers & Service Requesters');
        $this->command->warn('═══════════════════════════════════════════════════════');
        $this->command->warn('');
        
        if (!$this->command->confirm('Êtes-vous sûr de vouloir supprimer tous les providers et requesters ?', false)) {
            $this->command->info('❌ Opération annulée.');
            return;
        }

        $this->command->info('🧹 DÉBUT DU NETTOYAGE...');
        
        $adminsCount = User::whereIn('user_role', ['admin', 'superadmin', 'moderator'])->count();
        $this->command->info("🔒 Admins protégés : {$adminsCount}");

        $reviewCount = ProviderReview::count();
        if ($reviewCount > 0) {
            ProviderReview::truncate();
            $this->command->info("✓ {$reviewCount} avis supprimés");
        }

        $providerCount = ServiceProvider::count();
        if ($providerCount > 0) {
            ServiceProvider::truncate();
            $this->command->info("✓ {$providerCount} providers supprimés");
        }

        $providersToDelete = User::where('user_role', 'service_provider')->count();
        $requestersToDelete = User::where('user_role', 'service_requester')->count();
        
        if ($providersToDelete + $requestersToDelete > 0) {
            User::whereIn('user_role', ['service_provider', 'service_requester'])->delete();
            $this->command->info("✓ {$providersToDelete} providers + {$requestersToDelete} requesters supprimés");
        }

        $photoPath = public_path('assets/profileImages/');
        if (File::exists($photoPath)) {
            $files = File::files($photoPath);
            $photoCount = 0;
            foreach ($files as $file) {
                if (preg_match('/^profile-.*\.jpg$/', $file->getFilename())) {
                    File::delete($file->getPathname());
                    $photoCount++;
                }
            }
            if ($photoCount > 0) {
                $this->command->info("✓ {$photoCount} photos supprimées");
            }
        }

        try {
            DB::statement('ALTER TABLE provider_reviews AUTO_INCREMENT = 1');
            DB::statement('ALTER TABLE service_providers AUTO_INCREMENT = 1');
            $this->command->info('✓ Compteurs réinitialisés');
        } catch (\Exception $e) {
            $this->command->warn('⚠ Erreur compteurs');
        }

        $this->command->info('');
        $this->command->info('✅ NETTOYAGE TERMINÉ !');
        $this->command->info("✅ {$adminsCount} admin(s) conservé(s)");
        $this->command->info('');
    }
}