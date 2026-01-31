<?php

return [
    // स्थिति
    'status' => [
        'clean' => 'स्वीकृत',
        'review' => 'समीक्षाधीन',
        'blocked' => 'अवरुद्ध',
        'pending_review' => 'समीक्षा लंबित',
        'approved' => 'स्वीकृत',
        'rejected' => 'अस्वीकृत',
    ],

    // उपयोगकर्ता संदेश
    'account_banned' => 'आपका खाता निलंबित कर दिया गया है।',
    'account_suspended' => 'आपका खाता अस्थायी रूप से निलंबित है।',
    'content_blocked' => 'यह सामग्री हमारे दिशानिर्देशों का उल्लंघन करने के लिए अवरुद्ध कर दी गई है।',
    'content_pending_review' => 'आपकी सामग्री अनुमोदन के लिए लंबित है।',
    'content_approved' => 'सामग्री स्वीकृत।',
    'content_rejected' => 'सामग्री अस्वीकृत।',

    // प्रकाशन सीमाएं
    'daily_limit_reached' => 'आपने अपनी दैनिक प्रकाशन सीमा तक पहुंच गए हैं।',
    'limit_info' => 'आज आपके पास :limit में से :remaining प्रकाशन शेष हैं।',
    'limit_reset' => 'सीमा :time पर रीसेट होगी।',

    // रिपोर्ट
    'report_submitted' => 'आपकी रिपोर्ट जमा कर दी गई है।',
    'report_limit_exceeded' => 'आपने अपनी रिपोर्ट सीमा तक पहुंच गए हैं।',
    'already_reported' => 'आप इस सामग्री की पहले ही रिपोर्ट कर चुके हैं।',
    'report_processed' => 'रिपोर्ट संसाधित।',

    // अपील
    'appeal_submitted' => 'आपकी अपील जमा कर दी गई है।',
    'appeal_not_allowed' => 'आप अपील नहीं कर सकते।',
    'appeal_deadline_passed' => 'अपील की समय सीमा समाप्त हो गई है।',
    'appeal_already_pending' => 'आपकी एक अपील पहले से लंबित है।',
    'appeal_processed' => 'अपील संसाधित।',

    // चेतावनियां
    'strike_issued' => 'चेतावनी जारी।',
    'strike_removed' => 'चेतावनी हटाई गई।',
    'strike_warning' => 'ध्यान दें: आपको एक चेतावनी मिली है (:current/:max)।',
    'strike_reason' => 'कारण: :reason',

    // प्रतिबंध
    'user_banned' => 'उपयोगकर्ता प्रतिबंधित।',
    'user_unbanned' => 'उपयोगकर्ता का प्रतिबंध हटाया गया।',
    'user_suspended' => 'उपयोगकर्ता निलंबित।',
    'user_warned' => 'चेतावनी भेजी गई।',
    'ban_message' => 'निम्नलिखित कारण से आपका खाता निलंबित कर दिया गया है: :reason',
    'ban_appeal' => 'आप :date तक अपील कर सकते हैं।',

    // प्रतिबंधित शब्द
    'word_added' => 'शब्द सूची में जोड़ा गया।',
    'word_updated' => 'शब्द अपडेट किया गया।',
    'word_deleted' => 'शब्द हटाया गया।',

    // रिपोर्ट के कारण
    'reasons' => [
        'inappropriate' => 'अनुचित सामग्री',
        'spam' => 'स्पैम',
        'harassment' => 'उत्पीड़न',
        'fraud' => 'धोखाधड़ी',
        'other' => 'अन्य',
    ],

    // सत्यापन त्रुटियां
    'errors' => [
        'inappropriate_content' => 'आपके संदेश में अनुचित सामग्री है।',
        'contact_info_detected' => 'व्यक्तिगत संपर्क जानकारी साझा करना अनुमत नहीं है।',
        'spam_detected' => 'आपका संदेश स्पैम के रूप में पाया गया।',
    ],
];
