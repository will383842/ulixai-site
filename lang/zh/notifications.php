<?php

return [
    // 通知标题
    'titles' => [
        'content_flagged' => '内容审核中',
        'content_approved' => '内容已批准',
        'content_rejected' => '内容未发布',
        'content_blocked' => '发布不被允许',
        'strike' => '收到警告',
        'user_banned' => '账户已暂停',
        'appeal_approved' => '申诉已批准',
        'appeal_rejected' => '申诉已拒绝',
    ],

    // 消息
    'messages' => [
        'content_flagged' => '您的:type正在由我们的团队审核。',
        'content_approved' => '您的:type「:title」已获批准，现已可见。',
        'content_rejected' => '您的:type「:title」未获批准。',
        'content_blocked' => '您的:type「:title」无法发布。',
        'strike_warning' => '您已收到警告（:current/:max）。',
        'account_banned' => '您的账户已被暂停。',
        'appeal_approved' => '您的申诉已被接受。',
        'appeal_rejected' => '您的申诉未被接受。',
    ],

    // 屏蔽原因
    'block_reasons' => [
        'inappropriate_content' => '内容包含禁止使用的词语。',
        'contact_info_detected' => '检测到联系方式。请使用内置消息系统。',
        'spam_detected' => '内容被识别为垃圾信息。',
        'default' => '内容不符合我们的服务条款。',
    ],

    // 被屏蔽内容的建议
    'blocked_advice' => [
        'intro' => '您可以怎么做？',
        'modify' => '修改您的内容以符合我们的服务条款。',
        'no_contact' => '请勿包含联系方式（电子邮件、电话、社交媒体）。',
        'use_messaging' => '使用内置消息系统与服务提供商沟通。',
        'review_info' => '如果您认为这是错误的，我们的团队会自动审核被屏蔽的内容。',
    ],

    // 内容类型
    'content_types' => [
        'mission' => '服务请求',
        'offer' => '提案',
        'message' => '消息',
        'content' => '内容',
    ],

    // 电子邮件
    'email' => [
        'greeting' => '您好，',
        'salutation' => 'Ulixai团队',
        'view_content' => '查看我的内容',
        'view_terms' => '服务条款',
        'appeal_action' => '提交申诉',
        'dashboard_action' => '前往我的账户',
    ],

    // 管理员操作
    'admin' => [
        'new_content' => '新内容待审核',
        'new_report' => '新举报',
        'new_appeal' => '新申诉',
        'view_queue' => '查看审核队列',
        'view_reports' => '查看举报',
        'view_appeals' => '查看申诉',
    ],
];
