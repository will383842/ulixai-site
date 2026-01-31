<?php

return [
    // Status
    'status' => [
        'clean' => 'Genehmigt',
        'review' => 'Wird überprüft',
        'blocked' => 'Blockiert',
        'pending_review' => 'Wird überprüft',
        'approved' => 'Genehmigt',
        'rejected' => 'Abgelehnt',
    ],

    // User messages
    'account_banned' => 'Ihr Konto wurde gesperrt.',
    'account_suspended' => 'Ihr Konto ist vorübergehend gesperrt.',
    'content_blocked' => 'Dieser Inhalt wurde blockiert, da er gegen unsere Richtlinien verstößt.',
    'content_pending_review' => 'Ihr Inhalt wartet auf Genehmigung.',
    'content_approved' => 'Inhalt genehmigt.',
    'content_rejected' => 'Inhalt abgelehnt.',

    // Publication limits
    'daily_limit_reached' => 'Sie haben Ihr tägliches Veröffentlichungslimit erreicht.',
    'limit_info' => 'Sie haben heute noch :remaining von :limit Veröffentlichung(en) übrig.',
    'limit_reset' => 'Das Limit wird um :time zurückgesetzt.',

    // Reports
    'report_submitted' => 'Ihre Meldung wurde eingereicht.',
    'report_limit_exceeded' => 'Sie haben Ihr Meldelimit erreicht.',
    'already_reported' => 'Sie haben diesen Inhalt bereits gemeldet.',
    'report_processed' => 'Meldung bearbeitet.',

    // Appeals
    'appeal_submitted' => 'Ihr Einspruch wurde eingereicht.',
    'appeal_not_allowed' => 'Sie können keinen Einspruch einlegen.',
    'appeal_deadline_passed' => 'Die Einspruchsfrist ist abgelaufen.',
    'appeal_already_pending' => 'Sie haben bereits einen laufenden Einspruch.',
    'appeal_processed' => 'Einspruch bearbeitet.',

    // Strikes
    'strike_issued' => 'Verwarnung erteilt.',
    'strike_removed' => 'Verwarnung entfernt.',
    'strike_warning' => 'Achtung: Sie haben eine Verwarnung erhalten (:current/:max).',
    'strike_reason' => 'Grund: :reason',

    // Banning
    'user_banned' => 'Benutzer gesperrt.',
    'user_unbanned' => 'Benutzer entsperrt.',
    'user_suspended' => 'Benutzer vorübergehend gesperrt.',
    'user_warned' => 'Warnung gesendet.',
    'ban_message' => 'Ihr Konto wurde aus folgendem Grund gesperrt: :reason',
    'ban_appeal' => 'Sie können bis :date Einspruch einlegen.',

    // Banned words
    'word_added' => 'Wort zur Liste hinzugefügt.',
    'word_updated' => 'Wort aktualisiert.',
    'word_deleted' => 'Wort gelöscht.',

    // Report reasons
    'reasons' => [
        'inappropriate' => 'Unangemessener Inhalt',
        'spam' => 'Spam',
        'harassment' => 'Belästigung',
        'fraud' => 'Betrug',
        'other' => 'Andere',
    ],

    // Validation errors
    'errors' => [
        'inappropriate_content' => 'Ihre Nachricht enthält unangemessene Inhalte.',
        'contact_info_detected' => 'Das Teilen persönlicher Kontaktdaten ist nicht erlaubt.',
        'spam_detected' => 'Ihre Nachricht wurde als Spam erkannt.',
    ],
];
