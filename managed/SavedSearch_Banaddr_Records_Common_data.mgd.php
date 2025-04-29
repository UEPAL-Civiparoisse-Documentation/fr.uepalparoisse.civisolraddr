<?php
use CRM_Civisolraddr_ExtensionUtil as E;

return [
  [
    'name' => 'SavedSearch_Banaddr_Records_Common_data',
    'entity' => 'SavedSearch',
    'cleanup' => 'unused',
    'update' => 'unmodified',
    'params' => [
      'version' => 4,
      'values' => [
        'name' => 'Banaddr_Records_Common_data',
        'label' => E::ts('Banaddr Records Common data'),
        'api_entity' => 'Banaddr',
        'api_params' => [
          'version' => 4,
          'select' => [
            'id',
            'validation:label',
            'addr_id',
            'numero',
            'rep',
            'nom_voie',
            'code_postal',
            'nom_commune',
            'numero_departement',
          ],
          'orderBy' => [],
          'where' => [],
          'groupBy' => [],
          'join' => [],
          'having' => [],
        ],
      ],
      'match' => ['name'],
    ],
  ],
  [
    'name' => 'SavedSearch_Banaddr_Records_Common_data_SearchDisplay_Banaddr_Records_Common_data',
    'entity' => 'SearchDisplay',
    'cleanup' => 'unused',
    'update' => 'unmodified',
    'params' => [
      'version' => 4,
      'values' => [
        'name' => 'Banaddr_Records_Common_data',
        'label' => E::ts('Banaddr Records Common data'),
        'saved_search_id.name' => 'Banaddr_Records_Common_data',
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
              'key' => 'validation:label',
              'dataType' => 'String',
              'label' => E::ts('Validation'),
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
              'key' => 'code_postal',
              'dataType' => 'String',
              'label' => E::ts('Code postal'),
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
              'key' => 'numero_departement',
              'dataType' => 'String',
              'label' => E::ts('numero_departement'),
              'sortable' => TRUE,
            ],
          ],
          'actions' => TRUE,
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
