<?php
use CRM_Civisolraddr_ExtensionUtil as E;

/**
 * CiviSolrAddr.Cronsearch API specification (optional)
 * This is used for documentation and validation.
 *
 * @param array $spec description of fields supported by this API call
 *
 * @see https://docs.civicrm.org/dev/en/latest/framework/api-architecture/
 */
function _civicrm_api3_civi_solr_addr_Cronsearch_spec(&$spec) {

}

/**
 * CiviSolrAddr.Cronsearch API
 *
 * @param array $params
 *
 * @return array
 *   API result descriptor
 *
 * @see civicrm_api3_create_success
 *
 * @throws CRM_Core_Exception
 */
function civicrm_api3_civi_solr_addr_Cronsearch($params) {

    \Civi\Api4\CiviSolrAddr::cronSearch(false)->execute();
    return civicrm_api3_create_success([], $params, 'CiviSolrAddr', 'Cronsearch');

}
