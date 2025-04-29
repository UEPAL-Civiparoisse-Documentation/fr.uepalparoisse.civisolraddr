<?php

namespace Civi\Api4\Actions\CiviSolrAddr;

use Civi\Api4\Generic\AbstractAction;
use Civi\Api4\Generic\Result;
use CRM_Civisolraddr_SolrClient as SolrClient;
use Civi;

/**
 * Cron search : sync banaddr with solr
 */
class Cronsearch extends AbstractAction
{

  public function _run(Result $result)
  {
    $solrClient = \CRM_Civisolraddr_SolrClient::singleton();
    if ($solrClient->isEnabled()) {
      $log = Civi::log();
      $addresses = \Civi\Api4\Address::get(false)
        ->addSelect('id')
        ->addJoin('Banaddr AS banaddr', 'LEFT', ['banaddr.addr_id', '=', 'id'])
        ->addClause('OR', ['banaddr.validation', 'IN', ['invalid', 'stale']], ['banaddr.id', 'IS NULL'])
        ->addWhere('country_id.iso_code', '=', 'FR')
        ->setLimit(0)
        ->execute();
      foreach ($addresses as $address) {
        try {
          $addr_id = $address['id'];
          $addr = new \CRM_Core_BAO_Address();
          $addr->id = $addr_id;
          $addr->find(true);
          $solrClient->syncAddress($addr,false);

        } catch (Exception $e) {
          $log->error($e->__toString());
        }
      }
    }
  }
}
