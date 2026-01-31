<?php

return [
    // Notification titles
    'titles' => [
        'content_flagged' => 'Content under review',
        'content_approved' => 'Content approved',
        'content_rejected' => 'Content not published',
        'strike' => 'Warning received',
        'user_banned' => 'Account suspended',
        'appeal_approved' => 'Appeal approved',
        'appeal_rejected' => 'Appeal rejected',
    ],

    // Messages
    'messages' => [
        'content_flagged' => 'Your :type is being reviewed by our team.',
        'content_approved' => 'Your :type ":title" has been approved and is now visible.',
        'content_rejected' => 'Your :type ":title" was not approved.',
        'strike_warning' => 'You have received a warning (:current/:max).',
        'account_banned' => 'Your account has been suspended.',
        'appeal_approved' => 'Your appeal has been accepted.',
        'appeal_rejected' => 'Your appeal was not accepted.',
    ],

    // Content types
    'content_types' => [
        'mission' => 'service request',
        'offer' => 'proposal',
        'message' => 'message',
        'content' => 'content',
    ],

    // Emails
    'email' => [
        'greeting' => 'Hello,',
        'salutation' => 'The Ulixai Team',
        'view_content' => 'View my content',
        'view_terms' => 'Terms of Service',
        'appeal_action' => 'Submit an appeal',
        'dashboard_action' => 'Go to my account',
    ],

    // Admin actions
    'admin' => [
        'new_content' => 'New content to review',
        'new_report' => 'New report',
        'new_appeal' => 'New appeal',
        'view_queue' => 'View moderation queue',
        'view_reports' => 'View reports',
        'view_appeals' => 'View appeals',
    ],
];
