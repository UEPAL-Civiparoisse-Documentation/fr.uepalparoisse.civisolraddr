<?php

require_once 'civisolraddr.civix.php';

use CRM_Civisolraddr_ExtensionUtil as E;

function smarty_prefilter_civisolraddr(string $tpl_source, \Smarty\Template $template): string
{

  $tplResource=$template->template_resource;
//  $templateToModify=["file:CRM/Contact/Form/Edit/Address.tpl","file:CRM/Contact/Form/Inline/Address.tpl"];
  $templateToModify=["file:CRM/Contact/Form/Edit/Address/street_address.tpl"];
  $suppTemplate= <<<'EOD'
<tr>
<td colspan="2">
<crm-angular-js modules="hvaddrdialog">
  <div class="addrvirtualcontainer">
    <button name="show_hvaddr" type="button" hvaddr-dialog-popup="hvaddrdialog" block-id="{$blockId}">Afficher HVAddr</button>
  </div>
  <script type="text/javascript">
    CRM.$("div.addrvirtualcontainer").on("hvaddrdialog", function (event, data) {
      console.log("hvaddrDialogPopup");
      console.log(data);
      window.alert(JSON.stringify(data));
    });
  </script>
</crm-angular-js>
</td>
</tr>
EOD;

  if(in_array($tplResource,$templateToModify))
  {
    $tpl_source=$suppTemplate.$tpl_source;
  }

  return $tpl_source;
}


/**
 * Implements hook_civicrm_config().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_config/
 */
function civisolraddr_civicrm_config(&$config): void {
  _civisolraddr_civix_civicrm_config($config);
  $smarty=CRM_Core_Smarty::singleton();
  $smarty->loadFilter('pre','civisolraddr');

}

/**
 * Implements hook_civicrm_install().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_install
 */
