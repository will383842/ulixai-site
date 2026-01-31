<?php

return [
    // الحالات
    'status' => [
        'clean' => 'موافق عليه',
        'review' => 'قيد المراجعة',
        'blocked' => 'محظور',
        'pending_review' => 'في انتظار المراجعة',
        'approved' => 'موافق عليه',
        'rejected' => 'مرفوض',
    ],

    // رسائل المستخدم
    'account_banned' => 'تم تعليق حسابك.',
    'account_suspended' => 'تم تعليق حسابك مؤقتاً.',
    'content_blocked' => 'تم حظر هذا المحتوى لمخالفته إرشاداتنا.',
    'content_pending_review' => 'محتواك في انتظار الموافقة.',
    'content_approved' => 'تمت الموافقة على المحتوى.',
    'content_rejected' => 'تم رفض المحتوى.',

    // حدود النشر
    'daily_limit_reached' => 'لقد وصلت إلى الحد اليومي للنشر.',
    'limit_info' => 'لديك :remaining منشور(ات) متبقية من :limit اليوم.',
    'limit_reset' => 'سيتم إعادة تعيين الحد في :time.',

    // البلاغات
    'report_submitted' => 'تم إرسال بلاغك.',
    'report_limit_exceeded' => 'لقد وصلت إلى حد البلاغات.',
    'already_reported' => 'لقد أبلغت عن هذا المحتوى بالفعل.',
    'report_processed' => 'تمت معالجة البلاغ.',

    // الاستئنافات
    'appeal_submitted' => 'تم إرسال استئنافك.',
    'appeal_not_allowed' => 'لا يمكنك تقديم استئناف.',
    'appeal_deadline_passed' => 'انتهى الموعد النهائي للاستئناف.',
    'appeal_already_pending' => 'لديك استئناف قيد الانتظار بالفعل.',
    'appeal_processed' => 'تمت معالجة الاستئناف.',

    // التحذيرات
    'strike_issued' => 'تم إصدار تحذير.',
    'strike_removed' => 'تمت إزالة التحذير.',
    'strike_warning' => 'تنبيه: لقد تلقيت تحذيراً (:current/:max).',
    'strike_reason' => 'السبب: :reason',

    // الحظر
    'user_banned' => 'تم حظر المستخدم.',
    'user_unbanned' => 'تم إلغاء حظر المستخدم.',
    'user_suspended' => 'تم تعليق المستخدم.',
    'user_warned' => 'تم إرسال التحذير.',
    'ban_message' => 'تم تعليق حسابك للسبب التالي: :reason',
    'ban_appeal' => 'يمكنك الاستئناف حتى :date.',

    // الكلمات المحظورة
    'word_added' => 'تمت إضافة الكلمة إلى القائمة.',
    'word_updated' => 'تم تحديث الكلمة.',
    'word_deleted' => 'تم حذف الكلمة.',

    // أسباب البلاغ
    'reasons' => [
        'inappropriate' => 'محتوى غير لائق',
        'spam' => 'بريد مزعج',
        'harassment' => 'مضايقة',
        'fraud' => 'احتيال',
        'other' => 'أخرى',
    ],

    // أخطاء التحقق
    'errors' => [
        'inappropriate_content' => 'رسالتك تحتوي على محتوى غير لائق.',
        'contact_info_detected' => 'مشاركة معلومات الاتصال الشخصية غير مسموح بها.',
        'spam_detected' => 'تم اكتشاف رسالتك كبريد مزعج.',
    ],
];
