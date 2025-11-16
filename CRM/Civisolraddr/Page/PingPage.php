<?php
class CRM_Civisolraddr_Page_PingPage extends CRM_Core_Page
{
  public function run()
  {
    $pingRes=[];
    try {
      $ping = civicrm_api4('CiviSolrAddr', 'pingRegisteredCores')->first();
      $pingRes=$ping;
      $this->assign('pingRes', $pingRes);
    }
    catch(Exception $e)
    {
      Civi::log()->warning($e->__toString());
    }
    parent::run();
  }
}
