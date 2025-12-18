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
            'pricing' => 'Pricing',
            'recurring' => 'Recurring Billing',
            'status' => 'Status',
        ],

        'fields' => [
            'code' => 'Code',
            'name' => 'Name',
            'description' => 'Description',
            'item_type' => 'Type',
            'item_type_helper' => 'Good: physical product. Service: service provision.',
            'category' => 'Category',
            'base_price' => 'Base Price',
            'cost_price' => 'Cost Price',
            'tax_group' => 'Tax Group',
            'unit_measure' => 'Unit of Measure',
            'is_recurring' => 'Recurring',
            'billing_frequency' => 'Billing Frequency',
            'billing_interval' => 'Billing Interval',
            'billing_days_in_advance' => 'Days in Advance',
            'is_active' => 'Active',
            'created_at' => 'Created At',
        ],
    ],
];
