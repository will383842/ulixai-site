# Deploiement Ulixai sur O2Switch

## Pre-requis

### 1. Activer SSH sur O2Switch
1. Connecte-toi a cPanel O2Switch
2. Va dans **Securite > Acces SSH**
3. **Generer une nouvelle cle** ou **Importer une cle existante**
4. **Autoriser** la cle pour l'acces SSH

### 2. Creer la base de donnees MySQL sur O2Switch
1. cPanel > **Bases de donnees MySQL**
2. Creer une nouvelle base: `ulixai_prod`
3. Creer un utilisateur: `ulixai_user` avec mot de passe fort
4. Associer l'utilisateur a la base avec **TOUS LES PRIVILEGES**

---

## Methode 1: Deploiement initial (premiere fois)

### Etape 1: Connexion SSH
```bash
ssh USERNAME@serveurXXX.o2switch.net
```

### Etape 2: Cloner le repo
```bash
cd ~/public_html
# Si le dossier n'est pas vide, sauvegarder d'abord
mv public_html public_html_backup

# Cloner
git clone https://github.com/will383842/ulixai-site.git public_html
cd public_html
```

### Etape 3: Installer les dependances
```bash
composer install --no-dev --optimize-autoloader
npm install && npm run production
```

### Etape 4: Configurer l'environnement
```bash
cp .env.example .env
nano .env
```

Modifier ces valeurs:
```
APP_ENV=production
APP_DEBUG=false
APP_URL=https://ulixai.com

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=USERNAME_ulixai_prod
DB_USERNAME=USERNAME_ulixai_user
DB_PASSWORD=TON_MOT_DE_PASSE
```

### Etape 5: Generer la cle et migrer
```bash
php artisan key:generate
php artisan migrate --force
php artisan db:seed --force  # Si tu veux les donnees de base
php artisan storage:link
```

### Etape 6: Optimiser
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## Methode 2: Mise a jour (deploiements suivants)

### Depuis ton PC Windows (une seule commande)
```powershell
ssh USERNAME@serveurXXX.o2switch.net "cd ~/public_html && git pull origin main && composer install --no-dev -o && php artisan migrate --force && php artisan config:cache && php artisan route:cache && php artisan view:cache"
```

---

## Transferer les donnees SQLite vers MySQL

### Option A: Exporter depuis le PC local
```bash
# Sur ton PC, installer sqlite3 puis:
sqlite3 database/database.sqlite .dump > dump.sql
```

Puis editer dump.sql pour le rendre compatible MySQL (remplacer les types SQLite).

### Option B: Utiliser un outil de conversion
- Utiliser https://www.rebasedata.com/convert-sqlite-to-mysql-online
- Uploader database.sqlite
- Telecharger le dump MySQL
- Importer via phpMyAdmin sur O2Switch

### Option C: Recreer avec les migrations (recommande si donnees de test)
```bash
php artisan migrate:fresh --seed --force
```

---

## Fichier .htaccess (deja present normalement)

Verifier que `public/.htaccess` contient:
```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
```

---

## Commandes utiles

### Voir les logs d'erreur
```bash
tail -f ~/public_html/storage/logs/laravel.log
```

### Vider le cache
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

### Mode maintenance
```bash
php artisan down --secret="mon-secret-123"
php artisan up
```
