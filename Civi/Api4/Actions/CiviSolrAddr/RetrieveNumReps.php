<?php
namespace Civi\Api4\Actions\CiviSolrAddr;
use Civi\Api4\Generic\AbstractAction;
use Civi\Api4\Generic\Result;
use CRM_Civisolraddr_SolrClient as SolrClient;
/**
Facet Numero Reps from SOLR
 */
class RetrieveNumReps extends AbstractAction
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

  /**
   * @var string street
   * @required
   */
  protected string $street="Quai Saint-Thomas";

  public function _run(Result $result)
  {
    $dept=$this->getDept();
    $city=$this->getCity();
    $street=$this->getStreet();
    $numreps=SolrClient::singleton()->retrieveNumeroReps($dept,$city,$street);
    $result->append(['numreps'=>$numreps]);
  }


}
