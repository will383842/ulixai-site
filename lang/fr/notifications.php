<?php

return [
    // Titres des notifications
    'titles' => [
        'content_flagged' => 'Contenu en vérification',
        'content_approved' => 'Contenu approuvé',
        'content_rejected' => 'Contenu non publié',
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
        'strike_warning' => 'Vous avez reçu un avertissement (:current/:max).',
        'account_banned' => 'Votre compte a été suspendu.',
        'appeal_approved' => 'Votre appel a été accepté.',
        'appeal_rejected' => 'Votre appel n\'a pas été accepté.',
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
