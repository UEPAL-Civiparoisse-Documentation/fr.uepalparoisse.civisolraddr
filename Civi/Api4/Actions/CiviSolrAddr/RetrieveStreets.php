<?php
namespace Civi\Api4\Actions\CiviSolrAddr;
use Civi\Api4\Generic\AbstractAction;
use Civi\Api4\Generic\Result;
use CRM_Civisolraddr_SolrClient as SolrClient;
/**
Facet Streets from SOLR
 */
class RetrieveStreets extends AbstractAction
{
  /**
   * @var string dept
   * @required
   */
  protected string $dept="67";

  /**
   * @var string city
   * @required
   */
  protected string $city="Strasbourg";

  public function _run(Result $result)
  {
    $dept=$this->getDept();
    $city=$this->getCity();
    $streets=SolrClient::singleton()->retrieveStreets($dept,$city);
    $result->append(['streets'=>$streets]);
  }


}
