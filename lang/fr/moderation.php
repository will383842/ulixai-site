<?php

return [
    // Statuts
    'status' => [
        'clean' => 'Approuvé',
        'review' => 'En attente de révision',
        'blocked' => 'Bloqué',
        'pending_review' => 'En attente de révision',
        'approved' => 'Approuvé',
        'rejected' => 'Rejeté',
    ],

    // Messages utilisateur
    'account_banned' => 'Votre compte a été suspendu.',
    'account_suspended' => 'Votre compte est temporairement suspendu.',
    'content_blocked' => 'Ce contenu a été bloqué car il ne respecte pas nos règles.',
    'content_pending_review' => 'Votre contenu est en attente de validation.',
    'content_approved' => 'Contenu approuvé.',
    'content_rejected' => 'Contenu rejeté.',

    // Limites de publication
    'daily_limit_reached' => 'Vous avez atteint votre limite quotidienne de publications.',
    'limit_info' => 'Il vous reste :remaining publication(s) sur :limit aujourd\'hui.',
    'limit_reset' => 'La limite sera réinitialisée à :time.',

    // Signalements
    'report_submitted' => 'Votre signalement a été envoyé.',
    'report_limit_exceeded' => 'Vous avez atteint votre limite de signalements.',
    'already_reported' => 'Vous avez déjà signalé ce contenu.',
    'report_processed' => 'Signalement traité.',

    // Appels
    'appeal_submitted' => 'Votre appel a été envoyé.',
    'appeal_not_allowed' => 'Vous ne pouvez pas faire appel.',
    'appeal_deadline_passed' => 'Le délai pour faire appel est dépassé.',
    'appeal_already_pending' => 'Vous avez déjà un appel en cours.',
    'appeal_processed' => 'Appel traité.',

    // Strikes
    'strike_issued' => 'Strike émis.',
    'strike_removed' => 'Strike retiré.',
    'strike_warning' => 'Attention : vous avez reçu un avertissement (:current/:max).',
    'strike_reason' => 'Raison : :reason',

    // Bannissement
    'user_banned' => 'Utilisateur banni.',
    'user_unbanned' => 'Utilisateur débanni.',
    'user_suspended' => 'Utilisateur suspendu.',
    'user_warned' => 'Avertissement envoyé.',
    'ban_message' => 'Votre compte a été suspendu pour la raison suivante : :reason',
    'ban_appeal' => 'Vous pouvez faire appel jusqu\'au :date.',

    // Mots interdits
    'word_added' => 'Mot ajouté à la liste.',
    'word_updated' => 'Mot mis à jour.',
    'word_deleted' => 'Mot supprimé.',

    // Raisons de signalement
    'reasons' => [
        'inappropriate' => 'Contenu inapproprié',
        'spam' => 'Spam',
        'harassment' => 'Harcèlement',
        'fraud' => 'Fraude/Arnaque',
        'other' => 'Autre',
    ],

    // Erreurs de validation
    'errors' => [
        'inappropriate_content' => 'Votre message contient du contenu inapproprié.',
        'contact_info_detected' => 'Le partage de coordonnées personnelles n\'est pas autorisé.',
        'spam_detected' => 'Votre message a été détecté comme spam.',
    ],
];
