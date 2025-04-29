<?php
namespace Civi\Api4\Actions\CiviSolrAddr;
use Civi\Api4\Generic\AbstractAction;
use Civi\Api4\Generic\Result;
use CRM_Civisolraddr_SolrClient as SolrClient;
/**
City Suggest
*/
class Suggest extends AbstractAction
{
  /** 
   *  @var string $dept Département
   *  @required 
   */
  protected string $dept="67";
  /**  
   * @var string $ville Ville
   * @required 
   */
  protected string $ville="Illkirch";

  public function _run(Result $result)
  {
    $dept=$this->getDept();
    $ville=$this->getVille();
    $suggestRes= SolrClient::singleton()->suggest($ville,$dept);
    $result->append(['suggest'=>$suggestRes]);
  }
}
