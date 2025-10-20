<?php
declare(strict_types=1);

/**
 * FaceTools — Annotation d'images IA (AJAX + multi-sources + fallback + diagnostics)
 * Fichier : /home/juwi2670/public_html/faces-tool.php
 */

//////////////////////////
// Boot & Session
//////////////////////////
error_reporting(E_ALL);
ini_set('display_errors', '1');
set_time_limit(0);

$secure = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || ((int)($_SERVER['SERVER_PORT'] ?? 80) === 443);
session_set_cookie_params([
    'lifetime' => 0,
    'path'     => '/',
    'secure'   => $secure,
    'httponly' => true,
    'samesite' => 'Lax',
]);
@session_start();

//////////////////////////
// Configuration
//////////////////////////
define('ACCESS_PASSWORD', getenv('FACETOOLS_PASSWORD') ?: 'Ulx#7kP9@mZ2$vR5&nQ8!wL3^yF6');

define('ROOT_DIR', '/home/juwi2670/public_html');
$facesDir = ROOT_DIR . '/faces/';
$jsonFile = ROOT_DIR . '/faces-annotations.json';

$facesUrl = '/faces/';
$selfUrl  = '/faces-tool.php';

// timeouts
define('FETCH_TIMEOUT', 8);
define('CONNECT_TIMEOUT', 5);

// >>> Réseau (diagnostic/contournement)
// Laisser true si possible. METTRE false TEMPORAIREMENT pour débloquer si SSL est bloqué.
define('CURL_SSL_VERIFY', false);        // <—— TEMPORAIREMENT désactivé pour débloquer
define('CURL_FORCE_IPV4', true);         // force IPv4 (souvent nécessaire en mutualisé)

// Fallback local
define('FALLBACK_LOCAL_ON_FETCH_FAIL', true);

// Log
$logFile = ROOT_DIR . '/faces-tool.log';

//////////////////////////
// Utils
//////////////////////////
function logit(string $msg): void {
    global $logFile;
    @file_put_contents($logFile, date('c') . ' ' . $msg . "\n", FILE_APPEND);
}
function json_out(array $data, int $code = 200): void {
    http_response_code($code);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    exit;
}
function safe_name(string $name): string { return basename($name); }
function ensure_dir(string $dir): void { if (!is_dir($dir)) { @mkdir($dir, 0755, true); } }
function new_face_filename(): string { return 'face_' . date('Ymd_His') . '_' . bin2hex(random_bytes(4)) . '.jpg'; }

/**
 * Télécharge une image depuis plusieurs sources (HTTPS & HTTP), sinon fallback local.
 * Retourne [ok(bool), data(string|false), src(string|null)]
 */
