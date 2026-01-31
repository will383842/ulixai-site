# PLAN COMPLET DE MODÉRATION ULIXAI
## Système Global_Moderations - Architecture Professionnelle

**Date:** 31 janvier 2026
**Version:** 1.0
**Objectif:** Système de modération intelligent, modulaire et non-intrusif pour l'expérience utilisateur

---

## TABLE DES MATIÈRES

### BACKEND
1. [Résumé Exécutif](#1-résumé-exécutif)
2. [Architecture Technique](#2-architecture-technique)
3. [Limite de Création d'Annonces](#3-limite-de-création-dannonces)
4. [Filtre de Mots Interdits](#4-filtre-de-mots-interdits)
5. [Détection des Coordonnées](#5-détection-des-coordonnées)
6. [Modération des Images](#6-modération-des-images)
7. [Détection de Spam et Patterns](#7-détection-de-spam-et-patterns)
8. [Système de Signalement](#8-système-de-signalement)
9. [Système de Strikes et Sanctions](#9-système-de-strikes-et-sanctions)
10. [Système d'Appel (Appeal)](#10-système-dappel-appeal)
11. [API REST Complète](#11-api-rest-complète)
12. [Jobs et Queues](#12-jobs-et-queues)
13. [Analytics et Statistiques](#13-analytics-et-statistiques)
14. [Multi-langue](#14-multi-langue)
15. [Base de Données](#15-base-de-données)
16. [Système Global_Notifications](#16-système-global_notifications)

### FRONTEND
17. [Architecture Frontend](#17-architecture-frontend)
18. [Composants Utilisateur](#18-composants-utilisateur)
19. [Console Admin Modération](#19-console-admin-modération)
20. [Messages et UX](#20-messages-et-ux)

### IMPLÉMENTATION
21. [Plan d'Implémentation](#21-plan-dimplémentation)
22. [Tests](#22-tests)

---

## 1. RÉSUMÉ EXÉCUTIF

### Contexte Plateforme

| Caractéristique | Valeur |
|-----------------|--------|
| **Présence géographique** | Monde entier (tous les pays) |
| **Utilisateurs** | Toutes nationalités |
| **Langues de navigation** | 9 langues (FR, EN, DE, RU, ZH, ES, PT, AR, HI) |
| **Langues de contenu** | N'importe quelle langue (libre) |
| **Type de plateforme** | Marketplace de services pour expatriés |

### Implications pour la Modération
- Le contenu doit être vérifié contre **TOUTES les langues** de mots interdits
- Les patterns de détection de contact doivent être **internationaux**
- Les messages d'erreur doivent être traduits dans les **9 langues de navigation**
- Le système doit gérer les **alphabets non-latins** (cyrillique, arabe, hindi, chinois)

### Problèmes Identifiés
| Problème | Impact | Solution |
|----------|--------|----------|
| Spam d'annonces (50+ d'affilée) | Image catastrophique | Limite 3/jour + rate limiting |
| Contenu sexuel/politique/religieux | Réputation plateforme | Filtre 2 niveaux (ban + review) |
| Partage de coordonnées | Contournement plateforme | Détection intelligente + blocage |
| Pas de signalement utilisateur | Modération réactive impossible | API signalement + queue admin |
| Pas de sanctions progressives | Pas de dissuasion | Système de strikes automatique |

### Principes Directeurs
1. **Non-intrusif** - L'utilisateur légitime ne doit jamais être bloqué
2. **Progressif** - Avertissement avant sanction
3. **Transparent** - L'utilisateur sait pourquoi il est bloqué
4. **Modulaire** - Code isolé dans `Global_Moderations`
5. **Configurable** - Tous les seuils sont dans la config

---

## 2. ARCHITECTURE TECHNIQUE

### Structure des Fichiers

```
app/
├── Services/
│   ├── Global_Moderations/                    # NOUVEAU - Service modération
│   │   ├── ModerationService.php              # Orchestrateur principal
│   │   ├── ContentAnalyzer.php                # Analyse de contenu
│   │   ├── ContactDetector.php                # Détection coordonnées
│   │   ├── WordFilter.php                     # Filtre de mots
│   │   ├── SanctionManager.php                # Gestion des sanctions
│   │   ├── Models/                            # Modèles spécifiques modération
│   │   │   ├── ModerationFlag.php
│   │   │   ├── ModerationAction.php
│   │   │   ├── UserStrike.php
│   │   │   ├── BannedWord.php
│   │   │   └── ContentReport.php
│   │   └── Exceptions/
│   │       └── ModerationException.php
│   │
│   └── Global_Notifications/                  # NOUVEAU - Notifications centralisées
│       ├── BaseNotification.php               # Classe de base pour toutes les notifs
│       ├── NotificationService.php            # Service d'envoi centralisé
│       ├── Channels/                          # Canaux personnalisés
│       │   ├── SmsChannel.php
│       │   └── PushChannel.php
│       ├── Moderation/                        # Notifications modération
│       │   ├── ContentFlaggedNotification.php
│       │   ├── ContentApprovedNotification.php
│       │   ├── ContentRejectedNotification.php
│       │   ├── FirstStrikeNotification.php
│       │   ├── SecondStrikeNotification.php
│       │   └── UserBannedNotification.php
│       ├── Payment/                           # Notifications paiement
│       │   ├── PaymentReceivedNotification.php
│       │   ├── PaymentFailedNotification.php
│       │   ├── PayoutCompletedNotification.php
│       │   └── PayPalDisputeNotification.php
│       ├── Mission/                           # Notifications missions
│       │   ├── MissionCreatedNotification.php
│       │   ├── OfferReceivedNotification.php
│       │   ├── OfferAcceptedNotification.php
│       │   └── MissionCompletedNotification.php
│       ├── User/                              # Notifications utilisateur
│       │   ├── WelcomeNotification.php
│       │   ├── EmailVerificationNotification.php
│       │   └── PasswordResetNotification.php
│       └── Admin/                             # Notifications admin
│           ├── NewUserNotification.php
│           ├── NewDisputeNotification.php
│           └── CriticalReportNotification.php
│
├── Http/
│   ├── Controllers/
│   │   └── Admin/
│   │       └── ModerationController.php       # Console admin modération
│   │
│   └── Middleware/
│       └── ContentModerationMiddleware.php    # Middleware de modération
│
├── Console/
│   └── Commands/
│       └── ProcessModerationQueue.php         # Traitement queue

config/
├── moderations.php                            # Configuration modération
└── notifications.php                          # Configuration notifications globales

database/
└── migrations/
    ├── xxxx_create_moderation_flags_table.php
    ├── xxxx_create_moderation_actions_table.php
    ├── xxxx_create_user_strikes_table.php
    ├── xxxx_create_banned_words_table.php
    ├── xxxx_create_content_reports_table.php
    └── xxxx_add_moderation_fields_to_users_table.php

resources/views/admin/dashboard/moderation/
├── index.blade.php                            # Dashboard modération
├── queue.blade.php                            # Queue de review
├── banned-words.blade.php                     # Gestion mots interdits
├── reports.blade.php                          # Signalements
└── user-strikes.blade.php                     # Historique strikes
```

### Architecture Global_Notifications

```
┌─────────────────────────────────────────────────────────────────────────────┐
│                    SYSTÈME GLOBAL_NOTIFICATIONS                              │
├─────────────────────────────────────────────────────────────────────────────┤
│                                                                              │
│   BaseNotification (classe abstraite)                                       │
│   ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━                                       │
│   • Définit les canaux par défaut (mail, database)                          │
│   • Gère la mise en file d'attente (ShouldQueue)                            │
│   • Fournit les méthodes communes (locale, retry, etc.)                     │
│   • Configuration centralisée des templates email                           │
│                                                                              │
│   Canaux disponibles:                                                        │
│   ┌─────────┐ ┌─────────┐ ┌─────────┐ ┌─────────┐                           │
│   │  Mail   │ │Database │ │   SMS   │ │  Push   │                           │
│   └─────────┘ └─────────┘ └─────────┘ └─────────┘                           │
│                                                                              │
│   Catégories:                                                                │
│   • Moderation/ - Strikes, bans, approbations                               │
│   • Payment/    - Transactions, refunds, disputes                           │
│   • Mission/    - Offres, missions, livraisons                              │
│   • User/       - Inscription, vérification, reset                          │
│   • Admin/      - Alertes admin, rapports critiques                         │
│                                                                              │
└─────────────────────────────────────────────────────────────────────────────┘
```

### Diagramme de Flux

```
┌─────────────────────────────────────────────────────────────────────────────┐
│                          FLUX DE MODÉRATION                                  │
├─────────────────────────────────────────────────────────────────────────────┤
│                                                                              │
│   UTILISATEUR                                                                │
│       │                                                                      │
│       ▼                                                                      │
│   ┌───────────────────┐                                                     │
│   │ Soumet contenu    │ (mission, message, offre)                           │
│   └─────────┬─────────┘                                                     │
│             │                                                                │
│             ▼                                                                │
│   ┌───────────────────────────────────────────────────────────────────┐     │
│   │              ContentModerationMiddleware                          │     │
│   │  ┌─────────────────────────────────────────────────────────────┐  │     │
│   │  │  1. Vérifier limite quotidienne (3 missions/jour)           │  │     │
│   │  │  2. Analyser contenu avec ModerationService                 │  │     │
│   │  └─────────────────────────────────────────────────────────────┘  │     │
│   └─────────────────────────┬─────────────────────────────────────────┘     │
│                             │                                                │
│             ┌───────────────┼───────────────┐                               │
│             │               │               │                               │
│             ▼               ▼               ▼                               │
│   ┌─────────────┐   ┌─────────────┐   ┌─────────────┐                       │
│   │   CLEAN     │   │   REVIEW    │   │  BLOCKED    │                       │
│   │  (Score<30) │   │ (Score 30-70)│   │ (Score>70)  │                       │
│   └──────┬──────┘   └──────┬──────┘   └──────┬──────┘                       │
│          │                 │                 │                               │
│          ▼                 ▼                 ▼                               │
│   ┌─────────────┐   ┌─────────────┐   ┌─────────────┐                       │
│   │  PUBLIÉ     │   │ EN ATTENTE  │   │  REJETÉ     │                       │
│   │ Directement │   │ Queue Admin │   │ + STRIKE    │                       │
│   └─────────────┘   └──────┬──────┘   └──────┬──────┘                       │
│                            │                 │                               │
│                            ▼                 ▼                               │
│                    ┌─────────────┐   ┌─────────────┐                        │
│                    │ Admin Notif │   │ User Notif  │                        │
│                    │ + Review    │   │ Avertissement│                       │
│                    └──────┬──────┘   └─────────────┘                        │
│                           │                                                  │
│               ┌───────────┴───────────┐                                     │
│               ▼                       ▼                                     │
│        ┌─────────────┐         ┌─────────────┐                              │
│        │  APPROUVER  │         │  REJETER    │                              │
│        │  → Publié   │         │  → Strike   │                              │
│        └─────────────┘         └─────────────┘                              │
│                                                                              │
└─────────────────────────────────────────────────────────────────────────────┘
```

---

## 3. LIMITE DE CRÉATION D'ANNONCES

### Configuration

```php
// config/moderations.php
'limits' => [
    'missions_per_day' => 3,
    'missions_per_week' => 10,
    'offers_per_day' => 20,
    'messages_per_hour' => 30,
    'reports_per_day' => 5,
],
```

### Implémentation

```php
// app/Services/Moderations/ModerationService.php

public function canCreateMission(User $user): array
{
    $today = Carbon::today();
    $count = Mission::where('requester_id', $user->id)
        ->whereDate('created_at', $today)
        ->count();

    $limit = config('moderations.limits.missions_per_day');

    return [
        'allowed' => $count < $limit,
        'remaining' => max(0, $limit - $count),
        'reset_at' => $today->endOfDay(),
        'message' => $count >= $limit
            ? "Vous avez atteint la limite de {$limit} annonces par jour. Réessayez demain."
            : null
    ];
}
```

### Affichage Frontend

```javascript
// Composant Vue/React pour afficher la limite
{
    remaining: 2,
    message: "Il vous reste 2 annonces aujourd'hui",
    showWarning: remaining <= 1
}
```

### Message à l'utilisateur

| Situation | Message |
|-----------|---------|
| 0 annonce restante | "Vous avez atteint votre limite quotidienne de 3 annonces. Vous pourrez en publier de nouvelles demain à 00h00." |
| 1 annonce restante | "Attention : il vous reste 1 annonce pour aujourd'hui." |
| 2+ annonces restantes | Pas de message (expérience fluide) |

---

## 4. FILTRE DE MOTS INTERDITS

### Architecture à Deux Niveaux

```
┌────────────────────────────────────────────────────────────────────┐
│                    FILTRE DE MOTS INTERDITS                         │
├────────────────────────────────────────────────────────────────────┤
│                                                                     │
│   NIVEAU 1: BLOCAGE AUTOMATIQUE (severity = 'critical')            │
│   ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━             │
│   • Contenu à caractère sexuel explicite                           │
│   • Contenu politique (campagnes, propagande, militants)           │
│   • Discours de haine                                               │
│   • Termes illégaux (drogue, armes, etc.)                          │
│   • Insultes graves                                                 │
│                                                                     │
│   → Action: REJET IMMÉDIAT + STRIKE                                │
│   → Après 3 strikes: BAN AUTOMATIQUE                                │
│                                                                     │
├────────────────────────────────────────────────────────────────────┤
│                                                                     │
│   NIVEAU 2: MISE EN ATTENTE (severity = 'warning')                 │
│   ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━             │
│   • Références religieuses sensibles                                │
│   • Termes ambigus pouvant être inappropriés                        │
│   • Contenu nécessitant vérification humaine                        │
│                                                                     │
│   → Action: EN ATTENTE DE VALIDATION ADMIN                         │
│   → Admin approuve ou rejette                                       │
│                                                                     │
└────────────────────────────────────────────────────────────────────┘
```

### Base de Données des Mots

```php
// Table: banned_words
Schema::create('banned_words', function (Blueprint $table) {
    $table->id();
    $table->string('word');                    // Le mot ou pattern
    $table->string('normalized_word');          // Version normalisée (sans accents)
    $table->enum('severity', ['critical', 'warning', 'info']);
    $table->enum('category', [
        'sexual', 'political', 'religious',
        'hate_speech', 'illegal', 'spam', 'other'
    ]);
    $table->string('language')->default('fr'); // Langue
    $table->boolean('is_regex')->default(false);
    $table->boolean('is_active')->default(true);
    $table->text('notes')->nullable();          // Notes pour admins
    $table->timestamps();

    $table->unique(['word', 'language']);
    $table->index('severity');
    $table->index('category');
});
```

### Liste Initiale de Mots

```php
// database/seeders/BannedWordsSeeder.php

// NIVEAU 1 - BLOCAGE AUTOMATIQUE (critical)
$criticalWords = [
    // Sexuel explicite
    ['word' => 'escort', 'category' => 'sexual'],
    ['word' => 'massage tantrique', 'category' => 'sexual'],
    ['word' => 'massage sensuel', 'category' => 'sexual'],
    ['word' => 'services intimes', 'category' => 'sexual'],
    ['word' => 'compagnie nocturne', 'category' => 'sexual'],
    ['word' => 'accompagnement privé', 'category' => 'sexual'],
    // + patterns regex pour variations
    ['word' => 's[e3]x[e]?', 'is_regex' => true, 'category' => 'sexual'],
    ['word' => 'pr[o0]st[i1]tu', 'is_regex' => true, 'category' => 'sexual'],

    // Politique - BLOCAGE AUTOMATIQUE
    ['word' => 'campagne électorale', 'category' => 'political'],
    ['word' => 'parti politique', 'category' => 'political'],
    ['word' => 'propagande', 'category' => 'political'],
    ['word' => 'militant politique', 'category' => 'political'],
    ['word' => 'élection', 'category' => 'political'],
    ['word' => 'vote pour', 'category' => 'political'],
    ['word' => 'candidat', 'category' => 'political'],
    ['word' => 'manifestation politique', 'category' => 'political'],
    ['word' => 'syndicat', 'category' => 'political'],
    ['word' => 'grève', 'category' => 'political'],

    // Illégal
    ['word' => 'drogue', 'category' => 'illegal'],
    ['word' => 'cannabis', 'category' => 'illegal'],
    ['word' => 'cocaïne', 'category' => 'illegal'],
    ['word' => 'arme à feu', 'category' => 'illegal'],

    // Haine
    ['word' => 'terroriste', 'category' => 'hate_speech'],
    // ... (liste complète à définir avec équipe légale)
];

// NIVEAU 2 - MISE EN ATTENTE (warning)
$warningWords = [
    // Religion (review nécessaire - peut être légitime dans certains contextes)
    ['word' => 'conversion religieuse', 'category' => 'religious'],
    ['word' => 'secte', 'category' => 'religious'],
    ['word' => 'prosélytisme', 'category' => 'religious'],
    ['word' => 'endoctrinement', 'category' => 'religious'],
    ['word' => 'prêche', 'category' => 'religious'],
    ['word' => 'évangélisation', 'category' => 'religious'],

    // Ambigus (peuvent être légitimes - nécessitent review)
    ['word' => 'massage', 'category' => 'other'], // Peut être légitime (kiné, bien-être)
    ['word' => 'accompagnement', 'category' => 'other'], // Peut être légitime (coaching)
    ['word' => 'soirée privée', 'category' => 'other'], // Peut être légitime (événementiel)
];
```

### Algorithme de Détection

```php
// app/Services/Moderations/WordFilter.php

class WordFilter
{
    public function analyze(string $content, string $language = 'fr'): ModerationResult
    {
        $normalized = $this->normalize($content);
        $result = new ModerationResult();

        // Charger les mots interdits
        $bannedWords = BannedWord::where('is_active', true)
            ->where(function($q) use ($language) {
                $q->where('language', $language)
                  ->orWhere('language', '*'); // Mots universels
            })
            ->get();

        foreach ($bannedWords as $word) {
            if ($this->matches($normalized, $word)) {
                $result->addMatch($word);
            }
        }

        return $result;
    }

    private function normalize(string $text): string
    {
        // Supprimer accents
        $text = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $text);
        // Minuscules
        $text = mb_strtolower($text);
        // Remplacer caractères spéciaux (l33t speak)
        $text = strtr($text, [
            '0' => 'o', '1' => 'i', '3' => 'e',
            '4' => 'a', '5' => 's', '7' => 't',
            '@' => 'a', '$' => 's'
        ]);
        // Supprimer espaces multiples
        $text = preg_replace('/\s+/', ' ', $text);

        return $text;
    }

    private function matches(string $content, BannedWord $word): bool
    {
        if ($word->is_regex) {
            return preg_match('/' . $word->word . '/iu', $content) === 1;
        }

        // Recherche mot entier (word boundaries)
        $pattern = '/\b' . preg_quote($word->normalized_word, '/') . '\b/iu';
        return preg_match($pattern, $content) === 1;
    }
}
```

### Scoring et Décision

```php
// Calcul du score de risque
public function calculateRiskScore(array $matches): int
{
    $score = 0;

    foreach ($matches as $match) {
        switch ($match->severity) {
            case 'critical':
                $score += 50; // Un seul mot critical = blocage
                break;
            case 'warning':
                $score += 20; // Accumulation possible
                break;
            case 'info':
                $score += 5;
                break;
        }
    }

    return min(100, $score);
}

// Décision basée sur le score
public function getDecision(int $score): string
{
    if ($score >= 50) return 'blocked';      // Blocage immédiat
    if ($score >= 30) return 'review';       // Review admin requis
    return 'clean';                           // Publication directe
}
```

---

## 5. DÉTECTION DES COORDONNÉES

### Patterns de Détection Intelligents

```php
// app/Services/Moderations/ContactDetector.php

class ContactDetector
{
    private array $patterns = [
        // Emails - très strict
        'email' => [
            'pattern' => '/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}/i',
            'severity' => 'critical',
        ],

        // Emails déguisés
        'email_disguised' => [
            'pattern' => '/[a-zA-Z0-9._%+-]+\s*[\[\(\{]?\s*(@|at|arobase|chez)\s*[\]\)\}]?\s*[a-zA-Z0-9.-]+\s*[\[\(\{]?\s*(\.|\s*dot\s*|\s*point\s*)\s*[\]\)\}]?\s*[a-zA-Z]{2,}/i',
            'severity' => 'critical',
        ],

        // Téléphones internationaux
        'phone_international' => [
            'pattern' => '/(?:\+|00)[1-9]\d{6,14}/',
            'severity' => 'critical',
        ],

        // Téléphones français
        'phone_french' => [
            'pattern' => '/(?:0|\+33|0033)\s*[1-9](?:[\s.-]*\d{2}){4}/',
            'severity' => 'critical',
        ],

        // Téléphones déguisés (zéro six, etc.)
        'phone_disguised' => [
            'pattern' => '/(?:z[eé]ro|zero)\s*(?:un|deux|trois|quatre|cinq|six|sept|huit|neuf)(?:\s*(?:un|deux|trois|quatre|cinq|six|sept|huit|neuf)){7,}/i',
            'severity' => 'critical',
        ],

        // WhatsApp / Telegram mentions
        'messaging_apps' => [
            'pattern' => '/(?:whatsapp|telegram|signal|viber|wechat|line)\s*[:\-]?\s*[\d\s\+\-\.]+/i',
            'severity' => 'critical',
        ],

        // Réseaux sociaux avec identifiants
        'social_media' => [
            'pattern' => '/(?:instagram|facebook|twitter|tiktok|snapchat|linkedin)\s*[:\-@]?\s*[a-zA-Z0-9._]+/i',
            'severity' => 'warning', // Warning car peut être légitime dans certains contextes
        ],

        // URLs
        'urls' => [
            'pattern' => '/https?:\/\/[^\s]+/i',
            'severity' => 'critical',
        ],

        // Domaines sans protocole
        'domains' => [
            'pattern' => '/\b[a-zA-Z0-9][a-zA-Z0-9-]*\.(com|fr|net|org|io|co|be|ch|ca|app|site|online)\b/i',
            'severity' => 'critical',
        ],
    ];

    public function detect(string $content): array
    {
        $detected = [];

        foreach ($this->patterns as $type => $config) {
            if (preg_match_all($config['pattern'], $content, $matches)) {
                foreach ($matches[0] as $match) {
                    $detected[] = [
                        'type' => $type,
                        'value' => $match,
                        'severity' => $config['severity'],
                    ];
                }
            }
        }

        return $detected;
    }

    public function redact(string $content): string
    {
        foreach ($this->patterns as $type => $config) {
            $content = preg_replace_callback(
                $config['pattern'],
                fn($m) => str_repeat('•', min(strlen($m[0]), 10)) . '***',
                $content
            );
        }

        return $content;
    }
}
```

### Application par Contexte

| Contexte | Action Coordonnées |
|----------|-------------------|
| **Mission (titre/description)** | BLOCAGE + Strike |
| **Message public (mission)** | Remplacement automatique par `•••` |
| **Message privé (conversation)** | AUTORISATION (déjà en relation) |
| **Offre de prestataire** | BLOCAGE + Warning |
| **Profil prestataire (bio)** | WARNING (peut être légitime - liens sociaux pro) |

### Message Utilisateur

```
⚠️ Attention : votre annonce contient des coordonnées personnelles.

Sur Ulixai, les coordonnées de contact sont automatiquement échangées
une fois qu'un prestataire est sélectionné et le paiement effectué.

Cela protège votre vie privée et garantit des transactions sécurisées.

Veuillez modifier votre annonce pour retirer : [email/téléphone détecté]
```

---

## 6. MODÉRATION DES IMAGES

### Objectif
Détecter automatiquement les images inappropriées (contenu adulte, violent, politique) uploadées dans les missions et profils.

### Architecture

```php
// app/Services/Global_Moderations/ImageModerator.php

namespace App\Services\Global_Moderations;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;

class ImageModerator
{
    private string $provider;
    private array $thresholds;

    public function __construct()
    {
        $this->provider = config('moderations.images.provider', 'google_vision');
        $this->thresholds = config('moderations.images.thresholds');
    }

    /**
     * Analyser une image uploadée
     */
    public function analyze(UploadedFile|string $image): ImageModerationResult
    {
        $imagePath = $image instanceof UploadedFile
            ? $image->getRealPath()
            : $image;

        return match($this->provider) {
            'google_vision' => $this->analyzeWithGoogleVision($imagePath),
            'aws_rekognition' => $this->analyzeWithAwsRekognition($imagePath),
            'azure_vision' => $this->analyzeWithAzureVision($imagePath),
            'sightengine' => $this->analyzeWithSightEngine($imagePath),
            default => $this->analyzeWithGoogleVision($imagePath),
        };
    }

    /**
     * Google Cloud Vision API
     */
    private function analyzeWithGoogleVision(string $imagePath): ImageModerationResult
    {
        $imageContent = base64_encode(file_get_contents($imagePath));

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post('https://vision.googleapis.com/v1/images:annotate?key=' . config('services.google_vision.key'), [
            'requests' => [[
                'image' => ['content' => $imageContent],
                'features' => [
                    ['type' => 'SAFE_SEARCH_DETECTION'],
                    ['type' => 'LABEL_DETECTION', 'maxResults' => 10],
                    ['type' => 'TEXT_DETECTION'], // OCR pour détecter texte dans images
                ],
            ]],
        ]);

        $data = $response->json();
        $safeSearch = $data['responses'][0]['safeSearchAnnotation'] ?? [];
        $labels = $data['responses'][0]['labelAnnotations'] ?? [];
        $textAnnotations = $data['responses'][0]['textAnnotations'] ?? [];

        return new ImageModerationResult(
            adult: $this->likelihoodToScore($safeSearch['adult'] ?? 'UNKNOWN'),
            violence: $this->likelihoodToScore($safeSearch['violence'] ?? 'UNKNOWN'),
            racy: $this->likelihoodToScore($safeSearch['racy'] ?? 'UNKNOWN'),
            medical: $this->likelihoodToScore($safeSearch['medical'] ?? 'UNKNOWN'),
            spoof: $this->likelihoodToScore($safeSearch['spoof'] ?? 'UNKNOWN'),
            labels: array_column($labels, 'description'),
            detectedText: $textAnnotations[0]['description'] ?? null,
            raw: $data
        );
    }

    /**
     * Convertir likelihood Google en score 0-100
     */
    private function likelihoodToScore(string $likelihood): int
    {
        return match($likelihood) {
            'VERY_UNLIKELY' => 0,
            'UNLIKELY' => 20,
            'POSSIBLE' => 50,
            'LIKELY' => 75,
            'VERY_LIKELY' => 100,
            default => 0,
        };
    }

    /**
     * Décision basée sur les scores
     */
    public function getDecision(ImageModerationResult $result): string
    {
        // Contenu adulte ou violence = blocage immédiat
        if ($result->adult >= $this->thresholds['adult_block'] ||
            $result->violence >= $this->thresholds['violence_block']) {
            return 'blocked';
        }

        // Scores moyens = review
        if ($result->adult >= $this->thresholds['adult_review'] ||
            $result->violence >= $this->thresholds['violence_review'] ||
            $result->racy >= $this->thresholds['racy_review']) {
            return 'review';
        }

        // Vérifier texte détecté dans l'image (coordonnées cachées)
        if ($result->detectedText) {
            $contactDetector = app(ContactDetector::class);
            $contacts = $contactDetector->detect($result->detectedText);
            if (!empty($contacts)) {
                return 'blocked'; // Coordonnées cachées dans l'image
            }

            $wordFilter = app(WordFilter::class);
            $wordResult = $wordFilter->analyze($result->detectedText);
            if ($wordResult->hasCritical()) {
                return 'blocked';
            }
            if ($wordResult->hasWarning()) {
                return 'review';
            }
        }

        return 'clean';
    }
}
```

### Classe de Résultat

```php
// app/Services/Global_Moderations/ImageModerationResult.php

namespace App\Services\Global_Moderations;

class ImageModerationResult
{
    public function __construct(
        public int $adult = 0,
        public int $violence = 0,
        public int $racy = 0,
        public int $medical = 0,
        public int $spoof = 0,
        public array $labels = [],
        public ?string $detectedText = null,
        public array $raw = []
    ) {}

    public function isClean(): bool
    {
        return $this->adult < 50 && $this->violence < 50 && $this->racy < 50;
    }

    public function getHighestRisk(): string
    {
        $risks = [
            'adult' => $this->adult,
            'violence' => $this->violence,
            'racy' => $this->racy,
        ];
        return array_search(max($risks), $risks);
    }

    public function toArray(): array
    {
        return [
            'adult' => $this->adult,
            'violence' => $this->violence,
            'racy' => $this->racy,
            'medical' => $this->medical,
            'spoof' => $this->spoof,
            'labels' => $this->labels,
            'detected_text' => $this->detectedText,
        ];
    }
}
```

### Configuration

```php
// config/moderations.php - Section images

'images' => [
    'enabled' => env('MODERATION_IMAGES_ENABLED', true),
    'provider' => env('MODERATION_IMAGES_PROVIDER', 'google_vision'),

    'thresholds' => [
        'adult_block' => 75,    // Score >= 75 = blocage
        'adult_review' => 50,   // Score 50-74 = review
        'violence_block' => 75,
        'violence_review' => 50,
        'racy_review' => 60,
    ],

    // Analyser images de manière asynchrone
    'async' => env('MODERATION_IMAGES_ASYNC', true),

    // Taille max pour analyse (éviter coûts excessifs)
    'max_size_mb' => 5,

    // Cache des résultats (hash de l'image)
    'cache_results' => true,
    'cache_ttl' => 86400, // 24h
],
```

### Intégration avec Upload

```php
// Dans ServiceRequestController ou MissionController

public function uploadImages(Request $request)
{
    $images = $request->file('images');
    $results = [];

    foreach ($images as $image) {
        // Analyse synchrone ou async selon config
        if (config('moderations.images.async')) {
            // Dispatcher un job
            AnalyzeImageJob::dispatch($image, $mission->id);
            $results[] = ['status' => 'pending', 'message' => 'Image en cours d\'analyse'];
        } else {
            // Analyse immédiate
            $moderator = app(ImageModerator::class);
            $result = $moderator->analyze($image);
            $decision = $moderator->getDecision($result);

            if ($decision === 'blocked') {
                return response()->json([
                    'error' => 'Cette image contient du contenu inapproprié et ne peut pas être uploadée.',
                    'reason' => $result->getHighestRisk(),
                ], 422);
            }

            $results[] = [
                'status' => $decision,
                'path' => $image->store('missions/' . $mission->id),
            ];
        }
    }

    return response()->json(['images' => $results]);
}
```

---

## 7. DÉTECTION DE SPAM ET PATTERNS

### Objectif
Détecter les comportements de spam automatiquement :
- Répétition de contenu identique
- Flooding (trop de soumissions rapides)
- Patterns suspects (majuscules excessives, caractères spéciaux)
- Copier-coller entre annonces

### Service de Détection

```php
// app/Services/Global_Moderations/SpamDetector.php

namespace App\Services\Global_Moderations;

use App\Models\Mission;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class SpamDetector
{
    /**
     * Analyser un contenu pour détecter le spam
     */
    public function analyze(string $content, User $user): SpamDetectionResult
    {
        $result = new SpamDetectionResult();

        // 1. Vérifier les patterns textuels
        $result->addCheck('caps_ratio', $this->checkCapsRatio($content));
        $result->addCheck('special_chars', $this->checkSpecialChars($content));
        $result->addCheck('repetition', $this->checkRepetition($content));
        $result->addCheck('emoji_spam', $this->checkEmojiSpam($content));

        // 2. Vérifier la similarité avec contenus précédents
        $result->addCheck('duplicate', $this->checkDuplicateContent($content, $user));

        // 3. Vérifier le comportement utilisateur
        $result->addCheck('flooding', $this->checkFlooding($user));
        $result->addCheck('velocity', $this->checkVelocity($user));

        return $result;
    }

    /**
     * Ratio de majuscules (SPAM EN MAJUSCULES)
     */
    private function checkCapsRatio(string $content): array
    {
        $letters = preg_replace('/[^a-zA-Z]/', '', $content);
        if (strlen($letters) < 20) {
            return ['score' => 0, 'reason' => null];
        }

        $caps = preg_replace('/[^A-Z]/', '', $content);
        $ratio = strlen($caps) / strlen($letters);

        if ($ratio > 0.7) {
            return ['score' => 40, 'reason' => 'Trop de majuscules (spam)'];
        }
        if ($ratio > 0.5) {
            return ['score' => 20, 'reason' => 'Majuscules excessives'];
        }

        return ['score' => 0, 'reason' => null];
    }

    /**
     * Caractères spéciaux excessifs (!!!??? $$$$)
     */
    private function checkSpecialChars(string $content): array
    {
        // Compter les répétitions de caractères spéciaux
        if (preg_match('/[!?$€£]{4,}/', $content)) {
            return ['score' => 30, 'reason' => 'Caractères spéciaux répétés'];
        }

        // Compter le ratio de caractères spéciaux
        $specialCount = preg_match_all('/[!?$€£@#%&*]/', $content);
        $ratio = $specialCount / max(strlen($content), 1);

        if ($ratio > 0.1) {
            return ['score' => 25, 'reason' => 'Trop de caractères spéciaux'];
        }

        return ['score' => 0, 'reason' => null];
    }

    /**
     * Répétition de mots/phrases
     */
    private function checkRepetition(string $content): array
    {
        $words = str_word_count(strtolower($content), 1);
        $wordCounts = array_count_values($words);

        foreach ($wordCounts as $word => $count) {
            // Ignorer les mots courts
            if (strlen($word) < 4) continue;

            // Même mot répété plus de 5 fois
            if ($count > 5) {
                return ['score' => 35, 'reason' => "Mot '{$word}' répété {$count} fois"];
            }
        }

        // Vérifier répétition de phrases
        if (preg_match('/(.{20,})\1{2,}/i', $content, $matches)) {
            return ['score' => 50, 'reason' => 'Phrase répétée plusieurs fois'];
        }

        return ['score' => 0, 'reason' => null];
    }

    /**
     * Spam d'emojis
     */
    private function checkEmojiSpam(string $content): array
    {
        // Pattern pour détecter les emojis
        $emojiPattern = '/[\x{1F600}-\x{1F64F}\x{1F300}-\x{1F5FF}\x{1F680}-\x{1F6FF}\x{2600}-\x{26FF}]/u';

        $emojiCount = preg_match_all($emojiPattern, $content);

        if ($emojiCount > 10) {
            return ['score' => 25, 'reason' => 'Trop d\'emojis'];
        }

        return ['score' => 0, 'reason' => null];
    }

    /**
     * Contenu dupliqué (même user ou global)
     */
    private function checkDuplicateContent(string $content, User $user): array
    {
        $contentHash = md5(Str::lower(preg_replace('/\s+/', '', $content)));

        // Vérifier les missions récentes de cet utilisateur
        $recentMissions = Mission::where('requester_id', $user->id)
            ->where('created_at', '>=', now()->subDays(30))
            ->get(['title', 'description']);

        foreach ($recentMissions as $mission) {
            $existingHash = md5(Str::lower(preg_replace('/\s+/', '', $mission->title . $mission->description)));

            if ($contentHash === $existingHash) {
                return ['score' => 60, 'reason' => 'Contenu identique à une annonce existante'];
            }

            // Similarité avec algorithme de Levenshtein
            $similarity = similar_text(
                Str::lower($content),
                Str::lower($mission->title . ' ' . $mission->description),
                $percent
            );

            if ($percent > 80) {
                return ['score' => 45, 'reason' => 'Contenu très similaire à une annonce existante'];
            }
        }

        return ['score' => 0, 'reason' => null];
    }

    /**
     * Flooding (trop de soumissions en peu de temps)
     */
    private function checkFlooding(User $user): array
    {
        $cacheKey = "user_submissions_{$user->id}";
        $submissions = Cache::get($cacheKey, []);

        // Compter les soumissions des 10 dernières minutes
        $recentSubmissions = array_filter($submissions, fn($time) => $time > now()->subMinutes(10)->timestamp);

        if (count($recentSubmissions) >= 5) {
            return ['score' => 70, 'reason' => 'Trop de soumissions en peu de temps'];
        }
        if (count($recentSubmissions) >= 3) {
            return ['score' => 40, 'reason' => 'Soumissions fréquentes'];
        }

        return ['score' => 0, 'reason' => null];
    }

    /**
     * Vélocité de frappe (bot detection)
     */
    private function checkVelocity(User $user): array
    {
        // Temps entre chargement formulaire et soumission stocké en session
        $formLoadTime = session('mission_form_loaded_at');

        if ($formLoadTime) {
            $secondsToFill = now()->diffInSeconds($formLoadTime);

            // Moins de 5 secondes pour remplir = suspect
            if ($secondsToFill < 5) {
                return ['score' => 80, 'reason' => 'Formulaire rempli trop rapidement (bot?)'];
            }
            if ($secondsToFill < 15) {
                return ['score' => 30, 'reason' => 'Formulaire rempli rapidement'];
            }
        }

        return ['score' => 0, 'reason' => null];
    }

    /**
     * Enregistrer une soumission pour le tracking
     */
    public function recordSubmission(User $user): void
    {
        $cacheKey = "user_submissions_{$user->id}";
        $submissions = Cache::get($cacheKey, []);
        $submissions[] = now()->timestamp;

        // Garder seulement les 20 dernières
        $submissions = array_slice($submissions, -20);

        Cache::put($cacheKey, $submissions, now()->addHours(1));
    }
}
```

### Classe de Résultat

```php
// app/Services/Global_Moderations/SpamDetectionResult.php

namespace App\Services\Global_Moderations;

class SpamDetectionResult
{
    private array $checks = [];

    public function addCheck(string $name, array $result): void
    {
        $this->checks[$name] = $result;
    }

    public function getTotalScore(): int
    {
        return array_sum(array_column($this->checks, 'score'));
    }

    public function getReasons(): array
    {
        return array_filter(array_column($this->checks, 'reason'));
    }

    public function isSpam(): bool
    {
        return $this->getTotalScore() >= config('moderations.spam.block_threshold', 70);
    }

    public function needsReview(): bool
    {
        $score = $this->getTotalScore();
        return $score >= config('moderations.spam.review_threshold', 40) && $score < 70;
    }

    public function toArray(): array
    {
        return [
            'total_score' => $this->getTotalScore(),
            'is_spam' => $this->isSpam(),
            'needs_review' => $this->needsReview(),
            'checks' => $this->checks,
            'reasons' => $this->getReasons(),
        ];
    }
}
```

### Configuration

```php
// config/moderations.php - Section spam

'spam' => [
    'enabled' => env('MODERATION_SPAM_ENABLED', true),

    'block_threshold' => 70,    // Score >= 70 = blocage spam
    'review_threshold' => 40,   // Score 40-69 = review

    'checks' => [
        'caps_ratio' => true,
        'special_chars' => true,
        'repetition' => true,
        'emoji_spam' => true,
        'duplicate' => true,
        'flooding' => true,
        'velocity' => true,
    ],

    // Fenêtre de temps pour flooding (minutes)
    'flooding_window' => 10,
    'flooding_max' => 5,

    // Seuil de similarité pour duplication (%)
    'duplicate_similarity' => 80,
],
```

---

## 8. SYSTÈME DE SIGNALEMENT

### Types de Signalement

```php
// Table: content_reports
Schema::create('content_reports', function (Blueprint $table) {
    $table->id();
    $table->foreignId('reporter_id')->constrained('users');
    $table->morphs('reportable'); // mission, message, user, offer
    $table->enum('reason', [
        'spam',
        'inappropriate_content',
        'harassment',
        'fake_profile',
        'scam',
        'contact_sharing',
        'off_platform',
        'other'
    ]);
    $table->text('details')->nullable();
    $table->enum('status', ['pending', 'reviewed', 'action_taken', 'dismissed']);
    $table->foreignId('reviewed_by')->nullable()->constrained('users');
    $table->timestamp('reviewed_at')->nullable();
    $table->text('admin_notes')->nullable();
    $table->timestamps();

    // Un user ne peut signaler qu'une fois le même contenu
    $table->unique(['reporter_id', 'reportable_type', 'reportable_id']);
});
```

### API de Signalement

```php
// Routes
Route::post('/report/mission/{mission}', [ReportController::class, 'reportMission']);
Route::post('/report/user/{user}', [ReportController::class, 'reportUser']);
Route::post('/report/message/{message}', [ReportController::class, 'reportMessage']);
Route::post('/report/offer/{offer}', [ReportController::class, 'reportOffer']);

// Controller
class ReportController extends Controller
{
    public function reportMission(Request $request, Mission $mission)
    {
        $validated = $request->validate([
            'reason' => 'required|in:spam,inappropriate_content,...',
            'details' => 'nullable|string|max:1000',
        ]);

        // Vérifier limite quotidienne (anti-abus)
        $todayReports = ContentReport::where('reporter_id', auth()->id())
            ->whereDate('created_at', today())
            ->count();

        if ($todayReports >= config('moderations.limits.reports_per_day')) {
            return response()->json([
                'error' => 'Vous avez atteint la limite de signalements pour aujourd\'hui.'
            ], 429);
        }

        // Créer le signalement
        $report = ContentReport::create([
            'reporter_id' => auth()->id(),
            'reportable_type' => Mission::class,
            'reportable_id' => $mission->id,
            'reason' => $validated['reason'],
            'details' => $validated['details'],
            'status' => 'pending',
        ]);

        // Si contenu reçoit 3+ signalements → flag automatique
        $this->checkAutoFlag($mission);

        // Notification admin si signalement critique
        if (in_array($validated['reason'], ['scam', 'harassment'])) {
            $this->notifyAdmins($report);
        }

        return response()->json([
            'success' => true,
            'message' => 'Merci pour votre signalement. Notre équipe va l\'examiner.'
        ]);
    }

    private function checkAutoFlag($content)
    {
        $reportCount = ContentReport::where('reportable_type', get_class($content))
            ->where('reportable_id', $content->id)
            ->count();

        if ($reportCount >= 3) {
            ModerationFlag::firstOrCreate([
                'flaggable_type' => get_class($content),
                'flaggable_id' => $content->id,
            ], [
                'flag_type' => 'user_reports',
                'severity' => 'warning',
                'auto_flagged' => true,
                'report_count' => $reportCount,
            ]);
        }
    }
}
```

### Interface Utilisateur

```html
<!-- Bouton de signalement discret mais accessible -->
<button class="report-btn" @click="showReportModal = true">
    <i class="icon-flag"></i>
    Signaler
</button>

<!-- Modal de signalement -->
<div class="report-modal" v-if="showReportModal">
    <h3>Signaler cette annonce</h3>
    <p>Pourquoi signalez-vous ce contenu ?</p>

    <label v-for="reason in reasons" :key="reason.value">
        <input type="radio" v-model="selectedReason" :value="reason.value">
        {{ reason.label }}
    </label>

    <textarea v-if="selectedReason === 'other'"
              v-model="details"
              placeholder="Précisez le problème...">
    </textarea>

    <button @click="submitReport">Envoyer le signalement</button>
    <button @click="showReportModal = false">Annuler</button>
</div>
```

---

## 9. SYSTÈME DE STRIKES ET SANCTIONS

(Déplacé vers section suivante - voir ci-dessous)

---

## 10. SYSTÈME D'APPEL (APPEAL)

### Objectif
Permettre aux utilisateurs bannis de contester leur suspension de manière structurée.

### Workflow d'Appel

```
┌─────────────────────────────────────────────────────────────────────────────┐
│                        PROCESSUS D'APPEL                                     │
├─────────────────────────────────────────────────────────────────────────────┤
│                                                                              │
│   UTILISATEUR BANNI                                                          │
│         │                                                                    │
│         ▼                                                                    │
│   ┌─────────────────┐                                                       │
│   │ Page /appeal    │ (accessible même si banni)                            │
│   │ Formulaire      │                                                       │
│   └────────┬────────┘                                                       │
│            │                                                                 │
│            ▼                                                                 │
│   ┌─────────────────┐                                                       │
│   │ Soumission      │                                                       │
│   │ - Raison appel  │                                                       │
│   │ - Pièces        │                                                       │
│   │ - Engagement    │                                                       │
│   └────────┬────────┘                                                       │
│            │                                                                 │
│            ▼                                                                 │
│   ┌─────────────────┐     ┌─────────────────┐                               │
│   │ ADMIN REVIEW    │────▶│ Notification    │                               │
│   │ Queue appels    │     │ admin           │                               │
│   └────────┬────────┘     └─────────────────┘                               │
│            │                                                                 │
│     ┌──────┴──────┐                                                         │
│     ▼             ▼                                                         │
│ ┌───────┐    ┌───────┐                                                      │
│ │ACCEPTÉ│    │REJETÉ │                                                      │
│ └───┬───┘    └───┬───┘                                                      │
│     │            │                                                           │
│     ▼            ▼                                                           │
│ ┌─────────┐  ┌─────────────┐                                                │
│ │ UNBAN   │  │ Ban confirmé│                                                │
│ │ Compte  │  │ Définitif   │                                                │
│ │ réactivé│  │ après 2 appels│                                              │
│ └─────────┘  └─────────────┘                                                │
│                                                                              │
└─────────────────────────────────────────────────────────────────────────────┘
```

### Modèle Appeal

```php
// Migration
Schema::create('user_appeals', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->text('reason');                           // Raison de l'appel
    $table->text('commitment')->nullable();           // Engagement à respecter les règles
    $table->json('evidence')->nullable();             // Pièces jointes
    $table->enum('status', ['pending', 'approved', 'rejected', 'expired'])->default('pending');
    $table->foreignId('reviewed_by')->nullable()->constrained('users');
    $table->timestamp('reviewed_at')->nullable();
    $table->text('admin_response')->nullable();
    $table->integer('appeal_number')->default(1);     // 1er, 2ème appel...
    $table->timestamps();

    $table->index(['user_id', 'status']);
});
```

### Controller

```php
// app/Http/Controllers/AppealController.php

namespace App\Http\Controllers;

use App\Models\UserAppeal;
use App\Services\Global_Moderations\SanctionManager;
use App\Services\Global_Notifications\NotificationService;
use Illuminate\Http\Request;

class AppealController extends Controller
{
    public function __construct(
        private SanctionManager $sanctionManager,
        private NotificationService $notificationService
    ) {}

    /**
     * Afficher le formulaire d'appel
     */
    public function showForm()
    {
        $user = auth()->user();

        // Vérifier si l'utilisateur peut faire appel
        if ($user->status !== 'suspended') {
            return redirect('/')->with('info', 'Votre compte n\'est pas suspendu.');
        }

        if (!$user->can_appeal) {
            return view('appeal.denied', [
                'reason' => 'Vous avez épuisé vos possibilités d\'appel.'
            ]);
        }

        if ($user->appeal_until && now()->gt($user->appeal_until)) {
            return view('appeal.denied', [
                'reason' => 'Le délai pour faire appel est dépassé.'
            ]);
        }

        // Compter les appels précédents
        $appealCount = UserAppeal::where('user_id', $user->id)->count();

        return view('appeal.form', [
            'user' => $user,
            'ban_reason' => $user->ban_reason,
            'appeal_count' => $appealCount,
            'max_appeals' => config('moderations.ban.max_appeals', 2),
            'deadline' => $user->appeal_until,
        ]);
    }

    /**
     * Soumettre un appel
     */
    public function submit(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'reason' => 'required|string|min:50|max:2000',
            'commitment' => 'required|string|min:20|max:500',
            'evidence.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        // Vérifications
        $existingPending = UserAppeal::where('user_id', $user->id)
            ->where('status', 'pending')
            ->exists();

        if ($existingPending) {
            return back()->withErrors(['Un appel est déjà en cours de traitement.']);
        }

        $appealCount = UserAppeal::where('user_id', $user->id)->count();
        $maxAppeals = config('moderations.ban.max_appeals', 2);

        if ($appealCount >= $maxAppeals) {
            return back()->withErrors(['Vous avez atteint le nombre maximum d\'appels.']);
        }

        // Traiter les pièces jointes
        $evidencePaths = [];
        if ($request->hasFile('evidence')) {
            foreach ($request->file('evidence') as $file) {
                $evidencePaths[] = $file->store('appeals/' . $user->id);
            }
        }

        // Créer l'appel
        $appeal = UserAppeal::create([
            'user_id' => $user->id,
            'reason' => $validated['reason'],
            'commitment' => $validated['commitment'],
            'evidence' => $evidencePaths,
            'appeal_number' => $appealCount + 1,
        ]);

        // Notifier les admins
        $this->notificationService->sendToAdmins(
            new \App\Services\Global_Notifications\Admin\NewAppealNotification($appeal)
        );

        return view('appeal.submitted', [
            'appeal' => $appeal,
            'message' => 'Votre appel a été soumis. Nous l\'examinerons dans les 48-72h.'
        ]);
    }

    /**
     * [ADMIN] Accepter un appel
     */
    public function approve(Request $request, UserAppeal $appeal)
    {
        $validated = $request->validate([
            'response' => 'required|string|max:1000',
        ]);

        DB::transaction(function () use ($appeal, $validated) {
            $appeal->update([
                'status' => 'approved',
                'reviewed_by' => auth()->id(),
                'reviewed_at' => now(),
                'admin_response' => $validated['response'],
            ]);

            // Débannir l'utilisateur
            $this->sanctionManager->unbanUser(
                $appeal->user,
                'Appel approuvé: ' . $validated['response']
            );
        });

        // Notifier l'utilisateur
        $appeal->user->notify(
            new \App\Services\Global_Notifications\Moderation\AppealApprovedNotification($appeal)
        );

        return back()->with('success', 'Appel approuvé. L\'utilisateur a été réactivé.');
    }

    /**
     * [ADMIN] Rejeter un appel
     */
    public function reject(Request $request, UserAppeal $appeal)
    {
        $validated = $request->validate([
            'response' => 'required|string|max:1000',
        ]);

        $appeal->update([
            'status' => 'rejected',
            'reviewed_by' => auth()->id(),
            'reviewed_at' => now(),
            'admin_response' => $validated['response'],
        ]);

        // Vérifier si c'était le dernier appel possible
        $appealCount = UserAppeal::where('user_id', $appeal->user_id)->count();
        $maxAppeals = config('moderations.ban.max_appeals', 2);

        if ($appealCount >= $maxAppeals) {
            $appeal->user->update([
                'can_appeal' => false,
                'ban_reason' => $appeal->user->ban_reason . ' (Définitif après rejet d\'appel)',
            ]);
        }

        // Notifier l'utilisateur
        $appeal->user->notify(
            new \App\Services\Global_Notifications\Moderation\AppealRejectedNotification($appeal)
        );

        return back()->with('success', 'Appel rejeté.');
    }
}
```

### Routes

```php
// routes/web.php

// Routes accessibles même si banni
Route::middleware(['auth'])->group(function () {
    Route::get('/appeal', [AppealController::class, 'showForm'])->name('appeal.form');
    Route::post('/appeal', [AppealController::class, 'submit'])->name('appeal.submit');
    Route::get('/appeal/status', [AppealController::class, 'status'])->name('appeal.status');
});

// Routes admin
Route::prefix('admin/moderation/appeals')->name('admin.moderation.appeals.')->group(function () {
    Route::get('/', [AppealController::class, 'adminIndex'])->name('index');
    Route::post('/{appeal}/approve', [AppealController::class, 'approve'])->name('approve');
    Route::post('/{appeal}/reject', [AppealController::class, 'reject'])->name('reject');
});
```

---

## 11. API REST COMPLÈTE

### Endpoints Modération (Utilisateur)

```php
// routes/api.php

Route::prefix('v1')->group(function () {

    // === LIMITES ET STATUT ===
    Route::middleware('auth:sanctum')->group(function () {

        // Obtenir les limites actuelles de l'utilisateur
        Route::get('/moderation/limits', [ModerationApiController::class, 'getLimits']);
        // Response: { missions_remaining: 2, offers_remaining: 15, reset_at: "2026-01-31T23:59:59Z" }

        // Vérifier le statut de modération de l'utilisateur
        Route::get('/moderation/status', [ModerationApiController::class, 'getStatus']);
        // Response: { strikes: 1, warnings: [], can_post: true, review_mode: false }

        // === SIGNALEMENTS ===
        Route::post('/report/mission/{mission}', [ReportApiController::class, 'reportMission']);
        Route::post('/report/user/{user}', [ReportApiController::class, 'reportUser']);
        Route::post('/report/message/{message}', [ReportApiController::class, 'reportMessage']);
        Route::post('/report/offer/{offer}', [ReportApiController::class, 'reportOffer']);
        // Response: { success: true, report_id: 123, message: "Signalement enregistré" }

        // === APPELS ===
        Route::get('/appeal/can-appeal', [AppealApiController::class, 'canAppeal']);
        Route::post('/appeal', [AppealApiController::class, 'submit']);
        Route::get('/appeal/status', [AppealApiController::class, 'status']);

        // === PRÉ-VALIDATION CONTENU ===
        Route::post('/moderation/check-content', [ModerationApiController::class, 'checkContent']);
        // Body: { title: "...", description: "..." }
        // Response: { valid: true, warnings: [], would_need_review: false }
    });
});
```

### Endpoints Admin

```php
Route::prefix('v1/admin/moderation')->middleware(['auth:sanctum', 'admin'])->group(function () {

    // === DASHBOARD ===
    Route::get('/stats', [AdminModerationApiController::class, 'getStats']);
    // Response: { pending: 12, reports: 8, strikes_today: 3, bans_week: 1 }

    // === QUEUE DE MODÉRATION ===
    Route::get('/queue', [AdminModerationApiController::class, 'getQueue']);
    Route::get('/queue/{flag}', [AdminModerationApiController::class, 'getFlag']);
    Route::post('/queue/{flag}/approve', [AdminModerationApiController::class, 'approve']);
    Route::post('/queue/{flag}/reject', [AdminModerationApiController::class, 'reject']);
    Route::post('/queue/bulk-approve', [AdminModerationApiController::class, 'bulkApprove']);
    Route::post('/queue/bulk-reject', [AdminModerationApiController::class, 'bulkReject']);

    // === SIGNALEMENTS ===
    Route::get('/reports', [AdminModerationApiController::class, 'getReports']);
    Route::get('/reports/{report}', [AdminModerationApiController::class, 'getReport']);
    Route::post('/reports/{report}/action', [AdminModerationApiController::class, 'actionReport']);
    Route::post('/reports/{report}/dismiss', [AdminModerationApiController::class, 'dismissReport']);

    // === UTILISATEURS ===
    Route::get('/users/{user}/history', [AdminModerationApiController::class, 'getUserHistory']);
    Route::post('/users/{user}/strike', [AdminModerationApiController::class, 'giveStrike']);
    Route::delete('/users/{user}/strikes/{strike}', [AdminModerationApiController::class, 'removeStrike']);
    Route::post('/users/{user}/ban', [AdminModerationApiController::class, 'banUser']);
    Route::post('/users/{user}/unban', [AdminModerationApiController::class, 'unbanUser']);
    Route::post('/users/{user}/warn', [AdminModerationApiController::class, 'warnUser']);

    // === APPELS ===
    Route::get('/appeals', [AdminModerationApiController::class, 'getAppeals']);
    Route::post('/appeals/{appeal}/approve', [AdminModerationApiController::class, 'approveAppeal']);
    Route::post('/appeals/{appeal}/reject', [AdminModerationApiController::class, 'rejectAppeal']);

    // === MOTS INTERDITS ===
    Route::get('/banned-words', [BannedWordApiController::class, 'index']);
    Route::post('/banned-words', [BannedWordApiController::class, 'store']);
    Route::put('/banned-words/{word}', [BannedWordApiController::class, 'update']);
    Route::delete('/banned-words/{word}', [BannedWordApiController::class, 'destroy']);
    Route::post('/banned-words/import', [BannedWordApiController::class, 'import']);
    Route::get('/banned-words/export', [BannedWordApiController::class, 'export']);

    // === ANALYTICS ===
    Route::get('/analytics/overview', [ModerationAnalyticsController::class, 'overview']);
    Route::get('/analytics/trends', [ModerationAnalyticsController::class, 'trends']);
    Route::get('/analytics/top-reporters', [ModerationAnalyticsController::class, 'topReporters']);
    Route::get('/analytics/top-offenders', [ModerationAnalyticsController::class, 'topOffenders']);
});
```

### Controller API Exemple

```php
// app/Http/Controllers/Api/ModerationApiController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Global_Moderations\ModerationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ModerationApiController extends Controller
{
    public function __construct(
        private ModerationService $moderationService
    ) {}

    /**
     * Obtenir les limites de l'utilisateur
     */
    public function getLimits(Request $request): JsonResponse
    {
        $user = $request->user();
        $limits = $this->moderationService->getUserLimits($user);

        return response()->json([
            'missions' => [
                'used' => $limits['missions_today'],
                'limit' => $limits['missions_per_day'],
                'remaining' => $limits['missions_remaining'],
            ],
            'offers' => [
                'used' => $limits['offers_today'],
                'limit' => $limits['offers_per_day'],
                'remaining' => $limits['offers_remaining'],
            ],
            'reset_at' => now()->endOfDay()->toISOString(),
        ]);
    }

    /**
     * Pré-valider un contenu avant soumission
     */
    public function checkContent(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:5000',
            'context' => 'nullable|string|in:mission,offer,message',
        ]);

        $content = ($validated['title'] ?? '') . ' ' . ($validated['description'] ?? '');
        $result = $this->moderationService->analyzeContent($content);

        return response()->json([
            'valid' => $result['decision'] === 'clean',
            'decision' => $result['decision'],
            'score' => $result['score'],
            'warnings' => $result['warnings'],
            'would_need_review' => $result['decision'] === 'review',
            'blocked_reasons' => $result['decision'] === 'blocked' ? $result['reasons'] : [],
        ]);
    }
}
```

---

## 12. JOBS ET QUEUES

### Architecture des Jobs

```
┌─────────────────────────────────────────────────────────────────────────────┐
│                        JOBS ASYNCHRONES                                      │
├─────────────────────────────────────────────────────────────────────────────┤
│                                                                              │
│   QUEUE: moderation (haute priorité)                                        │
│   ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━                                        │
│   • AnalyzeContentJob        - Analyse texte (mots, spam, contacts)         │
│   • AnalyzeImageJob          - Analyse image via API Vision                 │
│   • ProcessReportJob         - Traitement signalement                       │
│   • ApplyStrikeJob           - Application d'un strike                      │
│                                                                              │
│   QUEUE: notifications (priorité normale)                                    │
│   ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━                                     │
│   • SendStrikeNotification   - Email/DB notification                        │
│   • SendBanNotification      - Email de ban                                 │
│   • NotifyAdminsJob          - Alerter les admins                           │
│                                                                              │
│   QUEUE: analytics (basse priorité)                                          │
│   ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━                                        │
│   • UpdateModerationStats    - Mise à jour statistiques                     │
│   • GenerateModerationReport - Rapport quotidien                            │
│                                                                              │
│   SCHEDULED TASKS (Cron)                                                     │
│   ━━━━━━━━━━━━━━━━━━━━━━━━                                                  │
│   • ExpireStrikes            - Expirer les strikes > 30 jours               │
│   • ExpireAppeals            - Expirer les appels non traités               │
│   • CleanupFlags             - Nettoyer les flags anciens                   │
│   • DailyModerationDigest    - Email récap admin                            │
│                                                                              │
└─────────────────────────────────────────────────────────────────────────────┘
```

### Jobs Principaux

```php
// app/Jobs/Moderation/AnalyzeContentJob.php

namespace App\Jobs\Moderation;

use App\Models\Mission;
use App\Services\Global_Moderations\ModerationService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AnalyzeContentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3;
    public int $backoff = 60;

    public function __construct(
        private string $contentType,
        private int $contentId
    ) {
        $this->onQueue('moderation');
    }

    public function handle(ModerationService $moderationService): void
    {
        $content = match($this->contentType) {
            'mission' => Mission::find($this->contentId),
            'offer' => MissionOffer::find($this->contentId),
            'message' => MissionMessage::find($this->contentId),
            default => null,
        };

        if (!$content) {
            return;
        }

        $text = $this->extractText($content);
        $result = $moderationService->analyzeContent($text);

        // Appliquer la décision
        $moderationService->applyDecision($content, $result);
    }

    private function extractText($content): string
    {
        return match($this->contentType) {
            'mission' => $content->title . ' ' . $content->description,
            'offer' => $content->message,
            'message' => $content->message,
            default => '',
        };
    }
}
```

```php
// app/Jobs/Moderation/AnalyzeImageJob.php

namespace App\Jobs\Moderation;

use App\Models\Mission;
use App\Services\Global_Moderations\ImageModerator;
use App\Services\Global_Moderations\ModerationService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class AnalyzeImageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3;
    public int $timeout = 120;

    public function __construct(
        private string $imagePath,
        private int $missionId
    ) {
        $this->onQueue('moderation');
    }

    public function handle(ImageModerator $imageModerator, ModerationService $moderationService): void
    {
        $mission = Mission::find($this->missionId);
        if (!$mission) {
            return;
        }

        $fullPath = Storage::disk('public')->path($this->imagePath);

        if (!file_exists($fullPath)) {
            return;
        }

        $result = $imageModerator->analyze($fullPath);
        $decision = $imageModerator->getDecision($result);

        if ($decision !== 'clean') {
            // Créer un flag
            $moderationService->flagContent($mission, 'image_moderation', [
                'image_path' => $this->imagePath,
                'result' => $result->toArray(),
                'decision' => $decision,
            ]);

            // Si bloqué, supprimer l'image
            if ($decision === 'blocked') {
                Storage::disk('public')->delete($this->imagePath);

                // Retirer de la liste des attachments
                $attachments = $mission->attachments ?? [];
                $attachments = array_filter($attachments, fn($a) => $a !== $this->imagePath);
                $mission->update(['attachments' => array_values($attachments)]);
            }
        }
    }
}
```

### Commandes Planifiées

```php
// app/Console/Kernel.php

protected function schedule(Schedule $schedule): void
{
    // Expirer les strikes après 30 jours
    $schedule->command('moderation:expire-strikes')
        ->daily()
        ->at('02:00')
        ->withoutOverlapping();

    // Expirer les appels non traités après 14 jours
    $schedule->command('moderation:expire-appeals')
        ->daily()
        ->at('02:30');

    // Nettoyer les flags anciens (> 90 jours)
    $schedule->command('moderation:cleanup-flags')
        ->weekly()
        ->sundays()
        ->at('03:00');

    // Rapport quotidien modération aux admins
    $schedule->command('moderation:daily-digest')
        ->dailyAt('08:00');

    // Mise à jour des statistiques
    $schedule->command('moderation:update-stats')
        ->everyFifteenMinutes();
}
```

```php
// app/Console/Commands/ExpireStrikesCommand.php

namespace App\Console\Commands;

use App\Services\Global_Moderations\Models\UserStrike;
use Illuminate\Console\Command;

class ExpireStrikesCommand extends Command
{
    protected $signature = 'moderation:expire-strikes';
    protected $description = 'Expire les strikes anciens';

    public function handle(): int
    {
        $expiryDays = config('moderations.strikes.expiry_days', 30);

        $expired = UserStrike::where('is_active', true)
            ->where('expires_at', '<=', now())
            ->update(['is_active' => false]);

        $this->info("Expirés: {$expired} strikes");

        // Recalculer les compteurs utilisateurs
        $users = UserStrike::where('is_active', false)
            ->where('expires_at', '<=', now())
            ->distinct()
            ->pluck('user_id');

        foreach ($users as $userId) {
            $activeCount = UserStrike::where('user_id', $userId)
                ->where('is_active', true)
                ->count();

            \App\Models\User::where('id', $userId)
                ->update(['strike_count' => $activeCount]);
        }

        return Command::SUCCESS;
    }
}
```

---

## 13. ANALYTICS ET STATISTIQUES

### Modèle de Statistiques

```php
// app/Services/Global_Moderations/Models/ModerationStat.php

namespace App\Services\Global_Moderations\Models;

use Illuminate\Database\Eloquent\Model;

class ModerationStat extends Model
{
    protected $fillable = [
        'date',
        'type',
        'value',
        'metadata',
    ];

    protected $casts = [
        'date' => 'date',
        'metadata' => 'array',
    ];
}
```

### Service Analytics

```php
// app/Services/Global_Moderations/ModerationAnalytics.php

namespace App\Services\Global_Moderations;

use App\Services\Global_Moderations\Models\ModerationAction;
use App\Services\Global_Moderations\Models\ModerationFlag;
use App\Services\Global_Moderations\Models\ContentReport;
use App\Services\Global_Moderations\Models\UserStrike;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class ModerationAnalytics
{
    /**
     * Statistiques globales temps réel
     */
    public function getOverview(): array
    {
        return Cache::remember('moderation_overview', 300, function () {
            return [
                'queue' => [
                    'pending' => ModerationFlag::where('status', 'pending')->count(),
                    'oldest_hours' => $this->getOldestPendingHours(),
                ],
                'reports' => [
                    'pending' => ContentReport::where('status', 'pending')->count(),
                    'today' => ContentReport::whereDate('created_at', today())->count(),
                ],
                'strikes' => [
                    'today' => UserStrike::whereDate('created_at', today())->count(),
                    'this_week' => UserStrike::where('created_at', '>=', now()->startOfWeek())->count(),
                ],
                'bans' => [
                    'active' => \App\Models\User::where('status', 'suspended')->count(),
                    'this_week' => \App\Models\User::where('status', 'suspended')
                        ->where('banned_at', '>=', now()->startOfWeek())
                        ->count(),
                ],
                'approvals' => [
                    'today' => ModerationFlag::where('status', 'approved')
                        ->whereDate('reviewed_at', today())
                        ->count(),
                    'rejection_rate' => $this->getRejectionRate(),
                ],
            ];
        });
    }

    /**
     * Tendances sur période
     */
    public function getTrends(int $days = 30): array
    {
        $startDate = now()->subDays($days);

        return [
            'flags_per_day' => ModerationFlag::where('created_at', '>=', $startDate)
                ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
                ->groupBy('date')
                ->orderBy('date')
                ->pluck('count', 'date'),

            'reports_per_day' => ContentReport::where('created_at', '>=', $startDate)
                ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
                ->groupBy('date')
                ->orderBy('date')
                ->pluck('count', 'date'),

            'strikes_per_day' => UserStrike::where('created_at', '>=', $startDate)
                ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
                ->groupBy('date')
                ->orderBy('date')
                ->pluck('count', 'date'),

            'response_time_avg' => $this->getAverageResponseTime($days),
        ];
    }

    /**
     * Top signaleurs (pour détecter abus)
     */
    public function getTopReporters(int $limit = 10): array
    {
        return ContentReport::where('created_at', '>=', now()->subDays(30))
            ->select('reporter_id', DB::raw('COUNT(*) as count'))
            ->groupBy('reporter_id')
            ->orderByDesc('count')
            ->limit($limit)
            ->with('reporter:id,name,email')
            ->get()
            ->toArray();
    }

    /**
     * Top contrevenants
     */
    public function getTopOffenders(int $limit = 10): array
    {
        return UserStrike::where('created_at', '>=', now()->subDays(30))
            ->select('user_id', DB::raw('COUNT(*) as strike_count'))
            ->groupBy('user_id')
            ->orderByDesc('strike_count')
            ->limit($limit)
            ->with('user:id,name,email,status')
            ->get()
            ->toArray();
    }

    /**
     * Répartition par type de flag
     */
    public function getFlagsByType(): array
    {
        return ModerationFlag::where('created_at', '>=', now()->subDays(30))
            ->select('flag_type', DB::raw('COUNT(*) as count'))
            ->groupBy('flag_type')
            ->pluck('count', 'flag_type')
            ->toArray();
    }

    /**
     * Répartition par catégorie de mot interdit
     */
    public function getBannedWordsByCategory(): array
    {
        return DB::table('moderation_flags')
            ->where('flag_type', 'banned_word')
            ->where('created_at', '>=', now()->subDays(30))
            ->selectRaw("JSON_EXTRACT(detected_items, '$[0].category') as category, COUNT(*) as count")
            ->groupBy('category')
            ->pluck('count', 'category')
            ->toArray();
    }

    /**
     * Temps de réponse moyen
     */
    private function getAverageResponseTime(int $days): float
    {
        $result = ModerationFlag::whereNotNull('reviewed_at')
            ->where('created_at', '>=', now()->subDays($days))
            ->selectRaw('AVG(TIMESTAMPDIFF(HOUR, created_at, reviewed_at)) as avg_hours')
            ->first();

        return round($result->avg_hours ?? 0, 1);
    }

    /**
     * Taux de rejet
     */
    private function getRejectionRate(): float
    {
        $total = ModerationFlag::where('status', '!=', 'pending')
            ->where('reviewed_at', '>=', now()->subDays(30))
            ->count();

        if ($total === 0) return 0;

        $rejected = ModerationFlag::where('status', 'rejected')
            ->where('reviewed_at', '>=', now()->subDays(30))
            ->count();

        return round(($rejected / $total) * 100, 1);
    }

    /**
     * Heures depuis le plus ancien flag en attente
     */
    private function getOldestPendingHours(): int
    {
        $oldest = ModerationFlag::where('status', 'pending')
            ->orderBy('created_at')
            ->first();

        if (!$oldest) return 0;

        return (int) now()->diffInHours($oldest->created_at);
    }
}
```

---

## 14. MULTI-LANGUE ET PRÉSENCE MONDIALE

### Contexte Global

```
┌─────────────────────────────────────────────────────────────────────────────┐
│                    PORTÉE INTERNATIONALE ULIXAI                              │
├─────────────────────────────────────────────────────────────────────────────┤
│                                                                              │
│   🌍 PRÉSENCE: Monde entier (tous les pays)                                 │
│   👥 UTILISATEURS: Toutes nationalités                                      │
│   🗣️ LANGUES NAVIGATION: 9 langues officielles                              │
│   ✍️ LANGUES CONTENU: Libre (n'importe quelle langue)                       │
│                                                                              │
│   Langues de Navigation:                                                     │
│   ┌─────────┬─────────┬─────────┬─────────┬─────────┐                       │
│   │ FR      │ EN      │ DE      │ RU      │ ZH      │                       │
│   │ Français│ Anglais │ Allemand│ Russe   │ Chinois │                       │
│   ├─────────┼─────────┼─────────┼─────────┼─────────┤                       │
│   │ ES      │ PT      │ AR      │ HI      │         │                       │
│   │ Espagnol│Portugais│ Arabe   │ Hindi   │         │                       │
│   └─────────┴─────────┴─────────┴─────────┴─────────┘                       │
│                                                                              │
└─────────────────────────────────────────────────────────────────────────────┘
```

### Stratégie de Modération Multi-Langue

| Aspect | Stratégie |
|--------|-----------|
| **Vérification mots interdits** | Contre TOUTES les langues (pas seulement celle de l'utilisateur) |
| **Détection contacts** | Patterns internationaux (tous formats téléphone, toutes écritures) |
| **Messages d'erreur** | Traduits dans les 9 langues de navigation |
| **Alphabets supportés** | Latin, Cyrillique, Arabe, Devanagari (Hindi), Chinois simplifié |

### Configuration

```php
// config/moderations.php

'supported_languages' => ['fr', 'en', 'de', 'ru', 'zh', 'es', 'pt', 'ar', 'hi'],

// NOTE IMPORTANTE:
// Les utilisateurs peuvent publier dans N'IMPORTE QUELLE langue.
// La modération vérifie le contenu contre TOUTES les langues de mots interdits.
```

### Détection de Contact Internationale

```php
// Patterns pour détecter les numéros écrits en toutes langues

'contact_patterns' => [
    'phone' => [
        // Formats numériques internationaux
        '/\+?\d{1,4}[\s.\-]?\(?\d{1,4}\)?[\s.\-]?\d{1,4}[\s.\-]?\d{1,9}/',

        // Chiffres écrits - Français
        '/z[ée]ro|un|deux|trois|quatre|cinq|six|sept|huit|neuf/iu',

        // Chiffres écrits - Anglais
        '/\b(zero|one|two|three|four|five|six|seven|eight|nine)\b/i',

        // Chiffres écrits - Espagnol
        '/\b(cero|uno|dos|tres|cuatro|cinco|seis|siete|ocho|nueve)\b/i',

        // Chiffres écrits - Portugais
        '/\b(zero|um|dois|tres|quatro|cinco|seis|sete|oito|nove)\b/i',

        // Chiffres écrits - Allemand
        '/\b(null|eins|zwei|drei|vier|funf|sechs|sieben|acht|neun)\b/i',

        // Chiffres écrits - Russe (Cyrillique)
        '/ноль|один|два|три|четыре|пять|шесть|семь|восемь|девять/iu',

        // Chiffres écrits - Arabe
        '/صفر|واحد|اثنان|ثلاثة|أربعة|خمسة|ستة|سبعة|ثمانية|تسعة/u',

        // Chiffres écrits - Hindi (Devanagari)
        '/शून्य|एक|दो|तीन|चार|पांच|छह|सात|आठ|नौ/u',

        // Chiffres écrits - Chinois
        '/零|一|二|三|四|五|六|七|八|九|〇/u',
    ],
],
```

### Mots Interdits par Langue

```php
// database/seeders/BannedWordsSeeder.php

// Structure du seeder - 9 langues + patterns universels

class BannedWordsSeeder extends Seeder
{
    private const SUPPORTED_LANGUAGES = ['fr', 'en', 'de', 'ru', 'zh', 'es', 'pt', 'ar', 'hi'];

    public function run(): void
    {
        $this->seedUniversalWords();  // Patterns regex universels (language = '*')
        $this->seedFrenchWords();     // ~30 mots FR
        $this->seedEnglishWords();    // ~30 mots EN
        $this->seedGermanWords();     // ~20 mots DE
        $this->seedRussianWords();    // ~20 mots RU (cyrillique)
        $this->seedChineseWords();    // ~20 mots ZH (sinogrammes)
        $this->seedSpanishWords();    // ~25 mots ES
        $this->seedPortugueseWords(); // ~25 mots PT
        $this->seedArabicWords();     // ~20 mots AR (arabe)
        $this->seedHindiWords();      // ~20 mots HI (devanagari)
    }
}

// TOTAL: ~200 mots interdits couvrant 9 langues + patterns universels
```

### Vérification Multi-Langue dans WordFilter

```php
// app/Services/Global_Moderations/Models/BannedWord.php

class BannedWord extends Model
{
    /**
     * Récupère TOUS les mots interdits pour la modération
     * (toutes langues confondues car les utilisateurs peuvent publier en n'importe quelle langue)
     */
    public static function getAllForModeration()
    {
        return static::active()->get()->groupBy('severity');
    }

    /**
     * Scope pour toutes les langues
     */
    public function scopeAllLanguages($query)
    {
        return $query->where('is_active', true);
    }
}
```

### Messages d'Erreur Traduits

Les messages de modération doivent être dans les fichiers de traduction:

```
lang/
├── fr.json   # Messages en français
├── en.json   # Messages en anglais
├── de.json   # Messages en allemand
├── ru.json   # Messages en russe
├── zh.json   # Messages en chinois
├── es.json   # Messages en espagnol
├── pt.json   # Messages en portugais
├── ar.json   # Messages en arabe
└── hi.json   # Messages en hindi
```

Exemple de clés à ajouter:
```json
{
    "moderation.limit_reached": "Vous avez atteint la limite de :limit annonces par jour.",
    "moderation.content_blocked": "Votre contenu ne respecte pas nos conditions d'utilisation.",
    "moderation.content_pending": "Votre contenu est en cours de vérification.",
    "moderation.strike_warning": "Avertissement :current/:max reçu.",
    "moderation.account_suspended": "Votre compte a été suspendu."
}
```

---

## 15. BASE DE DONNÉES

### Diagramme des Tables

```
┌─────────────────────────────────────────────────────────────────────────────┐
│                    SCHÉMA BASE DE DONNÉES MODÉRATION                        │
├─────────────────────────────────────────────────────────────────────────────┤
│                                                                              │
│   users                           moderation_flags                           │
│   ├── id                          ├── id                                    │
│   ├── status (active/suspended)   ├── flaggable_type                        │
│   ├── strike_count                ├── flaggable_id                          │
│   ├── last_strike_at              ├── flag_type                             │
│   ├── banned_at                   ├── severity                              │
│   ├── ban_reason                  ├── risk_score                            │
│   ├── can_appeal                  ├── detected_items (JSON)                 │
│   ├── appeal_until                ├── status                                │
│   └── moderation_level            ├── reviewed_by → users.id                │
│         │                         ├── reviewed_at                           │
│         │                         └── rejection_reason                      │
│         │                                   │                               │
│         ▼                                   │                               │
│   user_strikes ◄────────────────────────────┘                               │
│   ├── id                                                                    │
│   ├── user_id → users.id          content_reports                           │
│   ├── reason                      ├── id                                    │
│   ├── details                     ├── reporter_id → users.id                │
│   ├── given_by → users.id         ├── reportable_type                       │
│   ├── related_content_type        ├── reportable_id                         │
│   ├── related_content_id          ├── reason                                │
│   ├── is_active                   ├── details                               │
│   └── expires_at                  ├── status                                │
│                                   ├── reviewed_by → users.id                │
│                                   └── admin_notes                           │
│   user_appeals                                                              │
│   ├── id                          banned_words                              │
│   ├── user_id → users.id          ├── id                                    │
│   ├── reason                      ├── word                                  │
│   ├── commitment                  ├── normalized_word                       │
│   ├── evidence (JSON)             ├── severity                              │
│   ├── status                      ├── category                              │
│   ├── reviewed_by → users.id      ├── language                              │
│   ├── admin_response              ├── is_regex                              │
│   └── appeal_number               └── is_active                             │
│                                                                              │
│   moderation_actions              moderation_stats                          │
│   ├── id                          ├── id                                    │
│   ├── admin_id → users.id         ├── date                                  │
│   ├── action_type                 ├── type                                  │
│   ├── target_type                 ├── value                                 │
│   ├── target_id                   └── metadata (JSON)                       │
│   ├── notes                                                                 │
│   └── metadata (JSON)                                                       │
│                                                                              │
└─────────────────────────────────────────────────────────────────────────────┘
```

### Dashboard Principal (Console Admin - Section Frontend)

```
┌─────────────────────────────────────────────────────────────────────────────┐
│                    CONSOLE DE MODÉRATION ULIXAI                              │
├─────────────────────────────────────────────────────────────────────────────┤
│                                                                              │
│   ┌─────────────┐  ┌─────────────┐  ┌─────────────┐  ┌─────────────┐        │
│   │  EN ATTENTE │  │ SIGNALEMENTS│  │  STRIKES    │  │   BANS      │        │
│   │     12      │  │      8      │  │     3       │  │      1      │        │
│   │  contenus   │  │  en cours   │  │  récents    │  │  cette sem. │        │
│   └─────────────┘  └─────────────┘  └─────────────┘  └─────────────┘        │
│                                                                              │
├─────────────────────────────────────────────────────────────────────────────┤
│                                                                              │
│   QUEUE DE MODÉRATION                                           [Filtrer ▼] │
│   ─────────────────────────────────────────────────────────────────────────  │
│                                                                              │
│   ⚠️  Mission #4521 - "Cours de massage..."                                 │
│      Flagged: warning_word (massage)  |  Score: 35  |  il y a 2h            │
│      [Approuver] [Rejeter] [Voir détails]                                   │
│                                                                              │
│   🔴 Mission #4518 - "Accompagnement soirée..."                             │
│      Flagged: contact_detected (email)  |  Score: 65  |  il y a 4h          │
│      [Approuver] [Rejeter] [Voir détails]                                   │
│                                                                              │
│   ⚠️  Offre #891 - Prestataire @jean_massage                                │
│      Flagged: 3x user_reports  |  Raison: spam  |  il y a 6h                │
│      [Approuver] [Rejeter] [Voir détails]                                   │
│                                                                              │
├─────────────────────────────────────────────────────────────────────────────┤
│                                                                              │
│   ACTIVITÉ RÉCENTE                                                          │
│   ─────────────────────────────────────────────────────────────────────────  │
│                                                                              │
│   ✅ Admin Sophie a approuvé Mission #4515             il y a 30min          │
│   ❌ Admin Marc a rejeté Offre #889 (strike donné)    il y a 1h              │
│   🔴 User @dupont_marie - 3ème strike → BAN AUTO      il y a 2h              │
│   ⚠️  Nouveau signalement sur User @fake_provider      il y a 3h              │
│                                                                              │
└─────────────────────────────────────────────────────────────────────────────┘
```

### Routes Admin

```php
// routes/web.php - Section Admin Modération

Route::prefix('admin/moderation')->name('admin.moderation.')->group(function () {
    // Dashboard
    Route::get('/', [ModerationController::class, 'dashboard'])->name('dashboard');

    // Queue de modération
    Route::get('/queue', [ModerationController::class, 'queue'])->name('queue');
    Route::post('/queue/{flag}/approve', [ModerationController::class, 'approve'])->name('approve');
    Route::post('/queue/{flag}/reject', [ModerationController::class, 'reject'])->name('reject');

    // Signalements
    Route::get('/reports', [ModerationController::class, 'reports'])->name('reports');
    Route::post('/reports/{report}/review', [ModerationController::class, 'reviewReport'])->name('review-report');

    // Strikes et Bans
    Route::get('/strikes', [ModerationController::class, 'strikes'])->name('strikes');
    Route::get('/user/{user}/history', [ModerationController::class, 'userHistory'])->name('user-history');
    Route::post('/user/{user}/manual-strike', [ModerationController::class, 'manualStrike'])->name('manual-strike');
    Route::post('/user/{user}/remove-strike', [ModerationController::class, 'removeStrike'])->name('remove-strike');

    // Mots interdits
    Route::get('/banned-words', [ModerationController::class, 'bannedWords'])->name('banned-words');
    Route::post('/banned-words', [ModerationController::class, 'addBannedWord'])->name('add-banned-word');
    Route::put('/banned-words/{word}', [ModerationController::class, 'updateBannedWord'])->name('update-banned-word');
    Route::delete('/banned-words/{word}', [ModerationController::class, 'deleteBannedWord'])->name('delete-banned-word');

    // Statistiques
    Route::get('/stats', [ModerationController::class, 'statistics'])->name('stats');
});
```

### Controller Admin

```php
// app/Http/Controllers/Admin/ModerationController.php

class ModerationController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard.moderation.index', [
            'pendingCount' => ModerationFlag::where('status', 'pending')->count(),
            'reportsCount' => ContentReport::where('status', 'pending')->count(),
            'recentStrikes' => UserStrike::where('created_at', '>=', now()->subWeek())->count(),
            'recentBans' => User::where('status', 'suspended')
                ->where('updated_at', '>=', now()->subWeek())->count(),
            'recentActivity' => ModerationAction::with('admin', 'target')
                ->latest()
                ->limit(10)
                ->get(),
        ]);
    }

    public function queue(Request $request)
    {
        $query = ModerationFlag::with('flaggable', 'flaggable.requester')
            ->where('status', 'pending');

        // Filtres
        if ($request->severity) {
            $query->where('severity', $request->severity);
        }
        if ($request->type) {
            $query->where('flag_type', $request->type);
        }

        // Tri: plus ancien d'abord (FIFO)
        $flags = $query->oldest()->paginate(20);

        return view('admin.dashboard.moderation.queue', compact('flags'));
    }

    public function approve(ModerationFlag $flag)
    {
        DB::transaction(function () use ($flag) {
            // Mettre à jour le flag
            $flag->update([
                'status' => 'approved',
                'reviewed_by' => auth()->id(),
                'reviewed_at' => now(),
            ]);

            // Publier le contenu si c'est une mission
            if ($flag->flaggable instanceof Mission) {
                $flag->flaggable->update(['moderation_status' => 'approved']);
            }

            // Logger l'action
            ModerationAction::create([
                'admin_id' => auth()->id(),
                'action_type' => 'approve',
                'target_type' => $flag->flaggable_type,
                'target_id' => $flag->flaggable_id,
                'notes' => request('notes'),
            ]);
        });

        return back()->with('success', 'Contenu approuvé et publié.');
    }

    public function reject(Request $request, ModerationFlag $flag)
    {
        $validated = $request->validate([
            'reason' => 'required|string|max:500',
            'give_strike' => 'boolean',
        ]);

        DB::transaction(function () use ($flag, $validated) {
            // Mettre à jour le flag
            $flag->update([
                'status' => 'rejected',
                'reviewed_by' => auth()->id(),
                'reviewed_at' => now(),
                'rejection_reason' => $validated['reason'],
            ]);

            // Supprimer/cacher le contenu
            if ($flag->flaggable instanceof Mission) {
                $flag->flaggable->delete(); // Soft delete
            }

            // Donner un strike si demandé
            if ($validated['give_strike'] ?? true) {
                $user = $flag->flaggable->requester ?? $flag->flaggable->user;
                app(SanctionManager::class)->addStrike($user, 'content_rejected', $validated['reason']);
            }

            // Logger
            ModerationAction::create([
                'admin_id' => auth()->id(),
                'action_type' => 'reject',
                'target_type' => $flag->flaggable_type,
                'target_id' => $flag->flaggable_id,
                'notes' => $validated['reason'],
            ]);

            // Notifier l'utilisateur
            $user = $flag->flaggable->requester ?? $flag->flaggable->user;
            $user->notify(new ContentRejectedNotification($flag, $validated['reason']));
        });

        return back()->with('success', 'Contenu rejeté. Strike donné à l\'utilisateur.');
    }
}
```

---

## 16. SYSTÈME GLOBAL_NOTIFICATIONS

### Architecture Centralisée

Le système `Global_Notifications` centralise toutes les notifications du site dans un module isolé et réutilisable.

```
app/Services/Global_Notifications/
├── BaseNotification.php           # Classe abstraite de base
├── NotificationService.php        # Service d'envoi centralisé
├── Channels/                      # Canaux personnalisés
├── Moderation/                    # Notifications modération
├── Payment/                       # Notifications paiement
├── Mission/                       # Notifications missions
├── User/                          # Notifications utilisateur
└── Admin/                         # Notifications admin
```

### Classe de Base

```php
// app/Services/Global_Notifications/BaseNotification.php

namespace App\Services\Global_Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

abstract class BaseNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected string $locale = 'fr';
    protected array $channels = ['mail', 'database'];

    public function __construct()
    {
        $this->onQueue('notifications');
    }

    public function via(object $notifiable): array
    {
        return $this->channels;
    }

    public function setLocale(string $locale): self
    {
        $this->locale = $locale;
        return $this;
    }

    protected function buildMailMessage(): MailMessage
    {
        return (new MailMessage)
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->replyTo(config('mail.reply_to.address'));
    }

    // Méthode abstraite à implémenter
    abstract public function toMail(object $notifiable): MailMessage;

    public function toArray(object $notifiable): array
    {
        return [
            'type' => class_basename($this),
            'created_at' => now()->toISOString(),
        ];
    }
}
```

### Service d'Envoi Centralisé

```php
// app/Services/Global_Notifications/NotificationService.php

namespace App\Services\Global_Notifications;

use App\Models\User;
use Illuminate\Support\Facades\Notification;

class NotificationService
{
    /**
     * Envoyer une notification à un utilisateur
     */
    public function send(User $user, BaseNotification $notification): void
    {
        $notification->setLocale($user->locale ?? 'fr');
        $user->notify($notification);
    }

    /**
     * Envoyer à plusieurs utilisateurs
     */
    public function sendToMany(iterable $users, BaseNotification $notification): void
    {
        Notification::send($users, $notification);
    }

    /**
     * Envoyer aux admins
     */
    public function sendToAdmins(BaseNotification $notification): void
    {
        $admins = User::whereIn('user_role', ['super_admin', 'regional_admin', 'moderator'])->get();
        $this->sendToMany($admins, $notification);
    }

    /**
     * Envoyer notification critique (immédiate, pas de queue)
     */
    public function sendCritical(User $user, BaseNotification $notification): void
    {
        $notification->onQueue(null); // Désactiver la queue
        $user->notifyNow($notification);
    }
}
```

### Configuration

```php
// config/notifications.php

return [
    /*
    |--------------------------------------------------------------------------
    | Canaux par défaut
    |--------------------------------------------------------------------------
    */
    'default_channels' => ['mail', 'database'],

    /*
    |--------------------------------------------------------------------------
    | Queue
    |--------------------------------------------------------------------------
    */
    'queue' => [
        'name' => 'notifications',
        'connection' => env('NOTIFICATION_QUEUE_CONNECTION', 'redis'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Templates Email
    |--------------------------------------------------------------------------
    */
    'mail' => [
        'logo_url' => env('APP_URL') . '/assets/logo.png',
        'support_email' => env('SUPPORT_EMAIL', 'support@ulixai.com'),
        'footer_text' => '© ' . date('Y') . ' Ulixai. Tous droits réservés.',
    ],

    /*
    |--------------------------------------------------------------------------
    | SMS (Twilio)
    |--------------------------------------------------------------------------
    */
    'sms' => [
        'enabled' => env('SMS_ENABLED', false),
        'provider' => env('SMS_PROVIDER', 'twilio'),
        'from' => env('TWILIO_FROM'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Push Notifications
    |--------------------------------------------------------------------------
    */
    'push' => [
        'enabled' => env('PUSH_ENABLED', false),
        'provider' => env('PUSH_PROVIDER', 'firebase'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Catégories de notifications
    |--------------------------------------------------------------------------
    */
    'categories' => [
        'moderation' => [
            'icon' => 'shield',
            'color' => '#dc3545',
        ],
        'payment' => [
            'icon' => 'credit-card',
            'color' => '#28a745',
        ],
        'mission' => [
            'icon' => 'briefcase',
            'color' => '#007bff',
        ],
        'user' => [
            'icon' => 'user',
            'color' => '#6c757d',
        ],
        'admin' => [
            'icon' => 'settings',
            'color' => '#ffc107',
        ],
    ],
];
```

### Exemples de Notifications

```php
// app/Services/Global_Notifications/Moderation/FirstStrikeNotification.php

namespace App\Services\Global_Notifications\Moderation;

use App\Services\Global_Notifications\BaseNotification;
use App\Services\Global_Moderations\Models\UserStrike;
use Illuminate\Notifications\Messages\MailMessage;

class FirstStrikeNotification extends BaseNotification
{
    public function __construct(
        protected UserStrike $strike
    ) {
        parent::__construct();
    }

    public function toMail(object $notifiable): MailMessage
    {
        return $this->buildMailMessage()
            ->subject('⚠️ Avertissement - Contenu non conforme sur Ulixai')
            ->greeting('Bonjour ' . $notifiable->name . ',')
            ->line('Nous avons détecté un contenu non conforme à nos conditions d\'utilisation.')
            ->line('**Raison :** ' . $this->strike->details)
            ->line('Ceci est votre **premier avertissement**.')
            ->line('Deux autres avertissements pourraient entraîner la suspension de votre compte.')
            ->action('Consulter les règles', url('/terms'))
            ->line('Si vous pensez qu\'il s\'agit d\'une erreur, vous pouvez nous contacter.')
            ->salutation('L\'équipe Ulixai');
    }

    public function toArray(object $notifiable): array
    {
        return array_merge(parent::toArray($notifiable), [
            'category' => 'moderation',
            'strike_id' => $this->strike->id,
            'reason' => $this->strike->reason,
            'strike_count' => 1,
        ]);
    }
}
```

```php
// app/Services/Global_Notifications/Moderation/UserBannedNotification.php

namespace App\Services\Global_Notifications\Moderation;

use App\Services\Global_Notifications\BaseNotification;
use Illuminate\Notifications\Messages\MailMessage;

class UserBannedNotification extends BaseNotification
{
    public function __construct(
        protected string $reason,
        protected ?string $appealDeadline = null
    ) {
        parent::__construct();
        $this->appealDeadline = $appealDeadline ?? now()->addDays(14)->format('d/m/Y');
    }

    public function toMail(object $notifiable): MailMessage
    {
        return $this->buildMailMessage()
            ->subject('🚫 Suspension de votre compte Ulixai')
            ->greeting('Bonjour,')
            ->line('Suite à plusieurs violations de nos conditions d\'utilisation, votre compte a été suspendu.')
            ->line('**Raison :** ' . $this->reason)
            ->line('Vous avez la possibilité de faire appel de cette décision avant le **' . $this->appealDeadline . '**.')
            ->action('Faire appel', url('/appeal'))
            ->line('Passé ce délai, la suspension sera définitive.')
            ->salutation('L\'équipe Ulixai');
    }

    public function toArray(object $notifiable): array
    {
        return array_merge(parent::toArray($notifiable), [
            'category' => 'moderation',
            'action' => 'banned',
            'reason' => $this->reason,
            'appeal_deadline' => $this->appealDeadline,
        ]);
    }
}
```

### Migration des Notifications Existantes

Les notifications existantes dans `app/Notifications/` devront être migrées vers `Global_Notifications` :

| Ancienne location | Nouvelle location |
|-------------------|-------------------|
| `app/Notifications/PaymentReceivedNotification.php` | `Global_Notifications/Payment/PaymentReceivedNotification.php` |
| `app/Notifications/PaymentFailedNotification.php` | `Global_Notifications/Payment/PaymentFailedNotification.php` |
| `app/Notifications/PayPalDisputeNotification.php` | `Global_Notifications/Payment/PayPalDisputeNotification.php` |
| `app/Notifications/PayoutFailedAdminNotification.php` | `Global_Notifications/Admin/PayoutFailedNotification.php` |

---

# PARTIE FRONTEND

---

## 17. ARCHITECTURE FRONTEND

### Structure des Fichiers Frontend

```
resources/
├── js/
│   ├── components/
│   │   └── moderation/
│   │       ├── MissionLimitBanner.vue        # Bannière limite annonces
│   │       ├── ReportModal.vue               # Modal signalement
│   │       ├── ContentWarning.vue            # Avertissement contenu
│   │       ├── StrikeNotification.vue        # Notification strike
│   │       └── AppealForm.vue                # Formulaire appel
│   │
│   ├── composables/
│   │   ├── useModeration.js                  # Logique modération
│   │   └── useMissionLimits.js               # Gestion limites
│   │
│   └── stores/
│       └── moderationStore.js                # État modération (Pinia/Vuex)
│
├── views/
│   ├── appeal/
│   │   ├── form.blade.php                    # Formulaire appel
│   │   ├── submitted.blade.php               # Confirmation
│   │   ├── denied.blade.php                  # Appel refusé
│   │   └── status.blade.php                  # Statut appel
│   │
│   └── admin/dashboard/moderation/
│       ├── index.blade.php                   # Dashboard principal
│       ├── queue.blade.php                   # Queue modération
│       ├── queue-item.blade.php              # Détail item queue
│       ├── reports.blade.php                 # Liste signalements
│       ├── report-detail.blade.php           # Détail signalement
│       ├── banned-words.blade.php            # Gestion mots interdits
│       ├── user-history.blade.php            # Historique user
│       ├── appeals.blade.php                 # Liste appels
│       ├── analytics.blade.php               # Statistiques
│       └── settings.blade.php                # Paramètres
│
└── css/
    └── moderation.css                        # Styles modération
```

### Technologies Frontend

| Composant | Technologie |
|-----------|-------------|
| Framework JS | Vue.js 3 / Alpine.js |
| État global | Pinia (si Vue) |
| Requêtes API | Axios |
| Styles | Tailwind CSS |
| Icônes | Heroicons / Lucide |
| Graphiques | Chart.js |
| Notifications | Toast (SweetAlert2 / Notyf) |

---

## 18. COMPOSANTS UTILISATEUR

### 1. Bannière Limite d'Annonces

```vue
<!-- resources/js/components/moderation/MissionLimitBanner.vue -->

<template>
    <div v-if="shouldShow" :class="bannerClass" class="mission-limit-banner">
        <div class="flex items-center gap-3">
            <component :is="icon" class="w-5 h-5" />
            <span>{{ message }}</span>
        </div>
        <span v-if="resetTime" class="text-sm opacity-75">
            Réinitialisation : {{ resetTime }}
        </span>
    </div>
</template>

<script setup>
import { computed, onMounted, ref } from 'vue';
import { AlertCircle, AlertTriangle, XCircle } from 'lucide-vue-next';

const props = defineProps({
    remaining: { type: Number, required: true },
    limit: { type: Number, default: 3 },
    resetAt: { type: String, default: null }
});

const shouldShow = computed(() => props.remaining <= 1);

const bannerClass = computed(() => {
    if (props.remaining === 0) return 'bg-red-100 text-red-800 border-red-200';
    if (props.remaining === 1) return 'bg-yellow-100 text-yellow-800 border-yellow-200';
    return 'bg-blue-100 text-blue-800 border-blue-200';
});

const icon = computed(() => {
    if (props.remaining === 0) return XCircle;
    if (props.remaining === 1) return AlertTriangle;
    return AlertCircle;
});

const message = computed(() => {
    if (props.remaining === 0) {
        return `Vous avez atteint votre limite de ${props.limit} annonces pour aujourd'hui.`;
    }
    if (props.remaining === 1) {
        return `Attention : il vous reste 1 annonce pour aujourd'hui.`;
    }
    return `Il vous reste ${props.remaining} annonces aujourd'hui.`;
});

const resetTime = computed(() => {
    if (!props.resetAt) return null;
    const date = new Date(props.resetAt);
    return date.toLocaleTimeString('fr-FR', { hour: '2-digit', minute: '2-digit' });
});
</script>

<style scoped>
.mission-limit-banner {
    @apply p-4 rounded-lg border flex items-center justify-between mb-4;
}
</style>
```

### 2. Modal de Signalement

```vue
<!-- resources/js/components/moderation/ReportModal.vue -->

<template>
    <Teleport to="body">
        <div v-if="isOpen" class="report-modal-overlay" @click.self="close">
            <div class="report-modal">
                <header class="report-modal-header">
                    <h3>Signaler ce contenu</h3>
                    <button @click="close" class="close-btn">
                        <X class="w-5 h-5" />
                    </button>
                </header>

                <div class="report-modal-body">
                    <p class="text-gray-600 mb-4">
                        Pourquoi signalez-vous {{ contentTypeLabel }} ?
                    </p>

                    <div class="space-y-2">
                        <label
                            v-for="reason in reasons"
                            :key="reason.value"
                            class="report-reason"
                            :class="{ 'selected': selectedReason === reason.value }"
                        >
                            <input
                                type="radio"
                                :value="reason.value"
                                v-model="selectedReason"
                                class="sr-only"
                            />
                            <component :is="reason.icon" class="w-5 h-5" />
                            <div>
                                <span class="font-medium">{{ reason.label }}</span>
                                <p class="text-sm text-gray-500">{{ reason.description }}</p>
                            </div>
                        </label>
                    </div>

                    <div v-if="selectedReason === 'other'" class="mt-4">
                        <label class="block text-sm font-medium mb-2">
                            Précisez le problème
                        </label>
                        <textarea
                            v-model="details"
                            rows="3"
                            class="w-full border rounded-lg p-3"
                            placeholder="Décrivez le problème rencontré..."
                            maxlength="500"
                        ></textarea>
                        <p class="text-xs text-gray-400 mt-1">{{ details.length }}/500</p>
                    </div>

                    <div v-if="error" class="mt-4 p-3 bg-red-50 text-red-600 rounded-lg">
                        {{ error }}
                    </div>
                </div>

                <footer class="report-modal-footer">
                    <button @click="close" class="btn-secondary">
                        Annuler
                    </button>
                    <button
                        @click="submit"
                        :disabled="!canSubmit || isLoading"
                        class="btn-primary"
                    >
                        <Loader v-if="isLoading" class="w-4 h-4 animate-spin" />
                        <span v-else>Envoyer le signalement</span>
                    </button>
                </footer>
            </div>
        </div>
    </Teleport>
</template>

<script setup>
import { ref, computed } from 'vue';
import { X, Loader, AlertTriangle, Ban, UserX, ShieldAlert, DollarSign, Share2, HelpCircle } from 'lucide-vue-next';
import axios from 'axios';

const props = defineProps({
    isOpen: Boolean,
    contentType: String, // 'mission', 'user', 'message', 'offer'
    contentId: [String, Number]
});

const emit = defineEmits(['close', 'reported']);

const selectedReason = ref(null);
const details = ref('');
const isLoading = ref(false);
const error = ref(null);

const reasons = [
    { value: 'spam', label: 'Spam', description: 'Contenu répétitif ou publicitaire', icon: AlertTriangle },
    { value: 'inappropriate_content', label: 'Contenu inapproprié', description: 'Contenu offensant ou choquant', icon: Ban },
    { value: 'fake_profile', label: 'Faux profil', description: 'Cette personne n\'est pas qui elle prétend être', icon: UserX },
    { value: 'scam', label: 'Arnaque', description: 'Tentative d\'escroquerie', icon: ShieldAlert },
    { value: 'contact_sharing', label: 'Partage de coordonnées', description: 'Tentative de contact hors plateforme', icon: Share2 },
    { value: 'other', label: 'Autre', description: 'Un autre problème', icon: HelpCircle },
];

const contentTypeLabel = computed(() => {
    const labels = {
        mission: 'cette annonce',
        user: 'cet utilisateur',
        message: 'ce message',
        offer: 'cette offre'
    };
    return labels[props.contentType] || 'ce contenu';
});

const canSubmit = computed(() => {
    if (!selectedReason.value) return false;
    if (selectedReason.value === 'other' && details.value.length < 10) return false;
    return true;
});

const close = () => {
    selectedReason.value = null;
    details.value = '';
    error.value = null;
    emit('close');
};

const submit = async () => {
    if (!canSubmit.value) return;

    isLoading.value = true;
    error.value = null;

    try {
        await axios.post(`/api/v1/report/${props.contentType}/${props.contentId}`, {
            reason: selectedReason.value,
            details: details.value || null
        });

        emit('reported');
        close();

        // Afficher toast de succès
        window.toast?.success('Merci pour votre signalement. Notre équipe va l\'examiner.');
    } catch (err) {
        if (err.response?.status === 429) {
            error.value = 'Vous avez atteint la limite de signalements pour aujourd\'hui.';
        } else {
            error.value = err.response?.data?.message || 'Une erreur est survenue.';
        }
    } finally {
        isLoading.value = false;
    }
};
</script>

<style scoped>
.report-modal-overlay {
    @apply fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4;
}
.report-modal {
    @apply bg-white rounded-xl shadow-2xl w-full max-w-md max-h-[90vh] overflow-hidden flex flex-col;
}
.report-modal-header {
    @apply flex items-center justify-between p-4 border-b;
}
.report-modal-body {
    @apply p-4 overflow-y-auto flex-1;
}
.report-modal-footer {
    @apply flex justify-end gap-3 p-4 border-t bg-gray-50;
}
.report-reason {
    @apply flex items-start gap-3 p-3 rounded-lg border cursor-pointer transition-all;
    @apply hover:border-blue-300 hover:bg-blue-50;
}
.report-reason.selected {
    @apply border-blue-500 bg-blue-50;
}
.btn-primary {
    @apply px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 disabled:opacity-50 disabled:cursor-not-allowed flex items-center gap-2;
}
.btn-secondary {
    @apply px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-lg;
}
</style>
```

### 3. Avertissement de Contenu (Validation Temps Réel)

```vue
<!-- resources/js/components/moderation/ContentWarning.vue -->

<template>
    <div v-if="warnings.length > 0" class="content-warnings">
        <div
            v-for="(warning, index) in warnings"
            :key="index"
            :class="warningClass(warning)"
            class="warning-item"
        >
            <component :is="warningIcon(warning)" class="w-5 h-5 flex-shrink-0" />
            <div class="flex-1">
                <p class="font-medium">{{ warning.title }}</p>
                <p class="text-sm opacity-80">{{ warning.message }}</p>
            </div>
        </div>
    </div>
</template>

<script setup>
import { computed, watch, ref } from 'vue';
import { AlertTriangle, XCircle, Info, Phone, Mail, Globe } from 'lucide-vue-next';
import { debounce } from 'lodash-es';
import axios from 'axios';

const props = defineProps({
    content: String,
    context: { type: String, default: 'mission' } // 'mission', 'offer', 'message'
});

const emit = defineEmits(['validationChange']);

const warnings = ref([]);
const isChecking = ref(false);

const checkContent = debounce(async (content) => {
    if (!content || content.length < 10) {
        warnings.value = [];
        emit('validationChange', { valid: true, warnings: [] });
        return;
    }

    isChecking.value = true;

    try {
        const response = await axios.post('/api/v1/moderation/check-content', {
            description: content,
            context: props.context
        });

        warnings.value = response.data.warnings.map(w => ({
            type: w.severity,
            title: getWarningTitle(w),
            message: w.reason
        }));

        emit('validationChange', {
            valid: response.data.valid,
            wouldNeedReview: response.data.would_need_review,
            blocked: response.data.decision === 'blocked',
            warnings: warnings.value
        });
    } catch (err) {
        console.error('Content check failed:', err);
    } finally {
        isChecking.value = false;
    }
}, 500);

watch(() => props.content, checkContent);

const getWarningTitle = (warning) => {
    const titles = {
        'contact_detected': 'Coordonnées détectées',
        'banned_word': 'Contenu non autorisé',
        'spam_pattern': 'Pattern suspect',
        'caps_ratio': 'Trop de majuscules'
    };
    return titles[warning.type] || 'Attention';
};

const warningClass = (warning) => {
    if (warning.type === 'critical' || warning.type === 'blocked') {
        return 'bg-red-50 border-red-200 text-red-800';
    }
    if (warning.type === 'warning') {
        return 'bg-yellow-50 border-yellow-200 text-yellow-800';
    }
    return 'bg-blue-50 border-blue-200 text-blue-800';
};

const warningIcon = (warning) => {
    if (warning.type === 'critical' || warning.type === 'blocked') return XCircle;
    if (warning.type === 'warning') return AlertTriangle;
    return Info;
};
</script>

<style scoped>
.content-warnings {
    @apply space-y-2 mt-2;
}
.warning-item {
    @apply flex items-start gap-3 p-3 rounded-lg border;
}
</style>
```

### 4. Notification de Strike (In-App)

```vue
<!-- resources/js/components/moderation/StrikeNotification.vue -->

<template>
    <Transition name="slide-down">
        <div v-if="isVisible" class="strike-notification" :class="notificationClass">
            <div class="flex items-start gap-4">
                <div class="notification-icon">
                    <AlertTriangle v-if="strikeCount < 3" class="w-6 h-6" />
                    <Ban v-else class="w-6 h-6" />
                </div>
                <div class="flex-1">
                    <h4 class="font-bold text-lg">{{ title }}</h4>
                    <p class="mt-1">{{ message }}</p>
                    <p v-if="reason" class="mt-2 text-sm opacity-80">
                        <strong>Raison :</strong> {{ reason }}
                    </p>
                    <div class="mt-4 flex gap-3">
                        <a href="/terms" class="btn-link">Consulter les règles</a>
                        <button @click="dismiss" class="btn-dismiss">Compris</button>
                    </div>
                </div>
                <button @click="dismiss" class="close-btn">
                    <X class="w-5 h-5" />
                </button>
            </div>
        </div>
    </Transition>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';
import { AlertTriangle, Ban, X } from 'lucide-vue-next';

const props = defineProps({
    strikeCount: { type: Number, required: true },
    reason: String,
    autoHide: { type: Boolean, default: false }
});

const emit = defineEmits(['dismiss']);

const isVisible = ref(true);

const title = computed(() => {
    if (props.strikeCount >= 3) return 'Votre compte a été suspendu';
    if (props.strikeCount === 2) return 'Deuxième avertissement';
    return 'Avertissement';
});

const message = computed(() => {
    if (props.strikeCount >= 3) {
        return 'Suite à plusieurs violations de nos conditions, votre compte est temporairement suspendu. Vous pouvez faire appel de cette décision.';
    }
    if (props.strikeCount === 2) {
        return 'C\'est votre deuxième avertissement. Un prochain manquement entraînera la suspension de votre compte.';
    }
    return 'Nous avons détecté un contenu non conforme. Veuillez consulter nos conditions d\'utilisation.';
});

const notificationClass = computed(() => {
    if (props.strikeCount >= 3) return 'strike-critical';
    if (props.strikeCount === 2) return 'strike-warning';
    return 'strike-info';
});

const dismiss = () => {
    isVisible.value = false;
    emit('dismiss');
};

onMounted(() => {
    if (props.autoHide && props.strikeCount < 3) {
        setTimeout(dismiss, 10000);
    }
});
</script>

<style scoped>
.strike-notification {
    @apply fixed top-4 right-4 left-4 md:left-auto md:w-96 p-4 rounded-xl shadow-2xl z-50;
}
.strike-info {
    @apply bg-yellow-50 border border-yellow-200 text-yellow-900;
}
.strike-warning {
    @apply bg-orange-50 border border-orange-300 text-orange-900;
}
.strike-critical {
    @apply bg-red-50 border border-red-300 text-red-900;
}
.notification-icon {
    @apply p-2 rounded-full bg-white/50;
}
.btn-link {
    @apply text-sm underline hover:no-underline;
}
.btn-dismiss {
    @apply px-4 py-2 bg-white/80 rounded-lg text-sm font-medium hover:bg-white;
}
.close-btn {
    @apply p-1 rounded hover:bg-white/50;
}
.slide-down-enter-active, .slide-down-leave-active {
    transition: all 0.3s ease;
}
.slide-down-enter-from, .slide-down-leave-to {
    opacity: 0;
    transform: translateY(-20px);
}
</style>
```

### 5. Formulaire d'Appel

```blade
{{-- resources/views/appeal/form.blade.php --}}

@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-12 px-4">
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
        {{-- Header --}}
        <div class="bg-gradient-to-r from-red-500 to-orange-500 p-6 text-white">
            <h1 class="text-2xl font-bold">Faire appel de votre suspension</h1>
            <p class="mt-2 opacity-90">
                Votre compte a été suspendu le {{ $user->banned_at->format('d/m/Y') }}
            </p>
        </div>

        {{-- Infos suspension --}}
        <div class="p-6 bg-red-50 border-b border-red-100">
            <h3 class="font-semibold text-red-800">Raison de la suspension</h3>
            <p class="mt-1 text-red-700">{{ $ban_reason }}</p>

            @if($appeal_count > 0)
            <p class="mt-3 text-sm text-red-600">
                <strong>Note :</strong> Ceci est votre appel n°{{ $appeal_count + 1 }} sur {{ $max_appeals }} possibles.
            </p>
            @endif
        </div>

        {{-- Formulaire --}}
        <form action="{{ route('appeal.submit') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf

            {{-- Raison de l'appel --}}
            <div>
                <label class="block font-medium mb-2">
                    Expliquez pourquoi vous contestez cette suspension
                    <span class="text-red-500">*</span>
                </label>
                <textarea
                    name="reason"
                    rows="5"
                    required
                    minlength="50"
                    maxlength="2000"
                    class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-500"
                    placeholder="Décrivez les circonstances, expliquez votre point de vue..."
                >{{ old('reason') }}</textarea>
                <p class="text-xs text-gray-500 mt-1">Minimum 50 caractères</p>
                @error('reason')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Engagement --}}
            <div>
                <label class="block font-medium mb-2">
                    Engagement à respecter les règles
                    <span class="text-red-500">*</span>
                </label>
                <textarea
                    name="commitment"
                    rows="3"
                    required
                    minlength="20"
                    maxlength="500"
                    class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-500"
                    placeholder="Décrivez comment vous vous engagez à respecter les règles..."
                >{{ old('commitment') }}</textarea>
                @error('commitment')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Pièces jointes --}}
            <div>
                <label class="block font-medium mb-2">
                    Pièces jointes (optionnel)
                </label>
                <input
                    type="file"
                    name="evidence[]"
                    multiple
                    accept=".jpg,.jpeg,.png,.pdf"
                    class="w-full border rounded-lg p-3"
                />
                <p class="text-xs text-gray-500 mt-1">
                    Formats acceptés : JPG, PNG, PDF. Max 5 Mo par fichier.
                </p>
            </div>

            {{-- Date limite --}}
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                <p class="text-yellow-800">
                    <strong>Date limite pour faire appel :</strong>
                    {{ \Carbon\Carbon::parse($deadline)->format('d/m/Y à H:i') }}
                </p>
            </div>

            {{-- Actions --}}
            <div class="flex justify-end gap-4 pt-4 border-t">
                <a href="/" class="px-6 py-3 text-gray-600 hover:text-gray-800">
                    Annuler
                </a>
                <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Soumettre mon appel
                </button>
            </div>
        </form>
    </div>

    {{-- Informations complémentaires --}}
    <div class="mt-8 text-center text-gray-500 text-sm">
        <p>Notre équipe examinera votre appel sous 48-72h ouvrées.</p>
        <p>Vous recevrez une notification par email de notre décision.</p>
    </div>
</div>
@endsection
```

---

## 19. CONSOLE ADMIN MODÉRATION

### 1. Dashboard Principal

```blade
{{-- resources/views/admin/dashboard/moderation/index.blade.php --}}

@extends('admin.layouts.app')

@section('content')
<div class="p-6">
    {{-- Header --}}
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Modération</h1>
            <p class="text-gray-500">Gérez le contenu et les utilisateurs</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.moderation.queue') }}" class="btn-primary">
                Voir la queue ({{ $pendingCount }})
            </a>
        </div>
    </div>

    {{-- KPIs --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        {{-- En attente --}}
        <div class="bg-white rounded-xl shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">En attente</p>
                    <p class="text-3xl font-bold {{ $pendingCount > 10 ? 'text-red-600' : 'text-gray-900' }}">
                        {{ $pendingCount }}
                    </p>
                </div>
                <div class="w-12 h-12 rounded-full bg-yellow-100 flex items-center justify-center">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            @if($oldestPendingHours > 24)
            <p class="text-xs text-red-500 mt-2">Plus ancien: {{ $oldestPendingHours }}h</p>
            @endif
        </div>

        {{-- Signalements --}}
        <div class="bg-white rounded-xl shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Signalements</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $reportsCount }}</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-orange-100 flex items-center justify-center">
                    <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
            </div>
        </div>

        {{-- Strikes cette semaine --}}
        <div class="bg-white rounded-xl shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Strikes (7j)</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $recentStrikes }}</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                    </svg>
                </div>
            </div>
        </div>

        {{-- Bans actifs --}}
        <div class="bg-white rounded-xl shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Bans actifs</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $recentBans }}</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-purple-100 flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636a9 9 0 010 12.728m0 0l-2.829-2.829m2.829 2.829L21 21M15.536 8.464a5 5 0 010 7.072m0 0l-2.829-2.829m-4.243 2.829a4.978 4.978 0 01-1.414-2.83m-1.414 5.658a9 9 0 01-2.167-9.238m7.824 2.167a1 1 0 111.414 1.414m-1.414-1.414L3 3m8.293 8.293l1.414 1.414" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    {{-- Navigation rapide --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        <a href="{{ route('admin.moderation.queue') }}" class="nav-card">
            <span class="text-2xl">📋</span>
            <span>Queue de modération</span>
        </a>
        <a href="{{ route('admin.moderation.reports') }}" class="nav-card">
            <span class="text-2xl">🚨</span>
            <span>Signalements</span>
        </a>
        <a href="{{ route('admin.moderation.banned-words') }}" class="nav-card">
            <span class="text-2xl">🚫</span>
            <span>Mots interdits</span>
        </a>
        <a href="{{ route('admin.moderation.stats') }}" class="nav-card">
            <span class="text-2xl">📊</span>
            <span>Statistiques</span>
        </a>
    </div>

    {{-- Activité récente --}}
    <div class="bg-white rounded-xl shadow">
        <div class="p-4 border-b">
            <h2 class="font-semibold">Activité récente</h2>
        </div>
        <div class="divide-y">
            @forelse($recentActivity as $activity)
            <div class="p-4 flex items-center gap-4">
                <div class="w-10 h-10 rounded-full {{ $activity->action_type === 'approve' ? 'bg-green-100' : 'bg-red-100' }} flex items-center justify-center">
                    @if($activity->action_type === 'approve')
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    @else
                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    @endif
                </div>
                <div class="flex-1">
                    <p>
                        <strong>{{ $activity->admin->name }}</strong>
                        a {{ $activity->action_type === 'approve' ? 'approuvé' : 'rejeté' }}
                        {{ class_basename($activity->target_type) }} #{{ $activity->target_id }}
                    </p>
                    @if($activity->notes)
                    <p class="text-sm text-gray-500">{{ Str::limit($activity->notes, 50) }}</p>
                    @endif
                </div>
                <span class="text-sm text-gray-400">{{ $activity->created_at->diffForHumans() }}</span>
            </div>
            @empty
            <div class="p-8 text-center text-gray-500">
                Aucune activité récente
            </div>
            @endforelse
        </div>
    </div>
</div>

<style>
.nav-card {
    @apply bg-white rounded-xl shadow p-6 flex flex-col items-center gap-2 hover:shadow-lg transition-shadow text-gray-700 hover:text-blue-600;
}
</style>
@endsection
```

### 2. Queue de Modération

```blade
{{-- resources/views/admin/dashboard/moderation/queue.blade.php --}}

@extends('admin.layouts.app')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Queue de modération</h1>

        {{-- Filtres --}}
        <form class="flex gap-3">
            <select name="severity" class="border rounded-lg px-3 py-2">
                <option value="">Toutes sévérités</option>
                <option value="critical" {{ request('severity') === 'critical' ? 'selected' : '' }}>Critique</option>
                <option value="warning" {{ request('severity') === 'warning' ? 'selected' : '' }}>Warning</option>
                <option value="info" {{ request('severity') === 'info' ? 'selected' : '' }}>Info</option>
            </select>
            <select name="type" class="border rounded-lg px-3 py-2">
                <option value="">Tous types</option>
                <option value="banned_word">Mot interdit</option>
                <option value="contact_detected">Coordonnées</option>
                <option value="user_reports">Signalements</option>
                <option value="spam_pattern">Spam</option>
            </select>
            <button type="submit" class="btn-secondary">Filtrer</button>
        </form>
    </div>

    {{-- Actions groupées --}}
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <input type="checkbox" id="selectAll" class="w-5 h-5">
            <label for="selectAll">Tout sélectionner</label>
        </div>
        <div class="flex gap-3">
            <button class="btn-success" onclick="bulkApprove()">Approuver sélection</button>
            <button class="btn-danger" onclick="bulkReject()">Rejeter sélection</button>
        </div>
    </div>

    {{-- Liste --}}
    <div class="space-y-4">
        @forelse($flags as $flag)
        <div class="bg-white rounded-xl shadow p-4 flex items-start gap-4 queue-item" data-id="{{ $flag->id }}">
            <input type="checkbox" class="item-checkbox w-5 h-5 mt-1">

            {{-- Indicateur sévérité --}}
            <div class="w-2 h-full rounded-full {{ $flag->severity === 'critical' ? 'bg-red-500' : ($flag->severity === 'warning' ? 'bg-yellow-500' : 'bg-blue-500') }}"></div>

            {{-- Contenu --}}
            <div class="flex-1">
                <div class="flex items-center gap-2 mb-2">
                    <span class="px-2 py-1 rounded text-xs font-medium {{ $flag->severity === 'critical' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800' }}">
                        {{ strtoupper($flag->severity) }}
                    </span>
                    <span class="px-2 py-1 rounded text-xs bg-gray-100">
                        {{ $flag->flag_type }}
                    </span>
                    <span class="text-sm text-gray-500">
                        Score: {{ $flag->risk_score }}
                    </span>
                </div>

                <h3 class="font-semibold">
                    {{ class_basename($flag->flaggable_type) }} #{{ $flag->flaggable_id }}
                    @if($flag->flaggable)
                    - "{{ Str::limit($flag->flaggable->title ?? $flag->flaggable->message ?? 'N/A', 50) }}"
                    @endif
                </h3>

                @if($flag->detected_items)
                <div class="mt-2 flex flex-wrap gap-2">
                    @foreach($flag->detected_items as $item)
                    <span class="px-2 py-1 bg-red-50 text-red-700 rounded text-xs">
                        {{ $item['word'] ?? $item['type'] ?? json_encode($item) }}
                    </span>
                    @endforeach
                </div>
                @endif

                <p class="text-sm text-gray-500 mt-2">
                    Par {{ $flag->flaggable?->requester?->name ?? $flag->flaggable?->user?->name ?? 'Inconnu' }}
                    • {{ $flag->created_at->diffForHumans() }}
                </p>
            </div>

            {{-- Actions --}}
            <div class="flex gap-2">
                <a href="{{ route('admin.moderation.queue.detail', $flag) }}" class="btn-secondary">
                    Détails
                </a>
                <form action="{{ route('admin.moderation.approve', $flag) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="btn-success">Approuver</button>
                </form>
                <button onclick="openRejectModal({{ $flag->id }})" class="btn-danger">
                    Rejeter
                </button>
            </div>
        </div>
        @empty
        <div class="bg-white rounded-xl shadow p-12 text-center">
            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <h3 class="text-lg font-semibold text-gray-900">Queue vide</h3>
            <p class="text-gray-500">Tous les contenus ont été traités.</p>
        </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="mt-6">
        {{ $flags->withQueryString()->links() }}
    </div>
</div>

{{-- Modal Rejet --}}
<div id="rejectModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-md p-6">
        <h3 class="text-lg font-bold mb-4">Rejeter ce contenu</h3>
        <form id="rejectForm" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block font-medium mb-2">Raison du rejet</label>
                <textarea name="reason" required rows="3" class="w-full border rounded-lg p-3"></textarea>
            </div>
            <div class="mb-4">
                <label class="flex items-center gap-2">
                    <input type="checkbox" name="give_strike" value="1" checked>
                    <span>Donner un strike à l'utilisateur</span>
                </label>
            </div>
            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeRejectModal()" class="btn-secondary">Annuler</button>
                <button type="submit" class="btn-danger">Rejeter</button>
            </div>
        </form>
    </div>
</div>

<script>
function openRejectModal(flagId) {
    document.getElementById('rejectForm').action = `/admin/moderation/queue/${flagId}/reject`;
    document.getElementById('rejectModal').classList.remove('hidden');
}

function closeRejectModal() {
    document.getElementById('rejectModal').classList.add('hidden');
}
</script>
@endsection
```

---

## 20. MESSAGES ET UX

### Messages d'Erreur Utilisateur

| Situation | Message | Ton |
|-----------|---------|-----|
| Limite annonces atteinte | "Vous avez atteint votre limite de 3 annonces pour aujourd'hui. Vous pourrez en publier de nouvelles demain à 00h00." | Informatif |
| Contenu bloqué (mot interdit) | "Votre annonce contient des termes non autorisés sur Ulixai. Veuillez la modifier." | Ferme mais poli |
| Contenu bloqué (coordonnées) | "Les coordonnées personnelles ne sont pas autorisées dans les annonces. Elles sont partagées automatiquement après validation d'un prestataire." | Explicatif |
| En attente de validation | "Votre annonce est en cours de vérification et sera publiée sous peu." | Rassurant |
| Strike 1 | "Avertissement : votre contenu a été retiré car il ne respecte pas nos conditions. Consultez nos règles pour éviter de futures sanctions." | Éducatif |
| Strike 2 | "Deuxième avertissement : un prochain manquement entraînera la suspension de votre compte." | Sérieux |
| Ban | "Votre compte a été suspendu suite à plusieurs violations. Vous pouvez faire appel dans les 14 jours." | Factuel |

### Toast Notifications (JavaScript)

```javascript
// resources/js/utils/toast.js

const toastStyles = {
    success: {
        bg: 'bg-green-50',
        border: 'border-green-200',
        text: 'text-green-800',
        icon: '✓'
    },
    error: {
        bg: 'bg-red-50',
        border: 'border-red-200',
        text: 'text-red-800',
        icon: '✕'
    },
    warning: {
        bg: 'bg-yellow-50',
        border: 'border-yellow-200',
        text: 'text-yellow-800',
        icon: '⚠'
    },
    info: {
        bg: 'bg-blue-50',
        border: 'border-blue-200',
        text: 'text-blue-800',
        icon: 'ℹ'
    }
};

export function showToast(message, type = 'info', duration = 5000) {
    const style = toastStyles[type];

    const toast = document.createElement('div');
    toast.className = `fixed top-4 right-4 max-w-sm ${style.bg} ${style.border} ${style.text} border rounded-lg shadow-lg p-4 flex items-start gap-3 z-50 animate-slide-in`;
    toast.innerHTML = `
        <span class="text-xl">${style.icon}</span>
        <div class="flex-1">
            <p class="font-medium">${message}</p>
        </div>
        <button class="opacity-50 hover:opacity-100" onclick="this.parentElement.remove()">✕</button>
    `;

    document.body.appendChild(toast);

    setTimeout(() => {
        toast.classList.add('animate-slide-out');
        setTimeout(() => toast.remove(), 300);
    }, duration);
}

// Exposer globalement
window.toast = {
    success: (msg) => showToast(msg, 'success'),
    error: (msg) => showToast(msg, 'error'),
    warning: (msg) => showToast(msg, 'warning'),
    info: (msg) => showToast(msg, 'info')
};
```

### États de Chargement

```vue
<!-- resources/js/components/common/LoadingStates.vue -->

<template>
    <!-- Skeleton pour queue item -->
    <div v-if="type === 'queue-item'" class="bg-white rounded-xl shadow p-4 animate-pulse">
        <div class="flex items-start gap-4">
            <div class="w-5 h-5 bg-gray-200 rounded"></div>
            <div class="w-2 h-20 bg-gray-200 rounded-full"></div>
            <div class="flex-1 space-y-3">
                <div class="flex gap-2">
                    <div class="w-16 h-5 bg-gray-200 rounded"></div>
                    <div class="w-24 h-5 bg-gray-200 rounded"></div>
                </div>
                <div class="w-3/4 h-6 bg-gray-200 rounded"></div>
                <div class="w-1/2 h-4 bg-gray-200 rounded"></div>
            </div>
            <div class="flex gap-2">
                <div class="w-20 h-10 bg-gray-200 rounded-lg"></div>
                <div class="w-20 h-10 bg-gray-200 rounded-lg"></div>
            </div>
        </div>
    </div>

    <!-- Spinner centré -->
    <div v-else-if="type === 'spinner'" class="flex items-center justify-center py-12">
        <div class="w-12 h-12 border-4 border-blue-200 border-t-blue-600 rounded-full animate-spin"></div>
    </div>

    <!-- Loading overlay -->
    <div v-else-if="type === 'overlay'" class="fixed inset-0 bg-white/80 flex items-center justify-center z-50">
        <div class="text-center">
            <div class="w-16 h-16 border-4 border-blue-200 border-t-blue-600 rounded-full animate-spin mx-auto"></div>
            <p class="mt-4 text-gray-600">{{ message || 'Chargement...' }}</p>
        </div>
    </div>
</template>

<script setup>
defineProps({
    type: { type: String, default: 'spinner' },
    message: String
});
</script>
```

---

## 21. PLAN D'IMPLÉMENTATION

### PHASE 1: Infrastructure Backend (2-3 jours)

| Tâche | Fichiers | Priorité |
|-------|----------|----------|
| Créer les migrations | `database/migrations/` | P1 |
| Créer structure Global_Moderations | `app/Services/Global_Moderations/` | P1 |
| Créer structure Global_Notifications | `app/Services/Global_Notifications/` | P1 |
| Créer config/moderations.php | `config/moderations.php` | P1 |
| Créer config/notifications.php | `config/notifications.php` | P1 |
| Seeder mots interdits (FR + EN) | `database/seeders/` | P1 |

### PHASE 2: Services Core Modération (3-4 jours)

| Tâche | Fichiers | Priorité |
|-------|----------|----------|
| ModerationService | `Global_Moderations/ModerationService.php` | P1 |
| WordFilter | `Global_Moderations/WordFilter.php` | P1 |
| ContactDetector | `Global_Moderations/ContactDetector.php` | P1 |
| SpamDetector | `Global_Moderations/SpamDetector.php` | P1 |
| ImageModerator | `Global_Moderations/ImageModerator.php` | P1 |
| SanctionManager | `Global_Moderations/SanctionManager.php` | P1 |
| Modèles | `Global_Moderations/Models/*` | P1 |

### PHASE 3: Services Core Notifications (2-3 jours)

| Tâche | Fichiers | Priorité |
|-------|----------|----------|
| BaseNotification | `Global_Notifications/BaseNotification.php` | P1 |
| NotificationService | `Global_Notifications/NotificationService.php` | P1 |
| Notifications Modération | `Global_Notifications/Moderation/*` | P1 |
| Migration notifs existantes | Déplacer depuis `app/Notifications/` | P2 |

### PHASE 4: Intégration Controllers Backend (2-3 jours)

| Tâche | Fichiers | Priorité |
|-------|----------|----------|
| Limite missions/jour | `ServiceRequestController` | P1 |
| Middleware modération | `ContentModerationMiddleware` | P1 |
| API REST modération | `ModerationApiController` | P1 |
| Intégration création mission | `StoreMissionRequest` | P1 |

### PHASE 5: Jobs et Queues (1-2 jours)

| Tâche | Fichiers | Priorité |
|-------|----------|----------|
| AnalyzeContentJob | `Jobs/Moderation/` | P1 |
| AnalyzeImageJob | `Jobs/Moderation/` | P1 |
| Commandes planifiées | `Console/Commands/` | P1 |
| Configuration queue | `config/queue.php` | P1 |

### PHASE 6: Système d'Appel (1-2 jours)

| Tâche | Fichiers | Priorité |
|-------|----------|----------|
| AppealController | `AppealController.php` | P1 |
| Modèle UserAppeal | `Models/` | P1 |
| Vues appel | `views/appeal/` | P1 |
| Routes appel | `routes/web.php` | P1 |

### PHASE 7: Console Admin Backend (3-4 jours)

| Tâche | Fichiers | Priorité |
|-------|----------|----------|
| ModerationController Admin | `Admin/ModerationController` | P1 |
| BannedWordController | `Admin/BannedWordController` | P1 |
| ModerationAnalytics | `ModerationAnalytics.php` | P1 |
| Routes admin | `routes/web.php` | P1 |

### PHASE 8: Frontend Composants Utilisateur (3-4 jours)

| Tâche | Fichiers | Priorité |
|-------|----------|----------|
| MissionLimitBanner.vue | `components/moderation/` | P1 |
| ReportModal.vue | `components/moderation/` | P1 |
| ContentWarning.vue | `components/moderation/` | P1 |
| StrikeNotification.vue | `components/moderation/` | P1 |
| AppealForm (Blade) | `views/appeal/` | P1 |
| Composable useModeration | `composables/` | P1 |

### PHASE 9: Frontend Console Admin (3-4 jours)

| Tâche | Fichiers | Priorité |
|-------|----------|----------|
| Dashboard modération | `views/admin/moderation/index.blade.php` | P1 |
| Queue modération | `views/admin/moderation/queue.blade.php` | P1 |
| Gestion mots interdits | `views/admin/moderation/banned-words.blade.php` | P1 |
| Signalements | `views/admin/moderation/reports.blade.php` | P1 |
| Historique utilisateur | `views/admin/moderation/user-history.blade.php` | P1 |
| Analytics/Graphiques | `views/admin/moderation/analytics.blade.php` | P2 |
| Intégration Chart.js | `resources/js/` | P2 |

### PHASE 10: API Frontend (2 jours)

| Tâche | Fichiers | Priorité |
|-------|----------|----------|
| Endpoints utilisateur | `routes/api.php` | P1 |
| Endpoints admin | `routes/api.php` | P1 |
| Axios interceptors | `resources/js/` | P2 |
| Gestion erreurs API | `resources/js/` | P2 |

### PHASE 11: Tests (3-4 jours)

| Tâche | Description | Priorité |
|-------|-------------|----------|
| Tests unitaires services | WordFilter, ContactDetector, etc. | P1 |
| Tests unitaires modèles | Tous les modèles modération | P1 |
| Tests d'intégration | Flux complet modération | P1 |
| Tests API | Tous les endpoints | P1 |
| Tests Frontend (optionnel) | Composants Vue avec Vitest | P2 |

### PHASE 12: Finitions (2-3 jours)

| Tâche | Description | Priorité |
|-------|-------------|----------|
| Ajustement seuils | Calibrer les scores après tests | P1 |
| Documentation admin | Guide utilisation console | P1 |
| Messages UX | Révision tous les messages | P1 |
| Optimisation performances | Cache, indexes DB | P2 |
| Logs et monitoring | Intégration système logs | P2 |

---

## 22. TESTS

### Structure des Tests

```
tests/
├── Unit/
│   └── Services/
│       └── Moderation/
│           ├── WordFilterTest.php
│           ├── ContactDetectorTest.php
│           ├── SpamDetectorTest.php
│           ├── ImageModeratorTest.php
│           └── SanctionManagerTest.php
│
├── Feature/
│   └── Moderation/
│       ├── MissionModerationTest.php
│       ├── ReportingTest.php
│       ├── StrikeSystemTest.php
│       ├── AppealTest.php
│       └── AdminModerationTest.php
│
└── Browser/ (Dusk, optionnel)
    └── ModerationFlowTest.php
```

### Exemples de Tests

```php
// tests/Unit/Services/Moderation/WordFilterTest.php

namespace Tests\Unit\Services\Moderation;

use App\Services\Global_Moderations\WordFilter;
use Tests\TestCase;

class WordFilterTest extends TestCase
{
    private WordFilter $filter;

    protected function setUp(): void
    {
        parent::setUp();
        $this->filter = app(WordFilter::class);
    }

    /** @test */
    public function it_detects_critical_banned_words()
    {
        $content = "Recherche escort pour soirée";
        $result = $this->filter->analyze($content);

        $this->assertTrue($result->hasCritical());
        $this->assertContains('escort', $result->getMatchedWords());
    }

    /** @test */
    public function it_detects_leet_speak_variations()
    {
        $content = "Service de s3x disponible";
        $result = $this->filter->analyze($content);

        $this->assertTrue($result->hasCritical());
    }

    /** @test */
    public function it_respects_word_boundaries()
    {
        // "massage" seul est warning, mais "massage thérapeutique" est légitime
        $content = "Massage thérapeutique professionnel";
        $result = $this->filter->analyze($content);

        $this->assertFalse($result->hasCritical());
        $this->assertTrue($result->hasWarning()); // Mais flaggé pour review
    }

    /** @test */
    public function it_handles_political_content_as_critical()
    {
        $content = "Campagne électorale pour les expatriés";
        $result = $this->filter->analyze($content);

        $this->assertTrue($result->hasCritical());
    }

    /** @test */
    public function it_allows_clean_content()
    {
        $content = "Recherche professeur de français à Paris";
        $result = $this->filter->analyze($content);

        $this->assertFalse($result->hasCritical());
        $this->assertFalse($result->hasWarning());
    }
}
```

```php
// tests/Feature/Moderation/MissionModerationTest.php

namespace Tests\Feature\Moderation;

use App\Models\User;
use App\Models\Mission;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MissionModerationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_cannot_create_more_than_3_missions_per_day()
    {
        $user = User::factory()->create();

        // Créer 3 missions
        for ($i = 0; $i < 3; $i++) {
            Mission::factory()->create(['requester_id' => $user->id]);
        }

        // La 4ème doit échouer
        $response = $this->actingAs($user)->post('/save-request', [
            'requestTitle' => 'Test mission',
            'moreDetails' => 'Description test',
            // ... autres champs
        ]);

        $response->assertStatus(429);
        $response->assertJson(['error' => 'limit_reached']);
    }

    /** @test */
    public function mission_with_banned_word_is_rejected()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/save-request', [
            'requestTitle' => 'Recherche escort',
            'moreDetails' => 'Pour événement',
        ]);

        $response->assertStatus(422);
        $response->assertJson(['blocked' => true]);
    }

    /** @test */
    public function mission_with_contact_info_is_blocked()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/save-request', [
            'requestTitle' => 'Service de traduction',
            'moreDetails' => 'Contactez-moi au 06 12 34 56 78',
        ]);

        $response->assertStatus(422);
        $response->assertJsonPath('reason', 'contact_detected');
    }

    /** @test */
    public function mission_needing_review_is_flagged()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/save-request', [
            'requestTitle' => 'Cours de massage thérapeutique',
            'moreDetails' => 'Techniques professionnelles de bien-être',
        ]);

        $response->assertStatus(200);

        // Vérifier que la mission est en attente de review
        $mission = Mission::latest()->first();
        $this->assertEquals('pending', $mission->moderation_status);
    }
}
```

```php
// tests/Feature/Moderation/StrikeSystemTest.php

namespace Tests\Feature\Moderation;

use App\Models\User;
use App\Services\Global_Moderations\SanctionManager;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StrikeSystemTest extends TestCase
{
    use RefreshDatabase;

    private SanctionManager $sanctionManager;

    protected function setUp(): void
    {
        parent::setUp();
        $this->sanctionManager = app(SanctionManager::class);
    }

    /** @test */
    public function user_receives_strike_for_banned_content()
    {
        $user = User::factory()->create();

        $this->sanctionManager->addStrike($user, 'banned_word_critical', 'Test strike');

        $user->refresh();
        $this->assertEquals(1, $user->strike_count);
        $this->assertEquals('active', $user->status);
    }

    /** @test */
    public function user_is_banned_after_3_strikes()
    {
        $user = User::factory()->create();

        $this->sanctionManager->addStrike($user, 'banned_word_critical', 'Strike 1');
        $this->sanctionManager->addStrike($user, 'banned_word_critical', 'Strike 2');
        $this->sanctionManager->addStrike($user, 'banned_word_critical', 'Strike 3');

        $user->refresh();
        $this->assertEquals('suspended', $user->status);
        $this->assertNotNull($user->banned_at);
    }

    /** @test */
    public function rapid_recidivism_accelerates_ban()
    {
        $user = User::factory()->create();

        // 2 strikes en moins de 7 jours = ban immédiat
        $this->sanctionManager->addStrike($user, 'banned_word_critical', 'Strike 1');

        // Simuler le même jour
        $this->sanctionManager->addStrike($user, 'banned_word_critical', 'Strike 2');

        $user->refresh();
        // Récidive rapide = strike compte double, donc 2+1 = 3 = ban
        $this->assertEquals('suspended', $user->status);
    }

    /** @test */
    public function strikes_expire_after_30_days()
    {
        $user = User::factory()->create();

        // Créer un strike il y a 31 jours
        $strike = $this->sanctionManager->addStrike($user, 'banned_word_critical', 'Old strike');
        $strike->update(['expires_at' => now()->subDays(1)]);

        // Exécuter la commande d'expiration
        $this->artisan('moderation:expire-strikes');

        $strike->refresh();
        $this->assertFalse($strike->is_active);
    }
}

---

## RÉSUMÉ DES LIVRABLES

### Fichiers à Créer

```
NOUVEAU:
├── app/Services/
│   ├── Global_Moderations/                    # Module modération isolé
│   │   ├── ModerationService.php
│   │   ├── ContentAnalyzer.php
│   │   ├── ContactDetector.php
│   │   ├── WordFilter.php
│   │   ├── SanctionManager.php
│   │   ├── Models/
│   │   │   ├── ModerationFlag.php
│   │   │   ├── ModerationAction.php
│   │   │   ├── UserStrike.php
│   │   │   ├── BannedWord.php
│   │   │   └── ContentReport.php
│   │   └── Exceptions/
│   │       └── ModerationException.php
│   │
│   └── Global_Notifications/                  # Module notifications centralisé
│       ├── BaseNotification.php
│       ├── NotificationService.php
│       ├── Channels/
│       │   ├── SmsChannel.php
│       │   └── PushChannel.php
│       ├── Moderation/
│       │   ├── ContentFlaggedNotification.php
│       │   ├── ContentApprovedNotification.php
│       │   ├── ContentRejectedNotification.php
│       │   ├── FirstStrikeNotification.php
│       │   ├── SecondStrikeNotification.php
│       │   └── UserBannedNotification.php
│       ├── Payment/
│       │   ├── PaymentReceivedNotification.php
│       │   ├── PaymentFailedNotification.php
│       │   ├── PayoutCompletedNotification.php
│       │   └── PayPalDisputeNotification.php
│       ├── Mission/
│       │   ├── MissionCreatedNotification.php
│       │   ├── OfferReceivedNotification.php
│       │   ├── OfferAcceptedNotification.php
│       │   └── MissionCompletedNotification.php
│       ├── User/
│       │   ├── WelcomeNotification.php
│       │   ├── EmailVerificationNotification.php
│       │   └── PasswordResetNotification.php
│       └── Admin/
│           ├── NewUserNotification.php
│           ├── NewDisputeNotification.php
│           └── CriticalReportNotification.php
│
├── app/Http/Controllers/Admin/ModerationController.php
├── app/Http/Middleware/ContentModerationMiddleware.php
├── config/
│   ├── moderations.php
│   └── notifications.php
├── database/migrations/
│   ├── xxxx_create_moderation_flags_table.php
│   ├── xxxx_create_moderation_actions_table.php
│   ├── xxxx_create_user_strikes_table.php
│   ├── xxxx_create_banned_words_table.php
│   ├── xxxx_create_content_reports_table.php
│   └── xxxx_add_moderation_fields_to_users_table.php
├── database/seeders/BannedWordsSeeder.php
└── resources/views/admin/dashboard/moderation/
    ├── index.blade.php
    ├── queue.blade.php
    ├── banned-words.blade.php
    ├── reports.blade.php
    └── user-strikes.blade.php

À MODIFIER:
├── app/Http/Controllers/ServiceRequestController.php (limite 3/jour)
├── app/Http/Controllers/JobListController.php (modération offres)
├── app/Http/Kernel.php (enregistrement middleware)
├── app/Providers/AppServiceProvider.php (binding services)
├── routes/web.php (routes admin modération)
├── resources/views/admin/dashboard/sidebar.blade.php (menu modération)
└── app/Notifications/* (migrer vers Global_Notifications)
```

---

## ESTIMATION EFFORT TOTAL

### Par Phase

| Phase | Description | Durée estimée |
|-------|-------------|---------------|
| Phase 1 | Infrastructure Backend | 2-3 jours |
| Phase 2 | Services Core Modération | 3-4 jours |
| Phase 3 | Services Core Notifications | 2-3 jours |
| Phase 4 | Intégration Controllers Backend | 2-3 jours |
| Phase 5 | Jobs et Queues | 1-2 jours |
| Phase 6 | Système d'Appel | 1-2 jours |
| Phase 7 | Console Admin Backend | 3-4 jours |
| Phase 8 | Frontend Composants Utilisateur | 3-4 jours |
| Phase 9 | Frontend Console Admin | 3-4 jours |
| Phase 10 | API Frontend | 2 jours |
| Phase 11 | Tests | 3-4 jours |
| Phase 12 | Finitions | 2-3 jours |
| **TOTAL** | | **27-38 jours** |

### Par Catégorie

| Catégorie | Phases | Durée |
|-----------|--------|-------|
| **Backend Core** | 1-7 | 14-21 jours |
| **Frontend** | 8-10 | 8-10 jours |
| **Tests & Finitions** | 11-12 | 5-7 jours |

### Avec Équipe

| Configuration | Durée estimée |
|---------------|---------------|
| 1 développeur | 27-38 jours (~6-8 semaines) |
| 2 développeurs (Backend + Frontend en parallèle) | 15-20 jours (~3-4 semaines) |
| 3 développeurs | 10-15 jours (~2-3 semaines) |

---

## PROCHAINES ÉTAPES

1. **Validation du plan** - Ce document nécessite ton approbation
2. **Démarrage Phase 1** - Création des migrations et modèles
3. **Tests progressifs** - Validation à chaque phase

**Veux-tu que je commence l'implémentation ?**
