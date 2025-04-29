<?php

class CRM_Civisolraddr_Banaddr_Document implements JsonSerializable
{

  protected string $id="";
  protected string $id_fantoir="";
  protected string $numero="";
  protected string $rep="";
  protected string $nom_voie="";
  protected string $code_postal="";
  protected string $code_insee="";
  protected string $nom_commune="";
  protected string $code_insee_ancienne_commune="";
  protected string $nom_ancienne_commune="";
  protected string $x="";
  protected string $y="";
  protected string $lon="";
  protected string $lat="";
  protected string $type_position="";
  protected string $alias="";
  protected string $nom_ld="";
  protected string $libelle_acheminement="";
  protected string $nom_afnor="";
  protected string $source_position="";
  protected string $source_nom_voie="";
  protected string $certification_commune="";
  protected string $cad_parcelles="";
  protected string $numero_departement="";
  protected string $modified="";

  protected string $numero_rep="";

    public function getNumeroRep(): string
    {
        return $this->numero_rep;
    }

    public function setNumeroRep(string $numero_rep): void
    {
        $this->numero_rep = $numero_rep;
    }


  public function getNumeroDepartement(): string
  {
    return $this->numero_departement;
  }

  public function setNumeroDepartement(string $numero_departement): void
  {
    $this->numero_departement = $numero_departement;
  }

  public function getModified(): string
  {
    return $this->modified;
  }

  public function setModified(string $modified): void
  {
    $this->modified = $modified;
  }

  public function getId(): string
  {
    return $this->id;
  }

  public function setId(string $id): void
  {
    $this->id = $id;
  }

  public function getIdFantoir(): string
  {
    return $this->id_fantoir;
  }

  public function setIdFantoir(string $id_fantoir): void
  {
    $this->id_fantoir = $id_fantoir;
  }

  public function getNumero(): string
  {
    return $this->numero;
  }

  public function setNumero(string $numero): void
  {
    $this->numero = $numero;
  }

  public function getRep(): string
  {
    return $this->rep;
  }

  public function setRep(string $rep): void
  {
    $this->rep = $rep;
  }

  public function getNomVoie(): string
  {
    return $this->nom_voie;
  }

  public function setNomVoie(string $nom_voie): void
  {
    $this->nom_voie = $nom_voie;
  }

  public function getCodePostal(): string
  {
    return $this->code_postal;
  }

  public function setCodePostal(string $code_postal): void
  {
    $this->code_postal = $code_postal;
  }

  public function getCodeInsee(): string
  {
    return $this->code_insee;
  }

  public function setCodeInsee(string $code_insee): void
  {
    $this->code_insee = $code_insee;
  }

  public function getNomCommune(): string
  {
    return $this->nom_commune;
  }

  public function setNomCommune(string $nom_commune): void
  {
    $this->nom_commune = $nom_commune;
  }

  public function getCodeInseeAncienneCommune(): string
  {
    return $this->code_insee_ancienne_commune;
  }

  public function setCodeInseeAncienneCommune(string $code_insee_ancienne_commune): void
  {
    $this->code_insee_ancienne_commune = $code_insee_ancienne_commune;
  }

  public function getNomAncienneCommune(): string
  {
    return $this->nom_ancienne_commune;
  }

  public function setNomAncienneCommune(string $nom_ancienne_commune): void
  {
    $this->nom_ancienne_commune = $nom_ancienne_commune;
  }

  public function getX(): string
  {
    return $this->x;
  }

  public function setX(string $x): void
  {
    $this->x = $x;
  }

  public function getY(): string
  {
    return $this->y;
  }

  public function setY(string $y): void
  {
    $this->y = $y;
  }

  public function getLon(): string
  {
    return $this->lon;
  }

  public function setLon(string $lon): void
  {
    $this->lon = $lon;
  }

  public function getLat(): string
  {
    return $this->lat;
  }

  public function setLat(string $lat): void
  {
    $this->lat = $lat;
  }

  public function getTypePosition(): string
  {
    return $this->type_position;
  }

  public function setTypePosition(string $type_position): void
  {
    $this->type_position = $type_position;
  }

  public function getAlias(): string
  {
    return $this->alias;
  }

  public function setAlias(string $alias): void
  {
    $this->alias = $alias;
  }

  public function getNomLd(): string
  {
    return $this->nom_ld;
  }

  public function setNomLd(string $nom_ld): void
  {
    $this->nom_ld = $nom_ld;
  }

  public function getLibelleAcheminement(): string
  {
    return $this->libelle_acheminement;
  }

  public function setLibelleAcheminement(string $libelle_acheminement): void
  {
    $this->libelle_acheminement = $libelle_acheminement;
  }

  public function getNomAfnor(): string
  {
    return $this->nom_afnor;
  }

  public function setNomAfnor(string $nom_afnor): void
  {
    $this->nom_afnor = $nom_afnor;
  }

  public function getSourcePosition(): string
  {
    return $this->source_position;
  }

  public function setSourcePosition(string $source_position): void
  {
    $this->source_position = $source_position;
  }

  public function getSourceNomVoie(): string
  {
    return $this->source_nom_voie;
  }

  public function setSourceNomVoie(string $source_nom_voie): void
  {
    $this->source_nom_voie = $source_nom_voie;
  }