function fetch_image_remote(): array {
    // Ajout de sources HTTP pour contourner d'éventuels blocages HTTPS
    $seed = bin2hex(random_bytes(6));
    $idx  = random_int(1, 70);
    $man  = random_int(0, 99);
    $wom  = random_int(0, 99);

    $candidates = [
        // HTTPS (préférées)
        'https://thispersondoesnotexist.com/',
        'https://thispersondoesnotexist.com/image',
        'https://i.pravatar.cc/256?img=' . $idx,
        'https://randomuser.me/api/portraits/men/' . $man . '.jpg',
        'https://randomuser.me/api/portraits/women/' . $wom . '.jpg',
        'https://picsum.photos/seed/' . $seed . '/256/256',

        // HTTP (contournement si HTTPS bloqué)
        'http://placekitten.com/256/256',
        'http://picsum.photos/seed/' . $seed . '/256/256',
    ];

    $headers = [
        'Accept: image/jpeg,image/*;q=0.8,*/*;q=0.5',
        'User-Agent: Mozilla/5.0 (compatible; FaceTools/1.2)',
        'Referer: https://thispersondoesnotexist.com/'
    ];

    foreach ($candidates as $url) {
        $host = parse_url($url, PHP_URL_HOST) ?: '';
        $ip   = $host ? @gethostbyname($host) : 'n/a';

        // cURL prioritaire
        if (function_exists('curl_init')) {
            $ch = curl_init($url);
            $opts = [
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_TIMEOUT        => FETCH_TIMEOUT,
                CURLOPT_CONNECTTIMEOUT => CONNECT_TIMEOUT,
                CURLOPT_HTTPHEADER     => $headers,
            ];
            if (defined('CURL_FORCE_IPV4') && CURL_FORCE_IPV4 && defined('CURLOPT_IPRESOLVE') && defined('CURL_IPRESOLVE_V4')) {
                $opts[CURLOPT_IPRESOLVE] = CURL_IPRESOLVE_V4;
            }
            if (defined('CURL_SSL_VERIFY') && CURL_SSL_VERIFY === false) {
                $opts[CURLOPT_SSL_VERIFYPEER] = false;
                $opts[CURLOPT_SSL_VERIFYHOST] = 0;
            }
            curl_setopt_array($ch, $opts);
            $data = curl_exec($ch);
            $errno= curl_errno($ch);
            $err  = curl_error($ch);
            $code = (int)curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
            $ct   = (string)curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
            curl_close($ch);

            if ($errno === 0 && $code === 200 && $data !== false && stripos((string)$ct, 'image') !== false) {
                logit("FETCH OK curl url=$url host=$host ip=$ip ct=$ct bytes=" . strlen((string)$data));
                return [true, $data, $url];
            }
            logit("FETCH FAIL curl url=$url host=$host ip=$ip errno=$errno code=$code ct=$ct err=$err");
        }

        // fopen fallback
        if (ini_get('allow_url_fopen')) {
            $ctx = stream_context_create(['http' => ['header'=>implode("\r\n", $headers), 'timeout'=>FETCH_TIMEOUT]]);
            $data = @file_get_contents($url, false, $ctx);
            if ($data !== false) {
                logit("FETCH OK fopen url=$url host=$host ip=$ip bytes=" . strlen((string)$data));
                return [true, $data, $url];
            }
            logit("FETCH FAIL fopen url=$url host=$host ip=$ip");
        }
    }

    return [false, false, null];
}

/** Fallback local (JPEG 256px) */
function generate_local_image(): string {
    if (function_exists('imagecreatetruecolor')) {
        $w=256; $h=256;
        $im = imagecreatetruecolor($w, $h);
        $bg = imagecolorallocate($im, rand(0,255), rand(0,255), rand(0,255));
        imagefilledrectangle($im, 0, 0, $w, $h, $bg);
        $fg = imagecolorallocate($im, 255, 255, 255);
        imagestring($im, 5, 10, 10, 'Ulixai', $fg);
        ob_start(); imagejpeg($im, null, 85); $data = (string)ob_get_clean(); imagedestroy($im);
        return $data;
    }
    $base64 = '/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBxAQEA8PEA8QDw8QEA8QDw8PDw8QEA8PFREWFhURFRUYHSggGBolGxUVITEhJSkrLi4uFx8zODMtNygtLisBCgoKDQ0NDg0NDisZFRkrKystKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrK//AABEIAAEAAQMBIgACEQEDEQH/xAAXAAEBAQEAAAAAAAAAAAAAAAAAAQIG/8QAFxABAQEBAAAAAAAAAAAAAAAAAQIAEv/aAAwDAQACEAMQAAABsQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAf/9k=';
    return (string)base64_decode($base64);
}

//////////////////////////
// Diagnostics
//////////////////////////
if (isset($_GET['diag'])) {
    header('Content-Type: text/plain; charset=utf-8');
    echo "== FaceTools Diagnostic ==\n";
    echo "ROOT_DIR: " . ROOT_DIR . "\n";
    echo "facesDir: " . $GLOBALS['facesDir'] . "\n";
    echo "jsonFile: " . $GLOBALS['jsonFile'] . "\n";
    echo "allow_url_fopen: " . (ini_get('allow_url_fopen') ? 'ON' : 'OFF') . "\n";
    echo "curl: " . (function_exists('curl_version') ? 'ON' : 'OFF') . "\n";
    echo "CURL_FORCE_IPV4: " . (CURL_FORCE_IPV4 ? 'ON' : 'OFF') . "\n";
    echo "CURL_SSL_VERIFY: " . (CURL_SSL_VERIFY ? 'ON' : 'OFF') . "\n";
    ensure_dir($GLOBALS['facesDir']);
    $test = $GLOBALS['facesDir'] . '__write_test_' . time() . '.txt';
    $ok   = @file_put_contents($test, 'ok');
    echo "Write test: " . ($ok ? "OK ($test)" : "FAIL") . "\n";
    if ($ok) echo "Web URL (expect 200): " . $GLOBALS['facesUrl'] . basename($test) . "\n";
    [$okNet,$data,$src] = fetch_image_remote();
    echo "Remote fetch: " . ($okNet ? "OK (bytes=" . strlen((string)$data) . ", src=$src)" : "FAIL (all_sources_failed)") . "\n";
    echo "Log file: " . $GLOBALS['logFile'] . "\n";
    exit;
}

