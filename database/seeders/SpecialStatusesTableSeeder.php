<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SpecialStatus;

class SpecialStatusesTableSeeder extends Seeder
{
    public function run()
    {
        $statuses = [
            ['stitle' => 'Expatriates for 2 to 5 years',      'icon' => 'bg-pink-400'],
            ['stitle' => 'Expatriates for 6 to 10 years',     'icon' => 'bg-blue-600'],
            ['stitle' => 'Expatriates for more than 10 years','icon' => 'bg-green-400'],
            ['stitle' => 'Lawyer',                            'icon' => 'bg-pink-400'],
            ['stitle' => 'Legal advice',                      'icon' => 'bg-pink-400'],
            ['stitle' => 'Insurer',                           'icon' => 'bg-blue-600'],
            ['stitle' => 'Real estate agent',                 'icon' => 'bg-blue-600'],
            ['stitle' => 'Translator',                        'icon' => 'bg-pink-400'],
            ['stitle' => 'Guide',                             'icon' => 'bg-pink-400'],
            ['stitle' => 'Language teacher',                  'icon' => 'bg-pink-400'],
        ];

        foreach ($statuses as $status) {
            SpecialStatus::create($status);
        }
    }
}