  public function getCertificationCommune(): string
  {
    return $this->certification_commune;
  }

  public function setCertificationCommune(string $certification_commune): void
  {
    $this->certification_commune = $certification_commune;
  }

  public function getCadParcelles(): string
  {
    return $this->cad_parcelles;
  }

  public function setCadParcelles(string $cad_parcelles): void
  {
    $this->cad_parcelles = $cad_parcelles;
  }

  protected function retrieveValue(SolrDocumentField $field): string
  {
     $res="";
     $values=$field->values;
     if(is_array($values) && count($values)>0)
     {
         $res=$values[0];
     }
     return $res;
  }

  public function __construct(SolrDocument $document = null)
  {
    if ($document != null) {
      if (($field = $document->getField('id')) !== FALSE) $this->setId($this->retrieveValue($field));
      if (($field = $document->getField('id_fantoir')) !== FALSE) $this->setIdFantoir($this->retrieveValue($field));
      if (($field = $document->getField('numero')) !== FALSE) $this->setNumero($this->retrieveValue($field));
      if (($field = $document->getField('rep')) !== FALSE) $this->setRep($this->retrieveValue($field));
      if (($field = $document->getField('nom_voie')) !== FALSE) $this->setNomVoie($this->retrieveValue($field));
      if (($field = $document->getField('code_postal')) !== FALSE) $this->setCodePostal($this->retrieveValue($field));
      if (($field = $document->getField('code_insee')) !== FALSE) $this->setCodeInsee($this->retrieveValue($field));
      if (($field = $document->getField('nom_commune')) !== FALSE) $this->setNomCommune($this->retrieveValue($field));
      if (($field = $document->getField('code_insee_ancienne_commune')) !== FALSE) $this->setCodeInseeAncienneCommune($this->retrieveValue($field));
      if (($field = $document->getField('nom_ancienne_commune')) !== FALSE) $this->setNomAncienneCommune($this->retrieveValue($field));
      if (($field = $document->getField('x')) !== FALSE) $this->setX($this->retrieveValue($field));
      if (($field = $document->getField('y')) !== FALSE) $this->setY($this->retrieveValue($field));
      if (($field = $document->getField('lon')) !== FALSE) $this->setLon($this->retrieveValue($field));
      if (($field = $document->getField('lat')) !== FALSE) $this->setLat($this->retrieveValue($field));
      if (($field = $document->getField('type_position')) !== FALSE) $this->setTypePosition($this->retrieveValue($field));
      if (($field = $document->getField('alias')) !== FALSE) $this->setAlias($this->retrieveValue($field));
      if (($field = $document->getField('nom_ld')) !== FALSE) $this->setNomLd($this->retrieveValue($field));
      if (($field = $document->getField('libelle_acheminement')) !== FALSE) $this->setLibelleAcheminement($this->retrieveValue($field));
      if (($field = $document->getField('nom_afnor')) !== FALSE) $this->setNomAfnor($this->retrieveValue($field));
      if (($field = $document->getField('source_position')) !== FALSE) $this->setSourcePosition($this->retrieveValue($field));
      if (($field = $document->getField('source_nom_voie')) !== FALSE) $this->setSourceNomVoie($this->retrieveValue($field));
      if (($field = $document->getField('certification_commune')) !== FALSE) $this->setCertificationCommune($this->retrieveValue($field));
      if (($field = $document->getField('cad_parcelles')) !== FALSE) $this->setCadParcelles($this->retrieveValue($field));
      if (($field = $document->getField('numero_rep')) !== FALSE) $this->setNumeroRep($this->retrieveValue($field));
      if (($field = $document->getField('numero_departement')) !== FALSE) $this->setNumeroDepartement($this->retrieveValue($field));
      if (($field = $document->getField('modified')) !== FALSE) $this->setModified($this->retrieveValue($field));
    }
  }


  public function jsonSerialize(): mixed
  {
    $data = ['id' => $this->getId(),
      'id_fantoir' => $this->getIdFantoir(),
      'numero' => $this->getNumero(),
      'rep' => $this->getRep(),
      'nom_voie' => $this->getNomVoie(),
      'code_postal' => $this->getCodePostal(),
      'code_insee' => $this->getCodeInsee(),
      'nom_commune' => $this->getNomCommune(),
      'code_insee_ancienne_commune' => $this->getCodeInseeAncienneCommune(),
      'nom_ancienne_commune' => $this->getNomAncienneCommune(),
      'x' => $this->getX(),
      'y' => $this->getY(),
      'lon' => $this->getLon(),
      'lat' => $this->getLat(),
      'type_position' => $this->getTypePosition(),
      'alias' => $this->getAlias(),
      'nom_ld' => $this->getNomLd(),
      'libelle_acheminement' => $this->getLibelleAcheminement(),
      'nom_afnor' => $this->getNomAfnor(),
      'source_position' => $this->getSourcePosition(),
      'source_nom_voie' => $this->getSourceNomVoie(),
      'certification_commune' => $this->getCertificationCommune(),
      'cad_parcelles' => $this->getCadParcelles(),
      'numero_rep'=>$this->getNumeroRep(),
      'numero_departement' => $this->getNumeroDepartement(),
      'modified' => $this->getModified()];
    return $data;
  }

}
