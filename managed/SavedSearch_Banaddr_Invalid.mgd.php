<?php
use CRM_Civisolraddr_ExtensionUtil as E;

return [
  [
    'name' => 'SavedSearch_Banaddr_Invalid',
    'entity' => 'SavedSearch',
    'cleanup' => 'unused',
    'update' => 'unmodified',
    'params' => [
      'version' => 4,
      'values' => [
        'name' => 'Banaddr_Invalid',
        'label' => E::ts('Banaddr : Invalid'),
        'api_entity' => 'Banaddr',
        'api_params' => [
          'version' => 4,
          'select' => [
            'id',
            'addr_id',
            'addr_id.street_address',
            'modified',
          ],
          'orderBy' => [],
          'where' => [
            [
              'validation:name',
              '=',
              'invalid',
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
    'name' => 'SavedSearch_Banaddr_Invalid_SearchDisplay_Banaddr_Invalid_Table',
    'entity' => 'SearchDisplay',
    'cleanup' => 'unused',
    'update' => 'unmodified',
    'params' => [
      'version' => 4,
      'values' => [
        'name' => 'Banaddr_Invalid_Table',
        'label' => E::ts('Banaddr : Invalid Table'),
        'saved_search_id.name' => 'Banaddr_Invalid',
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
              'key' => 'addr_id.street_address',
              'dataType' => 'String',
              'label' => E::ts('Id. de l\'adresse Rue'),
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
        'name'
      ],
    ],
  ],
];
