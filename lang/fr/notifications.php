<?php

return [
    // Titres des notifications
    'titles' => [
        'content_flagged' => 'Contenu en vérification',
        'content_approved' => 'Contenu approuvé',
        'content_rejected' => 'Contenu non publié',
        'content_blocked' => 'Publication non autorisée',
        'strike' => 'Avertissement reçu',
        'user_banned' => 'Compte suspendu',
        'appeal_approved' => 'Appel approuvé',
        'appeal_rejected' => 'Appel rejeté',
    ],

    // Messages
    'messages' => [
        'content_flagged' => 'Votre :type est en cours de vérification par notre équipe.',
        'content_approved' => 'Votre :type ":title" a été approuvé et est maintenant visible.',
        'content_rejected' => 'Votre :type ":title" n\'a pas été approuvé.',
        'content_blocked' => 'Votre :type ":title" n\'a pas pu être publié.',
        'strike_warning' => 'Vous avez reçu un avertissement (:current/:max).',
        'account_banned' => 'Votre compte a été suspendu.',
        'appeal_approved' => 'Votre appel a été accepté.',
        'appeal_rejected' => 'Votre appel n\'a pas été accepté.',
    ],

    // Raisons de blocage (feedback utilisateur)
    'block_reasons' => [
        'inappropriate_content' => 'Le contenu contient des termes non autorisés.',
        'contact_info_detected' => 'Des informations de contact ont été détectées. Utilisez la messagerie intégrée.',
        'spam_detected' => 'Le contenu a été identifié comme spam.',
        'default' => 'Le contenu ne respecte pas nos conditions d\'utilisation.',
    ],

    // Conseils email pour contenu bloqué
    'blocked_advice' => [
        'intro' => 'Que pouvez-vous faire ?',
        'modify' => 'Modifiez votre contenu pour respecter nos conditions d\'utilisation.',
        'no_contact' => 'N\'incluez pas d\'informations de contact (email, téléphone, réseaux sociaux).',
        'use_messaging' => 'Utilisez la messagerie intégrée pour communiquer avec les prestataires.',
        'review_info' => 'Si vous pensez qu\'il s\'agit d\'une erreur, notre équipe examine automatiquement les contenus bloqués.',
    ],

    // Types de contenu
    'content_types' => [
        'mission' => 'demande de service',
        'offer' => 'proposition',
        'message' => 'message',
        'content' => 'contenu',
    ],

    // Emails
    'email' => [
        'greeting' => 'Bonjour,',
        'salutation' => 'L\'équipe Ulixai',
        'view_content' => 'Voir mon contenu',
        'view_terms' => 'Conditions d\'utilisation',
        'appeal_action' => 'Faire appel',
        'dashboard_action' => 'Accéder à mon compte',
    ],

    // Actions admin
    'admin' => [
        'new_content' => 'Nouveau contenu à vérifier',
        'new_report' => 'Nouveau signalement',
        'new_appeal' => 'Nouvel appel',
        'view_queue' => 'Voir la queue de modération',
        'view_reports' => 'Voir les signalements',
        'view_appeals' => 'Voir les appels',
    ],
];