function civisolraddr_civicrm_install(): void {
  _civisolraddr_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_enable
 */
function civisolraddr_civicrm_enable(): void {
  _civisolraddr_civix_civicrm_enable();
}


function civisolraddr_civicrm_buildForm($formName,&$form)
{
  $loader=Civi::service('angularjs.loader');
  $loader->addModules(["hvaddrdialog"]);
  Civi::resources()->addScriptFile("fr.uepalparoisse.civisolraddr","js/jquery_hvaddr.js");
}


function civisolraddr_civicrm_post(string $op, string $objectName, int $objectId, &$objectRef): void
{
    try {


        if ($objectName == "Address" && ($op == "create" || $op == "update" || $op == "edit") && $objectRef instanceof CRM_Core_BAO_Address) {
          CRM_Civisolraddr_SolrClient::singleton()->syncAddress($objectRef,true);
        }
    } catch (Exception $e) {
        Civi::log()->error($e->__toString());
    }
}

function civisolraddr_civicrm_searchKitTasks(array &$tasks, bool $checkPermissions, ?int $userID)
{
if(!array_key_exists('Banaddr',$tasks))
{
$tasks['Banaddr']=[];
}
if(!$checkPermissions || ($checkPermissions && CRM_Core_Permission::check(['access CiviCRM']))) {
  $tasks['Banaddr']['setValid'] = [
    'title' => E::ts('Set Valid'),
    'apiBatch' => [
      'action' => 'setValid',
      'params' => NULL, // Optional array of additional api params
      'confirmMsg' => E::ts('Are you sure you want to set valid %1 %2?'), // If omitted, the action will run immediately with no confirmation
      'runMsg' => E::ts('Setting valid %1 %2...'),
      'successMsg' => E::ts('Successfully valid set %1 %2.'),
      'errorMsg' => E::ts('An error occurred while attempting to set valid %1 %2.')
    ]
  ];
  $tasks['Banaddr']['setInvalid'] = [
    'title' => E::ts('Set Invalid'),
    'apiBatch' => [
      'action' => 'setInvalid',
      'params' => NULL, // Optional array of additional api params
      'confirmMsg' => E::ts('Are you sure you want to set invalid on %1 %2?'), // If omitted, the action will run immediately with no confirmation
      'runMsg' => E::ts('Setting invalid on %1 %2...'),
      'successMsg' => E::ts('Successfully invalid set on %1 %2.'),
      'errorMsg' => E::ts('An error occurred while attempting to set invalid %1 %2.')
    ]
  ];
}
if(!$checkPermissions || ($checkPermissions && CRM_Core_Permission::check(['administer CiviCRM']))) {
  $tasks['Banaddr']['setStale'] = [
    'title' => E::ts('Set Stale'),
    'apiBatch' => [
      'action' => 'setStale',
      'params' => NULL, // Optional array of additional api params
      'confirmMsg' => E::ts('Are you sure you want to set stale on %1 %2?'), // If omitted, the action will run immediately with no confirmation
      'runMsg' => E::ts('Setting stale on %1 %2...'),
      'successMsg' => E::ts('Successfully stale set on %1 %2.'),
      'errorMsg' => E::ts('An error occurred while attempting to set stale %1 %2.')
    ]
  ];
  $tasks['Banaddr']['setUnchecked'] = [
    'title' => E::ts('Set Unchecked'),
    'apiBatch' => [
      'action' => 'setUnchecked',
      'params' => NULL, // Optional array of additional api params
      'confirmMsg' => E::ts('Are you sure you want to set unchecked on %1 %2?'), // If omitted, the action will run immediately with no confirmation
      'runMsg' => E::ts('Setting unchecked on %1 %2...'),
      'successMsg' => E::ts('Successfully unchecked set on %1 %2.'),
      'errorMsg' => E::ts('An error occurred while attempting to set unchecked on %1 %2.')
    ]
  ];
}
}

function civisolraddr_civicrm_navigationmenu(&$menu)
{
  _civisolraddr_civix_insert_navigation_menu($menu,'',
   [ 'label'=>ts('UEPAL Civisolraddr'),
     'name'=>'uepal_civisolraddr',
     'permission'=>'access CiviCRM'

   ]);

  _civisolraddr_civix_insert_navigation_menu($menu,'uepal_civisolraddr',
   [ 'label'=>ts('Banaddr : Rapprochement Rapide'),
     'name'=>'banaddr_uncheck_records',
     'permission'=>'access CiviCRM',
     'url'=>'civicrm/banaddr/afform/unchecked-operations',
     'active'=>1
   ]);

 _civisolraddr_civix_insert_navigation_menu($menu,'uepal_civisolraddr',
   [ 'label'=>ts('Banaddr : Stale Records'),
     'name'=>'banaddr_stale_records',
     'permission'=>'access CiviCRM',
     'url'=>'civicrm/banaddr/afform/stale-records',
     'active'=>1
   ]);

 _civisolraddr_civix_insert_navigation_menu($menu,'uepal_civisolraddr',
   [ 'label'=>ts('Banaddr : Invalid Records'),
     'name'=>'banaddr_invalid_records',
     'permission'=>'access CiviCRM',
     'url'=>'civicrm/banaddr/afform/invalid-records',
     'active'=>1
   ]);

 _civisolraddr_civix_insert_navigation_menu($menu,'uepal_civisolraddr',
   [ 'label'=>ts('Banaddr : all records'),
     'name'=>'banaddr_all_records',
     'permission'=>'access CiviCRM',
     'url'=>'civicrm/banaddr/afform/all-records',
     'active'=>1
   ]);

 _civisolraddr_civix_insert_navigation_menu($menu,'uepal_civisolraddr',
   [ 'label'=>ts('Ping Registered Cores'),
     'name'=>'civisolraddr_ping_registered_cores',
     'permission'=>'access CiviCRM',
     'url'=>'civicrm/civisolraddr/pingcores',
     'active'=>1

   ]);

  _civisolraddr_civix_navigationMenu($menu);
}
/**
 * On veut "access CiviCRM" dans tous les cas.
 *
 * Ensuite Plusieurs cas :
 *  "edit all contacts" | "view all contacts" : on ne filtre pas
 *  sinon "view my contact" / "edit my contact" : on filtre sur le contact courant
 * 'delete contacts'
 * Et on rajoute si nécessaire le filtrage sur "access deleted contacts"
 */
function civisolraddr_civicrm_selectWhereClause(string $entity, array &$clauses, int $userId, array $conditions)
{
  if($entity==\Civi\Api4\Banaddr::getEntityName())
  {
    if(!array_key_exists('addr_id',$clauses))
    {
      $clauses['addr_id']=[];
    }
    $accessCiviPerm=CRM_Core_Permission::check('access CiviCRM',$userId);
    $allContactsPerm=CRM_Core_Permission::check([['edit all contacts','view all contacts']],$userId);
    $myContactPerm=CRM_Core_Permission::check([['view my contact','edit my contact']],$userId);
    $deletedContactPerm=CRM_Core_Permission::check(['access deleted contacts'],$userId);
    if(! ($accessCiviPerm&&($allContactsPerm || $myContactPerm)) )
    {
      $clauses['addr_id'][]= "IS NULL";//ce qui est impossible car est en not null=>pas d'enregistrements retournés (c'est volontaire)
    }
    else {
      if ($allContactsPerm) {
        ;//do nothing
      } else if ($myContactPerm) {
        $clauses['addr_id'][] = "IN (SELECT id FROM civicrm_address where contact_id=$userId)";
      }
      if(!$deletedContactPerm) {
        $clauses['addr_id'][] = "IN (SELECT id FROM civicrm_address where contact_id IN ( SELECT id from civicrm_contact where is_deleted=0))";
      }
    }

  }

}
