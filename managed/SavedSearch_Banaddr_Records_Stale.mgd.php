<?php
use CRM_Civisolraddr_ExtensionUtil as E;

return [
  [
    'name' => 'SavedSearch_Banaddr_Records_Stale',
    'entity' => 'SavedSearch',
    'cleanup' => 'always',
    'update' => 'always',
    'params' => [
      'version' => 4,
      'values' => [
        'name' => 'Banaddr_Records_Stale',
        'label' => E::ts('Banaddr Records : Stale'),
        'api_entity' => 'Banaddr',
        'api_params' => [
          'version' => 4,
          'select' => [
            'numero',
            'rep',
            'Banaddr_Address_addr_id_01.street_address',
            'nom_commune',
            'Banaddr_Address_addr_id_01.city',
            'Banaddr_Address_addr_id_01_Address_Contact_contact_id_01.sort_name',
            'nom_voie',
          ],
          'orderBy' => [],
          'where' => [
            [
              'validation:name',
              '=',
              'stale',
            ],
          ],
          'groupBy' => [],
          'join' => [
            [
              'Address AS Banaddr_Address_addr_id_01',
              'INNER',
              [
                'addr_id',
                '=',
                'Banaddr_Address_addr_id_01.id',
              ],
            ],
            [
              'Contact AS Banaddr_Address_addr_id_01_Address_Contact_contact_id_01',
              'LEFT',
              [
                'Banaddr_Address_addr_id_01.contact_id',
                '=',
                'Banaddr_Address_addr_id_01_Address_Contact_contact_id_01.id',
              ],
            ],
          ],
          'having' => [],
        ],
      ],
      'match' => [
        'name',
      ],
    ],
  ],
  [
    'name' => 'SavedSearch_Banaddr_Records_Stale_SearchDisplay_Banaddr_Records_Stale_Table',
    'entity' => 'SearchDisplay',
    'cleanup' => 'always',
    'update' => 'always',
    'params' => [
      'version' => 4,
      'values' => [
        'name' => 'Banaddr_Records_Stale_Table',
        'label' => E::ts('Banaddr Records : Stale Table'),
        'saved_search_id.name' => 'Banaddr_Records_Stale',
        'type' => 'table',
        'settings' => [
          'description' => '',
          'sort' => [
            [
              'id',
              'ASC',
            ],
          ],
          'limit' => 0,
          'pager' => FALSE,
          'placeholder' => 5,
          'columns' => [
            [
              'type' => 'field',
              'key' => 'numero',
              'dataType' => 'Integer',
              'label' => E::ts('Proposition : numéro'),
              'sortable' => TRUE,
            ],
            [
              'type' => 'field',
              'key' => 'rep',
              'dataType' => 'String',
              'label' => E::ts('Proposition : suffixe'),
              'sortable' => TRUE,
            ],
            [
              'type' => 'field',
              'key' => 'nom_voie',
              'dataType' => 'String',
              'label' => E::ts('Proposition: rue'),
              'sortable' => TRUE,
            ],
            [
              'type' => 'field',
              'key' => 'Banaddr_Address_addr_id_01.street_address',
              'dataType' => 'String',
              'label' => E::ts('Saisie : rue'),
              'sortable' => TRUE,
            ],
            [
              'type' => 'field',
              'key' => 'nom_commune',
              'dataType' => 'String',
              'label' => E::ts('Proposition : ville'),
              'sortable' => TRUE,
            ],
            [
              'type' => 'field',
              'key' => 'Banaddr_Address_addr_id_01.city',
              'dataType' => 'String',
              'label' => E::ts('Saisie : ville'),
              'sortable' => TRUE,
            ],
            [
              'type' => 'field',
              'key' => 'Banaddr_Address_addr_id_01_Address_Contact_contact_id_01.sort_name',
              'dataType' => 'String',
              'label' => E::ts('Contact'),
              'sortable' => TRUE,
              'icons' => [
                [
                  'field' => 'Banaddr_Address_addr_id_01_Address_Contact_contact_id_01.contact_type:icon',
                  'side' => 'left',
                ],
              ],
            ],
            [
              'links' => [
                [
                  'entity' => 'Contact',
                  'action' => 'update',
                  'join' => 'Banaddr_Address_addr_id_01_Address_Contact_contact_id_01',
                  'target' => '',
                  'icon' => 'fa-pencil',
                  'text' => E::ts("Modifier l'adresse"),
                  'style' => 'default',
                  'path' => '',
                  'task' => '',
                  'conditions' => [],
                ],
              ],
              'type' => 'links',
              'alignment' => 'text-right',
              'label' => E::ts("Modifier l'adresse"),
            ],
          ],
          'actions' => [],
          'classes' => [
            'table',
            'table-striped',
          ],
          'actions_display_mode' => 'menu',
        ],
      ],
      'match' => [
        'name',
      ],
    ],
  ],
];
