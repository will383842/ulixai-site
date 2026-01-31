<?php

return [
    // Títulos de notificações
    'titles' => [
        'content_flagged' => 'Conteúdo em análise',
        'content_approved' => 'Conteúdo aprovado',
        'content_rejected' => 'Conteúdo não publicado',
        'content_blocked' => 'Publicação não permitida',
        'strike' => 'Advertência recebida',
        'user_banned' => 'Conta suspensa',
        'appeal_approved' => 'Recurso aprovado',
        'appeal_rejected' => 'Recurso rejeitado',
    ],

    // Mensagens
    'messages' => [
        'content_flagged' => 'Seu :type está sendo analisado pela nossa equipe.',
        'content_approved' => 'Seu :type ":title" foi aprovado e agora está visível.',
        'content_rejected' => 'Seu :type ":title" não foi aprovado.',
        'content_blocked' => 'Seu :type ":title" não pôde ser publicado.',
        'strike_warning' => 'Você recebeu uma advertência (:current/:max).',
        'account_banned' => 'Sua conta foi suspensa.',
        'appeal_approved' => 'Seu recurso foi aceito.',
        'appeal_rejected' => 'Seu recurso não foi aceito.',
    ],

    // Motivos de bloqueio
    'block_reasons' => [
        'inappropriate_content' => 'O conteúdo contém termos proibidos.',
        'contact_info_detected' => 'Informações de contato foram detectadas. Por favor, use a mensageria integrada.',
        'spam_detected' => 'O conteúdo foi identificado como spam.',
        'default' => 'O conteúdo não está em conformidade com nossos termos de serviço.',
    ],

    // Conselhos para conteúdo bloqueado
    'blocked_advice' => [
        'intro' => 'O que você pode fazer?',
        'modify' => 'Modifique seu conteúdo para cumprir nossos termos de serviço.',
        'no_contact' => 'Não inclua informações de contato (e-mail, telefone, redes sociais).',
        'use_messaging' => 'Use a mensageria integrada para se comunicar com os prestadores.',
        'review_info' => 'Se você acredita que é um erro, nossa equipe revisa automaticamente os conteúdos bloqueados.',
    ],

    // Tipos de conteúdo
    'content_types' => [
        'mission' => 'solicitação de serviço',
        'offer' => 'proposta',
        'message' => 'mensagem',
        'content' => 'conteúdo',
    ],

    // E-mails
    'email' => [
        'greeting' => 'Olá,',
        'salutation' => 'A equipe Ulixai',
        'view_content' => 'Ver meu conteúdo',
        'view_terms' => 'Termos de serviço',
        'appeal_action' => 'Fazer recurso',
        'dashboard_action' => 'Ir para minha conta',
    ],

    // Ações de administrador
    'admin' => [
        'new_content' => 'Novo conteúdo para analisar',
        'new_report' => 'Nova denúncia',
        'new_appeal' => 'Novo recurso',
        'view_queue' => 'Ver fila de moderação',
        'view_reports' => 'Ver denúncias',
        'view_appeals' => 'Ver recursos',
    ],
];
