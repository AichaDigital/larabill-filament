<?php

declare(strict_types=1);

return [
    'fiscal_integrity' => [
        'title_global' => 'CRITICAL: Fiscal Integrity Compromised - Invoicing Blocked',
        'title_atomic' => 'URGENT: User Fiscal Integrity Issue',

        'message_global' => 'Multiple active company fiscal configurations detected. ALL invoicing is blocked until this issue is resolved.',
        'message_atomic' => 'Multiple active tax profiles detected for :count user(s). Invoicing to these users is blocked.',

        'action_resolve' => 'Resolve Fiscal Configuration',
        'action_view_users' => 'View Affected Users',

        'issues_count' => ':count issue|:count issues',
        'affected_users' => 'Affected users',
        'and_more' => 'and :count more',
    ],
];
