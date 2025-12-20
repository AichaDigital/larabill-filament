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
            'pricing' => 'Configuración de Precios',
            'pricing_description' => 'Los precios por frecuencia se gestionan en la pestaña "Precios" después de guardar.',
            'status' => 'Estado',
        ],

        'fields' => [
            'code' => 'Código',
            'name' => 'Nombre',
            'description' => 'Descripción',
            'item_type' => 'Tipo',
            'item_type_helper' => 'Bien: producto físico. Servicio: prestación de servicios.',
            'category' => 'Categoría',
            'cost_price' => 'Precio de Coste',
            'cost_price_helper' => 'Coste interno (no visible al cliente)',
            'tax_group' => 'Grupo de Impuestos',
            'unit_measure' => 'Unidad de Medida',
            'prices_count' => 'Precios',
            'is_active' => 'Activo',
            'created_at' => 'Creado',
        ],

        'relations' => [
            'prices' => [
                'title' => 'Precios',
                'fields' => [
                    'billing_frequency' => 'Frecuencia',
                    'price' => 'Precio',
                    'billing_days_in_advance' => 'Días Antelación',
                    'is_active' => 'Activo',
                    'valid_from' => 'Válido Desde',
                    'valid_to' => 'Válido Hasta',
                ],
            ],
        ],
    ],
];
