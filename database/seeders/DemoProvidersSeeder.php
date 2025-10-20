<?php

namespace Database\Seeders;

/**
 * DemoProvidersSeeder.php - VERSION COMPLÈTE ET VÉRIFIÉE
 * 
 * ✅ 100+ pays avec coordonnées GPS
 * ✅ Bios et commentaires dynamiques infinis
 * ✅ Numéros de téléphone avec vrais indicatifs
 * ✅ Models Eloquent (User, ServiceProvider, ProviderReview)
 * ✅ Fichier complet de bout en bout - VÉRIFIÉ 2 FOIS
 */

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\ServiceProvider;
use App\Models\ProviderReview;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DemoProvidersSeeder extends Seeder
{
    protected $jsonFile = 'ulixai_profiles.jsonl';
    protected $photoFolder = 'assets/profileImages/';
    protected $usedBios = [];
    protected $globalUsedComments = [];
    protected $phoneCounters = [];

    public function run()
    {
        $filePath = storage_path('app/' . $this->jsonFile);
        
        if (!file_exists($filePath)) {
            $this->command->error("❌ Fichier JSON introuvable : {$filePath}");
            return;
        }

        $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $this->command->info("🚀 Import de " . count($lines) . " profils...");
        $this->command->info('');

        $created = 0;
        $skipped = 0;
        $errors = [];

        foreach ($lines as $i => $line) {
            $rowNo = $i + 1;
            
            $data = json_decode($line, true);
            if (json_last_error() !== JSON_ERROR_NONE || !is_array($data)) {
                $errors[] = "Ligne {$rowNo} : JSON invalide - " . json_last_error_msg();
                $this->command->error("❌ " . end($errors));
                continue;
            }

            if (empty($data['filename']) || empty($data['first_name'])) {
                $this->command->warn("⚠️  Ligne {$rowNo} ignorée : first_name ou filename manquant");
                $skipped++;
                continue;
            }

            $photoPath = public_path($this->photoFolder . $data['filename']);
            if (!file_exists($photoPath)) {
                $this->command->warn("⚠️  Ligne {$rowNo} ignorée : photo introuvable ({$data['filename']})");
                $skipped++;
                continue;
            }

            $normalized = $this->normalizePayload($data);
            if ($normalized === null) {
                $skipped++;
                continue;
            }

            try {
                $userId = $this->createUser($normalized);
                $providerId = $this->createServiceProvider($userId, $normalized);
                $reviewsCreated = $this->createReviewsForProvider($providerId, $normalized);

                $created++;
                $this->command->info("✅ Ligne {$rowNo} : {$normalized['email']} ({$reviewsCreated} avis)");

            } catch (\Exception $e) {
                $errors[] = "Ligne {$rowNo} : " . $e->getMessage();
                $this->command->error("❌ " . end($errors));
            }
        }

        $this->command->info('');
        $this->command->info("🎉 Import terminé !");
        $this->command->info("   ✅ Créés : {$created}");
        $this->command->info("   ⚠️  Ignorés : {$skipped}");
        $this->command->info("   ❌ Erreurs : " . count($errors));
        
        if (!empty($errors)) {
            $this->command->info('');
            $this->command->warn("Détails des erreurs :");
            foreach ($errors as $e) {
                $this->command->line("  - {$e}");
            }
        }
    }

    protected function normalizePayload(array $data)
    {
        $firstName = trim($data['first_name']);
        $lastInitial = isset($data['last_initial']) ? trim($data['last_initial']) : strtoupper(substr($firstName, 0, 1));
        
        $timestamp = time() . rand(1000, 9999);
        $email = strtolower(Str::slug($firstName)) . '.' . strtolower($lastInitial) . '.' . $timestamp . '@ulixai.com';

        if (!empty($data['registration_date'])) {
            try {
                $reg = Carbon::parse($data['registration_date']);
            } catch (\Exception $e) {
                $reg = Carbon::now()->subDays(rand(30, 180));
            }
        } else {
            $reg = Carbon::now()->subDays(rand(30, 180));
        }

        $languages = $data['languages'] ?? [];
        if (!is_array($languages)) {
            $languages = array_filter(array_map('trim', explode(',', (string)$languages)));
        }

        $subcats = $data['subcategories'] ?? [];
        if (!is_array($subcats)) {
            $subcats = array_filter(array_map('trim', explode(',', (string)$subcats)));
        }
        if (empty($subcats) && !empty($data['category_l2'])) {
            $subcats = [$data['category_l2']];
        }

        return [
            'first_name' => $firstName,
            'last_initial' => $lastInitial,
            'email' => $email,
            'gender' => $data['gender'] ?? 'non_specifie',
            'ethnicity' => $data['ethnicity'] ?? null,
            'country' => $data['country'] ?? 'Unknown',
            'category_l2' => $data['category_l2'] ?? 'Autre',
            'subcategories' => $subcats,
            'registration_date' => $reg,
            'review_count' => isset($data['review_count']) ? max(0, (int)$data['review_count']) : 0,
            'languages' => $languages,
            'filename' => $data['filename'],
        ];
    }

    protected function createUser(array $data)
    {
        $user = User::create([
            'name' => $data['first_name'] . ' ' . $data['last_initial'],
            'email' => $data['email'],
            'password' => Hash::make('DemoProfile2025!'),
            'phone_number' => $this->generatePhoneNumber($data['country']),
            'gender' => $this->mapGender($data['gender']),
            'user_role' => 'service_provider',
            'status' => 'active',
            'is_fake' => 1,
            'avatar' => $this->photoFolder . $data['filename'],
            'created_at' => $data['registration_date'],
            'updated_at' => $data['registration_date'],
        ]);

        return $user->id;
    }

    protected function createServiceProvider(int $userId, array $data)
    {
        $coords = $this->generateRandomCoordinatesInCountry($data['country']);
        
        $bio = $this->generateUniqueBio(
            $data['first_name'],
            $data['subcategories'],
            $data['category_l2'],
            $data['country'],
            $data['registration_date']
        );

        $provider = ServiceProvider::create([
            'user_id' => $userId,
            'main_category' => $data['category_l2'],
            'subcategories' => json_encode($data['subcategories']),
            'country' => $data['country'],
            'latitude' => $coords['lat'],
            'longitude' => $coords['lng'],
            'bio' => $bio,
            'languages' => json_encode($data['languages']),
            'phone_number' => $this->generatePhoneNumber($data['country']),
            'is_fake' => 1,
            'created_at' => $data['registration_date'],
            'updated_at' => now(),
        ]);

        return $provider->id;
    }

    protected function generateRandomCoordinatesInCountry(string $country)
    {
        $boundaries = [
            // EUROPE
            'France' => ['lat_min' => 42.0, 'lat_max' => 51.1, 'lng_min' => -5.0, 'lng_max' => 9.6],
            'Allemagne' => ['lat_min' => 47.3, 'lat_max' => 55.1, 'lng_min' => 5.9, 'lng_max' => 15.0],
            'Espagne' => ['lat_min' => 36.0, 'lat_max' => 43.8, 'lng_min' => -9.3, 'lng_max' => 4.3],
            'Italie' => ['lat_min' => 36.6, 'lat_max' => 47.1, 'lng_min' => 6.6, 'lng_max' => 18.5],
            'Royaume-Uni' => ['lat_min' => 49.9, 'lat_max' => 60.9, 'lng_min' => -8.2, 'lng_max' => 1.8],
            'Portugal' => ['lat_min' => 36.9, 'lat_max' => 42.2, 'lng_min' => -9.5, 'lng_max' => -6.2],
            'Pays-Bas' => ['lat_min' => 50.7, 'lat_max' => 53.6, 'lng_min' => 3.3, 'lng_max' => 7.2],
            'Belgique' => ['lat_min' => 49.5, 'lat_max' => 51.5, 'lng_min' => 2.5, 'lng_max' => 6.4],
            'Suisse' => ['lat_min' => 45.8, 'lat_max' => 47.8, 'lng_min' => 5.9, 'lng_max' => 10.5],
            'Autriche' => ['lat_min' => 46.4, 'lat_max' => 49.0, 'lng_min' => 9.5, 'lng_max' => 17.2],
            'Grèce' => ['lat_min' => 34.8, 'lat_max' => 41.7, 'lng_min' => 19.4, 'lng_max' => 28.2],
            'Pologne' => ['lat_min' => 49.0, 'lat_max' => 54.8, 'lng_min' => 14.1, 'lng_max' => 24.1],
            'République Tchèque' => ['lat_min' => 48.6, 'lat_max' => 51.1, 'lng_min' => 12.1, 'lng_max' => 18.9],
            'Hongrie' => ['lat_min' => 45.7, 'lat_max' => 48.6, 'lng_min' => 16.1, 'lng_max' => 22.9],
            'Roumanie' => ['lat_min' => 43.6, 'lat_max' => 48.3, 'lng_min' => 20.3, 'lng_max' => 29.7],
            'Bulgarie' => ['lat_min' => 41.2, 'lat_max' => 44.2, 'lng_min' => 22.4, 'lng_max' => 28.6],
            'Croatie' => ['lat_min' => 42.4, 'lat_max' => 46.5, 'lng_min' => 13.5, 'lng_max' => 19.4],
            'Slovénie' => ['lat_min' => 45.4, 'lat_max' => 46.9, 'lng_min' => 13.4, 'lng_max' => 16.6],
            'Slovaquie' => ['lat_min' => 47.7, 'lat_max' => 49.6, 'lng_min' => 16.8, 'lng_max' => 22.6],
            'Lituanie' => ['lat_min' => 53.9, 'lat_max' => 56.5, 'lng_min' => 21.0, 'lng_max' => 26.8],
            'Lettonie' => ['lat_min' => 55.7, 'lat_max' => 58.1, 'lng_min' => 21.0, 'lng_max' => 28.2],
            'Estonie' => ['lat_min' => 57.5, 'lat_max' => 59.7, 'lng_min' => 21.8, 'lng_max' => 28.2],
            'Finlande' => ['lat_min' => 59.8, 'lat_max' => 70.1, 'lng_min' => 20.5, 'lng_max' => 31.6],
            'Suède' => ['lat_min' => 55.3, 'lat_max' => 69.1, 'lng_min' => 11.1, 'lng_max' => 24.2],
            'Norvège' => ['lat_min' => 57.9, 'lat_max' => 71.2, 'lng_min' => 4.5, 'lng_max' => 31.1],
            'Danemark' => ['lat_min' => 54.6, 'lat_max' => 57.8, 'lng_min' => 8.1, 'lng_max' => 15.2],
            'Islande' => ['lat_min' => 63.4, 'lat_max' => 66.5, 'lng_min' => -24.5, 'lng_max' => -13.5],
            'Irlande' => ['lat_min' => 51.4, 'lat_max' => 55.4, 'lng_min' => -10.5, 'lng_max' => -6.0],
            'Luxembourg' => ['lat_min' => 49.4, 'lat_max' => 50.2, 'lng_min' => 5.7, 'lng_max' => 6.5],
            'Malte' => ['lat_min' => 35.8, 'lat_max' => 36.1, 'lng_min' => 14.2, 'lng_max' => 14.6],
            'Chypre' => ['lat_min' => 34.6, 'lat_max' => 35.7, 'lng_min' => 32.3, 'lng_max' => 34.6],
            'Serbie' => ['lat_min' => 42.2, 'lat_max' => 46.2, 'lng_min' => 18.8, 'lng_max' => 23.0],
            'Monténégro' => ['lat_min' => 41.9, 'lat_max' => 43.6, 'lng_min' => 18.4, 'lng_max' => 20.4],
            'Bosnie-Herzégovine' => ['lat_min' => 42.6, 'lat_max' => 45.3, 'lng_min' => 15.7, 'lng_max' => 19.6],
            'Albanie' => ['lat_min' => 39.6, 'lat_max' => 42.7, 'lng_min' => 19.3, 'lng_max' => 21.1],
            'Macédoine du Nord' => ['lat_min' => 40.9, 'lat_max' => 42.4, 'lng_min' => 20.5, 'lng_max' => 23.0],
            'Kosovo' => ['lat_min' => 42.2, 'lat_max' => 43.3, 'lng_min' => 20.0, 'lng_max' => 21.8],
            
            // EUROPE DE L'EST & EX-URSS
            'Ukraine' => ['lat_min' => 44.4, 'lat_max' => 52.4, 'lng_min' => 22.1, 'lng_max' => 40.2],
            'Biélorussie' => ['lat_min' => 51.3, 'lat_max' => 56.2, 'lng_min' => 23.2, 'lng_max' => 32.8],
            'Russie' => ['lat_min' => 41.0, 'lat_max' => 70.0, 'lng_min' => 27.0, 'lng_max' => 180.0],
            'Moldavie' => ['lat_min' => 45.5, 'lat_max' => 48.5, 'lng_min' => 26.6, 'lng_max' => 30.1],
            'Géorgie' => ['lat_min' => 41.0, 'lat_max' => 43.6, 'lng_min' => 40.0, 'lng_max' => 46.7],
            'Arménie' => ['lat_min' => 38.8, 'lat_max' => 41.3, 'lng_min' => 43.4, 'lng_max' => 46.6],
            'Azerbaïdjan' => ['lat_min' => 38.4, 'lat_max' => 41.9, 'lng_min' => 44.8, 'lng_max' => 50.4],
            'Kazakhstan' => ['lat_min' => 40.9, 'lat_max' => 55.4, 'lng_min' => 46.5, 'lng_max' => 87.3],
            'Ouzbékistan' => ['lat_min' => 37.2, 'lat_max' => 45.6, 'lng_min' => 56.0, 'lng_max' => 73.1],
            'Kirghizistan' => ['lat_min' => 39.2, 'lat_max' => 43.3, 'lng_min' => 69.3, 'lng_max' => 80.3],
            'Turkménistan' => ['lat_min' => 35.1, 'lat_max' => 42.8, 'lng_min' => 52.4, 'lng_max' => 66.7],
            'Tadjikistan' => ['lat_min' => 36.7, 'lat_max' => 41.0, 'lng_min' => 67.4, 'lng_max' => 75.1],
            
            // ASIE
            'Chine' => ['lat_min' => 18.0, 'lat_max' => 53.5, 'lng_min' => 73.0, 'lng_max' => 135.0],
            'Japon' => ['lat_min' => 30.0, 'lat_max' => 45.5, 'lng_min' => 129.0, 'lng_max' => 146.0],
            'Inde' => ['lat_min' => 8.0, 'lat_max' => 35.5, 'lng_min' => 68.0, 'lng_max' => 97.4],
            'Corée du Sud' => ['lat_min' => 33.0, 'lat_max' => 38.6, 'lng_min' => 124.5, 'lng_max' => 130.0],
            'Corée du Nord' => ['lat_min' => 37.7, 'lat_max' => 43.0, 'lng_min' => 124.3, 'lng_max' => 130.7],
            'Thaïlande' => ['lat_min' => 5.6, 'lat_max' => 20.5, 'lng_min' => 97.3, 'lng_max' => 105.6],
            'Vietnam' => ['lat_min' => 8.5, 'lat_max' => 23.4, 'lng_min' => 102.1, 'lng_max' => 109.5],
            'Singapour' => ['lat_min' => 1.15, 'lat_max' => 1.47, 'lng_min' => 103.6, 'lng_max' => 104.0],
            'Indonésie' => ['lat_min' => -11.0, 'lat_max' => 6.0, 'lng_min' => 95.0, 'lng_max' => 141.0],
            'Malaisie' => ['lat_min' => 0.9, 'lat_max' => 7.4, 'lng_min' => 99.6, 'lng_max' => 119.3],
            'Philippines' => ['lat_min' => 4.6, 'lat_max' => 21.1, 'lng_min' => 116.9, 'lng_max' => 126.6],
            'Myanmar' => ['lat_min' => 9.8, 'lat_max' => 28.5, 'lng_min' => 92.2, 'lng_max' => 101.2],
            'Cambodge' => ['lat_min' => 10.4, 'lat_max' => 14.7, 'lng_min' => 102.3, 'lng_max' => 107.6],
            'Laos' => ['lat_min' => 13.9, 'lat_max' => 22.5, 'lng_min' => 100.1, 'lng_max' => 107.7],
            'Brunei' => ['lat_min' => 4.0, 'lat_max' => 5.1, 'lng_min' => 114.1, 'lng_max' => 115.4],
            'Taiwan' => ['lat_min' => 21.9, 'lat_max' => 25.3, 'lng_min' => 120.0, 'lng_max' => 122.0],
            'Hong Kong' => ['lat_min' => 22.2, 'lat_max' => 22.6, 'lng_min' => 113.8, 'lng_max' => 114.4],
            'Macao' => ['lat_min' => 22.1, 'lat_max' => 22.2, 'lng_min' => 113.5, 'lng_max' => 113.6],
            'Mongolie' => ['lat_min' => 41.6, 'lat_max' => 52.1, 'lng_min' => 87.7, 'lng_max' => 119.9],
            'Pakistan' => ['lat_min' => 23.7, 'lat_max' => 37.1, 'lng_min' => 60.9, 'lng_max' => 77.8],
            'Bangladesh' => ['lat_min' => 20.7, 'lat_max' => 26.6, 'lng_min' => 88.0, 'lng_max' => 92.7],
            'Sri Lanka' => ['lat_min' => 5.9, 'lat_max' => 9.8, 'lng_min' => 79.7, 'lng_max' => 81.9],
            'Népal' => ['lat_min' => 26.3, 'lat_max' => 30.4, 'lng_min' => 80.1, 'lng_max' => 88.2],
            'Bhoutan' => ['lat_min' => 26.7, 'lat_max' => 28.3, 'lng_min' => 88.8, 'lng_max' => 92.1],
            'Afghanistan' => ['lat_min' => 29.4, 'lat_max' => 38.5, 'lng_min' => 60.5, 'lng_max' => 75.0],
            
            // MOYEN-ORIENT
            'Turquie' => ['lat_min' => 36.0, 'lat_max' => 42.1, 'lng_min' => 26.0, 'lng_max' => 45.0],
            'Iran' => ['lat_min' => 25.1, 'lat_max' => 39.8, 'lng_min' => 44.0, 'lng_max' => 63.3],
            'Irak' => ['lat_min' => 29.1, 'lat_max' => 37.4, 'lng_min' => 38.8, 'lng_max' => 48.6],
            'Syrie' => ['lat_min' => 32.3, 'lat_max' => 37.3, 'lng_min' => 35.7, 'lng_max' => 42.4],
            'Liban' => ['lat_min' => 33.1, 'lat_max' => 34.7, 'lng_min' => 35.1, 'lng_max' => 36.6],
            'Jordanie' => ['lat_min' => 29.2, 'lat_max' => 33.4, 'lng_min' => 34.9, 'lng_max' => 39.3],
            'Israël' => ['lat_min' => 29.5, 'lat_max' => 33.3, 'lng_min' => 34.3, 'lng_max' => 35.9],
            'Palestine' => ['lat_min' => 31.4, 'lat_max' => 32.5, 'lng_min' => 34.9, 'lng_max' => 35.6],
            'Arabie Saoudite' => ['lat_min' => 16.4, 'lat_max' => 32.2, 'lng_min' => 34.6, 'lng_max' => 55.7],
            'Émirats Arabes Unis' => ['lat_min' => 22.6, 'lat_max' => 26.1, 'lng_min' => 51.6, 'lng_max' => 56.4],
            'Qatar' => ['lat_min' => 24.4, 'lat_max' => 26.2, 'lng_min' => 50.7, 'lng_max' => 51.7],
            'Koweït' => ['lat_min' => 28.5, 'lat_max' => 30.1, 'lng_min' => 46.6, 'lng_max' => 48.5],
            'Bahreïn' => ['lat_min' => 25.8, 'lat_max' => 26.3, 'lng_min' => 50.4, 'lng_max' => 50.8],
            'Oman' => ['lat_min' => 16.6, 'lat_max' => 26.4, 'lng_min' => 52.0, 'lng_max' => 59.8],
            'Yémen' => ['lat_min' => 12.1, 'lat_max' => 19.0, 'lng_min' => 42.5, 'lng_max' => 54.5],
            
            // AFRIQUE DU NORD
            'Égypte' => ['lat_min' => 22.0, 'lat_max' => 31.7, 'lng_min' => 25.0, 'lng_max' => 35.0],
            'Libye' => ['lat_min' => 19.5, 'lat_max' => 33.2, 'lng_min' => 9.4, 'lng_max' => 25.2],
            'Tunisie' => ['lat_min' => 30.2, 'lat_max' => 37.5, 'lng_min' => 7.5, 'lng_max' => 11.6],
            'Algérie' => ['lat_min' => 18.9, 'lat_max' => 37.1, 'lng_min' => -8.7, 'lng_max' => 12.0],
            'Maroc' => ['lat_min' => 27.7, 'lat_max' => 35.9, 'lng_min' => -13.2, 'lng_max' => -1.0],
            'Mauritanie' => ['lat_min' => 14.7, 'lat_max' => 27.3, 'lng_min' => -17.1, 'lng_max' => -4.8],
            'Soudan' => ['lat_min' => 8.7, 'lat_max' => 22.0, 'lng_min' => 21.8, 'lng_max' => 39.0],
            'Soudan du Sud' => ['lat_min' => 3.5, 'lat_max' => 12.2, 'lng_min' => 24.1, 'lng_max' => 35.9],
            
            // AFRIQUE DE L'OUEST
            'Sénégal' => ['lat_min' => 12.3, 'lat_max' => 16.7, 'lng_min' => -17.5, 'lng_max' => -11.4],
            'Mali' => ['lat_min' => 10.1, 'lat_max' => 25.0, 'lng_min' => -12.2, 'lng_max' => 4.2],
            'Niger' => ['lat_min' => 11.7, 'lat_max' => 23.5, 'lng_min' => 0.2, 'lng_max' => 16.0],
            'Burkina Faso' => ['lat_min' => 9.4, 'lat_max' => 15.1, 'lng_min' => -5.5, 'lng_max' => 2.4],
            'Côte d\'Ivoire' => ['lat_min' => 4.4, 'lat_max' => 10.7, 'lng_min' => -8.6, 'lng_max' => -2.5],
            'Ghana' => ['lat_min' => 4.7, 'lat_max' => 11.2, 'lng_min' => -3.3, 'lng_max' => 1.2],
            'Togo' => ['lat_min' => 6.1, 'lat_max' => 11.1, 'lng_min' => -0.1, 'lng_max' => 1.8],
            'Bénin' => ['lat_min' => 6.2, 'lat_max' => 12.4, 'lng_min' => 0.8, 'lng_max' => 3.9],
            'Nigeria' => ['lat_min' => 4.3, 'lat_max' => 13.9, 'lng_min' => 2.7, 'lng_max' => 14.7],
            'Guinée' => ['lat_min' => 7.2, 'lat_max' => 12.7, 'lng_min' => -15.1, 'lng_max' => -7.6],
            'Sierra Leone' => ['lat_min' => 6.9, 'lat_max' => 10.0, 'lng_min' => -13.3, 'lng_max' => -10.3],
            'Liberia' => ['lat_min' => 4.3, 'lat_max' => 8.6, 'lng_min' => -11.5, 'lng_max' => -7.4],
            'Gambie' => ['lat_min' => 13.1, 'lat_max' => 13.8, 'lng_min' => -16.8, 'lng_max' => -13.8],
            
            // AFRIQUE CENTRALE
            'Cameroun' => ['lat_min' => 1.7, 'lat_max' => 13.1, 'lng_min' => 8.5, 'lng_max' => 16.2],
            'Gabon' => ['lat_min' => -3.9, 'lat_max' => 2.3, 'lng_min' => 8.7, 'lng_max' => 14.5],
            'Congo' => ['lat_min' => -5.0, 'lat_max' => 3.7, 'lng_min' => 11.2, 'lng_max' => 18.6],
            'RD Congo' => ['lat_min' => -13.5, 'lat_max' => 5.4, 'lng_min' => 12.2, 'lng_max' => 31.3],
            'République Centrafricaine' => ['lat_min' => 2.2, 'lat_max' => 11.0, 'lng_min' => 14.4, 'lng_max' => 27.5],
            'Tchad' => ['lat_min' => 7.4, 'lat_max' => 23.4, 'lng_min' => 13.5, 'lng_max' => 24.0],
            
            // AFRIQUE DE L'EST
            'Kenya' => ['lat_min' => -4.7, 'lat_max' => 5.5, 'lng_min' => 33.9, 'lng_max' => 41.9],
            'Tanzanie' => ['lat_min' => -11.7, 'lat_max' => -1.0, 'lng_min' => 29.3, 'lng_max' => 40.5],
            'Ouganda' => ['lat_min' => -1.5, 'lat_max' => 4.2, 'lng_min' => 29.6, 'lng_max' => 35.0],
            'Rwanda' => ['lat_min' => -2.8, 'lat_max' => -1.1, 'lng_min' => 28.9, 'lng_max' => 30.9],
            'Burundi' => ['lat_min' => -4.5, 'lat_max' => -2.3, 'lng_min' => 29.0, 'lng_max' => 30.8],
            'Éthiopie' => ['lat_min' => 3.4, 'lat_max' => 14.9, 'lng_min' => 33.0, 'lng_max' => 48.0],
            'Somalie' => ['lat_min' => -1.7, 'lat_max' => 12.0, 'lng_min' => 40.9, 'lng_max' => 51.4],
            'Djibouti' => ['lat_min' => 10.9, 'lat_max' => 12.7, 'lng_min' => 41.8, 'lng_max' => 43.4],
            'Érythrée' => ['lat_min' => 12.4, 'lat_max' => 18.0, 'lng_min' => 36.4, 'lng_max' => 43.1],
            
            // AFRIQUE AUSTRALE
            'Afrique du Sud' => ['lat_min' => -34.8, 'lat_max' => -22.1, 'lng_min' => 16.5, 'lng_max' => 32.9],
            'Namibie' => ['lat_min' => -28.9, 'lat_max' => -17.0, 'lng_min' => 11.7, 'lng_max' => 25.3],
            'Botswana' => ['lat_min' => -26.9, 'lat_max' => -17.8, 'lng_min' => 19.9, 'lng_max' => 29.4],
            'Zimbabwe' => ['lat_min' => -22.4, 'lat_max' => -15.6, 'lng_min' => 25.2, 'lng_max' => 33.1],
            'Zambie' => ['lat_min' => -18.1, 'lat_max' => -8.2, 'lng_min' => 21.9, 'lng_max' => 33.7],
            'Mozambique' => ['lat_min' => -26.9, 'lat_max' => -10.5, 'lng_min' => 30.2, 'lng_max' => 40.8],
            'Angola' => ['lat_min' => -18.0, 'lat_max' => -4.4, 'lng_min' => 11.6, 'lng_max' => 24.1],
            'Madagascar' => ['lat_min' => -25.6, 'lat_max' => -12.0, 'lng_min' => 43.2, 'lng_max' => 50.5],
            
            // AMÉRIQUES
            'Canada' => ['lat_min' => 41.7, 'lat_max' => 83.1, 'lng_min' => -141.0, 'lng_max' => -52.6],
            'États-Unis' => ['lat_min' => 25.0, 'lat_max' => 49.0, 'lng_min' => -125.0, 'lng_max' => -66.0],
            'Mexique' => ['lat_min' => 14.5, 'lat_max' => 32.7, 'lng_min' => -118.4, 'lng_max' => -86.7],
            'Brésil' => ['lat_min' => -33.7, 'lat_max' => 5.3, 'lng_min' => -73.9, 'lng_max' => -34.8],
            'Argentine' => ['lat_min' => -55.0, 'lat_max' => -21.8, 'lng_min' => -73.6, 'lng_max' => -53.6],
            'Chili' => ['lat_min' => -55.9, 'lat_max' => -17.5, 'lng_min' => -75.6, 'lng_max' => -66.4],
            'Colombie' => ['lat_min' => -4.2, 'lat_max' => 12.5, 'lng_min' => -79.0, 'lng_max' => -66.9],
            'Pérou' => ['lat_min' => -18.3, 'lat_max' => -0.0, 'lng_min' => -81.3, 'lng_max' => -68.7],
            'Venezuela' => ['lat_min' => 0.6, 'lat_max' => 12.2, 'lng_min' => -73.4, 'lng_max' => -59.8],
            'Équateur' => ['lat_min' => -5.0, 'lat_max' => 1.7, 'lng_min' => -81.1, 'lng_max' => -75.2],
            'Bolivie' => ['lat_min' => -22.9, 'lat_max' => -9.7, 'lng_min' => -69.6, 'lng_max' => -57.5],
            'Paraguay' => ['lat_min' => -27.6, 'lat_max' => -19.3, 'lng_min' => -62.6, 'lng_max' => -54.3],
            'Uruguay' => ['lat_min' => -35.0, 'lat_max' => -30.1, 'lng_min' => -58.4, 'lng_max' => -53.1],
            
            // OCÉANIE
            'Australie' => ['lat_min' => -43.6, 'lat_max' => -10.7, 'lng_min' => 113.2, 'lng_max' => 153.6],
            'Nouvelle-Zélande' => ['lat_min' => -47.3, 'lat_max' => -34.4, 'lng_min' => 166.4, 'lng_max' => 178.6],
        ];

        if (!isset($boundaries[$country])) {
            return ['lat' => 48.8566, 'lng' => 2.3522];
        }

        $bounds = $boundaries[$country];
        $lat = $bounds['lat_min'] + (mt_rand() / mt_getrandmax()) * ($bounds['lat_max'] - $bounds['lat_min']);
        $lng = $bounds['lng_min'] + (mt_rand() / mt_getrandmax()) * ($bounds['lng_max'] - $bounds['lng_min']);

        return [
            'lat' => round($lat, 6),
            'lng' => round($lng, 6),
        ];
    }

    protected function generatePhoneNumber(string $country)
    {
        $countryDialCodes = [
            // EUROPE
            'France' => '+33', 'Allemagne' => '+49', 'Espagne' => '+34', 'Italie' => '+39',
            'Royaume-Uni' => '+44', 'Portugal' => '+351', 'Pays-Bas' => '+31', 'Belgique' => '+32',
            'Suisse' => '+41', 'Autriche' => '+43', 'Grèce' => '+30', 'Pologne' => '+48',
            'République Tchèque' => '+420', 'Hongrie' => '+36', 'Roumanie' => '+40', 'Bulgarie' => '+359',
            'Croatie' => '+385', 'Slovénie' => '+386', 'Slovaquie' => '+421', 'Lituanie' => '+370',
            'Lettonie' => '+371', 'Estonie' => '+372', 'Finlande' => '+358', 'Suède' => '+46',
            'Norvège' => '+47', 'Danemark' => '+45', 'Islande' => '+354', 'Irlande' => '+353',
            'Luxembourg' => '+352', 'Malte' => '+356', 'Chypre' => '+357', 'Serbie' => '+381',
            'Monténégro' => '+382', 'Bosnie-Herzégovine' => '+387', 'Albanie' => '+355',
            'Macédoine du Nord' => '+389', 'Kosovo' => '+383',
            
            // EUROPE DE L'EST & EX-URSS
            'Ukraine' => '+380', 'Biélorussie' => '+375', 'Russie' => '+7', 'Moldavie' => '+373',
            'Géorgie' => '+995', 'Arménie' => '+374', 'Azerbaïdjan' => '+994', 'Kazakhstan' => '+7',
            'Ouzbékistan' => '+998', 'Kirghizistan' => '+996', 'Turkménistan' => '+993', 'Tadjikistan' => '+992',
            
            // ASIE
            'Chine' => '+86', 'Japon' => '+81', 'Inde' => '+91', 'Corée du Sud' => '+82',
            'Corée du Nord' => '+850', 'Thaïlande' => '+66', 'Vietnam' => '+84', 'Singapour' => '+65',
            'Indonésie' => '+62', 'Malaisie' => '+60', 'Philippines' => '+63', 'Myanmar' => '+95',
            'Cambodge' => '+855', 'Laos' => '+856', 'Brunei' => '+673', 'Taiwan' => '+886',
            'Hong Kong' => '+852', 'Macao' => '+853', 'Mongolie' => '+976', 'Pakistan' => '+92',
            'Bangladesh' => '+880', 'Sri Lanka' => '+94', 'Népal' => '+977', 'Bhoutan' => '+975',
            'Afghanistan' => '+93',
            
            // MOYEN-ORIENT
            'Turquie' => '+90', 'Iran' => '+98', 'Irak' => '+964', 'Syrie' => '+963',
            'Liban' => '+961', 'Jordanie' => '+962', 'Israël' => '+972', 'Palestine' => '+970',
            'Arabie Saoudite' => '+966', 'Émirats Arabes Unis' => '+971', 'Qatar' => '+974',
            'Koweït' => '+965', 'Bahreïn' => '+973', 'Oman' => '+968', 'Yémen' => '+967',
            
            // AFRIQUE
            'Égypte' => '+20', 'Libye' => '+218', 'Tunisie' => '+216', 'Algérie' => '+213',
            'Maroc' => '+212', 'Mauritanie' => '+222', 'Soudan' => '+249', 'Soudan du Sud' => '+211',
            'Sénégal' => '+221', 'Mali' => '+223', 'Niger' => '+227', 'Burkina Faso' => '+226',
            'Côte d\'Ivoire' => '+225', 'Ghana' => '+233', 'Togo' => '+228', 'Bénin' => '+229',
            'Nigeria' => '+234', 'Guinée' => '+224', 'Sierra Leone' => '+232', 'Liberia' => '+231',
            'Gambie' => '+220', 'Cameroun' => '+237', 'Gabon' => '+241', 'Congo' => '+242',
            'RD Congo' => '+243', 'République Centrafricaine' => '+236', 'Tchad' => '+235',
            'Kenya' => '+254', 'Tanzanie' => '+255', 'Ouganda' => '+256', 'Rwanda' => '+250',
            'Burundi' => '+257', 'Éthiopie' => '+251', 'Somalie' => '+252', 'Djibouti' => '+253',
            'Érythrée' => '+291', 'Afrique du Sud' => '+27', 'Namibie' => '+264', 'Botswana' => '+267',
            'Zimbabwe' => '+263', 'Zambie' => '+260', 'Mozambique' => '+258', 'Angola' => '+244',
            'Madagascar' => '+261',
            
            // AMÉRIQUES
            'Canada' => '+1', 'États-Unis' => '+1', 'Mexique' => '+52', 'Brésil' => '+55',
            'Argentine' => '+54', 'Chili' => '+56', 'Colombie' => '+57', 'Pérou' => '+51',
            'Venezuela' => '+58', 'Équateur' => '+593', 'Bolivie' => '+591', 'Paraguay' => '+595',
            'Uruguay' => '+598',
            
            // OCÉANIE
            'Australie' => '+61', 'Nouvelle-Zélande' => '+64',
        ];

        $dialCode = $countryDialCodes[$country] ?? '+33';
        
        if (!isset($this->phoneCounters[$country])) {
            $this->phoneCounters[$country] = rand(100000, 999999);
        }
        
        $this->phoneCounters[$country]++;
        $number = $this->phoneCounters[$country];
        
        if (in_array($country, ['France', 'Belgique', 'Suisse'])) {
            return $dialCode . ' 6' . substr(str_pad($number, 8, '0', STR_PAD_LEFT), 0, 8);
        } elseif (in_array($country, ['États-Unis', 'Canada'])) {
            return $dialCode . ' 555' . substr(str_pad($number, 7, '0', STR_PAD_LEFT), 0, 7);
        } else {
            return $dialCode . substr(str_pad($number, 9, '0', STR_PAD_LEFT), 0, 9);
        }
    }

    protected function mapGender(string $gender)
    {
        $mapping = [
            'homme' => 'male',
            'femme' => 'female',
            'male' => 'male',
            'female' => 'female',
        ];

        return $mapping[strtolower($gender)] ?? 'non_specifie';
    }

    protected function generateUniqueBio(string $firstName, array $subcategories, string $category, string $country, Carbon $registrationDate)
    {
        $days = $registrationDate->diffInDays(Carbon::now());
        
        if ($days > 90) {
            $targetLength = rand(150, 250);
        } elseif ($days > 30) {
            $targetLength = rand(80, 150);
        } else {
            $targetLength = rand(40, 80);
        }

        $maxAttempts = 50;
        $attempt = 0;
        
        while ($attempt < $maxAttempts) {
            $bio = $this->buildDynamicBio($firstName, $subcategories, $category, $country, $targetLength);
            
            if (!in_array($bio, $this->usedBios, true)) {
                $this->usedBios[] = $bio;
                return $bio;
            }
            $attempt++;
        }

        $bio = $this->buildDynamicBio($firstName, $subcategories, $category, $country, $targetLength);
        $this->usedBios[] = $bio;
        return $bio;
    }

    protected function buildDynamicBio(string $firstName, array $subcategories, string $category, string $country, int $targetLength)
    {
        $parts = [];
        
        $intros = [
            "{$firstName} accompagne les expatriés",
            "{$firstName} aide les nouveaux arrivants",
            "Installé en {$country}, {$firstName} facilite",
            "{$firstName} propose des services",
            "Professionnel expérimenté, {$firstName} assiste",
            "{$firstName} coordonne",
            "Basé en {$country}, {$firstName} accompagne",
            "{$firstName} simplifie",
            "Expert local, {$firstName} guide",
            "{$firstName} prend en charge",
            "Spécialiste installé en {$country}, {$firstName} offre",
            "{$firstName} met son expertise au service",
            "Depuis son installation en {$country}, {$firstName} aide",
            "Consultant basé en {$country}, {$firstName} accompagne",
        ];
        $parts[] = $intros[array_rand($intros)];

        if (!empty($subcategories)) {
            $domains = $this->generateDomainDescription($subcategories);
            $parts[] = $domains;
        } else {
            $generic = [
                "dans leurs démarches quotidiennes",
                "pour une installation réussie",
                "sur des sujets pratiques",
                "dans toutes leurs démarches administratives",
                "pour faciliter leur intégration",
            ];
            $parts[] = $generic[array_rand($generic)];
        }

        $bio = implode(' ', $parts) . '.';

        if (strlen($bio) < $targetLength) {
            $bio .= ' ' . $this->generateAdditionalDetails($firstName, $subcategories, $country);
        }

        return trim($bio);
    }

    protected function generateDomainDescription(array $subcategories)
    {
        $connectors = [
            "dans les domaines suivants :",
            "pour",
            "sur des questions de",
            "notamment pour",
            "en particulier sur",
            "spécialement pour",
            "principalement pour",
        ];
        
        $connector = $connectors[array_rand($connectors)];
        $selected = array_slice($subcategories, 0, rand(2, min(4, count($subcategories))));
        shuffle($selected);
        
        if (count($selected) === 1) {
            return $connector . ' ' . $this->humanizeSubcategory($selected[0]);
        } elseif (count($selected) === 2) {
            return $connector . ' ' . $this->humanizeSubcategory($selected[0]) . ' et ' . $this->humanizeSubcategory($selected[1]);
        } else {
            $last = array_pop($selected);
            return $connector . ' ' . implode(', ', array_map([$this, 'humanizeSubcategory'], $selected)) . ' et ' . $this->humanizeSubcategory($last);
        }
    }

    protected function humanizeSubcategory(string $subcat)
    {
        $map = [
            'Civil Status' => ['actes d\'état civil', 'documents d\'état civil', 'certificats officiels'],
            'Embassy' => ['démarches consulaires', 'services d\'ambassade', 'procédures consulaires'],
            'Visas & Residence Permits' => ['visas', 'titres de séjour', 'permis de résidence'],
            'Banking Services' => ['ouverture de comptes', 'services bancaires', 'démarches bancaires'],
            'Housing rental' => ['location de logement', 'recherche d\'appartement', 'location immobilière'],
            'Job search' => ['recherche d\'emploi', 'recherche de travail', 'orientation professionnelle'],
            'Transport Solutions' => ['solutions de transport', 'mobilité', 'déplacements'],
            'Childcare / Elderly care' => ['garde d\'enfants', 'aide aux seniors', 'solutions de garde'],
            'Languages (adults, students, children)' => ['cours de langues', 'apprentissage linguistique'],
            'Schooling for Children / Students' => ['scolarisation', 'inscription scolaire', 'choix d\'école'],
            'Health Insurance & Coverage' => ['couverture santé', 'assurances santé', 'protection médicale'],
            'Medical Consultations' => ['consultations médicales', 'rendez-vous médicaux'],
            'Real Estate Purchase / Sale' => ['achat immobilier', 'vente immobilière', 'transactions immobilières'],
            'Moving organization' => ['déménagement', 'organisation de déménagement', 'logistique'],
            'Document translation' => ['traduction de documents', 'traductions administratives'],
            'Certified and legalized translations' => ['traductions certifiées', 'traductions assermentées'],
        ];

        foreach ($map as $key => $variants) {
            if (stripos($subcat, $key) !== false || stripos($key, $subcat) !== false) {
                return $variants[array_rand($variants)];
            }
        }

        return strtolower(trim($subcat));
    }

    protected function generateAdditionalDetails(string $firstName, array $subcategories, string $country)
    {
        $details = [
            "L'approche est pragmatique et centrée sur vos besoins réels.",
            "Chaque situation est unique et mérite une réponse personnalisée.",
            "La communication est fluide et les délais sont respectés.",
            "L'expérience terrain permet d'anticiper les obstacles courants.",
            "Les démarches sont expliquées clairement, sans jargon inutile.",
            "La disponibilité et la réactivité sont au cœur du service.",
            "L'objectif : vous faire gagner du temps et éviter les erreurs.",
            "Familier avec les administrations locales, {$firstName} sait où aller.",
            "Le service est adapté aux contraintes des expatriés.",
            "Réseau de professionnels de confiance pour les besoins spécifiques.",
            "Suivi personnalisé jusqu'à la résolution complète.",
            "Formules flexibles selon l'ampleur de votre projet.",
            "Échanges possibles en plusieurs langues.",
            "Connaissance approfondie des réglementations locales.",
            "Un accompagnement humain avant tout.",
        ];

        $selected = [];
        $count = rand(1, 2);
        shuffle($details);
        
        for ($i = 0; $i < $count && $i < count($details); $i++) {
            $detail = str_replace('{$firstName}', $firstName, $details[$i]);
            $selected[] = $detail;
        }

        return implode(' ', $selected);
    }

    protected function createReviewsForProvider(int $providerId, array $data)
    {
        $reviewCount = $data['review_count'];
        if ($reviewCount <= 0) {
            return 0;
        }

        $created = 0;
        $localUsedComments = [];

        for ($i = 0; $i < $reviewCount; $i++) {
            $rating = $this->sampleRating();
            $comment = $this->generateUniqueComment($rating, $data['subcategories'], $localUsedComments);
            
            $clientEmail = $this->generateUniqueClientEmail($data['first_name'], $providerId, $i);
            $clientUser = User::create([
                'name' => 'Client ' . Str::random(6),
                'email' => $clientEmail,
                'password' => Hash::make(Str::random(16)),
                'user_role' => 'client',
                'status' => 'active',
                'is_fake' => 1,
                'created_at' => $data['registration_date']->copy()->addWeeks($i)->addDays(rand(0, 6)),
                'updated_at' => now(),
            ]);

            ProviderReview::create([
                'provider_id' => $providerId,
                'user_id' => $clientUser->id,
                'rating' => $rating,
                'comment' => $comment,
                'created_at' => $data['registration_date']->copy()->addWeeks($i)->addDays(rand(0, 6)),
                'updated_at' => now(),
            ]);

            $created++;
        }

        return $created;
    }

    protected function generateUniqueComment(int $rating, array $subcategories, array &$localUsed)
    {
        $maxAttempts = 100;
        $attempt = 0;

        while ($attempt < $maxAttempts) {
            $comment = $this->buildDynamicComment($rating, $subcategories);
            
            if (!in_array($comment, $this->globalUsedComments, true) && !in_array($comment, $localUsed, true)) {
                $this->globalUsedComments[] = $comment;
                $localUsed[] = $comment;
                return $comment;
            }
            
            $attempt++;
        }

        $comment = $this->buildDynamicComment($rating, $subcategories);
        $this->globalUsedComments[] = $comment;
        $localUsed[] = $comment;
        return $comment;
    }

    protected function buildDynamicComment(int $rating, array $subcategories)
    {
        if ($rating === 5) {
            return $this->buildFiveStarComment($subcategories);
        } elseif ($rating === 4) {
            return $this->buildFourStarComment($subcategories);
        } else {
            return $this->buildThreeStarComment($subcategories);
        }
    }

    protected function buildFiveStarComment(array $subcategories)
    {
        $starts = [
            'Excellent service', 'Vraiment top', 'Super expérience', 'Parfait',
            'Impeccable', 'Très satisfait', 'Je recommande vivement', 'Service au top',
            'Prestation de qualité', 'Nickel', 'Au top', 'Très pro',
            'Efficace et rapide', 'Exactement ce qu\'il me fallait', 'Rien à redire',
        ];

        $middles = [
            ', tout s\'est bien passé', ', aucun souci', ', démarches facilitées',
            ', très réactif', ', bon suivi', ', je suis ravi', ', vraiment efficace',
            ', gain de temps énorme', ', accompagnement nickel', ', super accompagnement',
            ', je recommande', ', c\'était fluide', ', communication au top',
        ];

        $ends = [
            '!', '. Merci.', '. Je reviendrai.', '. Top pour les expatriés.',
            '. Ulixai est vraiment utile.', '. Parfait pour une installation sereine.',
            '. Un vrai soulagement.', '. Je le conseille.', '.',
        ];

        $comment = $starts[array_rand($starts)] . $middles[array_rand($middles)] . $ends[array_rand($ends)];

        if (rand(1, 3) === 1 && !empty($subcategories)) {
            $contextDetail = $this->getContextualDetail($subcategories);
            if ($contextDetail) {
                $comment .= ' ' . $contextDetail;
            }
        }

        return $comment;
    }

    protected function buildFourStarComment(array $subcategories)
    {
        $starts = [
            'Bon service', 'Très satisfait', 'Satisfait globalement', 'Bonne prestation',
            'Service sérieux', 'Plutôt content', 'Bon accompagnement', 'Prestation correcte',
        ];

        $middles = [
            ', quelques petits détails à améliorer mais', ', globalement',
            ', dans l\'ensemble', ', malgré quelques ajustements nécessaires', ',',
        ];

        $ends = [
            'c\'est bien.', 'je recommande.', 'ça fait le job.', 'c\'est utile.',
            'résultat positif.', 'mission accomplie.', 'l\'objectif est atteint.',
        ];

        return $starts[array_rand($starts)] . $middles[array_rand($middles)] . ' ' . $ends[array_rand($ends)];
    }

    protected function buildThreeStarComment(array $subcategories)
    {
        $starts = [
            'Service correct', 'Plutôt satisfait', 'Ça va', 'Résultat obtenu',
            'Mission accomplie', 'Convenable', 'Pas mal',
        ];

        $middles = [
            ', quelques lenteurs', ', communication parfois compliquée',
            ', quelques ajustements à faire', ', mais',
        ];

        $ends = [
            'mais le résultat est là.', 'mais ça a fonctionné.', 'l\'essentiel est fait.',
            'c\'est positif au final.', 'je garderai l\'adresse.',
        ];

        return $starts[array_rand($starts)] . $middles[array_rand($middles)] . ' ' . $ends[array_rand($ends)];
    }

    protected function getContextualDetail(array $subcategories)
    {
        $details = [
            'visa' => ['Visa obtenu sans souci.', 'Dossier bien préparé.'],
            'housing' => ['Logement trouvé rapidement.', 'Bonne négociation.'],
            'bank' => ['Compte ouvert facilement.', 'Démarches bancaires ok.'],
            'health' => ['Bon accompagnement santé.', 'Médecins trouvés.'],
            'job' => ['CV bien retravaillé.', 'Bon coaching emploi.'],
            'school' => ['Enfants bien inscrits.', 'École trouvée.'],
            'translation' => ['Traductions conformes.', 'Documents bien traduits.'],
            'legal' => ['Conseils juridiques clairs.', 'Contrat vérifié.'],
            'moving' => ['Déménagement bien organisé.', 'Transport sécurisé.'],
        ];

        foreach ($details as $keyword => $phrases) {
            foreach ($subcategories as $sub) {
                if (stripos(strtolower($sub), $keyword) !== false) {
                    return $phrases[array_rand($phrases)];
                }
            }
        }

        return null;
    }

    protected function sampleRating()
    {
        $r = rand(1, 100);
        if ($r <= 70) return 5;
        if ($r <= 97) return 4;
        return 3;
    }

    protected function generateUniqueClientEmail(string $firstName, int $providerId, int $index)
    {
        $base = strtolower(Str::slug($firstName)) . '.client' . $providerId . '.' . $index . '.' . time();
        return $base . '@client-ulixai.com';
    }
}