<?php

namespace Civi\Api4\Actions\CiviSolrAddr;

use Civi\Api4\Generic\AbstractAction;
use Civi\Api4\Generic\Result;
use CRM_Civisolraddr_SolrClient as SolrClient;

/**
 * Configured depts for SOLR
 */
class RetrieveDepts extends AbstractAction
{

  public function _run(Result $result)
  {
    $depts = SolrClient::singleton()->retrieveDepts();
    $result->append(['depts' => $depts]);
  }


}
