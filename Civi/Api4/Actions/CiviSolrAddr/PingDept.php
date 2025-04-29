<?php
namespace Civi\Api4\Actions\CiviSolrAddr;
use Civi\Api4\Generic\AbstractAction;
use Civi\Api4\Generic\Result;
use CRM_Civisolraddr_SolrClient as SolrClient;
/**
Ping Dept
 */
class PingDept extends AbstractAction
{
  /**
   * @var string dept
   * @required
   */
  protected string $dept="67";

  public function _run(Result $result)
  {
    $dept=$this->getDept();
    $res=SolrClient::singleton()->pingDept($dept);
    $result->append(['ping'=>$res]);
  }


}
