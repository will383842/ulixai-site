# Guide de Déploiement Ulixai - Hetzner Production

## Table des matières
1. [Prérequis](#prérequis)
2. [Option A: Déploiement Manuel](#option-a-déploiement-manuel)
3. [Option B: Laravel Forge (Recommandé)](#option-b-laravel-forge-recommandé)
4. [Configuration Post-Installation](#configuration-post-installation)
5. [Maintenance](#maintenance)
6. [Scaling](#scaling)
7. [Monitoring](#monitoring)
8. [Troubleshooting](#troubleshooting)

---

## Prérequis

### Serveur Hetzner Recommandé
| Trafic attendu | Type | RAM | CPU | Prix/mois |
|----------------|------|-----|-----|-----------|
| < 10k visites/jour | CX21 | 4GB | 2 vCPU | ~5€ |
| 10k-50k visites/jour | CX31 | 8GB | 4 vCPU | ~10€ |
| 50k-200k visites/jour | CX41 | 16GB | 8 vCPU | ~20€ |
| > 200k visites/jour | CX51 + scaling | 32GB+ | 16+ vCPU | ~40€+ |

### Checklist avant déploiement
- [ ] Serveur Hetzner commandé (Ubuntu 24.04)
- [ ] Nom de domaine configuré (DNS pointant vers IP serveur)
- [ ] Clé SSH générée et ajoutée au serveur
- [ ] Accès au repository Git
- [ ] Clés API production (Stripe, Google, R2, etc.)

---

## Option A: Déploiement Manuel

### 1. Connexion au serveur
```bash
ssh root@YOUR_SERVER_IP
```

### 2. Installation automatique
```bash
# Télécharger le script
wget https://raw.githubusercontent.com/YOUR_REPO/ulixai-site/main/deployment/deploy.sh
chmod +x deploy.sh

# Première installation
./deploy.sh --first-run
```

### 3. Configuration manuelle étape par étape

#### Mise à jour système
```bash
apt update && apt upgrade -y
```

#### Installation des packages
```bash
# Ajouter le repo PHP
add-apt-repository ppa:ondrej/php -y
apt update

# Installer tout
apt install -y nginx mysql-server redis-server supervisor certbot \
    python3-certbot-nginx git unzip curl \
    php8.3-fpm php8.3-mysql php8.3-redis php8.3-xml php8.3-curl \
    php8.3-mbstring php8.3-zip php8.3-gd php8.3-intl php8.3-bcmath php8.3-opcache

# Composer
curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer
```

#### Configuration MySQL
```bash
mysql_secure_installation

mysql -u root -p
```
```sql
CREATE DATABASE ulixai_production CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'ulixai_user'@'localhost' IDENTIFIED BY 'STRONG_PASSWORD_HERE';
GRANT ALL PRIVILEGES ON ulixai_production.* TO 'ulixai_user'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

#### Déployer l'application
```bash
# Créer le dossier
mkdir -p /var/www/ulixai.com
cd /var/www

# Cloner le repo
git clone git@github.com:YOUR_USERNAME/ulixai-site.git ulixai.com
cd ulixai.com

# Permissions
chown -R www-data:www-data /var/www/ulixai.com
chmod -R 755 /var/www/ulixai.com
chmod -R 775 storage bootstrap/cache

# Installer les dépendances
sudo -u www-data composer install --no-dev --optimize-autoloader

# Configurer l'environnement
cp deployment/.env.production .env
nano .env  # Remplir les vraies valeurs

# Générer la clé
sudo -u www-data php artisan key:generate

# Migrations
sudo -u www-data php artisan migrate --force

# Optimiser
sudo -u www-data php artisan config:cache
sudo -u www-data php artisan route:cache
sudo -u www-data php artisan view:cache
```

#### Configurer Nginx
```bash
cp /var/www/ulixai.com/deployment/nginx.conf /etc/nginx/sites-available/ulixai.com
ln -s /etc/nginx/sites-available/ulixai.com /etc/nginx/sites-enabled/
rm /etc/nginx/sites-enabled/default
nginx -t
systemctl reload nginx
```

#### Configurer SSL
```bash
certbot --nginx -d ulixai.com -d www.ulixai.com
```

#### Configurer Supervisor
```bash
cp /var/www/ulixai.com/deployment/supervisor.conf /etc/supervisor/conf.d/ulixai.conf
supervisorctl reread
supervisorctl update
supervisorctl start ulixai-workers:*
```

#### Configurer le Firewall
```bash
ufw allow 'Nginx Full'
ufw allow OpenSSH
ufw enable
```

---

## Option B: Laravel Forge (Recommandé)

### Pourquoi Forge ?
| Avantage | Détail |
|----------|--------|
| **Setup automatique** | Nginx, PHP, MySQL, Redis configurés en 5 min |
| **Zero-downtime deploy** | Déploiement sans interruption intégré |
| **SSL automatique** | Let's Encrypt renouvelé automatiquement |
| **Monitoring intégré** | Dashboard des métriques serveur |
| **Backups automatiques** | Base de données sauvegardée |
| **Scaling facile** | Load balancers en quelques clics |
| **Support Hetzner** | Intégration native |

### Prix
- **$12/mois** pour serveurs illimités
- ROI immédiat vs temps passé en maintenance manuelle

### Setup avec Forge

1. **Créer un compte** sur [forge.laravel.com](https://forge.laravel.com)

2. **Connecter Hetzner**
   - Settings → Server Providers → Add Hetzner
   - Générer une API key dans Hetzner Cloud Console

3. **Créer le serveur**
   - Create Server → Hetzner
   - Région: Nuremberg ou Helsinki (EU)
   - Size: Selon ton trafic (voir tableau ci-dessus)
   - Services: PHP 8.3, MySQL 8, Redis

4. **Ajouter le site**
   - Sites → Add Site
   - Domain: ulixai.com
   - Project Type: General PHP / Laravel

5. **Connecter Git**
   - Repository: votre repo GitHub
   - Branch: main
   - Deploy on push: Yes

6. **Variables d'environnement**
   - Environment → Edit
   - Coller le contenu de `.env.production` avec les vraies valeurs

7. **Queue Workers**
   - Forge crée automatiquement les workers
   - Ajouter des workers supplémentaires si besoin

8. **SSL**
   - SSL → Let's Encrypt → Obtain Certificate

### Script de déploiement Forge
Dans Forge → Site → Deploy Script:
```bash
cd /home/forge/ulixai.com

git pull origin main

composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

php artisan migrate --force

php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache
php artisan cache:clear

php artisan queue:restart
```

---

## Configuration Post-Installation

### 1. Configurer predis dans Laravel
```bash
composer require predis/predis
```

### 2. Vérifier la config Redis
```php
// config/database.php - déjà configuré
'redis' => [
    'client' => env('REDIS_CLIENT', 'predis'),
    'default' => [
        'host' => env('REDIS_HOST', '127.0.0.1'),
        'password' => env('REDIS_PASSWORD', null),
        'port' => env('REDIS_PORT', 6379),
        'database' => 0,
    ],
    'cache' => [
        'host' => env('REDIS_HOST', '127.0.0.1'),
        'password' => env('REDIS_PASSWORD', null),
        'port' => env('REDIS_PORT', 6379),
        'database' => 1,
    ],
],
```

### 3. Sécurité supplémentaire
```bash
# Fail2ban (protection brute force)
apt install fail2ban -y
systemctl enable fail2ban

# Automatic security updates
apt install unattended-upgrades -y
dpkg-reconfigure -plow unattended-upgrades
```

---

## Maintenance

### Déploiement standard
```bash
./deploy.sh
```

### Rollback en cas de problème
```bash
./deploy.sh --rollback
```

### Health check
```bash
./deploy.sh --health
```

### Logs utiles
```bash
# Laravel
tail -f /var/www/ulixai.com/storage/logs/laravel.log

# Nginx
tail -f /var/log/nginx/ulixai.error.log

# Queue workers
tail -f /var/www/ulixai.com/storage/logs/queue-*.log

# PHP-FPM
tail -f /var/log/php-fpm/ulixai-error.log
```

### Commandes courantes
```bash
# Vider le cache
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Reconstruire le cache
php artisan optimize

# Relancer les workers
php artisan queue:restart
supervisorctl restart ulixai-workers:*

# Voir les jobs en attente
php artisan queue:work --once
```

---

## Scaling

### Scaling Vertical (plus de ressources)
1. Hetzner Cloud Console → Server → Resize
2. Ajuster `pm.max_children` dans php-fpm.conf selon la RAM

### Scaling Horizontal (plusieurs serveurs)

#### Architecture recommandée pour gros trafic:
```
                    ┌─────────────┐
                    │  Cloudflare │
                    │    (CDN)    │
                    └──────┬──────┘
                           │
                    ┌──────▼──────┐
                    │   Hetzner   │
                    │ Load Balancer│
                    └──────┬──────┘
                           │
           ┌───────────────┼───────────────┐
           │               │               │
    ┌──────▼──────┐ ┌──────▼──────┐ ┌──────▼──────┐
    │   Web App   │ │   Web App   │ │   Web App   │
    │  Server 1   │ │  Server 2   │ │  Server 3   │
    └──────┬──────┘ └──────┬──────┘ └──────┬──────┘
           │               │               │
           └───────────────┼───────────────┘
                           │
              ┌────────────┼────────────┐
              │            │            │
       ┌──────▼──────┐ ┌───▼───┐ ┌──────▼──────┐
       │   MySQL     │ │ Redis │ │   Queue     │
       │  (Primary)  │ │Cluster│ │  Workers    │
       └─────────────┘ └───────┘ └─────────────┘
```

#### Avec Forge:
1. Créer un Load Balancer
2. Ajouter des serveurs au pool
3. Séparer MySQL/Redis sur serveurs dédiés

---

## Monitoring

### Solutions recommandées

| Outil | Usage | Prix |
|-------|-------|------|
| **Laravel Pulse** | Monitoring Laravel natif | Gratuit |
| **Uptime Robot** | Monitoring uptime | Gratuit |
| **Sentry** | Error tracking | Gratuit (limité) |
| **New Relic** | APM complet | ~$100/mois |

### Laravel Pulse (gratuit)
```bash
composer require laravel/pulse

php artisan vendor:publish --provider="Laravel\Pulse\PulseServiceProvider"
php artisan migrate
```

### Alertes basiques (gratuit)
```bash
# Installer monitoring Hetzner
# Dashboard → Metrics → Enable

# Script de monitoring simple
cat > /usr/local/bin/health-check.sh << 'EOF'
#!/bin/bash
if ! curl -s -o /dev/null -w "%{http_code}" https://ulixai.com/health | grep -q "200"; then
    echo "ALERT: ulixai.com is down!" | mail -s "Server Alert" admin@ulixai.com
fi
EOF
chmod +x /usr/local/bin/health-check.sh

# Cron toutes les 5 minutes
(crontab -l 2>/dev/null; echo "*/5 * * * * /usr/local/bin/health-check.sh") | crontab -
```

---

## Troubleshooting

### 502 Bad Gateway
```bash
# Vérifier PHP-FPM
systemctl status php8.3-fpm
systemctl restart php8.3-fpm

# Vérifier les logs
tail -f /var/log/nginx/ulixai.error.log
```

### Queue jobs ne se lancent pas
```bash
# Vérifier Supervisor
supervisorctl status
supervisorctl restart ulixai-workers:*

# Vérifier Redis
redis-cli ping  # Doit répondre PONG
```

### Site lent
```bash
# Vérifier Redis
redis-cli info stats

# Vérifier les slow queries
tail -f /var/log/php-fpm/ulixai-slow.log

# Vérifier la charge
htop
```

### Espace disque plein
```bash
# Nettoyer les logs
truncate -s 0 /var/www/ulixai.com/storage/logs/*.log

# Supprimer les anciens backups
find /var/www/ulixai.com/storage -name "*.gz" -mtime +30 -delete
```

---

## Checklist Finale

- [ ] Serveur provisionné
- [ ] DNS configuré (A record + www)
- [ ] SSL activé
- [ ] .env configuré avec vraies valeurs
- [ ] Migrations exécutées
- [ ] Cache optimisé
- [ ] Queue workers actifs
- [ ] Firewall configuré
- [ ] Backups automatiques activés
- [ ] Monitoring en place
- [ ] Test de charge effectué
