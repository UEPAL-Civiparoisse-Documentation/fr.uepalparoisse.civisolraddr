<?php

namespace Civi\Api4;

use Civi\Api4\Generic\AbstractEntity;
use CRM_CIvisolraddr_ExtensionUtil as E;
use Civi\Api4\Generic\BasicGetFieldsAction;

/**
 * En ce qui concerne les droits : le getFields est la seule action, et elle est gérée déjà par le default.
 */
class HVAddr extends AbstractEntity
{


  /**
   * @param bool $checkPermissions
   * @return BasicGetFieldsAction
   */

  public static function getFields(bool $checkPermissions=TRUE){
    return (new BasicGetFieldsAction(__CLASS__,__FUNCTION__,["\\Civi\\Api4\\Actions\\HVAddr\\Fields","fields"]))
      ->setCheckPermissions($checkPermissions);
  }
}
