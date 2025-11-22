<?php

namespace Civi\Api4\Actions\HVAddr;

use \CRM_Civisolraddr_ExtensionUtil as E;

class Fields
{


  protected static function containsField($avalues, $fieldName): bool
  {
    return is_array($avalues) && array_key_exists('values', $avalues) && is_array($avalues['values']) && array_key_exists($fieldName, $avalues['values'])
      && !is_null($avalues['values'][$fieldName]);
  }

  protected static function retrieveField($avalues, $fieldName)
  {
    $res = null;
    if (self::containsField($avalues, $fieldName)) {
      $res = $avalues['values'][$fieldName];
    }
    return $res;
  }


  public static function fields()
  {
    return [
      'dept' => [
        'name' => 'dept',
        'data_type' => 'String',
        'title' => E::ts('hvaddr_departement'),
        'sql_type' => 'varchar(255)',
        'input_type' => 'Select',
        'required' => FALSE,
        'description' => E::ts('Departement'),
        'input_attrs' => ['label' =>E::ts('hvaddr_label_departement')],
        'pseudoconstant' => [
          'callback' => function () {
            return \CRM_Civisolraddr_SolrClient::singleton()->retrieveDepts();
          }
        ]
      ],
      'city' => [
        'name' => 'city',
        'data_type' => 'String',
        'title' => E::ts('hvaddr_city'),
        'required' => FALSE,
        'sql_type' => 'varchar(255)',
        'input_type' => 'ChainSelect',
        'input_attrs' => [
          'control_field' => 'dept',
          'label' => E::ts('hvaddr_label_city'),
        ],
        'pseudoconstant' => [
          'callback' => function ($fieldName, $avalues) {
            $dept = self::retrieveField($avalues, 'dept');
            if (is_null($dept)) {
              return [];
            }
            $cities = \CRM_Civisolraddr_SolrClient::singleton()->retrieveCities($dept);
            $ret = [];
            foreach ($cities as $city) {
              $ret[$city] = $city;
            }
            return $ret;
          }
        ]
      ],
      'street' => [
        'name' => 'street',
        'data_type' => 'String',
        'title' => E::ts('hvaddr_street'),
        'required' => FALSE,
        'sql_type' => 'varchar(512)',
        'input_type' => 'ChainSelect',
        'input_attrs' => [
          'control_field' => 'city',
          'label' => E::ts('hvaddr_label_street'),
        ],
        'pseudoconstant' => [
          'callback' => function ($fieldName, $avalues) {

            $dept = self::retrieveField($avalues, 'dept');
            $city = self::retrieveField($avalues, 'city');
            if (is_null($dept) || is_null($city)) {
              return [];
            }

            $streets = \CRM_Civisolraddr_SolrClient::singleton()->retrieveStreets($dept, $city);
            $ret = [];
            foreach ($streets as $street) {
              $ret[$street] = $street;
            }
            return $ret;
          }
        ]
      ],
      'numrep' => [
        'name' => 'numrep',
        'data_type' => 'String',
        'title' => E::ts('hvaddr_numrep'),
        'required' => FALSE,
        'sql_type' => 'varchar(1024)',
        'input_type' => 'ChainSelect',
        'input_attrs' => [
          'control_field' => 'street',
          'label' => E::ts('hvaddr_label_numrep'),
        ],
        'pseudoconstant' => [
          'callback' => function ($fieldName, $avalues) {
            $dept = self::retrieveField($avalues, 'dept');
            $city = self::retrieveField($avalues, 'city');
            $street = self::retrieveField($avalues, 'street');
            if (is_null($dept) || is_null($city) || is_null($street)) {
              return [];
            }
            $numreps = \CRM_Civisolraddr_SolrClient::singleton()->retrieveNumeroReps($dept, $city, $street);
            $ret = [];
            foreach ($numreps as $numrep) {
              $ret[$numrep] = $numrep;
            }
            return $ret;
          }
        ]
      ],
      'postcode' => [
        'name' => 'postcode',
        'data_type' => 'String',
        'title' => E::ts('hvaddr_postcode'),
        'required' => FALSE,
        'sql_type' => 'varchar(1024)',
        'input_type' => 'ChainSelect',
        'input_attrs' => [
          'control_field' => 'numrep',
          'label' => E::ts('hvaddr_label_postcode'),
        ],
        'pseudoconstant' => [
          'callback' => function ($fieldName, $avalues) {
            $dept = self::retrieveField($avalues, 'dept');
            $city = self::retrieveField($avalues, 'city');
            $street = self::retrieveField($avalues, 'street');
            $numrep = self::retrieveField($avalues, 'numrep');
            if (is_null($dept) || is_null($city) || is_null($street) || is_null($numrep)) {
              return [];
            }
            $postcodes = \CRM_Civisolraddr_SolrClient::singleton()->retrievePostcodes($dept, $city, $street,$numrep);
            $ret = [];
            foreach ($postcodes as $code) {
              $ret[$code] = $code;
            }
            return $ret;
          }
        ]
      ]
    ];
  }
}
