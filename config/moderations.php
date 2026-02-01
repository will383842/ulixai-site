<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Limites de Création de Contenu
    |--------------------------------------------------------------------------
    |
    | Définit les limites de création de contenu par utilisateur.
    |
    */
    'limits' => [
        'missions_per_day' => 3,
        'missions_per_week' => 10,
        'offers_per_day' => 20,
        'messages_per_hour' => 30,
        'reports_per_day' => 5,
    ],

    /*
    |--------------------------------------------------------------------------
    | Seuils de Score de Modération
    |--------------------------------------------------------------------------
    |
    | Score de 0 à 100 déterminant le statut du contenu.
    | NOUVEAUX SEUILS plus souples (v2.0) :
    | - Un mot isolé dans un contexte légitime ne bloque plus
    | - Seules les combinaisons suspectes ou contacts explicites bloquent
    |
    */
    'thresholds' => [
        // Score < 40 : Publication directe (CLEAN)
        'clean_max' => 40,

        // Score 40-79 : En attente de review (WARNING)
        'review_min' => 40,
        'review_max' => 79,

        // Score >= 80 : Blocage automatique (BLOCKED)
        'block_min' => 80,
    ],

    /*
    |--------------------------------------------------------------------------
    | Configuration des Strikes
    |--------------------------------------------------------------------------
    |
    | Système de strikes progressif.
    |
    */
    'strikes' => [
        // Nombre max de strikes avant ban
        'max_before_ban' => 3,

        // Durée de vie d'un strike en mois (null = permanent)
        'expiry_months' => 6,

        // Score de confiance retiré par strike
        'trust_score_penalty' => 20,
    ],

    /*
    |--------------------------------------------------------------------------
    | Configuration du Bannissement
    |--------------------------------------------------------------------------
    |
    | Options de bannissement et d'appel.
    |
    */
    'ban' => [
        // Nombre max d'appels autorisés
        'max_appeals' => 2,

        // Délai en jours pour faire appel
        'appeal_deadline_days' => 7,

        // Durée de suspension temporaire en jours (avant ban définitif)
        'suspension_duration_days' => 30,
    ],

    /*
    |--------------------------------------------------------------------------
    | Pondération des Détections
    |--------------------------------------------------------------------------
    |
    | Score ajouté au contenu selon le type de problème détecté.
    | NOUVEAUX SCORES (v2.0) : plus progressifs, analyse contextuelle
    | - Un mot seul = 30% du score de base
    | - Contexte légitime = réduction supplémentaire de 80%
    | - Combinaisons suspectes = score additionnel
    |
    */
    'scoring' => [
        // Mots interdits (scores de BASE, réduits par contexte)
        'word_critical' => 40,      // Était 80, réduit car contextuel
        'word_warning' => 15,       // Était 40
        'word_info' => 5,           // Était 10

        // Coordonnées de contact (scores ajustés)
        'contact_phone' => 50,      // Était 70
        'contact_email' => 50,      // Était 70
        'contact_messaging' => 45,  // NOUVEAU: WhatsApp, Telegram, etc.
        'contact_request' => 40,    // NOUVEAU: "contactez-moi en DM"
        'contact_social' => 30,     // Était 60
        'contact_url' => 25,        // Était 50

        // Spam (inchangé)
        'spam_caps_ratio' => 20,    // Trop de majuscules
        'spam_special_chars' => 15, // Trop de caractères spéciaux
        'spam_repetition' => 25,    // Répétition de caractères
        'spam_velocity' => 30,      // Création trop rapide
        'spam_duplicate' => 40,     // Contenu dupliqué

        // Autres
        'low_trust_user' => 15,     // Utilisateur avec score de confiance bas
        'new_account' => 10,        // Compte créé récemment (< 7 jours)

        // NOUVEAU: Bonus contextuels (réductions)
        'context_legitimate_multiplier' => 0.2,   // 80% de réduction si contexte légitime
        'context_single_word_multiplier' => 0.3,  // 70% de réduction si mot seul
        'context_question_multiplier' => 0.5,     // 50% de réduction si question
    ],

    /*
    |--------------------------------------------------------------------------
    | Seuils de Détection de Spam
    |--------------------------------------------------------------------------
    |
    | Paramètres pour la détection de spam.
    |
    */
    'spam_detection' => [
        // Ratio max de majuscules (0.3 = 30%)
        'max_caps_ratio' => 0.3,

        // Ratio max de caractères spéciaux
        'max_special_chars_ratio' => 0.15,

        // Nombre max de caractères répétés consécutifs
        'max_repeated_chars' => 4,

        // Délai minimum entre créations (en secondes)
        'min_creation_interval' => 60,

        // Seuil de similarité pour détection de doublon (0-1)
        'duplicate_similarity_threshold' => 0.85,
    ],

    /*
    |--------------------------------------------------------------------------
    | Langues Supportées
    |--------------------------------------------------------------------------
    |
    | Langues de navigation de la plateforme.
    | NOTE: Les utilisateurs peuvent publier dans N'IMPORTE QUELLE langue.
    | La modération vérifie le contenu contre TOUTES les langues.
    |
    */
    'supported_languages' => ['fr', 'en', 'de', 'ru', 'zh', 'es', 'pt', 'ar', 'hi'],

    /*
    |--------------------------------------------------------------------------
    | Patterns de Détection de Contact (International)
    |--------------------------------------------------------------------------
    |
    | Expressions régulières pour détecter les coordonnées dans toutes les langues.
    |
    */
    'contact_patterns' => [
        'phone' => [
            // Format international standard (+XX XXX XXX XXXX)
            '/\+?\d{1,4}[\s.\-]?\(?\d{1,4}\)?[\s.\-]?\d{1,4}[\s.\-]?\d{1,9}/',
            // 5+ chiffres avec séparateurs (obfuscation)
            '/\d[\s\-._]*\d[\s\-._]*\d[\s\-._]*\d[\s\-._]*\d/',
            // Chiffres écrits en français
            '/z[ée]ro|un|deux|trois|quatre|cinq|six|sept|huit|neuf/iu',
            // Chiffres écrits en anglais
            '/\b(zero|one|two|three|four|five|six|seven|eight|nine)\b/i',
            // Chiffres écrits en espagnol
            '/\b(cero|uno|dos|tres|cuatro|cinco|seis|siete|ocho|nueve)\b/i',
            // Chiffres écrits en portugais
            '/\b(zero|um|dois|tres|quatro|cinco|seis|sete|oito|nove)\b/i',
            // Chiffres écrits en allemand
            '/\b(null|eins|zwei|drei|vier|funf|sechs|sieben|acht|neun)\b/i',
            // Chiffres écrits en russe
            '/ноль|один|два|три|четыре|пять|шесть|семь|восемь|девять/iu',
            // Chiffres écrits en arabe
            '/صفر|واحد|اثنان|ثلاثة|أربعة|خمسة|ستة|سبعة|ثمانية|تسعة/u',
            // Chiffres écrits en hindi
            '/शून्य|एक|दो|तीन|चार|पांच|छह|सात|आठ|नौ/u',
            // Chiffres chinois
            '/零|一|二|三|四|五|六|七|八|九|〇/u',
        ],
        'email' => [
            // Format standard et variations @
            '/[a-zA-Z0-9._%+-]+\s*[@\[at\]]\s*[a-zA-Z0-9.-]+\s*[.\[dot\]]\s*[a-zA-Z]{2,}/i',
            // Obfuscation multilingue (at, arobase, arroba, собака, etc.)
            '/[\w.]+\s*(at|@|arobase|arroba|собака|アット)\s*[\w.]+\s*(dot|point|punto|точка|\.)\s*\w{2,}/iu',
        ],
        'social' => [
            // Plateformes de messagerie
            '/(whatsapp|telegram|signal|viber|snapchat|instagram|facebook|tiktok|wechat|line|kakao)\s*[:\-]?\s*[@\w.\-+]+/i',
            // Demandes de contact multilingues
            '/(add|ajout|contact|agreg|contac|добавь|联系|संपर्क)\s*(me|moi|mi|меня|我|मुझे)?\s*(on|sur|en|на|在|पर)\s*(insta|snap|whats|telegram|wechat)/iu',
            // Usernames avec @
            '/@[a-zA-Z0-9._]{3,30}\b/',
        ],
        'url' => [
            // URLs complètes
            '/https?:\/\/[^\s<>"{}|\\^`\[\]]+/i',
            // Domaines internationaux
            '/\b[\w-]+\.(com|net|org|io|co|me|app|fr|de|es|pt|ru|cn|in|uk|br|mx|ar)\b/i',
            // Liens raccourcis
            '/\b(bit\.ly|tinyurl|t\.co|goo\.gl|shorturl)\b/i',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Configuration du Score de Confiance
    |--------------------------------------------------------------------------
    |
    | Calcul du score de confiance utilisateur.
    |
    */
    'trust_score' => [
        // Score initial pour nouveau compte
        'initial' => 100,

        // Score minimum pour bypass partiel de review
        'trusted_threshold' => 80,

        // Score en dessous duquel tout contenu est reviewé
        'review_threshold' => 50,

        // Bonus pour compte vérifié
        'verified_bonus' => 10,

        // Bonus par mois d'ancienneté (max 20)
        'account_age_bonus' => 2,
        'account_age_bonus_max' => 20,

        // Bonus pour missions complétées avec succès
        'completed_mission_bonus' => 1,
    ],

    /*
    |--------------------------------------------------------------------------
    | Signalements
    |--------------------------------------------------------------------------
    |
    | Configuration des signalements utilisateur.
    |
    */
    'reports' => [
        // Nombre de signalements avant review automatique
        'auto_review_threshold' => 3,

        // Nombre de signalements avant suspension temporaire
        'auto_suspend_threshold' => 10,

        // Priorité automatique selon le type
        'priority_by_reason' => [
            'hate_speech' => 'critical',
            'illegal_content' => 'critical',
            'harassment' => 'high',
            'scam' => 'high',
            'inappropriate_content' => 'medium',
            'fake_profile' => 'medium',
            'spam' => 'low',
            'contact_info' => 'low',
            'other' => 'low',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Catégories de Mots Interdits
    |--------------------------------------------------------------------------
    |
    | Configuration des catégories et leurs niveaux.
    |
    */
    'word_categories' => [
        'sexual' => [
            'label' => 'Contenu sexuel',
            'default_severity' => 'critical',
            'color' => '#dc3545',
        ],
        'political' => [
            'label' => 'Contenu politique',
            'default_severity' => 'critical',
            'color' => '#6f42c1',
        ],
        'religious' => [
            'label' => 'Contenu religieux',
            'default_severity' => 'warning',
            'color' => '#fd7e14',
        ],
        'hate_speech' => [
            'label' => 'Discours haineux',
            'default_severity' => 'critical',
            'color' => '#dc3545',
        ],
        'illegal' => [
            'label' => 'Contenu illégal',
            'default_severity' => 'critical',
            'color' => '#343a40',
        ],
        'spam' => [
            'label' => 'Spam',
            'default_severity' => 'warning',
            'color' => '#ffc107',
        ],
        'contact_info' => [
            'label' => 'Coordonnées',
            'default_severity' => 'warning',  // Était critical, maintenant review par défaut
            'color' => '#17a2b8',
        ],
        'other' => [
            'label' => 'Autre',
            'default_severity' => 'info',
            'color' => '#6c757d',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Soft Warnings (Avertissements Non-Bloquants)
    |--------------------------------------------------------------------------
    |
    | Avertissements informatifs qui n'empêchent PAS la publication
    | mais guident l'utilisateur vers les bonnes pratiques.
    |
    */
    'soft_warnings' => [
        // Activer les soft warnings
        'enabled' => true,

        // Score minimum pour afficher un soft warning (sans bloquer)
        'min_score' => 15,

        // Score maximum pour soft warning (au-delà = review/block)
        'max_score' => 39,

        // Messages par type de détection
        'messages' => [
            'contact_info' => 'Pour votre sécurité, nous vous recommandons d\'utiliser la messagerie intégrée plutôt que de partager vos coordonnées.',
            'external_payment' => 'Attention : les paiements hors plateforme ne sont pas protégés par notre garantie.',
            'single_word_match' => 'Votre message a été publié. Certains termes peuvent être sensibles dans d\'autres contextes.',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Messages Utilisateur
    |--------------------------------------------------------------------------
    |
    | Messages affichés aux utilisateurs.
    |
    */
    'messages' => [
        'limit_reached' => [
            'missions' => 'Vous avez atteint votre limite quotidienne de :limit annonces. Vous pourrez en publier de nouvelles demain à 00h00.',
            'offers' => 'Vous avez atteint votre limite quotidienne de :limit propositions.',
            'messages' => 'Vous avez atteint votre limite de :limit messages par heure.',
            'reports' => 'Vous avez atteint votre limite quotidienne de :limit signalements.',
        ],
        'content_blocked' => 'Votre contenu ne peut pas être publié car il ne respecte pas nos conditions d\'utilisation.',
        'content_pending' => 'Votre contenu est en cours de vérification. Vous serez notifié une fois la vérification terminée.',
        'content_approved_with_warning' => 'Votre contenu a été publié avec un avertissement.',
        'strike_warning' => 'Vous avez reçu un avertissement (:current/:max). Veuillez respecter nos règles.',
        'account_suspended' => 'Votre compte a été suspendu suite à de multiples violations de nos conditions.',
    ],

    /*
    |--------------------------------------------------------------------------
    | Queue de Modération
    |--------------------------------------------------------------------------
    |
    | Configuration de la queue de jobs.
    |
    */
    'queue' => [
        // Nom de la queue
        'name' => 'moderation',

        // Délai avant traitement (secondes)
        'delay' => 0,

        // Nombre de tentatives max
        'tries' => 3,

        // Timeout en secondes
        'timeout' => 60,
    ],

    /*
    |--------------------------------------------------------------------------
    | Image Moderation (Google Cloud Vision)
    |--------------------------------------------------------------------------
    |
    | Configuration de la modération d'images.
    |
    */
    'image_moderation' => [
        'enabled' => env('IMAGE_MODERATION_ENABLED', false),

        // Seuils de détection (VERY_LIKELY, LIKELY, POSSIBLE, UNLIKELY, VERY_UNLIKELY)
        'thresholds' => [
            'adult' => 'LIKELY',
            'violence' => 'LIKELY',
            'racy' => 'POSSIBLE',
        ],

        // Score ajouté si image flaggée
        'scores' => [
            'adult' => 80,
            'violence' => 70,
            'racy' => 40,
        ],
    ],
];
