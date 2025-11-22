<?php
namespace Civi\Api4\Service\Spec\Provider;
use Civi\Api4\Service\Spec\FieldSpec;
use Civi\Api4\Service\Spec\RequestSpec;
use CRM_Civisolraddr_ExtensionUtil as E;

/**
 * @service
 * @internal
 */
class BanaddrGetSpecProvider extends \Civi\Core\Service\AutoService implements Generic\SpecProviderInterface {
  public function modifySpec(RequestSpec $spec)
  {
    $field_match_street=new FieldSpec('match_street','Banaddr','Boolean');
    $field_match_street->setColumnName('match_street')
      ->setLabel(E::ts('match_street'))
      ->setReadonly(true)
      ->setSqlRenderer([__CLASS__,'renderMatchStreet']);

    $spec->addFieldSpec($field_match_street);

    $field_match_city=new FieldSpec('match_city','Banaddr','Boolean');
    $field_match_city->setColumnName('match_city')
      ->setLabel(E::ts('match_city'))
      ->setReadonly(true)
      ->setSqlRenderer([__CLASS__,'renderMatchCity']);

    $spec->addFieldSpec($field_match_city);

//    $field_contact_id=new FieldSpec('contact_id','Banaddr','Integer');
//    $field_contact_id
//      ->setColumnName('addr_id')
//      ->setLabel('contact_id')
//      ->setReadonly(true)
//      ->setSqlRenderer(['CRM_Civisolraddr_Banaddr_Utils','renderContactId']);
//
//    $spec->addFieldSpec($field_contact_id);
  }

  /**
   * @param string $entity
   * @param string $action
   * @return bool
   */
  public function applies(string $entity, string $action)
  {
    return $entity === 'Banaddr' && $action ==='get';
  }

  public static function renderMatchStreet(array $field):string
  {
    $alias='';
    $exploded=explode('.',$field['sql_name'],-1);
    if(count($exploded)==1)
    {
      $alias=$exploded[0];
      $alias.='.';
    }
    return "(
    (select street_address from civicrm_address where id={$alias}addr_id limit 1)
     like (concat('%',{$alias}nom_voie,'%'))
     )";
  }

  public static function renderMatchCity(array $field):string
  {
    $alias='';
    $exploded=explode('.',$field['sql_name'],-1);
    if(count($exploded)==1)
    {
      $alias=$exploded[0];
      $alias.='.';
    }
    return "(
    (select city from civicrm_address where id={$alias}addr_id limit 1)
     ={$alias}nom_commune
     )";
  }

}
