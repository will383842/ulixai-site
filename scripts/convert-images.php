<?php

/**
 * 🔄 CONVERSION WebP SIMPLE
 * Convertit toutes vos images .jpg et .png en .webp
 * 
 * Usage: php convert-images.php
 */

echo "\n🔄 Conversion des images en WebP...\n\n";

$baseDir = dirname(__DIR__) . '/public/images';
$extensions = ['jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG'];
$converted = 0;
$skipped = 0;
$errors = 0;
$totalSaved = 0;

function convertImages($dir, $extensions, &$converted, &$skipped, &$errors, &$totalSaved) {
    if (!is_dir($dir)) {
        echo "❌ Dossier introuvable: $dir\n";
        return;
    }
    
    $files = scandir($dir);
    
    foreach ($files as $file) {
        if ($file === '.' || $file === '..') continue;
        
        $path = $dir . '/' . $file;
        
        // Si c'est un dossier, le parcourir
        if (is_dir($path)) {
            convertImages($path, $extensions, $converted, $skipped, $errors, $totalSaved);
            continue;
        }
        
        // Vérifier si c'est une image
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        if (!in_array($ext, $extensions)) continue;
        
        // Chemin du fichier WebP
        $webpPath = preg_replace('/\.(jpe?g|png)$/i', '.webp', $path);
        
        // Si WebP existe déjà, skip
        if (file_exists($webpPath)) {
            echo "⏭️  Existe: " . basename($path) . "\n";
            $skipped++;
            continue;
        }
        
        // Conversion
        try {
            $info = @getimagesize($path);
            
            if (!$info) {
                throw new Exception('Fichier invalide');
            }
            
            // Charger l'image
            $image = null;
            switch ($info['mime']) {
                case 'image/jpeg':
                    $image = @imagecreatefromjpeg($path);
                    break;
                case 'image/png':
                    $image = @imagecreatefrompng($path);
                    if ($image) {
                        imagealphablending($image, true);
                        imagesavealpha($image, true);
                    }
                    break;
                default:
                    throw new Exception('Type non supporté');
            }
            
            if (!$image) {
                throw new Exception('Impossible de charger');
            }
            
            // Convertir en WebP (qualité 85%)
            if (!@imagewebp($image, $webpPath, 85)) {
                throw new Exception('Échec conversion');
            }
            
            imagedestroy($image);
            
            // Calculer économie
            $originalSize = filesize($path);
            $webpSize = filesize($webpPath);
            $saved = $originalSize - $webpSize;
            $percent = round(($saved / $originalSize) * 100);
            $totalSaved += $saved;
            
            echo "✅ " . basename($path) . " → " . basename($webpPath) . " (-" . round($saved/1024, 1) . " KB / -$percent%)\n";
            $converted++;
            
        } catch (Exception $e) {
            echo "❌ " . basename($path) . " - " . $e->getMessage() . "\n";
            $errors++;
        }
    }
}

// Vérifier que le dossier existe
if (!is_dir($baseDir)) {
    die("\n❌ ERREUR: Le dossier 'public/images' n'existe pas.\n\n");
}

// Lancer la conversion
echo "📁 Dossier: $baseDir\n\n";
convertImages($baseDir, $extensions, $converted, $skipped, $errors, $totalSaved);

// Résumé
echo "\n════════════════════════════════════════\n";
echo "✅ Converties:     $converted\n";
echo "⏭️  Déjà WebP:      $skipped\n";
echo "❌ Erreurs:        $errors\n";
echo "💾 Économisé:      " . round($totalSaved/1024/1024, 2) . " MB\n";
echo "════════════════════════════════════════\n\n";

if ($converted > 0) {
    echo "🎉 Conversion terminée !\n";
    echo "💡 Les images originales (.jpg, .png) sont conservées.\n\n";
} else {
    echo "ℹ️  Aucune nouvelle image à convertir.\n\n";
}