# Plan Infrastructure Ulixai - Migration O2Switch

## Objectif
Migrer depuis O2Switch vers une infrastructure scalable, préparée pour l'international (197 pays), tout en minimisant les coûts actuels.

---

## Architecture Cible

```
Utilisateurs (monde entier)
         ↓
   Cloudflare (CDN + Protection DDoS)
         ↓
   Serveur Hetzner (Allemagne)
   ├── Laravel (PHP-FPM + Nginx)
   ├── MySQL (local)
   └── Redis (local)
         ↓
   Cloudflare R2 (fichiers uploadés)
```

---

## Phase 1 : Configuration Actuelle à Modifier (avant migration)

### 1.1 Stockage fichiers → Cloudflare R2

**Pourquoi** : Fichiers accessibles depuis n'importe quel serveur futur, CDN intégré.

**Coût** : Gratuit (10 GB inclus, 10M reads/mois)

**À faire dans Laravel** :

```bash
composer require league/flysystem-aws-s3-v3
```

```php
// config/filesystems.php
'disks' => [
    'r2' => [
        'driver' => 's3',
        'key' => env('CLOUDFLARE_R2_ACCESS_KEY_ID'),
        'secret' => env('CLOUDFLARE_R2_SECRET_ACCESS_KEY'),
        'region' => 'auto',
        'bucket' => env('CLOUDFLARE_R2_BUCKET'),
        'url' => env('CLOUDFLARE_R2_URL'),
        'endpoint' => env('CLOUDFLARE_R2_ENDPOINT'),
        'use_path_style_endpoint' => false,
        'throw' => true,
    ],
],
```

```env
# .env
FILESYSTEM_DISK=r2
CLOUDFLARE_R2_ACCESS_KEY_ID=xxx
CLOUDFLARE_R2_SECRET_ACCESS_KEY=xxx
CLOUDFLARE_R2_BUCKET=ulixai-uploads
CLOUDFLARE_R2_ENDPOINT=https://<account_id>.r2.cloudflarestorage.com
CLOUDFLARE_R2_URL=https://cdn.ulixai.com
```

### 1.2 Sessions → Database (prêt pour scaling)

**Pourquoi** : Sessions partagées si multi-serveurs plus tard.

**Coût** : €0 (utilise MySQL existant)

```bash
php artisan session:table
php artisan migrate
```

```env
# .env
SESSION_DRIVER=database
```

### 1.3 Cache → Redis local (performant)

**Pourquoi** : Rapide, reste sur le serveur pour l'instant.

```env
# .env
CACHE_DRIVER=redis
QUEUE_CONNECTION=redis
```

### 1.4 Configuration CDN Cloudflare

**À configurer dans Cloudflare Dashboard** :

- [ ] Ajouter le domaine ulixai.com
- [ ] Activer proxy (nuage orange) sur les DNS
- [ ] SSL → Full (strict)
- [ ] Caching → Cache Everything pour /assets, /build, /images
- [ ] Page Rules :
  - `*.ulixai.com/api/*` → Cache Level: Bypass
  - `*.ulixai.com/build/*` → Cache Level: Cache Everything, Edge TTL: 1 month

---

## Phase 2 : Migration vers Hetzner

### 2.1 Créer le serveur

| Spec | Valeur |
|------|--------|
| **Type** | CX22 |
| **vCPU** | 2 |
| **RAM** | 4 GB |
| **SSD** | 40 GB |
| **Localisation** | Falkenstein (Allemagne) |
| **Coût** | €4,51/mois |

### 2.2 Option A : Avec Laravel Forge (recommandé)

**Coût** : $12/mois (~€11)

**Avantages** :
- Configuration automatique Nginx, PHP 8.3, MySQL 8, Redis
- Déploiement Git en 1 clic
- SSL Let's Encrypt automatique
- Scheduler Laravel configuré
- Queue workers (Supervisor)
- Backups automatiques

**Étapes** :
1. Créer compte Laravel Forge
2. Connecter Hetzner (API token)
3. Créer serveur via Forge
4. Ajouter le site
5. Configurer les variables d'environnement
6. Déployer

### 2.3 Option B : Configuration manuelle

**Coût** : €0 (juste le serveur)

**À installer** :
```bash
# PHP 8.3 + extensions
sudo apt install php8.3-fpm php8.3-mysql php8.3-redis php8.3-xml php8.3-curl php8.3-mbstring php8.3-zip

# Nginx
sudo apt install nginx

# MySQL 8
sudo apt install mysql-server

# Redis
sudo apt install redis-server

# Composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

# Certbot (SSL)
sudo apt install certbot python3-certbot-nginx
```

**Configuration Nginx** : voir Annexe A

---

