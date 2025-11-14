<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        if (config('app.env') !== 'production') {
            $this->call([
                // CleanAllUsersSeeder::class,
                // DemoProvidersSeeder::class,
            ]);
        }

        $this->call([
            CountrySeeder::class,
            ReputationPointsSeeder::class,
        ]);
    }
}