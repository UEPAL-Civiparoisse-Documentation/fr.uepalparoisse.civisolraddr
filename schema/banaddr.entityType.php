<?php

use CRM_Civisolraddr_ExtensionUtil as E;

return [
  'name' => 'Banaddr',
  'table' => 'civicrm_banaddr',
  'class' => 'CRM_Civisolraddr_DAO_Banaddr',
  'getInfo' => fn() => [
    'title' => E::ts('Banaddr'),
    'title_plural' => E::ts('Banaddrs'),
    'description' => E::ts('BAN Addr records'),
    'log' => TRUE,
  ],
  'getFields' => fn() => [
    'id' => [
      'title' => E::ts('ID'),
      'sql_type' => 'int unsigned',
      'input_type' => 'Number',
      'required' => TRUE,
      'description' => E::ts('Unique Banaddr ID'),
      'primary_key' => TRUE,
      'auto_increment' => TRUE,
    ],
    'record_id' => [
      'title' => E::ts('record id'),
      'sql_type' => 'varchar(255)',
      'input_type' => 'text',
      'required' => TRUE,
      'description' => E::ts('solr record id')
    ],
    'addr_id' => [
      'title' => E::ts('Address ID'),
      'sql_type' => 'int unsigned',
      'input_type' => 'EntityRef',
      'required' => TRUE,
      'description' => E::ts('FK to Address'),
      'entity_reference' => [
        'entity' => 'Address',
        'key' => 'id',
        'on_delete' => 'CASCADE',
      ],
    ],
    'validation' => [
      'title' => E::ts('Validation'),
      'sql_type' => 'varchar(255)',
      'input_type' => 'Select',
      'description' => E::ts('Validation status'),
      'pseudoconstant' => [
        'callback' => ['CRM_Civisolraddr_Banaddr_Validation', 'getValues']]
    ],

    'id_fantoir' => [
      'title' => E::ts('ID Fantoir'),
      'sql_type' => 'varchar(255)',
      'input_type' => 'Text',
      'required' => FALSE,
      'description' => E::ts('ID Fantoir')
    ],
    'numero' => [
      'title' => E::ts('Numéro'),
      'sql_type' => 'int',
      'input_type' => 'Number',
      'required' => FALSE,
      'description' => E::ts('Numéro')
    ],
    'rep' => [
      'title' => E::ts('Répéteur'),
      'sql_type' => 'varchar(255)',
      'input_type' => 'Text',
      'required' => FALSE,
      'description' => E::ts('Répéteur')
    ],
    'nom_voie' => [
      'title' => E::ts('Nom voie'),
      'sql_type' => 'varchar(255)',
      'input_type' => 'Text',
      'required' => FALSE,
      'description' => E::ts('Nom voie')
    ],
    'code_postal' => [
      'title' => E::ts('Code postal'),
      'sql_type' => 'varchar(255)',
      'input_type' => 'Text',
      'required' => FALSE,
      'description' => E::ts('Code postal')
    ],
    'code_insee' => [
      'title' => E::ts('Code INSEE'),
      'sql_type' => 'varchar(255)',
      'input_type' => 'Text',
      'required' => FALSE,
      'description' => E::ts('Code INSEE')
    ],
    'nom_commune' => [
      'title' => E::ts('Nom commune'),
      'sql_type' => 'varchar(255)',
      'input_type' => 'Text',
      'required' => FALSE,
      'description' => E::ts('Nom commune')
    ],
    'code_insee_ancienne_commune' => [
      'title' => E::ts('Code INSEE ancienne commune'),
      'sql_type' => 'varchar(255)',
      'input_type' => 'Text',
      'required' => FALSE,
      'description' => E::ts('Code INSEE ancienne commune')
    ],
    'nom_ancienne_commune' => [
      'title' => E::ts('Nom ancienne commune'),
      'sql_type' => 'varchar(255)',
      'input_type' => 'Text',
      'required' => FALSE,
      'description' => E::ts('Nom ancienne commune')
    ],
    'proj_leg_x' => [
      'title' => E::ts('proj_leg_x'),
      'sql_type' => 'varchar(255)',
      'input_type' => 'Text',
      'required' => FALSE,
      'description' => E::ts('proj_leg_x')
    ],
    'proj_leg_y' => [
      'title' => E::ts('proj_leg_y'),
      'sql_type' => 'varchar(255)',
      'input_type' => 'Text',
      'required' => FALSE,
      'description' => E::ts('proj_leg_y')
    ],
    'gps_lon' => [
      'title' => E::ts('gps_lon'),
      'sql_type' => 'varchar(255)',
      'input_type' => 'Text',
      'required' => FALSE,
      'description' => E::ts('gps_lon')
    ],
    'gps_lat' => [
      'title' => E::ts('gps_lat'),
      'sql_type' => 'varchar(255)',
      'input_type' => 'Text',
      'required' => FALSE,
      'description' => E::ts('gps_lat')
    ],
    'type_position' => [
      'title' => E::ts('Type position'),
      'sql_type' => 'varchar(255)',
      'input_type' => 'Text',
      'required' => FALSE,
      'description' => E::ts('Type position')
    ],
    'alias' => [
      'title' => E::ts('alias'),
      'sql_type' => 'varchar(255)',
      'input_type' => 'Text',
      'required' => FALSE,
      'description' => E::ts('alias')
    ],
    'nom_lieu_dit' => [
      'title' => E::ts('nom lieu dit'),
      'sql_type' => 'varchar(255)',
      'input_type' => 'Text',
      'required' => FALSE,
      'description' => E::ts('nom lieu dit')
    ],
    'libelle_acheminement' => [
      'title' => E::ts('libellé acheminement'),
      'sql_type' => 'varchar(255)',
      'input_type' => 'Text',
      'required' => FALSE,
      'description' => E::ts('libellé acheminement')
    ],
    'nom_afnor' => [
      'title' => E::ts('Nom AFNOR'),
      'sql_type' => 'varchar(255)',
      'input_type' => 'Text',
      'required' => FALSE,
      'description' => E::ts('Nom AFNOR')
    ],
    'source_position' => [
      'title' => E::ts('Source position'),
      'sql_type' => 'varchar(255)',
      'input_type' => 'Text',
      'required' => FALSE,
      'description' => E::ts('Source position')
    ],
    'source_nom_voie' => [
      'title' => E::ts('Source nom voie'),
      'sql_type' => 'varchar(255)',
      'input_type' => 'Text',
      'required' => FALSE,
      'description' => E::ts('Source nom voie')
    ],
    'certification_commune' => [
      'title' => E::ts('Certification commune'),
      'sql_type' => 'varchar(255)',
      'input_type' => 'Text',
      'required' => FALSE,
      'description' => E::ts('Certification commune')
    ],
    'cad_parcelles' => [
      'title' => E::ts('cad_parcelles'),
      'sql_type' => 'varchar(255)',
      'input_type' => 'Text',
      'required' => FALSE,
      'description' => E::ts('cad_parcelles')
    ],
    'numero_rep' => [
      'title' => E::ts('numero_rep'),
      'sql_type' => 'varchar(255)',
      'input_type' => 'Text',
      'required' => FALSE,
      'description' => E::ts('numero_rep')
    ],
    'numero_departement' => [
      'title' => E::ts('numero_departement'),
      'sql_type' => 'varchar(255)',
      'input_type' => 'Text',
      'required' => FALSE,
      'description' => E::ts('numero_departement')
    ],
    'modified' => [
      'title' => E::ts('modified'),
      'sql_type' => 'varchar(255)',
      'input_type' => 'Text',
      'required' => TRUE,
      'description' => E::ts('Source HTTP header modified')
    ],
    'is_even' => [
      'title' => E::ts('is_even'),
      'sql_type' => 'tinyint',
      'input_type' => 'Boolean',
      'description' => E::ts('is numero even'),
      'required' => FALSE,
    ],
    'is_odd' => [
      'title' => E::ts('is_odd'),
      'sql_type' => 'tinyint',
      'input_type' => 'Boolean',
      'description' => E::ts('is numero odd'),
      'required' => FALSE,
    ],
    'neg_numero_odd' => [
      'title' => E::ts('neg_numero_odd'),
      'sql_type' => 'int',
      'input_type' => 'Number',
      'description' => E::ts('neg_numero_odd'),
      'required' => FALSE
    ],
    'neg_numero_even' => [
      'title' => E::ts('neg_numero_even'),
      'sql_type' => 'int',
      'input_type' => 'Number',
      'description' => E::ts('neg_numero_even'),
      'required' => FALSE
    ]


  ],
  'getIndices' => fn() => [
    'idx_record_id' => ['fields' => ['record_id' => TRUE]],
    'idx_addr_id' => ['fields' => ['addr_id' => TRUE], 'unique' => TRUE],
    'idx_validation' => ['fields' => ['validation' => TRUE]],
    'idx_numero' => ['fields' => ['numero' => TRUE]],
    'idx_rep' => ['fields' => ['rep' => TRUE]],
    'idx_nom_voie' => ['fields' => ['nom_voie' => TRUE]],
    'idx_code_postal' => ['fields' => ['code_postal' => TRUE]],
    'idx_nom_commune' => ['fields' => ['nom_commune' => TRUE]],
    'idx_libelle_acheminement' => ['fields' => ['libelle_acheminement' => TRUE]],
    'idx_nom_afnor' => ['fields' => ['nom_afnor' => TRUE]],
    'idx_numero_rep' => ['fields' => ['numero_rep' => TRUE]],
    'idx_numero_departement' => ['fields' => ['numero_departement' => TRUE]],
    'idx_modified' => ['fields' => ['modified' => TRUE]],
    'idx_numero_odd' => ['fields' => ['nom_commune' => TRUE, 'nom_voie' => TRUE, 'is_odd' => TRUE, 'is_even' => TRUE, 'numero_rep' => TRUE]],
    'idx_numero_even' => ['fields' => ['nom_commune' => TRUE, 'nom_voie' => TRUE, 'is_even' => TRUE, 'is_odd' => TRUE, 'numero_rep' => TRUE]],
    'idx_neg_numero_odd' => ['fields' => ['nom_commune' => TRUE, 'nom_voie' => TRUE, 'is_odd' => TRUE, 'is_even' => TRUE, 'neg_numero_odd' => TRUE, 'rep' => TRUE]],
    'idx_neg_numero_even' => ['fields' => ['nom_commune' => TRUE, 'nom_voie' => TRUE, 'is_even' => TRUE, 'is_odd' => TRUE, 'neg_numero_even' => TRUE, 'rep' => TRUE]],
  ],
  'getPaths' => fn() => [],
];
