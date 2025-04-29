<?php
namespace Civi\Api4\Actions\CiviSolrAddr;
use Civi\Api4\Generic\AbstractAction;
use Civi\Api4\Generic\Result;
use CRM_Civisolraddr_SolrClient as SolrClient;
/**
City Spellcheck
*/
class Spellcheck extends AbstractAction{
  /** 
   *  @var string $dept Département
   *  @required 
   */
  protected string $dept="67";

  /** 
   *  @var string $ville Ville
   *  @required 
   */
  protected string $ville="Strasbourg";

  public function _run(Result $result)
  {
   $dept=$this->getDept();
   $ville=$this->getVille();
   $spellRes= SolrClient::singleton()->spellcheck($ville,$dept);
   $result->append(['spellcheck'=>$spellRes->value]);
   return $result;
  }
}
