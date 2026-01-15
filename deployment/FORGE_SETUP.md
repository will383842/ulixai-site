# Configuration Laravel Forge pour Ulixai

## 1. Créer le serveur Hetzner via Forge

1. **Forge Dashboard** → Create Server
2. **Provider**: Hetzner Cloud
3. **Credentials**: Ajouter ta clé API Hetzner (Hetzner Console → Security → API Tokens)
4. **Server Settings**:
   - Name: `ulixai-production`
   - Region: `Nuremberg` ou `Helsinki` (EU)
   - Size: `CX21` (4GB) pour commencer, scalable après
   - PHP Version: `8.3`
   - Database: `MySQL 8.0`
   - ✅ Install Redis

## 2. Ajouter le site

1. **Sites** → Add Site
2. **Root Domain**: `ulixai.com`
3. **Aliases**: `www.ulixai.com`
4. **Project Type**: `General PHP / Laravel`
5. **Web Directory**: `/public`
6. **PHP Version**: `8.3`
7. **Create Database**: `ulixai_production`

## 3. Connecter le repository Git

1. **Site** → Git Repository
2. **Provider**: GitHub
3. **Repository**: `ton-username/ulixai-site`
4. **Branch**: `main`
5. ✅ **Install Composer Dependencies**
6. ✅ **Deploy when code is pushed** (optionnel mais recommandé)

## 4. Configurer les variables d'environnement

**Site** → Environment → Edit Environment

```env
APP_NAME=Ulixai
APP_ENV=production
APP_DEBUG=false
APP_URL=https://ulixai.com

LOG_CHANNEL=stack
LOG_LEVEL=error

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ulixai_production
DB_USERNAME=forge
DB_PASSWORD=VOTRE_MOT_DE_PASSE_FORGE

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379
REDIS_CLIENT=predis

CACHE_DRIVER=redis
SESSION_DRIVER=redis
QUEUE_CONNECTION=redis

FILESYSTEM_DISK=r2
SESSION_LIFETIME=120
SESSION_SECURE_COOKIE=true

# Stripe (PRODUCTION!)
STRIPE_KEY=pk_live_xxx
STRIPE_SECRET=sk_live_xxx
STRIPE_WEBHOOK_SECRET=whsec_xxx

# Google OAuth
GOOGLE_CLIENT_ID=xxx
GOOGLE_CLIENT_SECRET=xxx
GOOGLE_REDIRECT_URI=https://ulixai.com/auth/google/callback

# Google Cloud Vision
GOOGLE_CLOUD_PROJECT_ID=ulixai-475917
GOOGLE_VISION_CREDENTIALS_PATH=/home/forge/ulixai.com/storage/app/google/vision-credentials.json
GOOGLE_VISION_ENABLED=true

# Cloudflare R2
UPLOADS_DISK=r2
R2_ACCESS_KEY_ID=xxx
R2_SECRET_ACCESS_KEY=xxx
R2_BUCKET=ulixai-uploads
R2_ENDPOINT=https://xxx.r2.cloudflarestorage.com
R2_URL=https://xxx.r2.dev
R2_VERIFY_SSL=true

# Pusher
PUSHER_APP_ID=xxx
PUSHER_APP_KEY=xxx
PUSHER_APP_SECRET=xxx
PUSHER_APP_CLUSTER=eu

# Analytics
GA4_PROPERTY_ID=properties/510947242
GA4_SERVICE_ACCOUNT_JSON_PATH=/home/forge/ulixai.com/storage/app/google/ga4.json
GTM_CONTAINER_ID=GTM-MDVV9NX7

# Localization
APP_LOCALES=en,fr,de,es,pt,ru,zh,ar,hi
APP_LOCALE_DEFAULT=fr
APP_FALLBACK_LOCALE=en
APP_CURRENCY_DEFAULT=EUR

# Security
RECAPTCHA_SITE_KEY=xxx
RECAPTCHA_SECRET_KEY=xxx
```

## 5. Configurer le script de déploiement

**Site** → Deployment Script

Copier le contenu de `deployment/forge-deploy.sh`

## 6. Configurer les Queue Workers

**Site** → Queue → Add Worker

### Worker 1: Default Queue
- **Connection**: `redis`
- **Queue**: `default`
- **Processes**: `2`
- **Timeout**: `60`
- **Sleep**: `3`
- **Tries**: `3`

### Worker 2: Verification Queue
- **Connection**: `redis`
- **Queue**: `verification`
- **Processes**: `2`
- **Timeout**: `120`
- **Sleep**: `3`
- **Tries**: `2`

### Worker 3: High Priority Queue (optionnel)
- **Connection**: `redis`
- **Queue**: `high`
- **Processes**: `1`
- **Timeout**: `60`
- **Sleep**: `1`
- **Tries**: `3`

## 7. Configurer le Scheduler

**Site** → Scheduler → Add Scheduled Job

- **Command**: `php /home/forge/ulixai.com/artisan schedule:run`
- **Frequency**: `Every Minute`
- **User**: `forge`

## 8. Configurer SSL

**Site** → SSL → LetsEncrypt

1. **Domains**: `ulixai.com`, `www.ulixai.com`
2. Click **Obtain Certificate**

## 9. Configurer les fichiers sensibles

Via SSH ou SFTP, copier les fichiers credentials Google:

```bash
# Se connecter au serveur
ssh forge@YOUR_SERVER_IP

# Créer le dossier
mkdir -p /home/forge/ulixai.com/storage/app/google

# Copier les fichiers (depuis ta machine locale avec scp)
scp vision-credentials.json forge@YOUR_SERVER_IP:/home/forge/ulixai.com/storage/app/google/
scp ga4.json forge@YOUR_SERVER_IP:/home/forge/ulixai.com/storage/app/google/
```

## 10. Premier déploiement

1. **Site** → Deploy Now
2. Vérifier les logs de déploiement
3. Tester le site

## 11. Configurer les backups (optionnel mais recommandé)

**Server** → Backups → Add Backup Configuration

- **Provider**: Amazon S3 ou autre
- **Databases**: `ulixai_production`
- **Frequency**: `Daily`
- **Retention**: `7 days`

## 12. Monitoring

**Server** → Monitoring → Enable

Tu auras accès à:
- CPU usage
- Memory usage
- Disk usage
- Network traffic

---

## Commandes utiles via SSH

```bash
# Se connecter
ssh forge@YOUR_SERVER_IP

# Aller dans le dossier
cd /home/forge/ulixai.com

# Voir les logs Laravel
tail -f storage/logs/laravel.log

# Artisan commands
php artisan queue:work --once  # Traiter un job
php artisan queue:failed       # Voir les jobs échoués
php artisan queue:retry all    # Relancer les jobs échoués

# Vider le cache
php artisan cache:clear
php artisan config:clear

# Voir le statut Redis
redis-cli info
redis-cli monitor  # Voir les commandes en temps réel
```

## Troubleshooting

### Jobs ne se lancent pas
1. Vérifier que Redis fonctionne: `redis-cli ping`
2. Vérifier les workers: **Site** → Queue → Workers Status
3. Restart les workers: **Site** → Queue → Restart Workers

### Erreur 500
1. Vérifier les logs: `tail -f storage/logs/laravel.log`
2. Vérifier les permissions: `sudo chown -R forge:forge storage bootstrap/cache`
3. Vérifier le .env: `php artisan config:clear`

### Site lent
1. Vérifier le cache Redis: `redis-cli info stats`
2. Vérifier OPcache: Forge l'active par défaut
3. Vérifier les slow queries MySQL: **Server** → MySQL → Slow Query Log
