<?php
namespace Civi\Api4\Actions\CiviSolrAddr;
use Civi\Api4\Generic\AbstractAction;
use Civi\Api4\Generic\Result;
use CRM_Civisolraddr_SolrClient as SolrClient;
/**
   Search BANAddr from SOLR
*/
class Search extends AbstractAction
{
/** 
  * @var string $addr Adresse
  * @required
  */
  protected string $addr="1b, Quai Saint-Thomas";

/** 
 * @var string $ville Ville
 * @required
 */
  protected string $city="Strasbourg";
/** 
 * @var string $dept Département
 * @required
 */
  protected string $dept="67";
  public function _run(Result $result)
  {
    $addr=$this->getAddr();
    $city=$this->getCity();
    $dept=$this->getDept();
    $banQuery=new \CRM_Civisolraddr_Banaddr_Query($addr,$city,$dept);
    $res=SolrClient::singleton()->retrieveBAN($banQuery);
    $result->append(['documents'=>$res]);

  }

}
