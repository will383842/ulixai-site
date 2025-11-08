# 🚀 TODO AVANT MISE EN PRODUCTION - ULIXAI

## ⚠️ CHECKLIST COMPLÈTE - NE RIEN OUBLIER !

---

## ✅ PHASE 1 : PRÉPARATION LOCALE (10 min)

### 1. Vérifier que tous les fichiers sont créés

- [ ] 20 fichiers backend/frontend créés
- [ ] Tests locaux passés (photo + documents)
- [ ] `.gitignore` mis à jour (credentials non versionnés)

### 2. Commit et Push sur Git
```bash
git add .
git commit -m "feat: Add Google Vision provider verification system"
git push origin main
```

---

## ✅ PHASE 2 : DÉPLOIEMENT SUR LE SERVEUR (30 min)

### 1️⃣ Upload du code

**Option A - Git (recommandé) :**
```bash
# SSH sur le serveur
cd ~/www/ulixai
git pull origin main
```

**Option B - FTP :**
- Upload tous les fichiers modifiés via FileZilla/cPanel File Manager

### 2️⃣ Installation des packages
```bash
cd ~/www/ulixai
composer install --no-dev --optimize-autoloader
```

### 3️⃣ Base de données

- [ ] Connexion à **phpMyAdmin** via cPanel
- [ ] Sélectionner ta base de données
- [ ] Onglet **"Importer"**
- [ ] Choisir le fichier : `database/sql/google_vision_setup.sql`
- [ ] Cliquer **"Exécuter"**
- [ ] **Vérifier** que les tables sont créées :
  - `provider_document_verifications` ✓
  - `jobs` ✓
  - `failed_jobs` ✓
  - Colonnes ajoutées dans `users` ✓

### 4️⃣ Upload du fichier credentials Google

- [ ] Aller dans **cPanel → File Manager**
- [ ] Naviguer vers : `storage/app/google/`
- [ ] Créer le dossier `google` si besoin : **New Folder**
- [ ] Upload le fichier `vision-credentials.json`
- [ ] **Vérifier les permissions** : clic droit → Change Permissions → **644 ou 664**

### 5️⃣ Configuration .env

- [ ] **File Manager** → éditer `.env`
- [ ] Ajouter ces lignes à la fin :
```env
# ============================================
# Google Cloud Vision API
# ============================================
GOOGLE_CLOUD_PROJECT_ID=ulixai-475917
GOOGLE_VISION_CREDENTIALS_PATH=app/google/vision-credentials.json
GOOGLE_VISION_ENABLED=true

# ============================================
# Queue Configuration
# ============================================
QUEUE_CONNECTION=database
```

- [ ] **Sauvegarder** le fichier

### 6️⃣ Permissions
```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

### 7️⃣ Clear cache
```bash
php artisan config:clear
php artisan config:cache
php artisan route:clear
php artisan view:clear
```

---

## 🔴 PHASE 3 : QUEUE WORKER (CRITIQUE - NE PAS OUBLIER !)

### ⚠️ SANS CETTE ÉTAPE, RIEN NE FONCTIONNERA !

Les photos et documents resteront en "pending" pour toujours si le queue worker ne tourne pas !

---

### **Option A : Supervisor (RECOMMANDÉ si tu as accès root)**

#### Étape 1 : Copier le fichier de config
```bash
sudo cp todo_when_production/ulixai-worker.conf.example /etc/supervisor/conf.d/ulixai-worker.conf
```

#### Étape 2 : Modifier avec les VRAIS chemins
```bash
sudo nano /etc/supervisor/conf.d/ulixai-worker.conf
```

**Remplace :**
- `VOTRE_USER_CPANEL` → ton user réel (ex: `ulixai`)
- `/chemin/vers/ulixai` → chemin réel (ex: `/home/ulixai/www/ulixai`)

**Exemple de ligne modifiée :**
```ini
command=php /home/ulixai/www/ulixai/artisan queue:work database --sleep=3 --tries=3 --max-time=3600 --timeout=60
user=ulixai
stdout_logfile=/home/ulixai/www/ulixai/storage/logs/worker.log
```

Sauvegarde : `Ctrl+O`, `Enter`, `Ctrl+X`

#### Étape 3 : Activer et démarrer
```bash
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start ulixai-worker-group:*
```

#### Étape 4 : Vérifier le status
```bash
sudo supervisorctl status
```

**Tu DOIS voir :**
```
ulixai-worker:ulixai-worker_00   RUNNING   pid 12345, uptime 0:00:05
ulixai-worker:ulixai-worker_01   RUNNING   pid 12346, uptime 0:00:05
```

✅ Si tu vois **RUNNING** → C'est bon !  
❌ Si tu vois **STOPPED** ou **FATAL** → Voir logs : `tail -f storage/logs/worker.log`

---

### **Option B : Cron Job (si pas d'accès root)**

#### Étape 1 : Aller dans cPanel → Cron Jobs

#### Étape 2 : Ajouter cette commande

**Commande :**
```bash
* * * * * cd /home/VOTRE_USER/www/ulixai && php artisan queue:work --stop-when-empty
```

**Remplace `VOTRE_USER`** par ton vrai user cPanel

**Fréquence :** Toutes les minutes (`* * * * *`)

#### Étape 3 : Sauvegarder

✅ Le cron va exécuter le worker toutes les minutes

**Note :** Moins performant que Supervisor mais ça fonctionne !

---

## ✅ PHASE 4 : TESTS EN PRODUCTION (20 min)

### 1️⃣ Tester Step 10 (Photo de profil)

- [ ] Aller sur `https://ulixai.com/provider/register`
- [ ] Naviguer jusqu'au Step 10
- [ ] Upload une photo de profil
- [ ] Cliquer "Validate this photo"
- [ ] **Observer :**
  - Spinner "Analyzing..." apparaît ✓
  - Après ~5-10 secondes : Badge vert "Approved" OU jaune "Pending" ✓
  - Score affiché ✓

