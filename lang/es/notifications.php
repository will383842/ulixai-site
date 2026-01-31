<?php

return [
    // Títulos de notificaciones
    'titles' => [
        'content_flagged' => 'Contenido en revisión',
        'content_approved' => 'Contenido aprobado',
        'content_rejected' => 'Contenido no publicado',
        'content_blocked' => 'Publicación no permitida',
        'strike' => 'Advertencia recibida',
        'user_banned' => 'Cuenta suspendida',
        'appeal_approved' => 'Apelación aprobada',
        'appeal_rejected' => 'Apelación rechazada',
    ],

    // Mensajes
    'messages' => [
        'content_flagged' => 'Su :type está siendo revisado por nuestro equipo.',
        'content_approved' => 'Su :type ":title" ha sido aprobado y ahora es visible.',
        'content_rejected' => 'Su :type ":title" no fue aprobado.',
        'content_blocked' => 'Su :type ":title" no pudo ser publicado.',
        'strike_warning' => 'Ha recibido una advertencia (:current/:max).',
        'account_banned' => 'Su cuenta ha sido suspendida.',
        'appeal_approved' => 'Su apelación ha sido aceptada.',
        'appeal_rejected' => 'Su apelación no fue aceptada.',
    ],

    // Razones de bloqueo
    'block_reasons' => [
        'inappropriate_content' => 'El contenido contiene términos prohibidos.',
        'contact_info_detected' => 'Se detectó información de contacto. Por favor, utilice la mensajería integrada.',
        'spam_detected' => 'El contenido fue identificado como spam.',
        'default' => 'El contenido no cumple con nuestros términos de servicio.',
    ],

    // Consejos para contenido bloqueado
    'blocked_advice' => [
        'intro' => '¿Qué puede hacer?',
        'modify' => 'Modifique su contenido para cumplir con nuestros términos de servicio.',
        'no_contact' => 'No incluya información de contacto (correo, teléfono, redes sociales).',
        'use_messaging' => 'Use la mensajería integrada para comunicarse con los proveedores.',
        'review_info' => 'Si cree que es un error, nuestro equipo revisa automáticamente los contenidos bloqueados.',
    ],

    // Tipos de contenido
    'content_types' => [
        'mission' => 'solicitud de servicio',
        'offer' => 'propuesta',
        'message' => 'mensaje',
        'content' => 'contenido',
    ],

    // Emails
    'email' => [
        'greeting' => 'Hola,',
        'salutation' => 'El equipo de Ulixai',
        'view_content' => 'Ver mi contenido',
        'view_terms' => 'Términos de servicio',
        'appeal_action' => 'Presentar apelación',
        'dashboard_action' => 'Ir a mi cuenta',
    ],

    // Acciones de administrador
    'admin' => [
        'new_content' => 'Nuevo contenido para revisar',
        'new_report' => 'Nueva denuncia',
        'new_appeal' => 'Nueva apelación',
        'view_queue' => 'Ver cola de moderación',
        'view_reports' => 'Ver denuncias',
        'view_appeals' => 'Ver apelaciones',
    ],
];
