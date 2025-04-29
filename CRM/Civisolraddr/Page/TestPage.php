<?php
class CRM_Civisolraddr_Page_TestPage extends CRM_Core_Page
{
public function run()
{
  /**
   * @var Civi\Angular\AngularLoader $loader
   */
  $loader=Civi::service('angularjs.loader');
  $loader->addModules(["hvaddrdialog"]);

//  $loader->useApp(['activeRoute' => '/',
//    'defaultRoute' => '/',
//    'file' => 'CRM/Civisolraddr/Page/TestPage.tpl',
//  'region' => 'page-body'
//  ]);

  parent::run();
}
}
