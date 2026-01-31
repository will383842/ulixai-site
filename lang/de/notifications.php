<?php

return [
    // Benachrichtigungstitel
    'titles' => [
        'content_flagged' => 'Inhalt wird geprüft',
        'content_approved' => 'Inhalt genehmigt',
        'content_rejected' => 'Inhalt nicht veröffentlicht',
        'content_blocked' => 'Veröffentlichung nicht erlaubt',
        'strike' => 'Verwarnung erhalten',
        'user_banned' => 'Konto gesperrt',
        'appeal_approved' => 'Einspruch genehmigt',
        'appeal_rejected' => 'Einspruch abgelehnt',
    ],

    // Nachrichten
    'messages' => [
        'content_flagged' => 'Ihr :type wird von unserem Team überprüft.',
        'content_approved' => 'Ihr :type ":title" wurde genehmigt und ist jetzt sichtbar.',
        'content_rejected' => 'Ihr :type ":title" wurde nicht genehmigt.',
        'content_blocked' => 'Ihr :type ":title" konnte nicht veröffentlicht werden.',
        'strike_warning' => 'Sie haben eine Verwarnung erhalten (:current/:max).',
        'account_banned' => 'Ihr Konto wurde gesperrt.',
        'appeal_approved' => 'Ihr Einspruch wurde akzeptiert.',
        'appeal_rejected' => 'Ihr Einspruch wurde nicht akzeptiert.',
    ],

    // Gründe für Blockierung
    'block_reasons' => [
        'inappropriate_content' => 'Der Inhalt enthält verbotene Begriffe.',
        'contact_info_detected' => 'Kontaktinformationen wurden erkannt. Bitte nutzen Sie das integrierte Nachrichtensystem.',
        'spam_detected' => 'Der Inhalt wurde als Spam erkannt.',
        'default' => 'Der Inhalt entspricht nicht unseren Nutzungsbedingungen.',
    ],

    // E-Mail-Hinweise für blockierte Inhalte
    'blocked_advice' => [
        'intro' => 'Was können Sie tun?',
        'modify' => 'Ändern Sie Ihren Inhalt, um unseren Nutzungsbedingungen zu entsprechen.',
        'no_contact' => 'Geben Sie keine Kontaktinformationen an (E-Mail, Telefon, soziale Medien).',
        'use_messaging' => 'Nutzen Sie das integrierte Nachrichtensystem zur Kommunikation.',
        'review_info' => 'Falls Sie glauben, dass ein Fehler vorliegt, überprüft unser Team automatisch blockierte Inhalte.',
    ],

    // Inhaltstypen
    'content_types' => [
        'mission' => 'Dienstleistungsanfrage',
        'offer' => 'Angebot',
        'message' => 'Nachricht',
        'content' => 'Inhalt',
    ],

    // E-Mails
    'email' => [
        'greeting' => 'Guten Tag,',
        'salutation' => 'Das Ulixai-Team',
        'view_content' => 'Meinen Inhalt ansehen',
        'view_terms' => 'Nutzungsbedingungen',
        'appeal_action' => 'Einspruch einlegen',
        'dashboard_action' => 'Zu meinem Konto',
    ],

    // Admin-Aktionen
    'admin' => [
        'new_content' => 'Neuer Inhalt zur Überprüfung',
        'new_report' => 'Neue Meldung',
        'new_appeal' => 'Neuer Einspruch',
        'view_queue' => 'Moderationswarteschlange ansehen',
        'view_reports' => 'Meldungen ansehen',
        'view_appeals' => 'Einsprüche ansehen',
    ],
];
