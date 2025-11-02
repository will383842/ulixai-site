<?php

return [

    // 'internal' (par défaut) ou 'external'
    'driver' => env('MESSAGES_DRIVER', 'internal'),

    // Sources (tu peux mettre plusieurs candidats de noms de tables)
    'sources' => [
        'press' => [
            'tables' => ['press_inquiries', 'press_messages', 'press_contacts'],
            'id' => 'id',
            // Candidates de colonnes (auto-détection)
            'name_candidates' => ['name','media','company','title','fullname','full_name'],
            'email_candidates' => ['email','email_address','contact_email'],
            'message_candidates' => ['message','content','description','body','text'],
            'status_candidates' => ['status','native_status','state'],
            'created_at_candidates' => ['created_at','createdOn','createdat','created_date','createdDate','date_created'],
            'read_flags' => ['is_read','read','seen'],
            'processed_flags' => ['is_processed','processed','handled'],
        ],
        'reportbug' => [
            'tables' => ['bug_reports','reports_bug','report_bugs'],
            'id' => 'id',
            'name_candidates' => ['name','fullname','full_name','reporter','user_name'],
            'email_candidates' => ['email','email_address','contact_email'],
            'message_candidates' => ['description','message','content','body','text'],
            'status_candidates' => ['status','native_status','state'],
            'created_at_candidates' => ['created_at','createdOn','createdat','created_date','createdDate','date_created'],
            'read_flags' => ['is_read','read','seen'],
            'processed_flags' => ['is_processed','processed','handled'],
        ],
        'partner' => [
            'tables' => ['partner_requests','partners_requests','partner_contacts'],
            'id' => 'id',
            'name_candidates' => ['name','company','contact_name','fullname','full_name'],
            'email_candidates' => ['email','email_address','contact_email'],
            'message_candidates' => ['message','content','description','body','notes'],
            'status_candidates' => ['status','native_status','state'],
            'created_at_candidates' => ['created_at','createdOn','createdat','created_date','createdDate','date_created'],
            'read_flags' => ['is_read','read','seen'],
            'processed_flags' => ['is_processed','processed','handled'],
        ],
        'recruitment' => [
            'tables' => ['recruitment_applications','applications','jobs_applications'],
            'id' => 'id',
            'name_candidates' => ['name','fullname','full_name','candidate_name'],
            'email_candidates' => ['email','email_address','contact_email'],
            'message_candidates' => ['cover_letter','message','content','motivation','body'],
            'status_candidates' => ['status','native_status','state'],
            'created_at_candidates' => ['created_at','createdOn','createdat','created_date','createdDate','date_created'],
            'read_flags' => ['is_read','read','seen'],
            'processed_flags' => ['is_processed','processed','handled'],
        ],
    ],

    // Driver externe (optionnel)
    'external' => [
        'url' => env('MESSAGES_EXTERNAL_URL', ''),
        'token' => env('MESSAGES_EXTERNAL_TOKEN', null),
    ],
];
