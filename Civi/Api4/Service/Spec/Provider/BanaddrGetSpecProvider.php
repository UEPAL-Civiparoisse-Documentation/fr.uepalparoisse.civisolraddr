<?php
//namespace Civi\Api4\Service\Spec\Provider;
//use Civi\Api4\Service\Spec\FieldSpec;
//use Civi\Api4\Service\Spec\RequestSpec;
//use CRM_Civisolraddr_ExtensionUtil as E;
//
///**
// * @service
// * @internal
// */
//class BanaddrGetSpecProvider extends \Civi\Core\Service\AutoService implements Generic\SpecProviderInterface {
//  public function modifySpec(RequestSpec $spec)
//  {
//    $field_contact_id=new FieldSpec('contact_id','Banaddr','Integer');
//    $field_contact_id
//      ->setColumnName('addr_id')
//      ->setLabel('contact_id')
//      ->setReadonly(true)
//      ->setSqlRenderer(['CRM_Civisolraddr_Banaddr_Utils','renderContactId']);
//
//    $spec->addFieldSpec($field_contact_id);
//  }
//
//  /**
//   * @param string $entity
//   * @param string $action
//   * @return bool
//   */
//  public function applies(string $entity, string $action)
//  {
//    return $entity === 'Banaddr' && $action ==='get';
//  }
//
//}
