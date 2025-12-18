<?php

declare(strict_types=1);

return [
    'fiscal_integrity' => [
        'title_global' => 'CRÍTICO: Integridad Fiscal Comprometida - Facturación Bloqueada',
        'title_atomic' => 'URGENTE: Problema de Integridad Fiscal en Usuarios',

        'message_global' => 'Se han detectado múltiples configuraciones fiscales de empresa activas. TODA la facturación está bloqueada hasta que se resuelva este problema.',
        'message_atomic' => 'Se han detectado múltiples perfiles fiscales activos para :count usuario(s). La facturación a estos usuarios está bloqueada.',

        'action_resolve' => 'Resolver Configuración Fiscal',
        'action_view_users' => 'Ver Usuarios Afectados',

        'issues_count' => ':count problema|:count problemas',
        'affected_users' => 'Usuarios afectados',
        'and_more' => 'y :count más',
    ],
];
