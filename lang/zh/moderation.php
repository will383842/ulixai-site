<?php

return [
    // 状态
    'status' => [
        'clean' => '已批准',
        'review' => '审核中',
        'blocked' => '已屏蔽',
        'pending_review' => '待审核',
        'approved' => '已批准',
        'rejected' => '已拒绝',
    ],

    // 用户消息
    'account_banned' => '您的账户已被暂停。',
    'account_suspended' => '您的账户已被临时暂停。',
    'content_blocked' => '此内容因违反我们的规定而被屏蔽。',
    'content_pending_review' => '您的内容正在等待审批。',
    'content_approved' => '内容已批准。',
    'content_rejected' => '内容已拒绝。',

    // 发布限制
    'daily_limit_reached' => '您已达到每日发布限制。',
    'limit_info' => '今天您还剩余 :remaining 次发布机会（共 :limit 次）。',
    'limit_reset' => '限制将于 :time 重置。',

    // 举报
    'report_submitted' => '您的举报已提交。',
    'report_limit_exceeded' => '您已达到举报限制。',
    'already_reported' => '您已举报过此内容。',
    'report_processed' => '举报已处理。',

    // 申诉
    'appeal_submitted' => '您的申诉已提交。',
    'appeal_not_allowed' => '您无法提交申诉。',
    'appeal_deadline_passed' => '申诉截止日期已过。',
    'appeal_already_pending' => '您已有待处理的申诉。',
    'appeal_processed' => '申诉已处理。',

    // 警告
    'strike_issued' => '已发出警告。',
    'strike_removed' => '警告已移除。',
    'strike_warning' => '注意：您已收到一次警告（:current/:max）。',
    'strike_reason' => '原因：:reason',

    // 封禁
    'user_banned' => '用户已被封禁。',
    'user_unbanned' => '用户已解封。',
    'user_suspended' => '用户已被暂停。',
    'user_warned' => '警告已发送。',
    'ban_message' => '您的账户因以下原因被暂停：:reason',
    'ban_appeal' => '您可以在 :date 之前提出申诉。',

    // 违禁词
    'word_added' => '词语已添加到列表。',
    'word_updated' => '词语已更新。',
    'word_deleted' => '词语已删除。',

    // 举报原因
    'reasons' => [
        'inappropriate' => '不当内容',
        'spam' => '垃圾信息',
        'harassment' => '骚扰',
        'fraud' => '欺诈/诈骗',
        'other' => '其他',
    ],

    // 验证错误
    'errors' => [
        'inappropriate_content' => '您的消息包含不当内容。',
        'contact_info_detected' => '不允许分享个人联系信息。',
        'spam_detected' => '您的消息被检测为垃圾信息。',
    ],
];
