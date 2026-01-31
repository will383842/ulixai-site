<?php

return [
    // Status
    'status' => [
        'clean' => 'Aprovado',
        'review' => 'Em revisão',
        'blocked' => 'Bloqueado',
        'pending_review' => 'Pendente de revisão',
        'approved' => 'Aprovado',
        'rejected' => 'Rejeitado',
    ],

    // Mensagens do usuário
    'account_banned' => 'Sua conta foi suspensa.',
    'account_suspended' => 'Sua conta está temporariamente suspensa.',
    'content_blocked' => 'Este conteúdo foi bloqueado por violar nossas diretrizes.',
    'content_pending_review' => 'Seu conteúdo está aguardando aprovação.',
    'content_approved' => 'Conteúdo aprovado.',
    'content_rejected' => 'Conteúdo rejeitado.',

    // Limites de publicação
    'daily_limit_reached' => 'Você atingiu seu limite diário de publicações.',
    'limit_info' => 'Você tem :remaining publicação(ões) restantes de :limit hoje.',
    'limit_reset' => 'O limite será redefinido às :time.',

    // Denúncias
    'report_submitted' => 'Sua denúncia foi enviada.',
    'report_limit_exceeded' => 'Você atingiu seu limite de denúncias.',
    'already_reported' => 'Você já denunciou este conteúdo.',
    'report_processed' => 'Denúncia processada.',

    // Apelações
    'appeal_submitted' => 'Sua apelação foi enviada.',
    'appeal_not_allowed' => 'Você não pode fazer uma apelação.',
    'appeal_deadline_passed' => 'O prazo para apelar expirou.',
    'appeal_already_pending' => 'Você já tem uma apelação pendente.',
    'appeal_processed' => 'Apelação processada.',

    // Strikes
    'strike_issued' => 'Advertência emitida.',
    'strike_removed' => 'Advertência removida.',
    'strike_warning' => 'Atenção: você recebeu uma advertência (:current/:max).',
    'strike_reason' => 'Motivo: :reason',

    // Banimento
    'user_banned' => 'Usuário banido.',
    'user_unbanned' => 'Usuário desbanido.',
    'user_suspended' => 'Usuário suspenso.',
    'user_warned' => 'Aviso enviado.',
    'ban_message' => 'Sua conta foi suspensa pelo seguinte motivo: :reason',
    'ban_appeal' => 'Você pode apelar até :date.',

    // Palavras proibidas
    'word_added' => 'Palavra adicionada à lista.',
    'word_updated' => 'Palavra atualizada.',
    'word_deleted' => 'Palavra excluída.',

    // Razões de denúncia
    'reasons' => [
        'inappropriate' => 'Conteúdo impróprio',
        'spam' => 'Spam',
        'harassment' => 'Assédio',
        'fraud' => 'Fraude/Golpe',
        'other' => 'Outro',
    ],

    // Erros de validação
    'errors' => [
        'inappropriate_content' => 'Sua mensagem contém conteúdo impróprio.',
        'contact_info_detected' => 'Compartilhar informações de contato pessoal não é permitido.',
        'spam_detected' => 'Sua mensagem foi detectada como spam.',
    ],
];