### 2️⃣ Tester Step 11 (Documents d'identité)

- [ ] Cliquer sur "Passport" (ou ID/License)
- [ ] Upload une photo de document
- [ ] **Observer :**
  - Spinner "Verifying..." apparaît ✓
  - Après ~5-15 secondes : Checkmark vert "Verified" OU croix rouge "Rejected" ✓
  - Message détaillé affiché ✓

### 3️⃣ Vérifier les logs
```bash
# Logs Google Vision
tail -f storage/logs/google-vision.log

# Logs Queue Worker
tail -f storage/logs/worker.log

# Logs Laravel généraux
tail -f storage/logs/laravel.log
```

**Tu dois voir :**
```
[2025-01-08 14:30:15] production.INFO: Photo verification started for user 42
[2025-01-08 14:30:18] production.INFO: Google Vision API responded: score 87
[2025-01-08 14:30:18] production.INFO: Photo approved for user 42
```

### 4️⃣ Vérifier la base de données

- [ ] phpMyAdmin → table `provider_document_verifications`
- [ ] Tu dois voir des lignes avec :
  - `verification_status` = `'verified'` ou `'rejected'`
  - `confidence_score` rempli
  - `detected_text` rempli

- [ ] Table `users` :
  - `profile_photo_verified` = `1`
  - `identity_verified` = `1` (si doc + photo validés)

---

## 🐛 DÉPANNAGE (Si ça ne marche pas)

### ❌ Problème : "Photo reste en pending pour toujours"

**Cause :** Queue worker ne tourne pas !

**Solution :**
```bash
# Vérifier si le worker tourne
ps aux | grep 'queue:work'

# Si rien → Le worker n'est pas lancé
# Retourne à PHASE 3 et configure Supervisor ou Cron Job
```

### ❌ Problème : "Google Vision API error"

**Vérifier :**
```bash
# Le fichier credentials existe ?
ls -la storage/app/google/vision-credentials.json

# Les permissions sont bonnes ?
# Doit afficher : -rw-r--r-- ou -rw-rw-r--

# Le .env est bon ?
cat .env | grep GOOGLE_CLOUD_PROJECT_ID
# Doit afficher : GOOGLE_CLOUD_PROJECT_ID=ulixai-475917
```

### ❌ Problème : "Job failed"

**Voir les failed jobs :**
```bash
php artisan queue:failed

# Relancer les jobs échoués
php artisan queue:retry all
```

### ❌ Problème : "Credentials not found"

**Solution :**
```bash
# Vider le cache config
php artisan config:clear
php artisan config:cache
```

---

## ✅ CHECKLIST FINALE

Avant de dire "C'est production ready" :

- [ ] Code déployé sur le serveur ✓
- [ ] Base de données mise à jour ✓
- [ ] Credentials Google présent ✓
- [ ] .env configuré ✓
- [ ] **Queue worker RUNNING** ✓ (le plus important !)
- [ ] Tests Step 10 : photo validée ✓
- [ ] Tests Step 11 : document vérifié ✓
- [ ] Logs OK dans `google-vision.log` ✓
- [ ] BDD : entrées dans `provider_document_verifications` ✓

---

## 🎉 SI TOUT EST VERT → PRODUCTION READY !

**Temps total estimé : 1h - 1h30**

---

## 📞 EN CAS DE PROBLÈME

1. Vérifie les logs : `storage/logs/`
2. Vérifie que le queue worker tourne : `ps aux | grep queue`
3. Vérifie phpMyAdmin : tables créées + données insérées

**Le problème #1 à 99% : Le queue worker ne tourne pas !**

Si les jobs ne se traitent pas, retourne à **PHASE 3** ! 🔴