<?php
namespace Civi\Api4\Actions\CiviSolrAddr;
use Civi\Api4\Generic\AbstractAction;
use Civi\Api4\Generic\Result;
use CRM_Civisolraddr_SolrClient as SolrClient;
/**
Ping Registered Cores
 */
class PingRegisteredCores extends AbstractAction
{


  public function _run(Result $result)
  {
     $solrClient=SolrClient::singleton();
     $cores=$solrClient->getRegisteredCores();
     $res=[];
     foreach($cores as $core)
     {
       $res[$core]=$solrClient->pingCore($core);
     }
    $result->append($res);
  }


}
