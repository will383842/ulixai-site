<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Services\Global_Moderations\WordFilter;
use App\Services\Global_Moderations\ContactDetector;

$wordFilter = new WordFilter();
$contactDetector = new ContactDetector();

$testCases = [
    "Bonjour, j'ai besoin d'aide pour un virement Western Union à ma famille",
    "Je cherche quelqu'un pour m'aider avec mes courses",
    "Mon numéro de commande est 0612345678",
    "Contactez-moi sur WhatsApp: 06 12 34 56 78",
    "J'habite au 6 rue des fleurs, Paris",
    "Je suis disponible six jours sur sept",
    "Urgent! Envoyez l'argent maintenant via Western Union!",
    "Pouvez-vous m'aider à traduire un document?",
    "Mon email est test@gmail.com pour plus d'infos",
    "J'ai besoin d'un taxi pour aller à l'aéroport demain à 6h",
    "Le prix est de 150 euros",
    "Ma référence client est ABC123456789",
];

echo "\n=== TEST DE MODERATION ===\n";
echo "Seuils: 0-39=CLEAN | 40-79=REVIEW | 80+=BLOCKED\n";
echo str_repeat("=", 80) . "\n\n";

foreach ($testCases as $i => $text) {
    $wordResult = $wordFilter->analyze($text);
    $contactResult = $contactDetector->analyze($text);

    $totalScore = $wordResult->getScore() + $contactResult->getScore();

    if ($totalScore >= 80) {
        $status = "\033[31mBLOCKED\033[0m";
    } elseif ($totalScore >= 40) {
        $status = "\033[33mREVIEW\033[0m";
    } else {
        $status = "\033[32mCLEAN\033[0m";
    }

    echo "[" . ($i+1) . "] " . substr($text, 0, 60) . (strlen($text) > 60 ? "..." : "") . "\n";
    echo "    Words=" . $wordResult->getScore() . " | Contacts=" . $contactResult->getScore() . " | Total=" . $totalScore . " => " . $status . "\n";

    if ($wordResult->getScore() > 0) {
        echo "    >> WordFilter: " . $wordResult->getSummary() . "\n";
    }
    if ($contactResult->getScore() > 0) {
        echo "    >> ContactDetector: " . $contactResult->getSummary() . "\n";
    }
    echo "\n";
}
