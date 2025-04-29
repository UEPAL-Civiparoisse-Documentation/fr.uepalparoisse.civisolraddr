<?php
namespace Civi\Api4\Actions\CiviSolrAddr;
use Civi\Api4\Generic\AbstractAction;
use Civi\Api4\Generic\Result;
use CRM_Civisolraddr_SolrClient as SolrClient;
/**
Ping Core
 */
class PingCore extends AbstractAction
{
  /**
   * @var string core
   * @required
   */
  protected string $core="core_67_active";

  public function _run(Result $result)
  {
    $core=$this->getCore();
    $res=SolrClient::singleton()->pingCore($core);
    $result->append(['ping'=>$res]);
  }


}
