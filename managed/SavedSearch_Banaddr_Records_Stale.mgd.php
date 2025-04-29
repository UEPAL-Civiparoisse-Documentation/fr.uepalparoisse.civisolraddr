<?php
use CRM_Civisolraddr_ExtensionUtil as E;

return [
  [
    'name' => 'SavedSearch_Banaddr_Records_Stale',
    'entity' => 'SavedSearch',
    'cleanup' => 'unused',
    'update' => 'unmodified',
    'params' => [
      'version' => 4,
      'values' => [
        'name' => 'Banaddr_Records_Stale',
        'label' => E::ts('Banaddr Records : Stale'),
        'api_entity' => 'Banaddr',
        'api_params' => [
          'version' => 4,
          'select' => [
            'id',
            'addr_id',
            'Banaddr_Address_addr_id_01.street_address',
            'modified',
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
          ],
          'having' => [],
        ],
      ],
      'match' => ['name'],
    ],
  ],
  [
    'name' => 'SavedSearch_Banaddr_Records_Stale_SearchDisplay_Banaddr_Records_Stale_Table',
    'entity' => 'SearchDisplay',
    'cleanup' => 'unused',
    'update' => 'unmodified',
    'params' => [
      'version' => 4,
      'values' => [
        'name' => 'Banaddr_Records_Stale_Table',
        'label' => E::ts('Banaddr Records : Stale Table'),
        'saved_search_id.name' => 'Banaddr_Records_Stale',
        'type' => 'table',
        'settings' => [
          'description' => E::ts(NULL),
          'sort' => [
            ['id', 'ASC'],
          ],
          'limit' => 0,
          'pager' => FALSE,
          'placeholder' => 5,
          'columns' => [
            [
              'type' => 'field',
              'key' => 'id',
              'dataType' => 'Integer',
              'label' => E::ts('ID'),
              'sortable' => TRUE,
            ],
            [
              'type' => 'field',
              'key' => 'addr_id',
              'dataType' => 'Integer',
              'label' => E::ts('Id. de l\'adresse'),
              'sortable' => TRUE,
            ],
            [
              'type' => 'field',
              'key' => 'Banaddr_Address_addr_id_01.street_address',
              'dataType' => 'String',
              'label' => E::ts('Banaddr Id. de l\'adresse: Rue'),
              'sortable' => TRUE,
            ],
            [
              'type' => 'field',
              'key' => 'modified',
              'dataType' => 'String',
              'label' => E::ts('modified'),
              'sortable' => TRUE,
            ],
          ],
          'actions' => ['download', 'delete'],
          'classes' => ['table', 'table-striped'],
          'actions_display_mode' => 'menu',
        ],
      ],
      'match' => [
        'name',
      ],
    ],
  ],
];
