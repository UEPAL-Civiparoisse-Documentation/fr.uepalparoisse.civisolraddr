<?php
namespace Civi\Api4;
/**
 * CiviSolrAddr API Actions
 */
class CiviSolrAddr extends Generic\AbstractEntity
{
  /**
   * On considère qu'on peut accéder au SOLR du moment qu'on peut accéder à CiviCRM
   * Après tout, les données dans le SOLR sont issues d'une source publique.
   * @return array|array[]|mixed
   */
  public static function permissions()
  {
    $corePermissions=\CRM_Core_Permission::getEntityActionPermissions();
    $res= [
      'pingCore'=>['access CiviCRM'],
      'pingDept'=>['access CiviCRM'],
      'pingRegisteredCores'=>['access CiviCRM'],
      'retrieveCities'=>['access CiviCRM'],
      'retrieveDepts'=>['access CiviCRM'],
      'retrieveNumReps'=>['access CiviCRM'],
      'retrievePostcodes'=>['access CiviCRM'],
      'retrieveStreets'=>['access CiviCRM'],
      'search'=>['access CiviCRM'],
      'spellcheck'=>['access CiviCRM'],
      'suggest'=>['access CiviCRM'],
      'cronSearch'=>['administer CiviCRM']
    ]+$corePermissions['default'];
    return $res;
  }


  /**
  * @param bool $checkPermissions
  * @return Action\CiviSolrAddr\Spellcheck
  */
  public static function spellcheck($checkPermissions = TRUE){
    return (new Actions\CiviSolrAddr\Spellcheck(__CLASS__,__FUNCTION__))
      ->setCheckPermissions($checkPermissions);
  }
  /**
  * @param bool $checkPermissions
  * @return Action\CiviSolrAddr\Suggest
  */
  public static function suggest($checkPermissions = TRUE){
    return (new Actions\CiviSolrAddr\Suggest(__CLASS__,__FUNCTION__))
      ->setCheckPermissions($checkPermissions);
  }
  /**
  * @param bool $checkPermissions
  * @return Action\CiviSolrAddr\Search
  */
  public static function search($checkPermissions = TRUE){
    return (new Actions\CiviSolrAddr\Search(__CLASS__,__FUNCTION__))
      ->setCheckPermissions($checkPermissions);
  }

  /**
   * @param bool $checkPermissions
   * @return Actions\CiviSolrAddr\Cronsearch
   */
  public static function cronSearch($checkPermissions = TRUE){
    return (new Actions\CiviSolrAddr\Cronsearch(__CLASS__,__FUNCTION__))
      ->setCheckPermissions($checkPermissions);
  }


  /**
   * @param bool $checkPermissions
   * @return Generic\BasicGetFieldsAction
   */
  public static function getFields($checkPermissions = TRUE){
    return (new Generic\BasicGetFieldsAction(__CLASS__,__FUNCTION__, function() { return [];
   }))->setCheckPermissions($checkPermissions);

  }

  /**
   * @param $checkPermissions
   * @return Actions\CiviSolrAddr\RetrieveDepts
   */
  public static function retrieveDepts($checkPermissions = TRUE){
    return (new Actions\CiviSolrAddr\RetrieveDepts(__CLASS__,__FUNCTION__))
      ->setCheckPermissions($checkPermissions);
  }

  /**
   * @param $checkPermissions
   * @return Actions\CiviSolrAddr\RetrieveCities
   */
  public static function retrieveCities($checkPermissions = TRUE){
    return (new Actions\CiviSolrAddr\RetrieveCities(__CLASS__,__FUNCTION__))
      ->setCheckPermissions($checkPermissions);
  }

  /**
   * @param $checkPermissions
   * @return Actions\CiviSolrAddr\RetrieveStreets
   */
  public static function retrieveStreets($checkPermissions = TRUE){
    return (new Actions\CiviSolrAddr\RetrieveStreets(__CLASS__,__FUNCTION__))
      ->setCheckPermissions($checkPermissions);
  }

  /**
   * @param $checkPermissions
   * @return Actions\CiviSolrAddr\RetrieveNumReps
   */
  public static function retrieveNumReps($checkPermissions = TRUE){
    return (new Actions\CiviSolrAddr\RetrieveNumReps(__CLASS__,__FUNCTION__))
      ->setCheckPermissions($checkPermissions);
  }

  /**
   * @param $checkPermissions
   * @return Actions\CiviSolrAddr\RetrievePostcodes
   */
  public static function retrievePostcodes($checkPermissions = TRUE){
    return (new Actions\CiviSolrAddr\RetrievePostcodes(__CLASS__,__FUNCTION__))
      ->setCheckPermissions($checkPermissions);
  }

  /**
   * @param $checkPermissions
   * @return Actions\CiviSolrAddr\PingCore
   */
  public static function pingCore($checkPermissions=TRUE){
    return (new Actions\CiviSolrAddr\PingCore(__CLASS__,__FUNCTION__))
      ->setCheckPermissions($checkPermissions);
  }

  /**
   * @param $checkPermissions
   * @return Actions\CiviSolrAddr\PingDept
   */
  public static function pingDept($checkPermissions=TRUE){
    return (new Actions\CiviSolrAddr\PingDept(__CLASS__,__FUNCTION__))
      ->setCheckPermissions($checkPermissions);
  }

  /**
   * @param $checkPermissions
   * @return Actions\CiviSolrAddr\PingRegisteredCores
   */
  public static function pingRegisteredCores($checkPermissions=TRUE){
    return (new Actions\CiviSolrAddr\PingRegisteredCores(__CLASS__,__FUNCTION__))
      ->setCheckPermissions($checkPermissions);
  }
}
