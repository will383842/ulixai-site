<?php

return [
    // عناوين الإشعارات
    'titles' => [
        'content_flagged' => 'المحتوى قيد المراجعة',
        'content_approved' => 'تمت الموافقة على المحتوى',
        'content_rejected' => 'لم يتم نشر المحتوى',
        'content_blocked' => 'النشر غير مسموح',
        'strike' => 'تم استلام تحذير',
        'user_banned' => 'تم تعليق الحساب',
        'appeal_approved' => 'تمت الموافقة على الاستئناف',
        'appeal_rejected' => 'تم رفض الاستئناف',
    ],

    // الرسائل
    'messages' => [
        'content_flagged' => ':type الخاص بك قيد المراجعة من قبل فريقنا.',
        'content_approved' => ':type الخاص بك ":title" تمت الموافقة عليه وهو مرئي الآن.',
        'content_rejected' => ':type الخاص بك ":title" لم تتم الموافقة عليه.',
        'content_blocked' => ':type الخاص بك ":title" لا يمكن نشره.',
        'strike_warning' => 'لقد تلقيت تحذيراً (:current/:max).',
        'account_banned' => 'تم تعليق حسابك.',
        'appeal_approved' => 'تم قبول استئنافك.',
        'appeal_rejected' => 'لم يتم قبول استئنافك.',
    ],

    // أسباب الحظر
    'block_reasons' => [
        'inappropriate_content' => 'المحتوى يحتوي على كلمات محظورة.',
        'contact_info_detected' => 'تم اكتشاف معلومات الاتصال. يرجى استخدام نظام المراسلة المدمج.',
        'spam_detected' => 'تم تحديد المحتوى على أنه بريد عشوائي.',
        'default' => 'المحتوى لا يتوافق مع شروط الخدمة لدينا.',
    ],

    // نصائح للمحتوى المحظور
    'blocked_advice' => [
        'intro' => 'ماذا يمكنك أن تفعل؟',
        'modify' => 'عدّل محتواك ليتوافق مع شروط الخدمة لدينا.',
        'no_contact' => 'لا تضمّن معلومات الاتصال (البريد الإلكتروني، الهاتف، وسائل التواصل الاجتماعي).',
        'use_messaging' => 'استخدم نظام المراسلة المدمج للتواصل مع مقدمي الخدمات.',
        'review_info' => 'إذا كنت تعتقد أن هذا خطأ، فإن فريقنا يراجع المحتوى المحظور تلقائياً.',
    ],

    // أنواع المحتوى
    'content_types' => [
        'mission' => 'طلب خدمة',
        'offer' => 'عرض',
        'message' => 'رسالة',
        'content' => 'محتوى',
    ],

    // البريد الإلكتروني
    'email' => [
        'greeting' => 'مرحباً،',
        'salutation' => 'فريق Ulixai',
        'view_content' => 'عرض المحتوى الخاص بي',
        'view_terms' => 'شروط الخدمة',
        'appeal_action' => 'تقديم استئناف',
        'dashboard_action' => 'الذهاب إلى حسابي',
    ],

    // إجراءات المسؤول
    'admin' => [
        'new_content' => 'محتوى جديد للمراجعة',
        'new_report' => 'بلاغ جديد',
        'new_appeal' => 'استئناف جديد',
        'view_queue' => 'عرض قائمة الإشراف',
        'view_reports' => 'عرض البلاغات',
        'view_appeals' => 'عرض الاستئنافات',
    ],
];
