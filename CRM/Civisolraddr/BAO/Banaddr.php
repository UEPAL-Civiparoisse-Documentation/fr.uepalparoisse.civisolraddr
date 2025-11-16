<?php

use CRM_Civisolraddr_ExtensionUtil as E;
use Civi\Api4\Event\AuthorizeRecordEvent;
use Civi\Api4\Utils\CoreUtil;

class CRM_Civisolraddr_BAO_Banaddr extends CRM_Civisolraddr_DAO_Banaddr implements Civi\Core\HookInterface
{


  /**
   * Adaptation de CRM_Contact_AccessTrait
   * @see \Civi\Api4\Utils\CoreUtil::checkAccessRecord*
   */
  public static function self_civi_api4_authorizeRecord(AuthorizeRecordEvent $e): void
  {
    $record = $e->getRecord();
    $userId = $e->getUserID();
    $action = $e->getActionName();

    /**
     * il ne faut pas oublier que c'est une vérification si une vérification doit être faite
     * attention : les hooks utilisent l'api4 update et le create en checkPermissions à false : ils ne passent donc pas ici
     * - d'abord, vérifier quel est l'adresse et le contact concerné
     * - vérifier si le contact est deleted
     * plusieurs cas :
     * - setValid / setInvalid /  'edit all contacts', 'edit my contact' + 'access deleted contacts'
     * - setStale / setUnchecked /delete : 'administer CiviCRM'
     * - autres : on interdit
     *
     */
    $addrId = null;
    if ($action == "create") {
      $addrId = $record['addr_id'];
    } else {
      $banaddrId = $record['id'];
      $addrId = CRM_Core_DAO::getFieldValue("CRM_Civisolraddr_BAO_Banaddr", $banaddrId, 'addr_id');
    }
    $cid = null;
    $contact_deleted = null;
    if (!is_null($addrId)) {
      $cid = CRM_Core_DAO::getFieldValue("CRM_Core_BAO_Address", $addrId, 'contact_id');
    }
    if (!is_null($cid)) {
      $contact_deleted = CRM_Core_DAO::getFieldValue("CRM_Contact_BAO_Contact", $cid, 'is_deleted');
    }
    $considered_actions = ['setValid', 'setInvalid', 'setStale', 'setUnchecked', 'delete'];
    if (!is_null($addrId) && !is_null($cid) && !is_null($contact_deleted) && in_array($action, $considered_actions)) {
      $permissions = ["access CiviCRM"];
      switch ($action) {
        case 'setValid':
        case 'setInvalid':
          if ($cid === ("".$userId)) {
            $permissions[] = ['edit all contacts', 'edit my contact'];//fait exprès : il faut un tableau à ce niveau pour faire un OR
          } else {
            $permissions[] = 'edit all contacts';
          }
          if ($contact_deleted!=="0") {
            $permissions[] = 'access deleted contacts';
          }
          break;
        case 'setStale':
        case 'setUnchecked':
        case 'delete':
          $permissions[] = 'administer CiviCRM';
          break;
        default://ne doit pas arriver
          throw new Exception ("unhandled action : " . $action);
      }
      $e->setAuthorized(CRM_Core_Permission::check($permissions, $userId));
    } else {
      //on interdit de toute façon
      $e->setAuthorized(false);
    }
    $e->stopPropagation();//et on arrête la propagation
  }

  public static function populateToUncheckedArray(int $addr_id, CRM_Civisolraddr_Banaddr_Document $document): array
  {
    $numero = $document->getNumero();
    $is_even = ($numero % 2 == 0);
    $is_odd = ($numero % 2 == 1);

    return [
      "record_id" => $document->getId(),
      "addr_id" => $addr_id,
      "validation" => CRM_Civisolraddr_Banaddr_Validation::UNCHECKED->value,
      "id_fantoir" => $document->getIdFantoir(),
      "numero" => $numero,
      "is_even" => $is_even,
      "is_odd" => $is_odd,
      "neg_numero_odd" => ($is_odd ? -1 : 1) * $numero,
      "neg_numero_even" => ($is_even ? -1 : 1) * $numero,
      "rep" => $document->getRep(),
      "nom_voie" => $document->getNomVoie(),
      "code_postal" => $document->getCodePostal(),
      "code_insee" => $document->getCodeInsee(),
      "nom_commune" => $document->getNomCommune(),
      "code_insee_ancienne_commune" => $document->getCodeInseeAncienneCommune(),
      "nom_ancienne_commune" => $document->getNomAncienneCommune(),
      "proj_leg_x" => $document->getX(),
      'proj_leg_y' => $document->getY(),
      "gps_lon" => $document->getLon(),
      "gps_lat" => $document->getLat(),
      "type_position" => $document->getTypePosition(),
      "alias" => $document->getAlias(),
      "nom_lieu_dit" => $document->getNomLd(),
      "libelle_acheminement" => $document->getLibelleAcheminement(),
      "nom_afnor" => $document->getNomAfnor(),
      "source_position" => $document->getSourcePosition(),
      "source_nom_voie" => $document->getSourceNomVoie(),
      "certification_commune" => $document->getCertificationCommune(),
      "cad_parcelles" => $document->getCadParcelles(),
      "numero_rep" => $document->getNumeroRep(),
      "numero_departement" => $document->getNumeroDepartement(),
      "modified" => $document->getModified()
    ];
  }

  public function populate(int $addr_id, CRM_Civisolraddr_Banaddr_Document $document)
  {

    $this->record_id = $document->getId();
    $this->addr_id = $addr_id;
    $this->validation = CRM_Civisolraddr_Banaddr_Validation::UNCHECKED->value;
    $this->id_fantoir = $document->getIdFantoir();
    $this->numero = $document->getNumero();
    $this->is_even = (($document->getNumero()) % 2 == 0);
    $this->is_odd = (($document->getNumero()) % 2 == 1);
    $this->neg_numero_odd = ($this->is_odd ? -1 : 1) * $this->numero;
    $this->neg_numero_even = ($this->is_even ? -1 : 1) * $this->numero;
    $this->rep = $document->getRep();
    $this->nom_voie = $document->getNomVoie();
    $this->code_postal = $document->getCodePostal();
    $this->code_insee = $document->getCodeInsee();
    $this->nom_commune = $document->getNomCommune();
    $this->code_insee_ancienne_commune = $document->getCodeInseeAncienneCommune();
    $this->nom_ancienne_commune = $document->getNomAncienneCommune();
    $this->proj_leg_x = $document->getX();
    $this->proj_leg_y = $document->getY();
    $this->gps_lon = $document->getLon();
    $this->gps_lat = $document->getLat();
    $this->type_position = $document->getTypePosition();
    $this->alias = $document->getAlias();
    $this->nom_lieu_dit = $document->getNomLd();
    $this->libelle_acheminement = $document->getLibelleAcheminement();
    $this->nom_afnor = $document->getNomAfnor();
    $this->source_position = $document->getSourcePosition();
    $this->source_nom_voie = $document->getSourceNomVoie();
    $this->certification_commune = $document->getCertificationCommune();
    $this->cad_parcelles = $document->getCadParcelles();
    $this->numero_rep = $document->getNumeroRep();
    $this->numero_departement = $document->getNumeroDepartement();
    $this->modified = $document->getModified();
  }
}
