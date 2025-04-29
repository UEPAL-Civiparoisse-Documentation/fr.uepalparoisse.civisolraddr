<?php
use CRM_Civisolraddr_ExtensionUtil as E;

return [
  "civisolraddr_solr_hostname"=> [
    'name'=>'civisolraddr_solr_hostname',
    'type'=>'String',
    'html_type'=>'text',
    'title'=>E::ts('solr hostname'),
    'description'=>E::ts('DNS Resolvable solr hostname'),
    'default'=>'solr-reader-proxy.solr',
    'is_domain'=>1,
    'is_contact'=>0,
    'settings_pages'=>['civisolraddr'=>['weight'=>10]]
  ],
  "civisolraddr_solr_port"=> [
    'name'=>'civisolraddr_solr_port',
    'type'=>'Integer',
    'html_type'=>'text',
    'title'=>E::ts('solr port'),
    'description'=>E::ts('solr port'),
    'default'=>443,
    'is_domain'=>1,
    'is_contact'=>0,
    'settings_pages'=>['civisolraddr'=>['weight'=>20]]
    ],
  "civisolraddr_solr_base_path" =>[
    'name'=>'civisolraddr_solr_base_path',
    'type'=>'String',
    'html_type'=>'text',
    'title'=> E::ts('solr base path'),
    'description' => E::ts('Root base url path, without trailing slash'),
    'default'=>'/solr',
    'is_domain'=>1,
    'is_contact'=>0,
    'settings_pages'=>['civisolraddr'=>['weight'=>30]]

  ],
  "civisolraddr_solr_spellcheck_handler"=>[
    'name'=>"civisolraddr_solr_spellcheck_handler",
    'type'=>"String",
    'html_type'=>"text",
    'title'=> E::ts('spellcheck handler'),
    'description'=>E::ts('Handler to spellcheck cities'),
    'default'=>'ville',
    'is_domain'=>1,
    'is_contact'=>0,
    'settings_pages'=>['civisolraddr'=>['weight'=>40]]

  ],
  "civisolraddr_solr_search_handler"=>[
    'name'=>"civisolraddr_solr_search_handler",
    'type'=>"String",
    'html_type'=>"text",
    'title'=> E::ts('search handler'),
    'description'=>E::ts('Handler to query addresses'),
    'default'=>'select',
    'is_domain'=>1,
    'is_contact'=>0,
    'settings_pages'=>['civisolraddr'=>['weight'=>50]]

  ],
  "civisolraddr_solr_ping_handler"=>[
    'name'=>"civisolraddr_solr_ping_handler",
    'type'=>"String",
    'html_type'=>"text",
    'title'=> E::ts('ping handler'),
    'description'=>E::ts('Handler to ping'),
    'default'=>'admin/ping',
    'is_domain'=>1,
    'is_contact'=>0,
    'settings_pages'=>['civisolraddr'=>['weight'=>55]]

  ],
  "civisolraddr_solr_cores"=>[
    'name'=>"civisolraddr_solr_cores",
    'type'=>"String",
    'html_type'=>"text",
    'title'=>E::ts('registered cores'),
    'description'=>E::ts('Registered cores by departement - json object'),
    'default'=>'{"67":"core_67_active","68":"core_68_active","54":"core_54_active","55":"core_55_active","57":"core_57_active","88":"core_88_active"}',
    'is_domain'=>1,
    'is_contact'=>0,
    'settings_pages'=>['civisolraddr'=>['weight'=>60]]
  ],
  "civisolraddr_solr_ssl_cainfo"=>[
    'name'=>"civisolraddr_solr_ssl_cainfo",
    'type'=>"String",
    'html_type'=>"text",
    'title'=>E::ts('ssl capath'),
    'description'=>E::ts('Absolute path of the CA file'),
    'default'=>'/solr_ca/solr_ca.pem',
    'is_domain'=>1,
    'is_contact'=>0,
    'settings_pages'=>['civisolraddr'=>['weight'=>70]]
  ],
  "civisolraddr_use_solr"=>[
    'name'=>"civisolraddr_use_solr",
    'type'=>"Boolean",
    'html_type'=>"checkbox",
    'title'=> E::ts('Use solr'),
    'description'=> E::ts('Enable usage of solr'),
    'default'=>1,
    'is_domain'=>1,
    'is_contact'=>0,
    'settings_pages'=>['civisolraddr'=>['weight'=>80]]
  ]
];
