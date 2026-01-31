<?php

return [
    // Notification titles
    'titles' => [
        'content_flagged' => 'Content under review',
        'content_approved' => 'Content approved',
        'content_rejected' => 'Content not published',
        'content_blocked' => 'Publication not allowed',
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
        'content_blocked' => 'Your :type ":title" could not be published.',
        'strike_warning' => 'You have received a warning (:current/:max).',
        'account_banned' => 'Your account has been suspended.',
        'appeal_approved' => 'Your appeal has been accepted.',
        'appeal_rejected' => 'Your appeal was not accepted.',
    ],

    // Block reasons (user feedback)
    'block_reasons' => [
        'inappropriate_content' => 'The content contains prohibited terms.',
        'contact_info_detected' => 'Contact information was detected. Please use the built-in messaging.',
        'spam_detected' => 'The content was identified as spam.',
        'default' => 'The content does not comply with our terms of service.',
    ],

    // Email advice for blocked content
    'blocked_advice' => [
        'intro' => 'What can you do?',
        'modify' => 'Modify your content to comply with our terms of service.',
        'no_contact' => 'Do not include contact information (email, phone, social media).',
        'use_messaging' => 'Use the built-in messaging to communicate with providers.',
        'review_info' => 'If you believe this is an error, our team automatically reviews blocked content.',
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