## Phase 3 : Évolution Future (quand nécessaire)

### Quand passer au multi-région ?

| Signal | Action |
|--------|--------|
| Latence > 500ms pour users US/Asie | Ajouter serveur US |
| Trafic > 100K visiteurs/jour | Load balancing |
| DB > 50 GB ou besoin haute dispo | PlanetScale |
| Sessions/Cache distribués nécessaires | Upstash Redis |

### Architecture Multi-Région

```
                    Cloudflare (Load Balancer)
                    /                         \
        Hetzner (EU)                    DigitalOcean (US)
        └── Laravel                     └── Laravel
                    \                         /
                     \                       /
                      ├── PlanetScale (DB distribuée)
                      ├── Upstash Redis (sessions/cache)
                      └── Cloudflare R2 (fichiers)
```

### Coûts Multi-Région (estimation)

| Service | Coût mensuel |
|---------|--------------|
| Hetzner EU | €4,5 |
| DigitalOcean US | $12 |
| PlanetScale | $29 |
| Upstash Redis | $10 |
| Cloudflare Pro | $20 |
| **Total** | ~€75/mois |

---

## Récapitulatif des Coûts

### Aujourd'hui (Phase 1 + 2)

| Service | Coût |
|---------|------|
| Hetzner CX22 | €4,51 |
| Laravel Forge | €11 |
| Cloudflare (gratuit) | €0 |
| Cloudflare R2 (gratuit) | €0 |
| **Total** | **~€16/mois** |

### Comparaison

| Solution | Coût |
|----------|------|
| O2Switch actuel | ~€5-10/mois |
| Nouvelle infra | ~€16/mois |
| Différence | +€6-10/mois |

**Gain** : Infrastructure scalable, préparée pour l'international, performance supérieure.

---

## Checklist Migration

### Avant migration
- [ ] Configurer Cloudflare R2 bucket
- [ ] Modifier `config/filesystems.php` pour R2
- [ ] Migrer fichiers existants vers R2
- [ ] Passer sessions sur database
- [ ] Tester en local/staging

### Migration
- [ ] Créer serveur Hetzner
- [ ] Configurer via Forge (ou manuellement)
- [ ] Configurer DNS Cloudflare
- [ ] Déployer le code
- [ ] Importer base de données
- [ ] Configurer SSL
- [ ] Tester toutes les fonctionnalités

### Post-migration
- [ ] Vérifier les logs d'erreurs
- [ ] Tester les uploads de fichiers
- [ ] Vérifier les emails
- [ ] Monitorer les performances
- [ ] Supprimer l'ancien hébergement O2Switch

---

## Annexe A : Configuration Nginx

```nginx
server {
    listen 80;
    listen [::]:80;
    server_name ulixai.com www.ulixai.com;
    return 301 https://$server_name$request_uri;
}

server {
    listen 443 ssl http2;
    listen [::]:443 ssl http2;
    server_name ulixai.com www.ulixai.com;

    root /var/www/ulixai/public;
    index index.php;

    ssl_certificate /etc/letsencrypt/live/ulixai.com/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/ulixai.com/privkey.pem;

    # Security headers
    add_header X-Frame-Options "SAMEORIGIN" always;
    add_header X-Content-Type-Options "nosniff" always;
    add_header X-XSS-Protection "1; mode=block" always;

    # Gzip
    gzip on;
    gzip_types text/plain text/css application/json application/javascript text/xml application/xml;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.3-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }

    # Cache static assets
    location ~* \.(css|js|jpg|jpeg|png|gif|ico|svg|woff|woff2)$ {
        expires 1y;
        add_header Cache-Control "public, immutable";
    }
}
```

---

## Annexe B : Script de déploiement (si sans Forge)

```bash
#!/bin/bash
# deploy.sh

cd /var/www/ulixai

# Pull latest code
git pull origin main

# Install dependencies
composer install --no-dev --optimize-autoloader

# Run migrations
php artisan migrate --force

# Clear and rebuild cache
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Restart queue workers
php artisan queue:restart

# Set permissions
chown -R www-data:www-data storage bootstrap/cache

echo "Deployment complete!"
```

---

## Annexe C : Cron pour Laravel Scheduler

```cron
* * * * * cd /var/www/ulixai && php artisan schedule:run >> /dev/null 2>&1
```

---

## Contact & Ressources

- **Hetzner Cloud** : https://www.hetzner.com/cloud
- **Laravel Forge** : https://forge.laravel.com
- **Cloudflare** : https://www.cloudflare.com
- **Cloudflare R2** : https://www.cloudflare.com/r2
- **PlanetScale** : https://planetscale.com (pour plus tard)
- **Upstash** : https://upstash.com (pour plus tard)
