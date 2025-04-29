<?php
namespace Civi\Api4\Actions\CiviSolrAddr;
use Civi\Api4\Generic\AbstractAction;
use Civi\Api4\Generic\Result;
use CRM_Civisolraddr_SolrClient as SolrClient;
/**
Facet Code Postal from SOLR
 */
class RetrievePostcodes extends AbstractAction
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

  /**
   * @var string numrep
   * @required
   */
  protected string $numrep="1b";


  /**
   * @param Result $result
   * @return void
   */

  public function _run(Result $result)
  {
    $dept=$this->getDept();
    $city=$this->getCity();
    $street=$this->getStreet();
    $numrep=$this->getNumrep();
    $codepostaux=SolrClient::singleton()->retrievePostcodes($dept,$city,$street,$numrep);
    $result->append(['cp'=>$codepostaux]);
  }


}
