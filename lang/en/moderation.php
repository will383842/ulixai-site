<?php

return [
    // Status
    'status' => [
        'clean' => 'Approved',
        'review' => 'Pending review',
        'blocked' => 'Blocked',
        'pending_review' => 'Pending review',
        'approved' => 'Approved',
        'rejected' => 'Rejected',
    ],

    // User messages
    'account_banned' => 'Your account has been suspended.',
    'account_suspended' => 'Your account is temporarily suspended.',
    'content_blocked' => 'This content has been blocked as it violates our guidelines.',
    'content_pending_review' => 'Your content is pending approval.',
    'content_approved' => 'Content approved.',
    'content_rejected' => 'Content rejected.',

    // Publication limits
    'daily_limit_reached' => 'You have reached your daily publication limit.',
    'limit_info' => 'You have :remaining publication(s) remaining out of :limit today.',
    'limit_reset' => 'The limit will reset at :time.',

    // Reports
    'report_submitted' => 'Your report has been submitted.',
    'report_limit_exceeded' => 'You have reached your report limit.',
    'already_reported' => 'You have already reported this content.',
    'report_processed' => 'Report processed.',

    // Appeals
    'appeal_submitted' => 'Your appeal has been submitted.',
    'appeal_not_allowed' => 'You cannot submit an appeal.',
    'appeal_deadline_passed' => 'The appeal deadline has passed.',
    'appeal_already_pending' => 'You already have a pending appeal.',
    'appeal_processed' => 'Appeal processed.',

    // Strikes
    'strike_issued' => 'Strike issued.',
    'strike_removed' => 'Strike removed.',
    'strike_warning' => 'Warning: you have received a strike (:current/:max).',
    'strike_reason' => 'Reason: :reason',

    // Banning
    'user_banned' => 'User banned.',
    'user_unbanned' => 'User unbanned.',
    'user_suspended' => 'User suspended.',
    'user_warned' => 'Warning sent.',
    'ban_message' => 'Your account has been suspended for the following reason: :reason',
    'ban_appeal' => 'You can appeal until :date.',

    // Banned words
    'word_added' => 'Word added to list.',
    'word_updated' => 'Word updated.',
    'word_deleted' => 'Word deleted.',

    // Report reasons
    'reasons' => [
        'inappropriate' => 'Inappropriate content',
        'spam' => 'Spam',
        'harassment' => 'Harassment',
        'fraud' => 'Fraud/Scam',
        'other' => 'Other',
    ],

    // Validation errors
    'errors' => [
        'inappropriate_content' => 'Your message contains inappropriate content.',
        'contact_info_detected' => 'Sharing personal contact information is not allowed.',
        'spam_detected' => 'Your message has been detected as spam.',
    ],
];
