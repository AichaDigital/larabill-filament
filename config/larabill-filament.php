<?php

declare(strict_types=1);

return [
    /*
    |--------------------------------------------------------------------------
    | Navigation Group
    |--------------------------------------------------------------------------
    |
    | The navigation group for Larabill resources in Filament.
    |
    */
    'navigation_group' => 'Billing',

    /*
    |--------------------------------------------------------------------------
    | Resources
    |--------------------------------------------------------------------------
    |
    | Enable or disable specific resources.
    |
    */
    'resources' => [
        'customer' => true,
        'article' => true,
    ],
];
