<?php

return [
    'customer' => [
        'navigation_label' => 'Clientes',
        'model_label' => 'Cliente',
        'plural_model_label' => 'Clientes',

        'sections' => [
            'basic_info' => 'Información Básica',
            'status' => 'Estado',
            'notes' => 'Notas',
        ],

        'fields' => [
            'display_name' => 'Nombre',
            'internal_code' => 'Código Interno',
            'relationship_type' => 'Tipo de Relación',
            'legal_entity_type' => 'Tipo de Entidad Legal',
            'is_active' => 'Activo',
            'inactive_since' => 'Inactivo Desde',
            'inactive_reason' => 'Motivo de Inactividad',
            'notes' => 'Notas',
            'tax_id' => 'NIF/CIF',
            'created_at' => 'Creado',
        ],
    ],

    'article' => [
        'navigation_label' => 'Artículos',
        'model_label' => 'Artículo',
        'plural_model_label' => 'Artículos',

        'sections' => [
            'basic_info' => 'Información Básica',
            'pricing' => 'Precios',
            'recurring' => 'Facturación Recurrente',
            'status' => 'Estado',
        ],

        'fields' => [
            'code' => 'Código',
            'name' => 'Nombre',
            'description' => 'Descripción',
            'item_type' => 'Tipo',
            'category' => 'Categoría',
            'base_price' => 'Precio Base',
            'cost_price' => 'Precio de Coste',
            'tax_group' => 'Grupo de Impuestos',
            'unit_measure' => 'Unidad de Medida',
            'is_recurring' => 'Recurrente',
            'billing_frequency' => 'Frecuencia de Facturación',
            'billing_interval' => 'Intervalo de Facturación',
            'billing_days_in_advance' => 'Días de Antelación',
            'is_active' => 'Activo',
            'created_at' => 'Creado',
        ],
    ],
];
