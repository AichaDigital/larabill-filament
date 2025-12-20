<?php

return [
    'customer' => [
        'navigation_label' => 'Customers',
        'model_label' => 'Customer',
        'plural_model_label' => 'Customers',

        'sections' => [
            'basic_info' => 'Basic Information',
            'status' => 'Status',
            'notes' => 'Notes',
        ],

        'fields' => [
            'display_name' => 'Name',
            'internal_code' => 'Internal Code',
            'relationship_type' => 'Relationship Type',
            'legal_entity_type' => 'Legal Entity Type',
            'is_active' => 'Active',
            'inactive_since' => 'Inactive Since',
            'inactive_reason' => 'Inactive Reason',
            'notes' => 'Notes',
            'tax_id' => 'Tax ID',
            'created_at' => 'Created At',
        ],
    ],

    'article' => [
        'navigation_label' => 'Articles',
        'model_label' => 'Article',
        'plural_model_label' => 'Articles',

        'sections' => [
            'basic_info' => 'Basic Information',
            'pricing' => 'Pricing Configuration',
            'pricing_description' => 'Prices by frequency are managed in the "Prices" tab after saving.',
            'status' => 'Status',
        ],

        'fields' => [
            'code' => 'Code',
            'name' => 'Name',
            'description' => 'Description',
            'item_type' => 'Type',
            'item_type_helper' => 'Good: physical product. Service: service provision.',
            'category' => 'Category',
            'cost_price' => 'Cost Price',
            'cost_price_helper' => 'Internal cost (not visible to customer)',
            'tax_group' => 'Tax Group',
            'unit_measure' => 'Unit of Measure',
            'prices_count' => 'Prices',
            'is_active' => 'Active',
            'created_at' => 'Created At',
        ],

        'relations' => [
            'prices' => [
                'title' => 'Prices',
                'fields' => [
                    'billing_frequency' => 'Frequency',
                    'price' => 'Price',
                    'billing_days_in_advance' => 'Days in Advance',
                    'is_active' => 'Active',
                    'valid_from' => 'Valid From',
                    'valid_to' => 'Valid Until',
                ],
            ],
        ],
    ],
];
