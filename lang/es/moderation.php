<?php

return [
    // Estados
    'status' => [
        'clean' => 'Aprobado',
        'review' => 'En revisión',
        'blocked' => 'Bloqueado',
        'pending_review' => 'Pendiente de revisión',
        'approved' => 'Aprobado',
        'rejected' => 'Rechazado',
    ],

    // Mensajes de usuario
    'account_banned' => 'Tu cuenta ha sido suspendida.',
    'account_suspended' => 'Tu cuenta está temporalmente suspendida.',
    'content_blocked' => 'Este contenido ha sido bloqueado por violar nuestras normas.',
    'content_pending_review' => 'Tu contenido está pendiente de aprobación.',
    'content_approved' => 'Contenido aprobado.',
    'content_rejected' => 'Contenido rechazado.',

    // Límites de publicación
    'daily_limit_reached' => 'Has alcanzado tu límite diario de publicaciones.',
    'limit_info' => 'Te quedan :remaining publicación(es) de :limit hoy.',
    'limit_reset' => 'El límite se restablecerá a las :time.',

    // Reportes
    'report_submitted' => 'Tu reporte ha sido enviado.',
    'report_limit_exceeded' => 'Has alcanzado tu límite de reportes.',
    'already_reported' => 'Ya has reportado este contenido.',
    'report_processed' => 'Reporte procesado.',

    // Apelaciones
    'appeal_submitted' => 'Tu apelación ha sido enviada.',
    'appeal_not_allowed' => 'No puedes presentar una apelación.',
    'appeal_deadline_passed' => 'El plazo para apelar ha expirado.',
    'appeal_already_pending' => 'Ya tienes una apelación pendiente.',
    'appeal_processed' => 'Apelación procesada.',

    // Strikes
    'strike_issued' => 'Advertencia emitida.',
    'strike_removed' => 'Advertencia eliminada.',
    'strike_warning' => 'Atención: has recibido una advertencia (:current/:max).',
    'strike_reason' => 'Razón: :reason',

    // Baneo
    'user_banned' => 'Usuario baneado.',
    'user_unbanned' => 'Usuario desbaneado.',
    'user_suspended' => 'Usuario suspendido.',
    'user_warned' => 'Advertencia enviada.',
    'ban_message' => 'Tu cuenta ha sido suspendida por la siguiente razón: :reason',
    'ban_appeal' => 'Puedes apelar hasta el :date.',

    // Palabras prohibidas
    'word_added' => 'Palabra añadida a la lista.',
    'word_updated' => 'Palabra actualizada.',
    'word_deleted' => 'Palabra eliminada.',

    // Razones de reporte
    'reasons' => [
        'inappropriate' => 'Contenido inapropiado',
        'spam' => 'Spam',
        'harassment' => 'Acoso',
        'fraud' => 'Fraude/Estafa',
        'other' => 'Otro',
    ],

    // Errores de validación
    'errors' => [
        'inappropriate_content' => 'Tu mensaje contiene contenido inapropiado.',
        'contact_info_detected' => 'No está permitido compartir información de contacto personal.',
        'spam_detected' => 'Tu mensaje ha sido detectado como spam.',
    ],
];
