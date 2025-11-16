<?php
use CRM_Civisolraddr_ExtensionUtil as E;

return [
  [
    'name' => 'SavedSearch_Banaddr_Records_Common_data',
    'entity' => 'SavedSearch',
    'cleanup' => 'always',
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
            'validation:label',
            'addr_id',
            'numero',
            'rep',
            'nom_voie',
            'code_postal',
            'nom_commune',
            'numero_departement',
            'Banaddr_Address_addr_id_01.street_address',
            'Banaddr_Address_addr_id_01.city',
            'Banaddr_Address_addr_id_01_Address_Contact_contact_id_01.sort_name',
            'Banaddr_Address_addr_id_01.postal_code',
          ],
          'orderBy' => [],
          'where' => [],
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
    'name' => 'SavedSearch_Banaddr_Records_Common_data_SearchDisplay_Banaddr_Records_Common_data',
    'entity' => 'SearchDisplay',
    'cleanup' => 'always',
    'update' => 'unmodified',
    'params' => [
      'version' => 4,
      'values' => [
        'name' => 'Banaddr_Records_Common_data',
        'label' => E::ts('Banaddr Records Common data'),
        'saved_search_id.name' => 'Banaddr_Records_Common_data',
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
              'type' => 'html',
              'key' => 'validation:label',
              'dataType' => 'String',
              'label' => E::ts('Adresse validée ?'),
              'sortable' => TRUE,
              'rewrite' => '{if "[validation:value]"=="unchecked" }
<p class="civisolraddr-validation-unchecked">[validation:label]</p>
{elseif "[validation:value]"=="invalid" }
<p class="civisolraddr-validation-invalid">[validation:label]</p>
{elseif  "[validation:value]"=="stale" }
<p class="civisolraddr-validation-stale" class="fa-times">[validation:label]</p>
{elseif "[validation:value]"=="valid" }
<p class="civisolraddr-validation-valid">[validation:label]</p>
{else}
<p class="civisolraddr-validation-default">[validation:label]</p>
{/if}',
            ],
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
              'label' => E::ts('Proposition : rue'),
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
              'key' => 'code_postal',
              'dataType' => 'String',
              'label' => E::ts('Proposition : code postal'),
              'sortable' => TRUE,
            ],
            [
              'type' => 'field',
              'key' => 'Banaddr_Address_addr_id_01.postal_code',
              'dataType' => 'String',
              'label' => E::ts('Saisie : code postal'),
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
              'key' => 'numero_departement',
              'dataType' => 'String',
              'label' => E::ts('Proposition : département'),
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
          'actions' => TRUE,
          'classes' => [
            'table',
            'table-striped',
          ],
          'actions_display_mode' => 'menu',
        ],
      ],
      'match' => [
        'saved_search_id',
        'name',
      ],
    ],
  ],
];