//////////////////////////
// Auth
//////////////////////////
$isAuthenticated = !empty($_SESSION['auth_faces']);
if (isset($_POST['login'])) {
    $pwd = (string)($_POST['password'] ?? '');
    if (hash_equals(ACCESS_PASSWORD, $pwd)) {
        $_SESSION['auth_faces'] = true;
        header('Location: ' . $selfUrl);
        exit;
    } else {
        $loginError = 'Mot de passe incorrect !';
    }
}
if (isset($_GET['logout'])) {
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        @setcookie(session_name(), '', time()-42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    }
    session_destroy();
    header('Location: ' . $selfUrl);
    exit;
}

//////////////////////////
// Login page
//////////////////////////
if (!$isAuthenticated):
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Connexion - Outil d'Annotation</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
*{margin:0;padding:0;box-sizing:border-box}
body{font-family:system-ui,-apple-system,sans-serif;background:linear-gradient(135deg,#1e40af 0%,#3b82f6 50%,#60a5fa 100%);min-height:100vh;display:flex;align-items:center;justify-content:center;padding:24px}
.login-container{background:rgba(255,255,255,.96);backdrop-filter:blur(10px);border-radius:20px;padding:48px;box-shadow:0 20px 60px rgba(0,0,0,.3);max-width:420px;width:100%}
h1{color:#1e40af;font-size:28px;margin-bottom:12px;text-align:center}
.subtitle{color:#64748b;text-align:center;margin-bottom:32px;font-size:14px}
.form-group{margin-bottom:24px}
label{display:block;color:#334155;font-weight:600;margin-bottom:8px;font-size:14px}
input[type=password]{width:100%;padding:14px 16px;border:2px solid #e2e8f0;border-radius:10px;font-size:16px}
input[type=password]:focus{outline:none;border-color:#3b82f6;box-shadow:0 0 0 3px rgba(59,130,246,.1)}
.btn-login{width:100%;padding:14px;background:#3b82f6;color:#fff;border:none;border-radius:10px;font-size:16px;font-weight:600;cursor:pointer}
.btn-login:hover{background:#2563eb}
.error{background:#fef2f2;border:1px solid #fecaca;color:#dc2626;padding:12px;border-radius:8px;margin-bottom:20px;font-size:14px;text-align:center}
.lock-icon{width:64px;height:64px;margin:0 auto 24px;background:#dbeafe;border-radius:50%;display:flex;align-items:center;justify-content:center}
</style>
</head>
<body>
<div class="login-container">
    <div class="lock-icon">
        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#3b82f6" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
    </div>
    <h1>🔐 Accès Sécurisé</h1>
    <p class="subtitle">Outil d'Annotation d'Images IA</p>

    <?php if (isset($loginError)): ?>
        <div class="error"><?= htmlspecialchars($loginError, ENT_QUOTES, 'UTF-8') ?></div>
    <?php endif; ?>

    <form method="POST" action="<?= htmlspecialchars($selfUrl, ENT_QUOTES, 'UTF-8') ?>" autocomplete="off">
        <div class="form-group">
            <label>Mot de passe</label>
            <input type="password" name="password" required autofocus>
        </div>
        <button type="submit" name="login" class="btn-login">Se connecter</button>
    </form>
</div>
</body>
</html>
<?php
exit;
endif;

//////////////////////////
// Charger / Purger JSON
//////////////////////////
ensure_dir($facesDir);
$annotations = (file_exists($jsonFile) ? json_decode((string)@file_get_contents($jsonFile), true) : []) ?: [];
$changed = false;
foreach ($annotations as $fn => $_) {
    if (!is_file($facesDir . $fn)) { unset($annotations[$fn]); $changed = true; }
}
if ($changed) {
    @file_put_contents($jsonFile, json_encode($annotations, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), LOCK_EX);
}

$message = '';

//////////////////////////
// Endpoints AJAX
//////////////////////////

// Télécharger UNE image (réseau + fallback)
if (isset($_POST['dl_one'])) {
    [$okNet, $data, $src] = fetch_image_remote();
    if (!$okNet) {
        logit("dl_one: ALL remote sources failed. using_local=" . (FALLBACK_LOCAL_ON_FETCH_FAIL ? 'yes':'no'));
        if (!FALLBACK_LOCAL_ON_FETCH_FAIL) {
            json_out(['success'=>false,'reason'=>'remote_fetch_failed'], 200);
        }
        $data = generate_local_image();
    }
    $filename = new_face_filename();
    $filepath = $facesDir . $filename;
    if (@file_put_contents($filepath, $data, LOCK_EX) === false) {
        logit("dl_one: WRITE FAIL path=$filepath");
        json_out(['success'=>false,'reason'=>'write_failed'], 200);
    }
    $annotations[$filename] = ['filename'=>$filename,'genre'=>'','ethnicite'=>'','langues'=>[]];
    @file_put_contents($jsonFile, json_encode($annotations, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), LOCK_EX);
    json_out(['success'=>true,'filename'=>$filename,'url'=>$facesUrl.$filename,'source'=>$okNet?('remote:'.$src):'local']);
}

// Générer N images en local (test écriture)
if (isset($_POST['gen_local'])) {
    $n = max(1, min(1000, (int)$_POST['gen_local']));
    $okc=0;
    for($i=0;$i<$n;$i++){
        $name=new_face_filename();
        if (@file_put_contents($facesDir.$name, generate_local_image(), LOCK_EX)!==false){
            $annotations[$name]=['filename'=>$name,'genre'=>'','ethnicite'=>'','langues'=>[]];
            $okc++;
        }
    }
    @file_put_contents($jsonFile, json_encode($annotations, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), LOCK_EX);
    json_out(['success'=>true,'created'=>$okc]);
}

// MAJ annotation
if (isset($_POST['update_annotation'])) {
    $filename = safe_name((string)($_POST['filename'] ?? ''));
    $field    = (string)($_POST['field'] ?? '');
    $value    = (string)($_POST['value'] ?? '');
    if (isset($annotations[$filename])) {
        if ($field === 'langues') {
            $langues = $annotations[$filename]['langues'] ?? [];
            if (in_array($value, $langues, true)) { $langues = array_values(array_diff($langues, [$value])); }
            else { $langues[] = $value; }
            $annotations[$filename]['langues'] = $langues;
        } elseif (in_array($field, ['genre','ethnicite'], true)) {
            $annotations[$filename][$field] = $value;
        }
        @file_put_contents($jsonFile, json_encode($annotations, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), LOCK_EX);
        json_out(['success'=>true]);
    }
    json_out(['success'=>false], 400);
}

// Delete 1
if (isset($_POST['delete_image'])) {
    $filename = safe_name((string)($_POST['filename'] ?? ''));
    if (is_file($facesDir.$filename)) { @unlink($facesDir.$filename); }
    unset($annotations[$filename]);
    @file_put_contents($jsonFile, json_encode($annotations, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), LOCK_EX);
    json_out(['success'=>true]);
}

// Delete multiple
if (isset($_POST['delete_multiple'])) {
    $list = json_decode((string)($_POST['filenames'] ?? '[]'), true) ?: [];
    foreach ($list as $fn) {
        $fn = safe_name((string)$fn);
        if (is_file($facesDir.$fn)) { @unlink($facesDir.$fn); }
        unset($annotations[$fn]);
    }
    @file_put_contents($jsonFile, json_encode($annotations, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), LOCK_EX);
    json_out(['success'=>true]);
}

// Export
if (isset($_POST['export'])) {
    $annotated = [];
    foreach ($annotations as $item) {
        $ok = !empty($item['genre']) && !empty($item['ethnicite']) && !empty($item['langues']) && is_file($facesDir . $item['filename']);
        if ($ok) $annotated[] = $item;
    }
    if (empty($annotated)) {
        $message = '❌ Aucune image annotée à exporter !';
    } else {
        $exportData = [
            'export_date'  => date('Y-m-d H:i:s'),
            'total_images' => count($annotated),
            'base_path'    => $facesUrl,
            'images'       => array_values(array_map(function($it) use ($facesUrl) {
                return [
                    'filename'  => $it['filename'],
                    'filepath'  => $facesUrl . $it['filename'],
                    'genre'     => $it['genre'],
                    'ethnicite' => $it['ethnicite'],
                    'langues'   => $it['langues'],
                ];
            }, $annotated)),
        ];
        header('Content-Type: application/json; charset=utf-8');
        header('Content-Disposition: attachment; filename="faces-export-' . time() . '.json"');
        echo json_encode($exportData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        exit;
    }
}

// Vider
if (isset($_POST['clear_all'])) {
    $files = glob($facesDir . '*') ?: [];
    foreach ($files as $file) { if (is_file($file)) { @unlink($file); } }
    $annotations = [];
    @file_put_contents($jsonFile, json_encode($annotations, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), LOCK_EX);
    $message = "✅ Toutes les images ont été supprimées !";
}

//////////////////////////
// UI
//////////////////////////
$totalImages = count($annotations);
$annotatedCount = 0; foreach ($annotations as $it) { if (!empty($it['genre']) && !empty($it['ethnicite']) && !empty($it['langues'])) $annotatedCount++; }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Outil d'Annotation d'Images IA</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
*{margin:0;padding:0;box-sizing:border-box}
body{font-family:system-ui,-apple-system,sans-serif;background:linear-gradient(135deg,#1e40af 0%,#3b82f6 100%);min-height:100vh;padding:20px}
.container{max-width:1400px;margin:0 auto}
.header{background:#fff;border-radius:12px;padding:20px;margin-bottom:20px;box-shadow:0 4px 16px rgba(0,0,0,.2);position:sticky;top:20px;z-index:100}
h1{color:#1e40af;font-size:24px;margin-bottom:16px}
.logout-btn{float:right;padding:8px 16px;background:#ef4444;color:#fff;text-decoration:none;border-radius:6px;font-size:14px;font-weight:600}
.controls{display:flex;gap:10px;flex-wrap:wrap;margin-bottom:16px;align-items:center}
.btn{padding:10px 20px;border:none;border-radius:6px;font-weight:600;cursor:pointer;font-size:14px}
.btn:disabled{opacity:.5;cursor:not-allowed}
.btn-blue{background:#3b82f6;color:#fff}
.btn-purple{background:#a855f7;color:#fff}
.btn-green{background:#10b981;color:#fff}
.btn-red{background:#ef4444;color:#fff}
.btn-orange{background:#f97316;color:#fff}
.message{padding:12px;border-radius:6px;margin-bottom:16px}
.message.success{background:#dcfce7;color:#15803d}
.stats{display:flex;gap:20px;color:#1e40af;font-weight:600}
.image-list{display:flex;flex-direction:column;gap:10px;margin-top:16px}
.image-item{background:#fff;border-radius:10px;padding:12px;display:flex;gap:12px;align-items:flex-start;border:2px solid transparent}
.image-item.selected{border-color:#3b82f6}
.image-item.annotated{border-color:#10b981}
.image-checkbox{width:20px;height:20px;cursor:pointer;margin-top:35px}
.image-preview{width:80px;height:80px;border-radius:6px;object-fit:cover;background:#f1f5f9}
.image-details{flex:1}
.annotation-section{margin-bottom:8px}
.annotation-label{color:#64748b;font-size:10px;font-weight:700;text-transform:uppercase;margin-bottom:4px}
.button-group{display:flex;gap:4px;flex-wrap:wrap}
.option-btn{padding:6px 10px;border:2px solid #e2e8f0;border-radius:6px;background:#fff;color:#334155;font-size:12px;font-weight:600;cursor:pointer}
.option-btn.selected{background:#10b981;border-color:#10b981;color:#fff}
.delete-btn{padding:6px 12px;background:#ef4444;color:#fff;border:none;border-radius:6px;cursor:pointer;font-size:12px;font-weight:600;align-self:center}
.selection-bar{display:none;background:#3b82f6;color:#fff;padding:10px 16px;border-radius:6px;margin-bottom:16px;align-items:center;gap:10px;font-weight:600}
.selection-bar.active{display:flex}
.empty{text-align:center;padding:40px;color:#1e40af;background:#fff;border-radius:10px}
.muted{color:#64748b;font-size:12px}
</style>
</head>
<body>
<div class="container">
    <div class="header">
        <a href="<?= htmlspecialchars($selfUrl, ENT_QUOTES, 'UTF-8') ?>?logout" class="logout-btn">🔓 Déconnexion</a>
        <h1>🎨 Outil d'Annotation d'Images IA</h1>

        <?php if (!empty($message)): ?>
            <div class="message success"><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></div>
        <?php endif; ?>

        <div class="controls">
            <button type="button" class="btn btn-blue btn-dl" onclick="startDownload(5)">Tester 5 (réseau+fallback)</button>
            <button type="button" class="btn btn-blue btn-dl" onclick="startDownload(50)">Télécharger 50</button>
            <button type="button" class="btn btn-blue btn-dl" onclick="startDownload(100)">Télécharger 100</button>
            <button type="button" class="btn btn-purple btn-dl" onclick="startDownload(500)">🚀 Télécharger 500</button>
            <button type="button" class="btn btn-orange" onclick="genLocal(10)">Forcer 10 (local, sans réseau)</button>
            <span id="dlProgress" class="muted"></span>
        </div>

        <div class="selection-bar" id="selectionBar">
            <span id="selectedCount">0</span> sélectionnée(s)
            <button type="button" class="btn btn-red" onclick="deleteSelected()">🗑️ Supprimer</button>
            <button type="button" class="btn btn-orange" onclick="clearSelection()">✖️ Annuler</button>
        </div>

        <div class="controls">
            <form method="POST" action="<?= htmlspecialchars($selfUrl, ENT_QUOTES, 'UTF-8') ?>" style="display:inline;">
                <button type="submit" name="export" class="btn btn-green" <?= $annotatedCount === 0 ? 'disabled' : '' ?>>
                    📥 Exporter (<?= (int)$annotatedCount ?>)
                </button>
            </form>
            <form method="POST" action="<?= htmlspecialchars($selfUrl, ENT_QUOTES, 'UTF-8') ?>" style="display:inline;">
                <button type="submit" name="clear_all" class="btn btn-red" <?= $totalImages === 0 ? 'disabled' : '' ?>>
                    🗑️ Vider tout
                </button>
            </form>
        </div>

        <div class="stats">
            <div>Total: <strong><?= (int)$totalImages ?></strong></div>
            <div>Annotées: <strong style="color:#10b981"><?= (int)$annotatedCount ?></strong></div>
        </div>
    </div>

    <div class="image-list">
        <?php if (empty($annotations)): ?>
            <div class="empty">
                <p style="font-size:18px;margin-bottom:8px;font-weight:600">Aucune image</p>
                <p>Cliquez sur “Tester 5” ou “Forcer 10 (local)”</p>
            </div>
        <?php else: ?>
            <?php foreach ($annotations as $filename => $data): ?>
                <?php $isAnnotated = !empty($data['genre']) && !empty($data['ethnicite']) && !empty($data['langues']); ?>
                <div class="image-item <?= $isAnnotated ? 'annotated' : '' ?>">
                    <input type="checkbox" class="image-checkbox" data-filename="<?= htmlspecialchars($filename, ENT_QUOTES, 'UTF-8') ?>" onchange="updateSelection()">
                    <img src="<?= $facesUrl . htmlspecialchars($filename, ENT_QUOTES, 'UTF-8') ?>" class="image-preview" loading="lazy" alt="portrait">
                    <div class="image-details">
                        <div class="annotation-section">
                            <div class="annotation-label">Genre :</div>
                            <div class="button-group">
                                <button class="option-btn <?= ($data['genre'] ?? '') === 'homme' ? 'selected' : '' ?>" onclick="updateAnnotation('<?= addslashes($filename) ?>','genre','homme')">Homme</button>
                                <button class="option-btn <?= ($data['genre'] ?? '') === 'femme' ? 'selected' : '' ?>" onclick="updateAnnotation('<?= addslashes($filename) ?>','genre','femme')">Femme</button>
                            </div>
                        </div>
                        <div class="annotation-section">
                            <div class="annotation-label">Ethnicité :</div>
                            <div class="button-group">
                                <?php
                                $eths = ['caucasien'=>'Caucasien','africain'=>'Africain','asiatique'=>'Asiatique','moyen-orient'=>'Moyen-Orient','latino'=>'Latino','mixte'=>'Mixte'];
                                foreach ($eths as $key=>$label):
                                    $sel = (($data['ethnicite'] ?? '') === $key) ? 'selected' : '';
                                ?>
                                    <button class="option-btn <?= $sel ?>" onclick="updateAnnotation('<?= addslashes($filename) ?>','ethnicite','<?= $key ?>')"><?= $label ?></button>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="annotation-section">
                            <div class="annotation-label">Langues parlées :</div>
                            <div class="button-group">
                                <?php 
                                $langues = [
                                    'francais'=>'Français','anglais'=>'Anglais','allemand'=>'Allemand','neerlandais'=>'Néerlandais','espagnol'=>'Espagnol','portugais'=>'Portugais',
                                    'hindi'=>'Hindi','russe'=>'Russe','chinois'=>'Chinois','arabe'=>'Arabe','bengali'=>'Bengali','japonais'=>'Japonais',
                                    'turc'=>'Turc','coreen'=>'Coréen','italien'=>'Italien','vietnamien'=>'Vietnamien','polonais'=>'Polonais','ukrainien'=>'Ukrainien','thai'=>'Thaï'
                                ];
                                $langSel = $data['langues'] ?? [];
                                foreach ($langues as $key=>$label):
                                    $selected = in_array($key, $langSel, true);
                                ?>
                                    <button class="option-btn <?= $selected ? 'selected' : '' ?>" onclick="updateAnnotation('<?= addslashes($filename) ?>','langues','<?= $key ?>')"><?= $label ?></button>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <button class="delete-btn" onclick="deleteImage('<?= addslashes($filename) ?>')">🗑️</button>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<script>
async function dlOne() {
    const fd = new FormData(); fd.append('dl_one','1');
    const r = await fetch('<?= $selfUrl ?>', { method:'POST', body: fd });
    try { return await r.json(); } catch(e){ return {success:false}; }
}
async function startDownload(n) {
    const btns=document.querySelectorAll('.btn-dl'); btns.forEach(b=>b.disabled=true);
    const p=document.getElementById('dlProgress'); let ok=0,fail=0;
    for(let i=0;i<n;i++){
        p.textContent=`Progression: ${ok+fail}/${n} — OK ${ok} / Échecs ${fail}`;
        const res=await dlOne(); if(res&&res.success){ok++;} else {fail++;}
    }
    p.textContent=`Terminé: OK ${ok} / Échecs ${fail}`;
    btns.forEach(b=>b.disabled=false); location.reload();
}
async function genLocal(n){
    const p=document.getElementById('dlProgress'); p.textContent='Génération locale...';
    const fd=new FormData(); fd.append('gen_local', n.toString());
    const r=await fetch('<?= $selfUrl ?>', {method:'POST', body:fd});
    try{const j=await r.json(); p.textContent=`Local: créées ${j.created??0}`; location.reload();}catch(e){p.textContent='Local: erreur';}
}
function postForm(fd){ return fetch('<?= $selfUrl ?>',{method:'POST',body:fd}).then(r=>r.json()); }
let selectedImages=new Set();
function updateAnnotation(filename,field,value){const fd=new FormData();fd.append('update_annotation','1');fd.append('filename',filename);fd.append('field',field);fd.append('value',value);postForm(fd).then(d=>{if(d.success)location.reload();});}
function deleteImage(filename){if(!confirm('Supprimer cette image ?'))return;const fd=new FormData();fd.append('delete_image','1');fd.append('filename',filename);postForm(fd).then(d=>{if(d.success)location.reload();});}
function updateSelection(){selectedImages.clear();document.querySelectorAll('.image-checkbox:checked').forEach(cb=>{selectedImages.add(cb.dataset.filename);cb.closest('.image-item').classList.add('selected');});document.querySelectorAll('.image-checkbox:not(:checked)').forEach(cb=>{cb.closest('.image-item').classList.remove('selected');});const bar=document.getElementById('selectionBar');if(selectedImages.size>0){bar.classList.add('active');document.getElementById('selectedCount').textContent=selectedImages.size;}else{bar.classList.remove('active');}}
function clearSelection(){selectedImages.clear();document.querySelectorAll('.image-checkbox').forEach(cb=>{cb.checked=false;cb.closest('.image-item').classList.remove('selected');});document.getElementById('selectionBar').classList.remove('active');}
function deleteSelected(){if(selectedImages.size===0)return;if(!confirm(`Supprimer ${selectedImages.size} image(s) ?`))return;const fd=new FormData();fd.append('delete_multiple','1');fd.append('filenames',JSON.stringify(Array.from(selectedImages)));postForm(fd).then(d=>{if(d.success)location.reload();});}
</script>
</body>
</html>
