# RAPPORT COMPLET : SYSTÈME D'AFFILIATION ULIXAI

## Document de Réimplémentation de A à Z

**Date de génération :** 20 janvier 2026
**Version :** 1.0
**Projet :** Ulixai Platform

---

# TABLE DES MATIÈRES

1. [Vue d'Ensemble de l'Architecture](#1-vue-densemble-de-larchitecture)
2. [Schéma de Base de Données](#2-schéma-de-base-de-données)
3. [Modèles Eloquent](#3-modèles-eloquent)
4. [Flux d'Inscription avec Affiliation](#4-flux-dinscription-avec-affiliation)
5. [Système de Commissions](#5-système-de-commissions)
6. [Calcul et Création des Commissions](#6-calcul-et-création-des-commissions)
7. [Gestion des Soldes Affiliés](#7-gestion-des-soldes-affiliés)
8. [Système de Retrait (Payout)](#8-système-de-retrait-payout)
9. [Intégration Stripe](#9-intégration-stripe)
10. [Interface Administration](#10-interface-administration)
11. [Routes et API](#11-routes-et-api)
12. [Vues et Templates](#12-vues-et-templates)
13. [Commandes Cron](#13-commandes-cron)
14. [Sécurité et Validations](#14-sécurité-et-validations)
15. [Flux Complet de Bout en Bout](#15-flux-complet-de-bout-en-bout)
16. [Checklist de Réimplémentation](#16-checklist-de-réimplémentation)

---

# 1. VUE D'ENSEMBLE DE L'ARCHITECTURE

## 1.1 Concept Général

Le système d'affiliation Ulixai permet aux utilisateurs de :
- **Parrainer** de nouveaux utilisateurs via un code unique
- **Gagner des commissions** sur les transactions des utilisateurs parrainés
- **Retirer leurs gains** vers leur compte bancaire ou Stripe

## 1.2 Acteurs du Système

| Acteur | Rôle | Description |
|--------|------|-------------|
| **Referrer (Parrain)** | Affilié | Utilisateur qui partage son code et gagne des commissions |
| **Referee (Filleul)** | Utilisateur parrainé | Utilisateur inscrit via un lien d'affiliation |
| **Service Provider** | Prestataire | Peut être affilié ET recevoir des paiements de missions |
| **Service Requester** | Demandeur | Peut être affilié, crée des missions |
| **Admin** | Administrateur | Gère les affiliés, les commissions, les payouts |

## 1.3 Flux Principal

```
┌─────────────────────────────────────────────────────────────────────────┐
│                        FLUX D'AFFILIATION ULIXAI                        │
└─────────────────────────────────────────────────────────────────────────┘

1. INSCRIPTION
   User A (parrain) ──── Partage son lien ────► User B (filleul) s'inscrit
                         ?code=XXXX               referred_by = User A

2. TRANSACTION
   User B crée mission ──► Paie Provider C ──► Transaction enregistrée
                              (100€ + 20€ frais)

3. COMMISSION (après 7 jours)
   Mission complétée ──► transferFunds() ──► AffiliateCommission créée
                                              User A.affiliate_balance += X€

4. RETRAIT
   User A demande retrait ──► Stripe Transfer ──► Payout vers banque
                               pending_balance = 0
```

---

# 2. SCHÉMA DE BASE DE DONNÉES

## 2.1 Table `users` (Colonnes d'Affiliation)

```sql
-- Migration: 0001_01_01_000000_create_users_table.php
-- + Migrations additionnelles

ALTER TABLE users ADD COLUMN affiliate_code VARCHAR(255) UNIQUE;
ALTER TABLE users ADD COLUMN referred_by BIGINT UNSIGNED NULL;
ALTER TABLE users ADD COLUMN referral_stats JSON NULL;
ALTER TABLE users ADD COLUMN affiliate_balance DECIMAL(10,2) DEFAULT 0;
ALTER TABLE users ADD COLUMN pending_affiliate_balance DECIMAL(10,2) DEFAULT 0;
ALTER TABLE users ADD COLUMN credit_balance DECIMAL(12,2) DEFAULT 0;

-- Détails bancaires pour les retraits
ALTER TABLE users ADD COLUMN bank_account_holder VARCHAR(255) NULL;
ALTER TABLE users ADD COLUMN bank_account_iban VARCHAR(255) NULL;  -- ENCRYPTED
ALTER TABLE users ADD COLUMN bank_swift_bic VARCHAR(255) NULL;     -- ENCRYPTED
ALTER TABLE users ADD COLUMN bank_name VARCHAR(255) NULL;
ALTER TABLE users ADD COLUMN account_country VARCHAR(255) NULL;
ALTER TABLE users ADD COLUMN bank_details_verified_at TIMESTAMP NULL;

-- Index
CREATE INDEX idx_affiliate_code ON users(affiliate_code);
CREATE INDEX idx_referred_by ON users(referred_by);

-- Foreign Key
ALTER TABLE users ADD CONSTRAINT fk_referred_by
    FOREIGN KEY (referred_by) REFERENCES users(id) ON DELETE SET NULL;
```

## 2.2 Table `affiliate_commissions`

```sql
-- Migration: 2025_07_28_101047_create_affiliate_commissions_table.php

CREATE TABLE affiliate_commissions (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    referrer_id BIGINT UNSIGNED NOT NULL,           -- L'affilié qui gagne
    referee_id BIGINT UNSIGNED NOT NULL,            -- L'utilisateur parrainé
    mission_id BIGINT UNSIGNED NULL,                -- Mission associée
    amount DECIMAL(10,2) NOT NULL,                  -- Montant de la commission
    status ENUM('pending', 'available', 'paid') DEFAULT 'pending',
    payout_method VARCHAR(255) NULL,                -- 'stripe', 'bank', etc.
    stripe_transfer_id VARCHAR(255) NULL,           -- ID du transfer Stripe
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,

    -- Foreign Keys
    CONSTRAINT fk_referrer FOREIGN KEY (referrer_id)
        REFERENCES users(id) ON DELETE CASCADE,
    CONSTRAINT fk_referee FOREIGN KEY (referee_id)
        REFERENCES users(id) ON DELETE CASCADE,
    CONSTRAINT fk_mission FOREIGN KEY (mission_id)
        REFERENCES missions(id) ON DELETE SET NULL,

    -- Index pour recherches rapides
    INDEX idx_referrer_referee (referrer_id, referee_id)
);
```

## 2.3 Table `ulix_commissions` (Configuration des Taux)

```sql
-- Migration: 2025_09_09_051825_create_ulix_commissions_table.php

CREATE TABLE ulix_commissions (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    requester_fee DECIMAL(5,4) DEFAULT 0.0500,      -- 5% frais demandeur
    provider_fee DECIMAL(5,4) DEFAULT 0.1500,       -- 15% frais prestataire
    org_fee DECIMAL(5,4) DEFAULT 0.0500,            -- 5% frais plateforme
    affiliate_fee DECIMAL(5,4) DEFAULT 0.0250,      -- 2.5% commission affilié
    description TEXT NULL,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

-- Insertion des valeurs par défaut
INSERT INTO ulix_commissions (requester_fee, provider_fee, org_fee, affiliate_fee, is_active)
VALUES (0.05, 0.15, 0.05, 0.025, true);
```

## 2.4 Table `payouts` (Historique des Retraits)

```sql
-- Migration: 2025_11_20_000003_create_payouts_table.php

CREATE TABLE payouts (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NULL,                   -- Utilisateur qui retire
    provider_id BIGINT UNSIGNED NULL,               -- Si c'est un provider
    amount DECIMAL(10,2) NOT NULL,                  -- Montant du retrait
    currency VARCHAR(3) DEFAULT 'EUR',              -- Devise
    payout_type VARCHAR(50) NOT NULL,               -- 'affiliate', 'mission'
    stripe_transfer_id VARCHAR(255) NULL,           -- ID transfer Stripe
    stripe_payout_id VARCHAR(255) NULL,             -- ID payout Stripe
    bank_account_last4 VARCHAR(4) NULL,             -- Derniers 4 chiffres IBAN
    bank_account_type VARCHAR(50) NULL,             -- 'connected_account', 'external_account'
    status ENUM('pending', 'processing', 'completed', 'paid', 'failed', 'cancelled') DEFAULT 'pending',
    failure_reason TEXT NULL,                       -- Raison de l'échec
    paid_at TIMESTAMP NULL,                         -- Date du paiement
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,

    -- Foreign Keys
    CONSTRAINT fk_payout_user FOREIGN KEY (user_id)
        REFERENCES users(id) ON DELETE SET NULL,
    CONSTRAINT fk_payout_provider FOREIGN KEY (provider_id)
        REFERENCES service_providers(id) ON DELETE CASCADE,

    -- Index
    INDEX idx_provider_status (provider_id, status),
    INDEX idx_status (status),
    INDEX idx_paid_at (paid_at)
);
```

## 2.5 Table `transactions` (Paiements de Missions)

```sql
-- Table existante - colonnes pertinentes pour l'affiliation

CREATE TABLE transactions (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    mission_id BIGINT UNSIGNED NOT NULL,
    provider_id BIGINT UNSIGNED NOT NULL,
    offer_id BIGINT UNSIGNED NULL,
    stripe_session_id VARCHAR(255) NULL,
    stripe_payment_intent_id VARCHAR(255) NULL,
    amount_paid DECIMAL(10,2) NOT NULL,             -- Montant total payé
    client_fee DECIMAL(10,2) NOT NULL,              -- Frais client
    provider_fee DECIMAL(10,2) NOT NULL,            -- Frais provider (base commission)
    country VARCHAR(255) NULL,
    user_role VARCHAR(255) NULL,
    status ENUM('pending_payment', 'paid', 'released', 'refunded', 'dispute_pending') DEFAULT 'pending_payment',
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);
```

## 2.6 Table `country_commissions` (Taux par Pays)

```sql
-- Migration: 2025_11_15_000003_create_country_commissions_table.php

CREATE TABLE country_commissions (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    country_code VARCHAR(2) UNIQUE NOT NULL,        -- Code ISO (FR, US, etc.)
    country_name VARCHAR(255) NOT NULL,
    region VARCHAR(255) NULL,
    platform_rate DECIMAL(5,2) NOT NULL,            -- Taux plateforme par pays
    min_commission DECIMAL(10,2) NULL,
    max_commission DECIMAL(10,2) NULL,
    service_rates JSON NULL,                        -- Taux par type de service
    vat_rate DECIMAL(5,2) DEFAULT 0,
    vat_included BOOLEAN DEFAULT FALSE,
    payment_processing_fee DECIMAL(5,2) DEFAULT 2.9,
    is_active BOOLEAN DEFAULT TRUE,
    effective_from DATE NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,

    INDEX idx_is_active (is_active),
    INDEX idx_region (region)
);
```

---

# 3. MODÈLES ELOQUENT

## 3.1 Modèle User

```php
<?php
// app/Models/User.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    protected $fillable = [
        'name', 'email', 'password',
        // Affiliation
        'affiliate_code',
        'referred_by',
        'referral_stats',
        'affiliate_balance',
        'pending_affiliate_balance',
        'credit_balance',
        // Détails bancaires
        'bank_account_holder',
        'bank_account_iban',
        'bank_swift_bic',
        'bank_name',
        'account_country',
        'bank_details_verified_at',
        // Autres
        'user_role',
        'status',
    ];

    protected $casts = [
        'referral_stats' => 'array',
        'bank_account_iban' => 'encrypted',      // CHIFFREMENT AUTOMATIQUE
        'bank_swift_bic' => 'encrypted',         // CHIFFREMENT AUTOMATIQUE
        'bank_details_verified_at' => 'datetime',
    ];

    // ============================================
    // RELATIONS D'AFFILIATION
    // ============================================

    /**
     * Le parrain de cet utilisateur
     */
    public function referrer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'referred_by');
    }

    /**
     * Les utilisateurs parrainés par cet utilisateur
     */
    public function referrals(): HasMany
    {
        return $this->hasMany(User::class, 'referred_by');
    }

    /**
     * Les commissions gagnées par cet utilisateur en tant qu'affilié
     */
    public function commissions(): HasMany
    {
        return $this->hasMany(AffiliateCommission::class, 'referrer_id');
    }

    // ============================================
    // MÉTHODES UTILITAIRES
    // ============================================

    /**
     * Vérifie si l'utilisateur a renseigné ses informations bancaires
     */
    public function hasBankingDetails(): bool
    {
        return !empty($this->bank_account_holder)
            && !empty($this->bank_account_iban)
            && !empty($this->bank_name);
    }

    /**
     * Génère le lien d'affiliation complet
     */
    public function getAffiliateLink(): string
    {
        return config('app.url') . '/affiliate/sign-up?code=' . $this->affiliate_code;
    }

    /**
     * Calcule le montant total retiré (différence entre balance et pending)
     */
    public function getTotalWithdrawn(): float
    {
        return (float) $this->affiliate_balance - (float) $this->pending_affiliate_balance;
    }
}
```

## 3.2 Modèle AffiliateCommission

```php
<?php
// app/Models/AffiliateCommission.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AffiliateCommission extends Model
{
    protected $fillable = [
        'referrer_id',           // ID de l'affilié qui gagne
        'referee_id',            // ID de l'utilisateur parrainé
        'mission_id',            // ID de la mission associée
        'amount',                // Montant de la commission
        'status',                // pending, available, paid
        'payout_method',         // stripe, bank
        'stripe_transfer_id',    // ID du transfer Stripe
    ];

    protected $casts = [
        'amount' => 'decimal:2',
    ];

    // ============================================
    // CONSTANTES DE STATUT
    // ============================================

    const STATUS_PENDING = 'pending';
    const STATUS_AVAILABLE = 'available';
    const STATUS_PAID = 'paid';

    // ============================================
    // RELATIONS
    // ============================================

    /**
     * L'affilié qui reçoit cette commission
     */
    public function referrer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'referrer_id');
    }

    /**
     * L'utilisateur parrainé qui a généré cette commission
     */
    public function referee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'referee_id');
    }

    /**
     * La mission associée à cette commission
     */
    public function mission(): BelongsTo
    {
        return $this->belongsTo(Mission::class);
    }

    // ============================================
    // SCOPES
    // ============================================

    public function scopeAvailable($query)
    {
        return $query->where('status', self::STATUS_AVAILABLE);
    }

    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    public function scopePaid($query)
    {
        return $query->where('status', self::STATUS_PAID);
    }

    public function scopeForReferrer($query, $referrerId)
    {
        return $query->where('referrer_id', $referrerId);
    }
}
```

## 3.3 Modèle UlixCommission (Configuration)

```php
<?php
// app/Models/UlixCommission.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UlixCommission extends Model
{
    protected $fillable = [
        'requester_fee',    // Frais prélevés sur le demandeur (5%)
        'provider_fee',     // Frais prélevés sur le prestataire (15%)
        'org_fee',          // Frais pour la plateforme (5%)
        'affiliate_fee',    // Commission d'affiliation (2.5%)
        'description',
        'is_active',
    ];

    protected $casts = [
        'requester_fee' => 'decimal:4',
        'provider_fee' => 'decimal:4',
        'org_fee' => 'decimal:4',
        'affiliate_fee' => 'decimal:4',
        'is_active' => 'boolean',
    ];

    // ============================================
    // MÉTHODES STATIQUES
    // ============================================

    /**
     * Récupère la configuration active des commissions
     */
    public static function getActive(): ?self
    {
        return static::where('is_active', true)->first();
    }

    /**
     * Calcule la commission d'affiliation pour un montant donné
     */
    public function calculateAffiliateCommission(float $providerFee): float
    {
        return ($this->affiliate_fee * $providerFee * 100) / 100;
    }
}
```

## 3.4 Modèle Payout

```php
<?php
// app/Models/Payout.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payout extends Model
{
    protected $fillable = [
        'user_id',
        'provider_id',
        'amount',
        'currency',
        'payout_type',           // 'affiliate', 'mission'
        'stripe_transfer_id',
        'stripe_payout_id',
        'bank_account_last4',
        'bank_account_type',     // 'connected_account', 'external_account'
        'status',                // processing, paid, failed
        'failure_reason',
        'paid_at',
    ];

    protected $casts = [
        'paid_at' => 'datetime',
        'amount' => 'decimal:2',
    ];

    // ============================================
    // CONSTANTES
    // ============================================

    const STATUS_PENDING = 'pending';
    const STATUS_PROCESSING = 'processing';
    const STATUS_COMPLETED = 'completed';
    const STATUS_PAID = 'paid';
    const STATUS_FAILED = 'failed';
    const STATUS_CANCELLED = 'cancelled';

    const TYPE_AFFILIATE = 'affiliate';
    const TYPE_MISSION = 'mission';

    // ============================================
    // RELATIONS
    // ============================================

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function provider(): BelongsTo
    {
        return $this->belongsTo(ServiceProvider::class);
    }

    // ============================================
    // SCOPES
    // ============================================

    public function scopeAffiliate($query)
    {
        return $query->where('payout_type', self::TYPE_AFFILIATE);
    }

    public function scopePaid($query)
    {
        return $query->where('status', self::STATUS_PAID);
    }

    public function scopeFailed($query)
    {
        return $query->where('status', self::STATUS_FAILED);
    }
}
```

---

# 4. FLUX D'INSCRIPTION AVEC AFFILIATION

## 4.1 Génération du Code d'Affiliation

```php
<?php
// app/Http/Controllers/RegisterController.php (extrait)

/**
 * Génère un code d'affiliation unique basé sur l'email et le nom
 */
private function generateAffiliateLink(string $email, string $firstName, ?string $lastName = null): string
{
    $base = strtolower(substr($firstName, 0, 3));

    if ($lastName) {
        $base .= strtolower(substr($lastName, 0, 3));
    }

    // Ajouter un hash unique
    $hash = substr(md5($email . time()), 0, 6);
    $code = $base . $hash;

    // S'assurer de l'unicité
    while (User::where('affiliate_code', $code)->exists()) {
        $hash = substr(md5($email . time() . rand()), 0, 6);
        $code = $base . $hash;
    }

    return $code;
}
```

## 4.2 Contrôleur d'Inscription via Affiliation

```php
<?php
// app/Http/Controllers/AffiliateController.php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AffiliateController extends Controller
{
    /**
     * Affiche le formulaire d'inscription avec validation du code affilié
     */
    public function affliateSignup(Request $request)
    {
        $code = $request->query('code');

        if (!$code) {
            return redirect()->route('login')
                ->with('error', 'Affiliate code is missing.');
        }

        // Optionnel: vérifier que le code existe
        $referrer = User::where('affiliate_code', $code)->first();

        if (!$referrer) {
            return redirect()->route('login')
                ->with('error', 'Invalid affiliate code.');
        }

        return view('user-auth.signup', [
            'affiliateCode' => $code,
            'referrer' => $referrer
        ]);
    }
}
```

## 4.3 Inscription d'un Nouvel Utilisateur (Service Requester)

```php
<?php
// app/Http/Controllers/RegisterController.php (extrait)

/**
 * Inscription standard des demandeurs de service
 */
public function signupRegister(Request $request)
{
    try {
        // 1. Récupérer le code d'affiliation
        $affiliateCode = $request->input('affiliate_code');
        $referrer = null;

        if ($affiliateCode) {
            $referrer = User::where('affiliate_code', $affiliateCode)->first();
        }

        // 2. Validation des données
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required',
                'string',
                'min:6',
                'regex:/[A-Z]/',    // Au moins 1 majuscule
                'regex:/[0-9]/',    // Au moins 1 chiffre
            ],
            'gender' => 'nullable|in:Male,Female'
        ]);

        // 3. Générer le code d'affiliation pour ce nouvel utilisateur
        $newAffiliateCode = $this->generateAffiliateLink(
            $request->input('email'),
            $request->input('name'),
            $request->input('last_name')
        );

        // 4. Créer l'utilisateur
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'user_role' => 'service_requester',
            'status' => 'active',
            'affiliate_code' => $newAffiliateCode,
            'gender' => $request->input('gender'),
            'referred_by' => $referrer ? $referrer->id : null,  // LIEN D'AFFILIATION
            'email_verified_at' => now(),
            // Initialisation des balances
            'affiliate_balance' => 0,
            'pending_affiliate_balance' => 0,
            'credit_balance' => 0,
        ]);

        // 5. Connexion automatique
        Auth::login($user);
        $user->update(['last_login_at' => now()]);

        return redirect()->route('dashboard');

    } catch (\Exception $e) {
        return redirect()->back()
            ->with('error', 'Registration failed: ' . $e->getMessage());
    }
}
```

## 4.4 URL d'Inscription avec Affiliation

```
Format: https://ulixai.com/affiliate/sign-up?code=XXXXXX

Exemple: https://ulixai.com/affiliate/sign-up?code=joh7f8e3a2
```

---

# 5. SYSTÈME DE COMMISSIONS

## 5.1 Structure des Taux de Commission

| Type de Frais | Taux Par Défaut | Description |
|---------------|-----------------|-------------|
| `requester_fee` | 5% (0.05) | Frais facturés au demandeur de service |
| `provider_fee` | 15% (0.15) | Frais déduits du paiement au prestataire |
| `org_fee` | 5% (0.05) | Frais de fonctionnement plateforme |
| `affiliate_fee` | 2.5% (0.025) | Commission reversée à l'affilié |

## 5.2 Calcul du Montant de Commission

```php
// Formule de calcul
$commissionAmount = ($affiliateFee * $providerFee) * 100 / 100;

// Exemple concret:
// - Mission: 100€
// - Provider fee (15%): 15€
// - Affiliate fee (2.5%): 2.5% × 15€ = 0.375€

// OU en pourcentage du montant total payé:
// Si affiliate_fee = 2.5% et amount_paid = 120€
// Commission = 120€ × 2.5% = 3€
```

## 5.3 Tableau des Statuts de Commission

| Statut | Description | Transition |
|--------|-------------|------------|
| `pending` | Commission créée, en attente de validation | → available |
| `available` | Commission disponible pour retrait | → paid |
| `paid` | Commission retirée par l'affilié | Final |

---

# 6. CALCUL ET CRÉATION DES COMMISSIONS

## 6.1 Service de Paiement - Création de Commission

```php
<?php
// app/Services/PaymentService.php

namespace App\Services;

use App\Models\AffiliateCommission;
use App\Models\Mission;
use App\Models\ServiceProvider;
use App\Models\Transaction;
use App\Models\UlixCommission;
use App\Models\User;
use Stripe\StripeClient;
use Stripe\Transfer;
use Stripe\PaymentIntent;

class PaymentService
{
    protected StripeClient $stripe;

    public function __construct()
    {
        $this->stripe = new StripeClient(config('services.stripe.secret'));
    }

    /**
     * Transfère les fonds au provider et crée la commission d'affiliation
     */
    public function transferFunds(Mission $mission, ServiceProvider $provider): Transfer
    {
        // 1. Récupérer la configuration des commissions
        $commission = UlixCommission::getActive();

        if (!$commission) {
            throw new \Exception('No active commission configuration found');
        }

        // 2. Récupérer la transaction et le PaymentIntent Stripe
        $transaction = $mission->transactions()->first();

        if (!$transaction) {
            throw new \Exception('No transaction found for this mission');
        }

        $stripeIntent = PaymentIntent::retrieve($transaction->stripe_payment_intent_id);

        // 3. Calculer le montant du transfer au provider
        // amount_received est en centimes
        $amountReceived = $stripeIntent->amount_received;
        $providerFeeAmount = $amountReceived * $commission->provider_fee;
        $transferAmount = floor($amountReceived - $providerFeeAmount);

        // 4. Effectuer le transfer vers le compte Stripe du provider
        $transfer = Transfer::create([
            'amount' => $transferAmount,
            'currency' => 'eur',
            'destination' => $provider->stripe_account_id,
            'transfer_group' => 'MISSION_' . $mission->id,
            'metadata' => [
                'mission_id' => $mission->id,
                'provider_id' => $provider->id,
            ],
        ]);

        // 5. CRÉER LA COMMISSION D'AFFILIATION SI LE REQUESTER A UN PARRAIN
        $this->createAffiliateCommission($mission, $transaction, $commission);

        return $transfer;
    }

    /**
     * Crée une commission d'affiliation si applicable
     */
    protected function createAffiliateCommission(
        Mission $mission,
        Transaction $transaction,
        UlixCommission $commission
    ): void {
        // Récupérer le requester (celui qui a payé la mission)
        $referee = User::find($mission->requester_id);

        // Vérifier s'il a un parrain
        if (!$referee || !$referee->referred_by) {
            return; // Pas de parrain, pas de commission
        }

        // Récupérer le parrain
        $referrer = User::find($referee->referred_by);

        if (!$referrer) {
            return; // Parrain introuvable
        }

        // Calculer le montant de la commission
        $commissionAmount = $commission->calculateAffiliateCommission(
            (float) $transaction->provider_fee
        );

        // Si le montant est trop faible, on peut ignorer
        if ($commissionAmount < 0.01) {
            return;
        }

        // Créer l'enregistrement de commission
        AffiliateCommission::create([
            'referrer_id' => $referrer->id,
            'referee_id' => $referee->id,
            'mission_id' => $mission->id,
            'amount' => $commissionAmount,
            'status' => AffiliateCommission::STATUS_AVAILABLE,
            'payout_method' => 'stripe',
            'stripe_transfer_id' => null, // Sera rempli lors du payout
        ]);

        // Mettre à jour les balances de l'affilié
        $referrer->increment('affiliate_balance', $commissionAmount);
        $referrer->increment('pending_affiliate_balance', $commissionAmount);
    }
}
```

## 6.2 Déclenchement Automatique (Cron)

```php
<?php
// app/Console/Commands/ReleasePendingPayments.php

namespace App\Console\Commands;

use App\Models\Mission;
use App\Services\PaymentService;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ReleasePendingPayments extends Command
{
    protected $signature = 'payments:release-pending';
    protected $description = 'Release payments for completed missions after 7 days';

    protected PaymentService $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        parent::__construct();
        $this->paymentService = $paymentService;
    }

    public function handle()
    {
        // Trouver les missions complétées depuis plus de 7 jours
        $missions = Mission::where('payment_status', 'held')
            ->where('status', 'completed')
            ->where('updated_at', '<=', Carbon::now()->subHours(168)) // 7 jours
            ->with(['selectedProvider', 'transactions'])
            ->get();

        foreach ($missions as $mission) {
            try {
                // Transférer les fonds et créer la commission
                $this->paymentService->transferFunds(
                    $mission,
                    $mission->selectedProvider
                );

                // Mettre à jour le statut
                $mission->update([
                    'payment_status' => 'released',
                    'status' => 'completed',
                ]);

                $this->info("Released payment for mission #{$mission->id}");

            } catch (\Exception $e) {
                $this->error("Failed to release payment for mission #{$mission->id}: {$e->getMessage()}");
            }
        }

        $this->info("Processed {$missions->count()} missions");
    }
}
```

---

# 7. GESTION DES SOLDES AFFILIÉS

## 7.1 Les Deux Types de Balance

| Champ | Description | Utilisation |
|-------|-------------|-------------|
| `affiliate_balance` | Total cumulé des commissions gagnées | Historique, statistiques |
| `pending_affiliate_balance` | Montant disponible au retrait | Retrait, paiement |

## 7.2 Logique des Balances

```php
// Quand une commission est créée:
$referrer->increment('affiliate_balance', $amount);        // Total += amount
$referrer->increment('pending_affiliate_balance', $amount); // Pending += amount

// Quand un retrait est effectué:
$user->pending_affiliate_balance = 0;  // Pending = 0
// affiliate_balance reste inchangé (historique)

// Calcul du montant déjà retiré:
$withdrawn = $user->affiliate_balance - $user->pending_affiliate_balance;
```

## 7.3 Affichage du Dashboard Affilié

```php
<?php
// app/Http/Controllers/AccountController.php (extrait)

public function affiliationAccounts(Request $request)
{
    $user = Auth::user();

    if (!$user) {
        return redirect()->route('login');
    }

    // Récupérer tous les utilisateurs parrainés
    $affiliates = $user->referrals()
        ->with(['missions.transactions'])
        ->get();

    // Calculer les statistiques
    $stats = [
        'total_referrals' => $affiliates->count(),
        'total_balance' => $user->affiliate_balance,
        'pending_balance' => $user->pending_affiliate_balance,
        'total_withdrawn' => $user->affiliate_balance - $user->pending_affiliate_balance,
    ];

    return view('dashboard.my-affiliate-account', compact('affiliates', 'user', 'stats'));
}
```

---

# 8. SYSTÈME DE RETRAIT (PAYOUT)

## 8.1 Contrôleur de Retrait

```php
<?php
// app/Http/Controllers/EarningsController.php

namespace App\Http\Controllers;

use App\Mail\PayoutProcessedMail;
use App\Models\Payout;
use App\Models\User;
use App\Services\PaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Stripe\StripeClient;

class EarningsController extends Controller
{
    protected PaymentService $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    /**
     * Affiche le dashboard des gains
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        $provider = $user->serviceProvider;
        $stripeBalance = null;

        if ($provider && $provider->stripe_account_id) {
            try {
                $stripeBalance = $this->paymentService->providerAccountBalance($provider);
            } catch (\Exception $e) {
                $stripeBalance = ['error' => 'Unable to fetch Stripe balance.'];
            }
        }

        return view('dashboard.my-earnings', [
            'user' => $user,
            'provider' => $provider,
            'balance' => $stripeBalance,
        ]);
    }

    /**
     * Traite le retrait des fonds d'affiliation
     */
    public function manageUserFunds(Request $request)
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login');
        }

        DB::beginTransaction();

        try {
            $stripe = new StripeClient(config('services.stripe.secret'));
            $affiliateAmount = (float) ($user->pending_affiliate_balance ?? 0);

            // Créer l'enregistrement de payout initial
            $payoutRecord = Payout::create([
                'user_id' => $user->id,
                'provider_id' => $user->serviceProvider->id ?? null,
                'amount' => $affiliateAmount,
                'currency' => 'eur',
                'payout_type' => Payout::TYPE_AFFILIATE,
                'status' => Payout::STATUS_PROCESSING,
            ]);

            // ================================================================
            // CAS 1: SERVICE PROVIDER AVEC COMPTE STRIPE CONNECT
            // ================================================================
            if ($user->user_role === 'service_provider' &&
                isset($user->serviceProvider->stripe_account_id)) {

                $this->processProviderPayout($user, $stripe, $payoutRecord, $affiliateAmount);
            }
            // ================================================================
            // CAS 2: UTILISATEUR STANDARD AVEC DÉTAILS BANCAIRES
            // ================================================================
            else {
                $this->processDirectPayout($user, $stripe, $payoutRecord, $affiliateAmount);
            }

            DB::commit();

            // Envoyer l'email de confirmation
            Mail::to($user->email)->queue(new PayoutProcessedMail($payoutRecord));

            return back()->with('success', "Your withdrawal of {$payoutRecord->amount}€ has been processed successfully.");

        } catch (\Exception $e) {
            DB::rollBack();

            if (isset($payoutRecord)) {
                $payoutRecord->update([
                    'status' => Payout::STATUS_FAILED,
                    'failure_reason' => $e->getMessage(),
                ]);
            }

            return back()->with('error', 'Withdrawal failed: ' . $e->getMessage());
        }
    }

    /**
     * Retrait pour un Service Provider via Stripe Connect
     */
    protected function processProviderPayout(
        User $user,
        StripeClient $stripe,
        Payout $payoutRecord,
        float $affiliateAmount
    ): void {
        $accountId = $user->serviceProvider->stripe_account_id;

        // Vérifier que le compte Stripe est activé
        $account = $stripe->accounts->retrieve($accountId);

        if (!$account->charges_enabled || !$account->payouts_enabled) {
            throw new \Exception('Your Stripe account is not fully verified. Please complete your Stripe onboarding.');
        }

        // Récupérer le solde disponible du compte Connect
        $balance = $stripe->balance->retrieve([], ['stripe_account' => $accountId]);
        $availableBalance = ($balance->available[0]->amount ?? 0) / 100;

        // Calculer le total à retirer
        $totalPayoutAmount = $affiliateAmount + $availableBalance;

        // Vérifier le montant minimum (30€)
        if ($totalPayoutAmount < 30) {
            throw new \Exception('Total balance (€' . number_format($totalPayoutAmount, 2) . ') is less than minimum withdrawal amount (€30)');
        }

        // 1. Transférer les commissions d'affiliation vers le compte Connect
        if ($affiliateAmount > 0) {
            $transfer = $stripe->transfers->create([
                'amount' => (int) round($affiliateAmount * 100),
                'currency' => 'eur',
                'destination' => $accountId,
                'description' => 'Affiliate commission transfer',
                'transfer_group' => 'affiliate_transfer_' . $user->id,
                'metadata' => [
                    'user_id' => $user->id,
                    'payout_record_id' => $payoutRecord->id,
                    'type' => 'affiliate_commission',
                ],
            ]);

            $payoutRecord->update([
                'stripe_transfer_id' => $transfer->id,
                'bank_account_type' => 'connected_account',
            ]);
        }

        // 2. Créer le payout depuis le compte Connect vers la banque
        $stripePayout = $stripe->payouts->create(
            [
                'amount' => (int) round($totalPayoutAmount * 100),
                'currency' => 'eur',
                'method' => 'standard',
                'metadata' => [
                    'user_id' => $user->id,
                    'payout_record_id' => $payoutRecord->id,
                ],
            ],
            ['stripe_account' => $accountId]
        );

        // 3. Mettre à jour l'enregistrement payout
        $payoutRecord->update([
            'amount' => $totalPayoutAmount,
            'stripe_payout_id' => $stripePayout->id,
            'status' => Payout::STATUS_PAID,
            'paid_at' => now(),
        ]);

        // 4. Réinitialiser le solde d'affiliation
        $user->pending_affiliate_balance = 0;
        $user->save();
    }

    /**
     * Retrait direct pour un utilisateur sans compte Stripe Connect
     */
    protected function processDirectPayout(
        User $user,
        StripeClient $stripe,
        Payout $payoutRecord,
        float $affiliateAmount
    ): void {
        // Vérifier que les détails bancaires sont renseignés
        if (!$user->hasBankingDetails()) {
            throw new \Exception('Please add your bank account details before withdrawing.');
        }

        // Vérifier le montant minimum (30€)
        if ($affiliateAmount < 30) {
            throw new \Exception('Minimum withdrawal amount is €30. Your current balance is €' . number_format($affiliateAmount, 2));
        }

        // Créer le payout direct vers le compte bancaire
        // NOTE: Cette méthode nécessite une configuration Stripe spécifique
        // pour les payouts vers des comptes externes (IBAN)
        $stripePayout = $stripe->payouts->create([
            'amount' => (int) round($affiliateAmount * 100),
            'currency' => 'eur',
            'method' => 'standard',
            'statement_descriptor' => 'Ulix.ai Affiliate',
            'metadata' => [
                'user_id' => $user->id,
                'payout_type' => 'affiliate_commission',
                'payout_record_id' => $payoutRecord->id,
            ],
        ]);

        // Mettre à jour l'enregistrement payout
        $payoutRecord->update([
            'stripe_payout_id' => $stripePayout->id,
            'bank_account_last4' => substr($user->bank_account_iban, -4),
            'bank_account_type' => 'external_account',
            'status' => Payout::STATUS_PAID,
            'paid_at' => now(),
        ]);

        // Réinitialiser le solde d'affiliation
        $user->pending_affiliate_balance = 0;
        $user->save();
    }
}
```

## 8.2 Montant Minimum de Retrait

```php
const MINIMUM_WITHDRAWAL_AMOUNT = 30; // en EUR

// Validation dans le contrôleur:
if ($totalPayoutAmount < self::MINIMUM_WITHDRAWAL_AMOUNT) {
    throw new \Exception('Minimum withdrawal amount is €30');
}
```

## 8.3 Email de Confirmation

```php
<?php
// app/Mail/PayoutProcessedMail.php

namespace App\Mail;

use App\Models\Payout;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PayoutProcessedMail extends Mailable
{
    use Queueable, SerializesModels;

    public Payout $payout;

    public function __construct(Payout $payout)
    {
        $this->payout = $payout;
    }

    public function build()
    {
        return $this->subject('Your Ulixai Payout Has Been Processed')
            ->markdown('emails.payout-processed', [
                'payout' => $this->payout,
                'user' => $this->payout->user,
            ]);
    }
}
```

---

# 9. INTÉGRATION STRIPE

## 9.1 Configuration Stripe

```php
// config/services.php
return [
    'stripe' => [
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
        'webhook_secret' => env('STRIPE_WEBHOOK_SECRET'),
    ],
];

// .env
STRIPE_KEY=pk_live_xxxxx
STRIPE_SECRET=sk_live_xxxxx
STRIPE_WEBHOOK_SECRET=whsec_xxxxx
```

## 9.2 Création de Compte Stripe Connect

```php
<?php
// app/Services/PaymentService.php (extrait)

/**
 * Crée un compte Stripe Connect pour un service provider
 */
public function createConnectAccount(ServiceProvider $provider): array
{
    // Déterminer le code pays
    $countryField = $provider->provider_address ?: $provider->country;
    $country = Country::where('country', $countryField)->first();
    $countryCode = $country?->short_name ?? 'FR';

    // 1. Créer un token de compte
    $token = $this->stripe->tokens->create([
        'account' => [
            'business_type' => 'individual',
            'individual' => [
                'first_name' => $provider->first_name,
                'last_name' => $provider->last_name,
                'email' => $provider->email,
            ],
            'tos_shown_and_accepted' => true,
        ],
    ]);

    // 2. Créer le compte Connect
    $account = $this->stripe->accounts->create([
        'type' => 'custom',
        'country' => $countryCode,
        'email' => $provider->email,
        'account_token' => $token->id,
        'capabilities' => [
            'card_payments' => ['requested' => true],
            'transfers' => ['requested' => true],
        ],
        'business_profile' => [
            'product_description' => 'Ulixai Service Provider',
            'mcc' => '7299', // Miscellaneous Personal Services
        ],
    ]);

    // 3. Vérifier si l'onboarding KYC est nécessaire
    if (!$account->details_submitted) {
        $accountLink = $this->stripe->accountLinks->create([
            'account' => $account->id,
            'refresh_url' => route('stripe.refresh'),
            'return_url' => route('stripe.return'),
            'type' => 'account_onboarding',
        ]);

        return [
            'account_id' => $account->id,
            'onboarding_url' => $accountLink->url,
            'isKYCComplete' => false,
        ];
    }

    return [
        'account_id' => $account->id,
        'onboarding_url' => null,
        'isKYCComplete' => true,
    ];
}

/**
 * Met à jour les informations Stripe du provider
 */
public function updateProviderStripeInfo(ServiceProvider $provider, array $stripeAccount): void
{
    $provider->update([
        'stripe_account_id' => $stripeAccount['account_id'],
        'kyc_link' => $stripeAccount['onboarding_url'],
        'kyc_status' => $stripeAccount['isKYCComplete'] ? 'verified' : 'pending',
    ]);
}

/**
 * Récupère le solde d'un compte provider
 */
public function providerAccountBalance(ServiceProvider $provider): array
{
    $balance = $this->stripe->balance->retrieve(
        [],
        ['stripe_account' => $provider->stripe_account_id]
    );

    return [
        'available' => ($balance->available[0]->amount ?? 0) / 100,
        'pending' => ($balance->pending[0]->amount ?? 0) / 100,
        'currency' => $balance->available[0]->currency ?? 'eur',
    ];
}
```

## 9.3 Webhook Stripe

```php
<?php
// app/Http/Controllers/StripeWebhookController.php

namespace App\Http\Controllers;

use App\Models\Mission;
use App\Models\Transaction;
use App\Models\UlixCommission;
use Illuminate\Http\Request;
use Stripe\Webhook;

class StripeWebhookController extends Controller
{
    public function handleWebhook(Request $request)
    {
        $endpointSecret = config('services.stripe.webhook_secret');
        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');

        try {
            $event = Webhook::constructEvent($payload, $sigHeader, $endpointSecret);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Invalid signature'], 400);
        }

        switch ($event->type) {
            case 'payment_intent.succeeded':
                $this->handlePaymentSuccess($event->data->object);
                break;

            case 'payout.paid':
                $this->handlePayoutPaid($event->data->object);
                break;

            case 'payout.failed':
                $this->handlePayoutFailed($event->data->object);
                break;
        }

        return response()->json(['status' => 'success']);
    }

    protected function handlePaymentSuccess($paymentIntent)
    {
        // Éviter les doublons
        if (Transaction::where('stripe_payment_intent_id', $paymentIntent->id)->exists()) {
            return;
        }

        $commission = UlixCommission::getActive();

        Transaction::create([
            'mission_id' => $paymentIntent->metadata->mission_id,
            'provider_id' => $paymentIntent->metadata->provider_id,
            'offer_id' => $paymentIntent->metadata->offer_id,
            'stripe_payment_intent_id' => $paymentIntent->id,
            'amount_paid' => $paymentIntent->amount / 100,
            'client_fee' => $paymentIntent->metadata->client_fee ?? 0,
            'provider_fee' => ($paymentIntent->amount / 100) * ($commission->provider_fee ?? 0.15),
            'status' => 'paid',
        ]);

        // Mettre à jour la mission
        Mission::find($paymentIntent->metadata->mission_id)?->update([
            'payment_status' => 'paid',
        ]);
    }

    protected function handlePayoutPaid($payout)
    {
        // Mettre à jour l'enregistrement Payout si nécessaire
        if (isset($payout->metadata->payout_record_id)) {
            \App\Models\Payout::find($payout->metadata->payout_record_id)?->update([
                'status' => 'paid',
                'paid_at' => now(),
            ]);
        }
    }

    protected function handlePayoutFailed($payout)
    {
        if (isset($payout->metadata->payout_record_id)) {
            \App\Models\Payout::find($payout->metadata->payout_record_id)?->update([
                'status' => 'failed',
                'failure_reason' => $payout->failure_message ?? 'Unknown error',
            ]);
        }
    }
}
```

---

# 10. INTERFACE ADMINISTRATION

## 10.1 Contrôleur Admin des Affiliés

```php
<?php
// app/Http/Controllers/Admin/AdminDashboardController.php (extraits)

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    /**
     * Affiche le résumé de tous les affiliés
     */
    public function showAffiliateSummary()
    {
        // Récupérer les IDs uniques des referrers
        $referrerIds = User::whereNotNull('referred_by')
            ->distinct()
            ->pluck('referred_by');

        // Récupérer les affiliés
        $affiliates = User::whereIn('id', $referrerIds)
            ->with(['referrals' => function ($query) {
                $query->select('id', 'name', 'email', 'referred_by', 'created_at');
            }])
            ->get();

        // Calculer les totaux
        $total = (float) User::sum('affiliate_balance');
        $totalWithdrawn = (float) User::sum('affiliate_balance') - (float) User::sum('pending_affiliate_balance');
        $totalPending = (float) User::sum('pending_affiliate_balance');

        return view('admin.dashboard.affiliates.index', compact(
            'affiliates',
            'total',
            'totalWithdrawn',
            'totalPending'
        ));
    }

    /**
     * Affiche les détails d'un affilié spécifique
     */
    public function affiliateDetails(Request $request, $id)
    {
        $affiliate = User::findOrFail($id);

        // Récupérer les referrals avec leurs dépenses
        $referrals = $affiliate->referrals()
            ->with(['missions:id,requester_id', 'missions.transactions:id,mission_id,amount_paid'])
            ->get(['id', 'name', 'email', 'created_at']);

        // Calculer le total dépensé par chaque referral
        $referrals = $referrals->map(function ($ref) {
            $total = $ref->missions
                ->flatMap->transactions
                ->sum('amount_paid');
            $ref->total_spent = (float) $total;
            return $ref;
        });

        // Statistiques de l'affilié
        $totalRevenue = (float) ($affiliate->affiliate_balance ?? 0);
        $totalWithdrawn = $totalRevenue - (float) ($affiliate->pending_affiliate_balance ?? 0);

        return view('admin.dashboard.affiliates.affiliate-info', compact(
            'affiliate',
            'referrals',
            'totalRevenue',
            'totalWithdrawn'
        ));
    }

    /**
     * Met à jour les taux de commission
     */
    public function updateCommission(Request $request)
    {
        $request->validate([
            'requester_fee' => 'required|numeric|min:0|max:100',
            'provider_fee' => 'required|numeric|min:0|max:100',
            'affiliate_fee' => 'required|numeric|min:0|max:100',
        ]);

        $commission = UlixCommission::getActive();

        if ($commission) {
            $commission->update([
                'requester_fee' => $request->requester_fee / 100,
                'provider_fee' => $request->provider_fee / 100,
                'affiliate_fee' => $request->affiliate_fee / 100,
            ]);
        }

        return back()->with('success', 'Commission rates updated successfully!');
    }
}
```

## 10.2 Gestion Utilisateur avec Actions d'Affiliation

```php
<?php
// app/Http/Controllers/Admin/UserManagementController.php (extraits)

/**
 * Gère un utilisateur spécifique (admin)
 */
public function manage(Request $request, $userId)
{
    $user = User::findOrFail($userId);

    // GET: Afficher la page de gestion
    if ($request->isMethod('get')) {
        return view('admin.dashboard.user-manage', compact('user'));
    }

    // POST/PATCH: Actions de gestion

    // 1. Modifier le solde payable
    if ($request->has('edit_payable_user_id')) {
        $targetUser = User::findOrFail($request->edit_payable_user_id);
        $targetUser->update([
            'pending_affiliate_balance' => $request->new_payable_amount,
        ]);
        return back()->with('success', 'Payable balance updated.');
    }

    // 2. Réassigner le referrer (retroactive linking)
    if ($request->has('retroactive_user_id')) {
        $referralUser = User::findOrFail($request->retroactive_user_id);

        // Trouver le nouveau referrer par email ou ID
        $newReferrer = User::where('email', $request->new_referrer_id)
            ->orWhere('id', $request->new_referrer_id)
            ->first();

        if (!$newReferrer) {
            return back()->with('error', 'Referrer not found.');
        }

        $referralUser->update(['referred_by' => $newReferrer->id]);
        return back()->with('success', 'Referrer reassigned successfully.');
    }

    // 3. Bloquer un affilié
    if ($request->has('block_affiliate_user_id')) {
        User::findOrFail($request->block_affiliate_user_id)
            ->update(['status' => 'suspended']);
        return back()->with('success', 'Affiliate blocked.');
    }

    // 4. Débloquer un affilié
    if ($request->has('unblock_affiliate_user_id')) {
        User::findOrFail($request->unblock_affiliate_user_id)
            ->update(['status' => 'active']);
        return back()->with('success', 'Affiliate unblocked.');
    }

    return back();
}
```

---

# 11. ROUTES ET API

## 11.1 Routes Publiques

```php
// routes/web.php

// Page d'affiliation publique
Route::get('/affiliate', function () {
    $reviewController = new \App\Http\Controllers\ReviewController();
    $reviews = $reviewController->getAffiliateReviews(3);
    return view('pages.affiliate', compact('reviews'));
})->name('affiliate');

// Inscription via lien d'affiliation
Route::get('/affiliate/sign-up', [AffiliateController::class, 'affliateSignup']);

// Inscription avec code affilié
Route::post('/signup/register', [RegisterController::class, 'signupRegister'])
    ->middleware('throttle:5,1')
    ->name('user.signupRegister');
```

## 11.2 Routes Authentifiées (Utilisateur)

```php
// routes/web.php

Route::middleware(['auth'])->group(function () {
    // Dashboard des affiliations
    Route::get('/affiliations', [AccountController::class, 'affiliationAccounts'])
        ->name('user.affiliate.account');

    // Dashboard des gains
    Route::get('/my-earnings', [EarningsController::class, 'index'])
        ->name('user.earnings');

    // Retrait des fonds
    Route::post('/user/funds', [EarningsController::class, 'manageUserFunds'])
        ->name('affiliate.withdraw');

    // Mise à jour des détails bancaires
    Route::post('/banking-details', [AccountController::class, 'updateBankingDetails'])
        ->name('user.banking.update');
});
```

## 11.3 Routes Admin

```php
// routes/web.php

Route::middleware(['auth:admin', 'admin.auth'])->prefix('admin')->group(function () {
    // Liste des affiliés
    Route::get('/user-affiliations', [AdminDashboardController::class, 'showAffiliateSummary'])
        ->name('admin.affiliations');

    // Détails d'un affilié
    Route::get('/affiliate-details/{id}', [AdminDashboardController::class, 'affiliateDetails'])
        ->name('admin.affiliates.details');

    // Mise à jour des commissions
    Route::post('/commission/update', [AdminDashboardController::class, 'updateCommission'])
        ->name('admin.commission.update');

    // Gestion utilisateur
    Route::match(['get', 'post', 'patch'], '/users/{userId}/manage', [UserManagementController::class, 'manage'])
        ->name('admin.users.manage');

    // Comptabilité
    Route::get('/accounting', [AccountingController::class, 'index'])
        ->name('admin.accounting');

    Route::get('/accounting/export', [AccountingController::class, 'export'])
        ->name('admin.accounting.export');
});
```

## 11.4 Routes Webhook Stripe

```php
// routes/web.php

Route::post('/stripe/webhook', [StripeWebhookController::class, 'handleWebhook'])
    ->name('stripe.webhook')
    ->withoutMiddleware(['csrf', 'verify-csrf-token']);
```

---

# 12. VUES ET TEMPLATES

## 12.1 Structure des Fichiers de Vues

```
resources/views/
├── admin/
│   └── dashboard/
│       ├── affiliates/
│       │   ├── index.blade.php           # Liste des affiliés (admin)
│       │   └── affiliate-info.blade.php  # Détails d'un affilié
│       └── partials/
│           └── affiliate-accounts-table.blade.php
├── dashboard/
│   ├── my-affiliate-account.blade.php    # Dashboard affilié (utilisateur)
│   ├── my-earnings.blade.php             # Page des gains
│   ├── my-earnings-payments.blade.php    # Formulaire de retrait
│   └── partials/
│       └── affiliate-card.blade.php
├── pages/
│   └── affiliate.blade.php               # Page publique d'affiliation
└── user-auth/
    └── signup.blade.php                  # Formulaire d'inscription
```

## 12.2 Vue Admin - Liste des Affiliés

```blade
{{-- resources/views/admin/dashboard/affiliates/index.blade.php --}}

@extends('admin.dashboard.layout')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Affiliate Management</h1>

    {{-- Cartes de statistiques --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-gray-500 text-sm">Total Affiliate Revenue</h3>
            <p class="text-3xl font-bold text-green-600">{{ number_format($total, 2) }} €</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-gray-500 text-sm">Total Withdrawn</h3>
            <p class="text-3xl font-bold text-blue-600">{{ number_format($totalWithdrawn, 2) }} €</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-gray-500 text-sm">Pending Payouts</h3>
            <p class="text-3xl font-bold text-orange-600">{{ number_format($totalPending, 2) }} €</p>
        </div>
    </div>

    {{-- Table des affiliés --}}
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Affiliate</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Referrals</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Balance</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pending</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Joined</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($affiliates as $affiliate)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div>
                                <div class="text-sm font-medium text-gray-900">{{ $affiliate->name }}</div>
                                <div class="text-sm text-gray-500">{{ $affiliate->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $affiliate->referrals->count() }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ number_format($affiliate->affiliate_balance, 2) }} €
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($affiliate->pending_affiliate_balance > 0)
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                {{ number_format($affiliate->pending_affiliate_balance, 2) }} €
                            </span>
                        @else
                            <span class="text-sm text-gray-500">0 €</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $affiliate->created_at->format('d/m/Y') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('admin.affiliates.details', $affiliate->id) }}"
                           class="text-indigo-600 hover:text-indigo-900">
                            View Details
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                        No affiliates found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
```

## 12.3 Vue Utilisateur - Dashboard Affilié

```blade
{{-- resources/views/dashboard/my-affiliate-account.blade.php --}}

@extends('dashboard.layout')

@section('content')
<div class="container mx-auto px-4 py-8">
    {{-- Banner avec lien d'affiliation --}}
    <div class="bg-gradient-to-r from-blue-600 to-cyan-500 rounded-2xl p-8 text-white mb-8">
        <h1 class="text-2xl font-bold mb-2">Share your affiliate link and earn passive income</h1>
        <p class="text-blue-100 mb-4">You earn 75% for life on the service fees spent by your referrals</p>

        <div class="flex items-center gap-4">
            <input type="text"
                   id="affiliateLink"
                   value="{{ $user->getAffiliateLink() }}"
                   class="flex-1 px-4 py-3 rounded-lg text-gray-800"
                   readonly>
            <button onclick="copyLink()"
                    class="bg-white text-blue-600 px-6 py-3 rounded-lg font-semibold hover:bg-blue-50">
                Copy Link
            </button>
        </div>
    </div>

    {{-- Statistiques --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-sm p-6 border">
            <h3 class="text-gray-500 text-sm mb-1">Total Referrals</h3>
            <p class="text-3xl font-bold">{{ $affiliates->count() }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-6 border">
            <h3 class="text-gray-500 text-sm mb-1">Available Balance</h3>
            <p class="text-3xl font-bold text-green-600">{{ number_format($user->pending_affiliate_balance, 2) }} €</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-6 border">
            <h3 class="text-gray-500 text-sm mb-1">Total Earned</h3>
            <p class="text-3xl font-bold">{{ number_format($user->affiliate_balance, 2) }} €</p>
        </div>
    </div>

    {{-- Liste des referrals --}}
    <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
        <div class="px-6 py-4 border-b">
            <h2 class="text-lg font-semibold">Your Referrals</h2>
        </div>

        @forelse($affiliates as $referral)
        <div class="px-6 py-4 border-b last:border-b-0 flex items-center justify-between">
            <div>
                <p class="font-medium">{{ $referral->name }}</p>
                <p class="text-sm text-gray-500">{{ $referral->email }}</p>
            </div>
            <div class="text-right">
                <p class="text-sm text-gray-500">Joined {{ $referral->created_at->diffForHumans() }}</p>
            </div>
        </div>
        @empty
        <div class="px-6 py-8 text-center text-gray-500">
            <p>You haven't referred anyone yet.</p>
            <p class="text-sm">Share your link above to start earning!</p>
        </div>
        @endforelse
    </div>

    {{-- Bouton de retrait --}}
    @if($user->pending_affiliate_balance >= 30)
    <div class="mt-8 text-center">
        <form action="{{ route('affiliate.withdraw') }}" method="POST">
            @csrf
            <button type="submit"
                    class="bg-gradient-to-r from-green-500 to-emerald-600 text-white px-8 py-4 rounded-xl font-semibold hover:opacity-90">
                Withdraw {{ number_format($user->pending_affiliate_balance, 2) }} €
            </button>
        </form>
    </div>
    @else
    <div class="mt-8 text-center text-gray-500">
        <p>Minimum withdrawal amount: 30 €</p>
        <p class="text-sm">Current balance: {{ number_format($user->pending_affiliate_balance, 2) }} €</p>
    </div>
    @endif
</div>

<script>
function copyLink() {
    const input = document.getElementById('affiliateLink');
    input.select();
    navigator.clipboard.writeText(input.value);
    alert('Link copied to clipboard!');
}
</script>
@endsection
```

---

# 13. COMMANDES CRON

## 13.1 Planification des Tâches

```php
// app/Console/Kernel.php

protected function schedule(Schedule $schedule)
{
    // Libérer les paiements des missions complétées (7 jours)
    $schedule->command('payments:release-pending')
        ->hourly()
        ->withoutOverlapping();

    // Traiter les remboursements des missions disputées (24h)
    $schedule->command('payments:refund-cancelled')
        ->hourly()
        ->withoutOverlapping();
}
```

## 13.2 Commande de Libération des Paiements

```php
<?php
// app/Console/Commands/ReleasePendingPayments.php

// (Voir section 6.2 pour le code complet)
```

## 13.3 Commande de Remboursement

```php
<?php
// app/Console/Commands/RefundCancelledMissions.php

namespace App\Console\Commands;

use App\Models\Mission;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Stripe\Refund;
use Stripe\PaymentIntent;

class RefundCancelledMissions extends Command
{
    protected $signature = 'payments:refund-cancelled';
    protected $description = 'Refund payments for disputed/cancelled missions after 24 hours';

    public function handle()
    {
        $missions = Mission::where('status', 'disputed')
            ->where('payment_status', 'held')
            ->where('cancelled_on', '<=', Carbon::now()->subHours(24))
            ->with('transactions')
            ->get();

        foreach ($missions as $mission) {
            $this->processMissionRefund($mission);
        }

        $this->info("Processed {$missions->count()} refunds");
    }

    protected function processMissionRefund(Mission $mission)
    {
        $transaction = $mission->transactions()->where('status', 'paid')->first();

        if (!$transaction) {
            $this->warn("No paid transaction found for mission #{$mission->id}");
            return;
        }

        try {
            $paymentIntent = PaymentIntent::retrieve($transaction->stripe_payment_intent_id);

            $refund = Refund::create([
                'payment_intent' => $paymentIntent->id,
                'amount' => (int) ($paymentIntent->metadata->mission_amount * 100),
            ]);

            if ($refund->status === 'succeeded') {
                $mission->update([
                    'status' => 'cancelled',
                    'payment_status' => 'refunded',
                    'selected_provider_id' => null,
                ]);

                $transaction->update(['status' => 'refunded']);

                $this->info("Refunded mission #{$mission->id}");
            }

        } catch (\Exception $e) {
            $this->error("Failed to refund mission #{$mission->id}: {$e->getMessage()}");
        }
    }
}
```

---

# 14. SÉCURITÉ ET VALIDATIONS

## 14.1 Chiffrement des Données Sensibles

```php
// Dans le modèle User
protected $casts = [
    'bank_account_iban' => 'encrypted',  // Chiffrement automatique Laravel
    'bank_swift_bic' => 'encrypted',
];

// Laravel utilise APP_KEY pour le chiffrement AES-256-CBC
```

## 14.2 Validation des Signatures Webhook Stripe

```php
// Dans StripeWebhookController
try {
    $event = Webhook::constructEvent(
        $payload,
        $sigHeader,
        config('services.stripe.webhook_secret')
    );
} catch (\Stripe\Exception\SignatureVerificationException $e) {
    return response()->json(['error' => 'Invalid signature'], 400);
}
```

## 14.3 Protection CSRF et Throttling

```php
// Routes avec throttling
Route::post('/signup/register', [RegisterController::class, 'signupRegister'])
    ->middleware('throttle:5,1');  // 5 tentatives par minute

// Admin login
Route::post('/login', [AdminAuthController::class, 'login'])
    ->middleware('throttle:5,1');
```

## 14.4 Middleware Admin

```php
<?php
// app/Http/Middleware/AdminAuthenticate.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthenticate
{
    public function handle(Request $request, Closure $next)
    {
        // Vérifier si l'utilisateur usurpe une identité
        if (session()->has('is_impersonating')) {
            abort(403, 'Cannot access admin panel while impersonating.');
        }

        // Vérifier l'authentification admin
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login.form');
        }

        return $next($request);
    }
}
```

## 14.5 Validation des Montants

```php
// Montant minimum de retrait
const MINIMUM_WITHDRAWAL = 30; // EUR

// Vérification avant payout
if ($amount < self::MINIMUM_WITHDRAWAL) {
    throw new \Exception('Minimum withdrawal amount is €30');
}

// Vérification du compte Stripe
if (!$account->charges_enabled || !$account->payouts_enabled) {
    throw new \Exception('Stripe account not verified');
}
```

## 14.6 Transactions Atomiques

```php
DB::beginTransaction();
try {
    // Opérations critiques
    $payout = Payout::create([...]);
    $stripe->transfers->create([...]);
    $user->update(['pending_affiliate_balance' => 0]);

    DB::commit();
} catch (\Exception $e) {
    DB::rollBack();
    throw $e;
}
```

---

# 15. FLUX COMPLET DE BOUT EN BOUT

## 15.1 Diagramme de Séquence Complet

```
┌──────────────────────────────────────────────────────────────────────────────┐
│                    FLUX COMPLET DU SYSTÈME D'AFFILIATION                     │
└──────────────────────────────────────────────────────────────────────────────┘

PHASE 1: INSCRIPTION
════════════════════

User A (Parrain)                                  User B (Filleul)
     │                                                  │
     │  1. Crée un compte                               │
     │  → affiliate_code = "usera123"                   │
     │                                                  │
     │  2. Partage son lien:                            │
     │  ulixai.com/affiliate/sign-up?code=usera123     │
     │ ─────────────────────────────────────────────►  │
     │                                                  │
     │                                   3. Clique sur le lien
     │                                   4. Remplit le formulaire
     │                                   5. Soumet l'inscription
     │                                                  │
     │                                   POST /signup/register
     │                                   { affiliate_code: "usera123" }
     │                                                  │
     │                         ◄─────────────────────── │
     │                                                  │
     │  6. User B créé avec:                            │
     │     referred_by = User A.id                      │
     │     affiliate_code = "userb456"                  │
     │                                                  │


PHASE 2: TRANSACTION
════════════════════

User B (Filleul)              Stripe              Provider C
     │                           │                    │
     │  1. Crée une mission      │                    │
     │     (100€)                │                    │
     │                           │                    │
     │  2. Provider C accepte    │                    │
     │     l'offre               │              ◄──── │
     │                           │                    │
     │  3. User B paie           │                    │
     │     120€ (100 + 20 frais) │                    │
     │ ─────────────────────────►│                    │
     │                           │                    │
     │           4. PaymentIntent.succeeded           │
     │              (Webhook)    │                    │
     │ ◄─────────────────────────│                    │
     │                           │                    │
     │  5. Transaction créée     │                    │
     │     status: 'paid'        │                    │
     │     payment_status: 'held'│                    │
     │                           │                    │


PHASE 3: LIBÉRATION (7 JOURS APRÈS)
═══════════════════════════════════

Cron Job                      Stripe              Provider C
     │                           │                    │
     │  1. ReleasePendingPayments│                    │
     │     finds mission         │                    │
     │                           │                    │
     │  2. transferFunds()       │                    │
     │ ─────────────────────────►│                    │
     │                           │  3. Transfer       │
     │                           │ ──────────────────►│
     │                           │     85€            │
     │                           │     (100 - 15%)    │
     │                           │                    │
     │  4. Vérifie referred_by   │                    │
     │     User B → User A       │                    │
     │                           │                    │
     │  5. Calcule commission:   │                    │
     │     2.5% × 15€ = 0.375€   │                    │
     │                           │                    │
     │  6. AffiliateCommission   │                    │
     │     créée pour User A     │                    │
     │                           │                    │
     │  7. User A balances:      │                    │
     │     affiliate_balance     │                    │
     │       += 0.375€           │                    │
     │     pending_affiliate     │                    │
     │       _balance += 0.375€  │                    │
     │                           │                    │


PHASE 4: RETRAIT
════════════════

User A (Parrain)              Stripe              Banque User A
     │                           │                    │
     │  1. Demande retrait       │                    │
     │     POST /user/funds      │                    │
     │                           │                    │
     │  2. Vérifie balance ≥ 30€ │                    │
     │                           │                    │
     │  3. Crée Payout record    │                    │
     │     status: 'processing'  │                    │
     │                           │                    │
     │  4. SI Service Provider:  │                    │
     │     a. Transfer vers      │                    │
     │        compte Connect     │                    │
     │ ─────────────────────────►│                    │
     │                           │                    │
     │     b. Payout depuis      │                    │
     │        compte Connect     │                    │
     │ ─────────────────────────►│ ──────────────────►│
     │                           │                    │
     │  5. SINON (user normal):  │                    │
     │     Payout direct vers    │                    │
     │     IBAN                  │                    │
     │ ─────────────────────────►│ ──────────────────►│
     │                           │                    │
     │  6. Payout record:        │                    │
     │     status: 'paid'        │                    │
     │     paid_at: now()        │                    │
     │                           │                    │
     │  7. pending_affiliate     │                    │
     │     _balance = 0          │                    │
     │                           │                    │
     │  8. Email de confirmation │                    │
     │     envoyé                │                    │
     │                           │                    │
```

## 15.2 États et Transitions

```
┌──────────────────────────────────────────────────────────────────────────────┐
│                           ÉTATS DES ENTITÉS                                  │
└──────────────────────────────────────────────────────────────────────────────┘

MISSION
═══════
  created → waiting_to_start → in_progress → completed → (archived)
                                    │
                                    └── disputed → cancelled (refund)

TRANSACTION
═══════════
  pending_payment → paid → released
                      │
                      └── refunded

AFFILIATE_COMMISSION
════════════════════
  pending → available → paid

PAYOUT
══════
  pending → processing → paid
                   │
                   └── failed
```

---

# 16. CHECKLIST DE RÉIMPLÉMENTATION

## 16.1 Base de Données

- [ ] Créer la migration `create_users_table` avec colonnes d'affiliation
- [ ] Créer la migration `add_affiliate_balance_to_users_table`
- [ ] Créer la migration `create_affiliate_commissions_table`
- [ ] Créer la migration `create_ulix_commissions_table`
- [ ] Créer la migration `add_banking_details_to_users_table`
- [ ] Créer la migration `create_payouts_table`
- [ ] Créer la migration `create_country_commissions_table`
- [ ] Exécuter les migrations
- [ ] Insérer les taux de commission par défaut

## 16.2 Modèles

- [ ] Créer/Modifier `User.php` avec relations d'affiliation
- [ ] Créer `AffiliateCommission.php`
- [ ] Créer `UlixCommission.php`
- [ ] Créer `Payout.php`
- [ ] Créer `CountryCommission.php` (optionnel)

## 16.3 Services

- [ ] Créer `PaymentService.php` avec méthodes:
  - [ ] `transferFunds()`
  - [ ] `createAffiliateCommission()`
  - [ ] `createConnectAccount()`
  - [ ] `providerAccountBalance()`

## 16.4 Contrôleurs

- [ ] Créer `AffiliateController.php`
- [ ] Modifier `RegisterController.php` pour gérer l'affiliation
- [ ] Créer `EarningsController.php`
- [ ] Modifier `AccountController.php` pour l'affiliation
- [ ] Créer `Admin/AdminDashboardController.php` (sections affiliés)
- [ ] Créer `Admin/UserManagementController.php`
- [ ] Créer `StripeWebhookController.php`

## 16.5 Routes

- [ ] Ajouter routes publiques d'affiliation
- [ ] Ajouter routes authentifiées utilisateur
- [ ] Ajouter routes admin
- [ ] Ajouter route webhook Stripe

## 16.6 Vues

- [ ] Créer `admin/dashboard/affiliates/index.blade.php`
- [ ] Créer `admin/dashboard/affiliates/affiliate-info.blade.php`
- [ ] Créer `dashboard/my-affiliate-account.blade.php`
- [ ] Créer `dashboard/my-earnings.blade.php`
- [ ] Modifier `user-auth/signup.blade.php`

## 16.7 Commandes Cron

- [ ] Créer `ReleasePendingPayments.php`
- [ ] Créer `RefundCancelledMissions.php`
- [ ] Configurer le scheduler dans `Kernel.php`

## 16.8 Configuration

- [ ] Configurer Stripe dans `.env`
- [ ] Configurer webhook Stripe
- [ ] Configurer APP_KEY pour le chiffrement

## 16.9 Emails

- [ ] Créer `PayoutProcessedMail.php`
- [ ] Créer template email `emails/payout-processed.blade.php`

## 16.10 Tests

- [ ] Tester l'inscription avec code affilié
- [ ] Tester la création de commission
- [ ] Tester le calcul des commissions
- [ ] Tester le retrait
- [ ] Tester les webhooks Stripe
- [ ] Tester les commandes cron

---

# ANNEXES

## A. Variables d'Environnement Requises

```env
# Stripe
STRIPE_KEY=pk_live_xxxxx
STRIPE_SECRET=sk_live_xxxxx
STRIPE_WEBHOOK_SECRET=whsec_xxxxx

# Application
APP_KEY=base64:xxxxx
APP_URL=https://ulixai.com
```

## B. Dépendances Composer

```json
{
    "require": {
        "stripe/stripe-php": "^10.0",
        "laravel/framework": "^10.0"
    }
}
```

## C. Formules de Calcul

```
Commission Affilié = affiliate_fee × provider_fee
                   = 2.5% × (15% × montant_mission)

Exemple:
- Mission: 100€
- Provider fee: 15% = 15€
- Affiliate fee: 2.5% × 15€ = 0.375€

OU simplement:
- Commission = 2.5% × montant_payé
- Commission = 2.5% × 120€ = 3€
```

## D. Contacts et Ressources

- Documentation Stripe Connect: https://stripe.com/docs/connect
- Documentation Laravel: https://laravel.com/docs
- Support Ulixai: support@ulixai.com

---

**FIN DU RAPPORT**

*Document généré le 20 janvier 2026*
*Version 1.0*
