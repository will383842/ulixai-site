# =============================================================================
# Script de deploiement Ulixai vers O2Switch
# Usage: .\deploy-o2switch.ps1 -Action deploy|init|db-export
# =============================================================================

param(
    [Parameter(Mandatory=$true)]
    [ValidateSet("deploy", "init", "db-export", "full")]
    [string]$Action,

    [string]$SshUser = "",
    [string]$SshHost = ""
)

# Configuration - A MODIFIER
$SSH_USER = if ($SshUser) { $SshUser } else { "juwi2670" }
$SSH_HOST = if ($SshHost) { $SshHost } else { "salopette.o2switch.net" }
$REMOTE_PATH = "/home/juwi2670/public_html"
$LOCAL_PATH = Split-Path -Parent $PSScriptRoot

# Couleurs
function Write-Info { Write-Host "[INFO] $args" -ForegroundColor Cyan }
function Write-Success { Write-Host "[OK] $args" -ForegroundColor Green }
function Write-Warn { Write-Host "[WARN] $args" -ForegroundColor Yellow }
function Write-Err { Write-Host "[ERROR] $args" -ForegroundColor Red }

# Verifier la connexion SSH
function Test-SshConnection {
    Write-Info "Test de connexion SSH..."
    $result = ssh -o ConnectTimeout=10 "$SSH_USER@$SSH_HOST" "echo OK" 2>&1
    if ($result -eq "OK") {
        Write-Success "Connexion SSH OK"
        return $true
    } else {
        Write-Err "Impossible de se connecter en SSH"
        Write-Err "Verifiez: ssh $SSH_USER@$SSH_HOST"
        return $false
    }
}

# Deploiement (mise a jour)
function Deploy {
    Write-Info "=== DEPLOIEMENT ==="

    if (-not (Test-SshConnection)) { return }

    Write-Info "Pull des derniers changements..."
    $commands = @"
cd $REMOTE_PATH && \
git pull origin main && \
composer install --no-dev --optimize-autoloader --no-interaction && \
php artisan migrate --force && \
php artisan config:cache && \
php artisan route:cache && \
php artisan view:cache && \
php artisan cache:clear && \
echo "Deploiement termine avec succes!"
"@

    ssh "$SSH_USER@$SSH_HOST" $commands

    Write-Success "=== DEPLOIEMENT TERMINE ==="
}

# Initialisation (premiere fois)
function Init {
    Write-Info "=== INITIALISATION ==="

    if (-not (Test-SshConnection)) { return }

    Write-Warn "Cette action va cloner le repo dans $REMOTE_PATH"
    $confirm = Read-Host "Continuer? (oui/non)"
    if ($confirm -ne "oui") {
        Write-Info "Annule"
        return
    }

    $commands = @"
cd ~ && \
if [ -d "$REMOTE_PATH" ]; then mv $REMOTE_PATH ${REMOTE_PATH}_backup_`$(date +%Y%m%d_%H%M%S); fi && \
git clone https://github.com/will383842/ulixai-site.git $REMOTE_PATH && \
cd $REMOTE_PATH && \
composer install --no-dev --optimize-autoloader && \
cp .env.example .env && \
php artisan key:generate && \
echo "Initialisation terminee!" && \
echo "IMPORTANT: Editez le fichier .env avec vos parametres de production"
"@

    ssh "$SSH_USER@$SSH_HOST" $commands

    Write-Success "=== INITIALISATION TERMINEE ==="
    Write-Warn "N'oubliez pas de configurer le .env sur le serveur!"
}

# Export de la base SQLite
function Export-Database {
    Write-Info "=== EXPORT BASE DE DONNEES ==="

    $sqliteDb = Join-Path $LOCAL_PATH "database\database.sqlite"
    $outputFile = Join-Path $LOCAL_PATH "database\export_mysql.sql"

    if (-not (Test-Path $sqliteDb)) {
        Write-Err "Base SQLite non trouvee: $sqliteDb"
        return
    }

    Write-Info "Conversion SQLite vers MySQL..."
    Write-Warn "Pour convertir SQLite vers MySQL, utilisez:"
    Write-Host ""
    Write-Host "  Option 1: https://www.rebasedata.com/convert-sqlite-to-mysql-online" -ForegroundColor Yellow
    Write-Host "  Option 2: Executer les migrations sur O2Switch avec 'php artisan migrate:fresh --seed'" -ForegroundColor Yellow
    Write-Host ""
    Write-Info "Fichier SQLite: $sqliteDb"
}

# Deploiement complet (code + migrations)
function Full-Deploy {
    Write-Info "=== DEPLOIEMENT COMPLET ==="

    if (-not (Test-SshConnection)) { return }

    Write-Warn "Cette action va:"
    Write-Warn "  1. Mettre a jour le code"
    Write-Warn "  2. Reinstaller les dependances"
    Write-Warn "  3. Executer migrate:fresh (EFFACE TOUTES LES DONNEES!)"
    Write-Warn "  4. Executer les seeders"

    $confirm = Read-Host "Continuer? (oui/non)"
    if ($confirm -ne "oui") {
        Write-Info "Annule"
        return
    }

    $commands = @"
cd $REMOTE_PATH && \
php artisan down --secret="maintenance-secret-2024" && \
git pull origin main && \
composer install --no-dev --optimize-autoloader --no-interaction && \
npm install && npm run production && \
php artisan migrate:fresh --seed --force && \
php artisan storage:link && \
php artisan config:cache && \
php artisan route:cache && \
php artisan view:cache && \
php artisan up && \
echo "Deploiement complet termine!"
"@

    ssh "$SSH_USER@$SSH_HOST" $commands

    Write-Success "=== DEPLOIEMENT COMPLET TERMINE ==="
}

# Main
Write-Host ""
Write-Host "=====================================" -ForegroundColor Magenta
Write-Host "  Deploiement Ulixai -> O2Switch" -ForegroundColor Magenta
Write-Host "=====================================" -ForegroundColor Magenta
Write-Host ""

switch ($Action) {
    "deploy" { Deploy }
    "init" { Init }
    "db-export" { Export-Database }
    "full" { Full-Deploy }
}
