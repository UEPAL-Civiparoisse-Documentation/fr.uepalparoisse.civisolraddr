<?php

namespace Civi\Api4;

use Civi\Api4\Generic\BasicUpdateAction;
use Civi\Api4\Generic\DAOEntity;
use Civi\Api4\Generic\DAOUpdateAction;
use CRM_Civisolraddr_Banaddr_Validation;

/**
 * Banaddr entity.
 *
 * Provided by the fr.uepalparoisse.civisolraddr extension.
 *
 * @package Civi\Api4
 */
class Banaddr extends Generic\DAOEntity
{

  /**
   * On se cale sur les permissions de l'adresse.
   * @return array|mixed
   */
  public static function permissions()
  {

    $permissions = \CRM_Core_Permission::getEntityActionPermissions();
    return $permissions['address'] + $permissions['default'];
  }


  public static function setValid(bool $checkPermissions = True): DAOUpdateAction
  {
    return (new DAOUpdateAction(static::getEntityName(), __FUNCTION__))
      ->setCheckPermissions($checkPermissions)
      ->addValue('validation', CRM_Civisolraddr_Banaddr_Validation::VALID->value);
  }

  public static function setInvalid(bool $checkPermissions = True): DAOUpdateAction
  {
    return (new DAOUpdateAction(static::getEntityName(), __FUNCTION__))
      ->setCheckPermissions($checkPermissions)
      ->addValue('validation', CRM_Civisolraddr_Banaddr_Validation::INVALID->value);
  }

  public static function setUnchecked(bool $checkPermissions = True): DAOUpdateAction
  {
    return (new DAOUpdateAction(static::getEntityName(), __FUNCTION__))
      ->setCheckPermissions($checkPermissions)
      ->addValue('validation', CRM_Civisolraddr_Banaddr_Validation::UNCHECKED->value);
  }

  public static function setStale(bool $checkPermissions = True): DAOUpdateAction
  {
    return (new DAOUpdateAction(static::getEntityName(), __FUNCTION__))
      ->setCheckPermissions($checkPermissions)
      ->addValue('validation', CRM_Civisolraddr_Banaddr_Validation::STALE->value);
  }
}
