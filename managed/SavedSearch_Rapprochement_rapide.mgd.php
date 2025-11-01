<?php
use CRM_Civisolraddr_ExtensionUtil as E;

return [
  [
    'name' => 'SavedSearch_Rapprochement_rapide',
    'entity' => 'SavedSearch',
    'cleanup' => 'unused',
    'update' => 'unmodified',
    'params' => [
      'version' => 4,
      'values' => [
        'name' => 'Rapprochement_rapide',
        'label' => E::ts('Banaddr Records : Rapprochement rapide'),
        'api_entity' => 'Banaddr',
        'api_params' => [
          'version' => 4,
          'select' => [
            'id',
            'addr_id',
            'numero',
            'rep',
            'nom_voie',
            'nom_commune',
            'Banaddr_Address_addr_id_01.street_address',
            'Banaddr_Address_addr_id_01.city',
          ],
          'orderBy' => [],
          'where' => [
            [
              'validation:name',
              '=',
              'unchecked',
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
    'name' => 'SavedSearch_Rapprochement_rapide_SearchDisplay_Rapprochement_rapide_Table_1',
    'entity' => 'SearchDisplay',
    'cleanup' => 'unused',
    'update' => 'unmodified',
    'params' => [
      'version' => 4,
      'values' => [
        'name' => 'Rapprochement_rapide_Table_1',
        'label' => E::ts('Rapprochement rapide Table'),
        'saved_search_id.name' => 'Rapprochement_rapide',
        'type' => 'table',
        'settings' => [
          'description' => E::ts(''),
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
              'key' => 'numero',
              'dataType' => 'Integer',
              'label' => E::ts('Numéro'),
              'sortable' => TRUE,
            ],
            [
              'type' => 'field',
              'key' => 'rep',
              'dataType' => 'String',
              'label' => E::ts('Répéteur'),
              'sortable' => TRUE,
            ],
            [
              'type' => 'field',
              'key' => 'nom_voie',
              'dataType' => 'String',
              'label' => E::ts('Nom voie'),
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
              'key' => 'nom_commune',
              'dataType' => 'String',
              'label' => E::ts('Nom commune'),
              'sortable' => TRUE,
            ],
            [
              'type' => 'field',
              'key' => 'Banaddr_Address_addr_id_01.city',
              'dataType' => 'String',
              'label' => E::ts('Banaddr Id. de l\'adresse: Ville'),
              'sortable' => TRUE,
            ]
          ],
          'actions' => ['setValid','setInvalid', 'delete'],
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
