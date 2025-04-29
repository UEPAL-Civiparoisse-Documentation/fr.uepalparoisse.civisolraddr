<?php

class CRM_Civisolraddr_SolrClient implements CRM_Civisolraddr_ISolrClient
{

  private static CRM_Civisolraddr_SolrClient $instance;
  protected SolrClient $solrClient;

  protected array $registeredCores;
  protected string $spellcheckHandler;
  protected string $searchHandler;

  protected string $pingHandler;

  protected function getPingHandler(): string
  {
    return $this->pingHandler;
  }

  protected function setPingHandler(string $pingHandler): void
  {
    $this->pingHandler = $pingHandler;
  }


  protected function getSolrClient(): SolrClient
  {
    return $this->solrClient;
  }

  protected function setSolrClient(SolrClient $solrClient): void
  {
    $this->solrClient = $solrClient;
  }

  public function getRegisteredCores(): array
  {
    return $this->registeredCores;
  }

  protected function setRegisteredCores(array $registeredCores): void
  {
    $this->registeredCores = $registeredCores;
  }

  protected function getSpellcheckHandler(): string
  {
    return $this->spellcheckHandler;
  }

  protected function setSpellcheckHandler(string $spellcheckHandler): void
  {
    $this->spellcheckHandler = $spellcheckHandler;
  }

  protected function getSearchHandler(): string
  {
    return $this->searchHandler;
  }

  protected function setSearchHandler(string $searchHandler): void
  {
    $this->searchHandler = $searchHandler;
  }

  public static function singleton(): CRM_Civisolraddr_SolrClient
  {
    if (!isset(self::$instance)) {
      self::$instance = new CRM_Civisolraddr_SolrClient();
    }
    return self::$instance;
  }


  public function isDepartementAvailable(string $dept): bool
  {
    $cores = $this->getRegisteredCores();
    return array_key_exists($dept, $cores);
  }

  protected function retrieveCore(string $dept): string
  {
    $ret = "";
    if ($this->isDepartementAvailable($dept)) {
      $cores = $this->getRegisteredCores();
      $ret = $cores[$dept];
    }
    return $ret;
  }

  protected function __construct()
  {
    $settings = Civi::settings();
    $log = Civi::log();
    $this->setSpellcheckHandler($settings->get("civisolraddr_solr_spellcheck_handler"));
    $this->setSearchHandler($settings->get("civisolraddr_solr_search_handler"));
    $this->setPingHandler($settings->get("civisolraddr_solr_ping_handler"));
    $rawcores = Civi::settings()->get("civisolraddr_solr_cores");
    $cores = json_decode($rawcores, true);
    $this->setRegisteredCores($cores);
    $params = [
      'secure' => true,
      'hostname' => $settings->get("civisolraddr_solr_hostname"),
      'port' => $settings->get("civisolraddr_solr_port"),
      'path' => $settings->get("civisolraddr_solr_base_path"),
      'ssl_cainfo' => $settings->get("civisolraddr_solr_ssl_cainfo")
    ];

    try {
      $this->solrClient = new SolrClient($params);
    } catch (SolrIllegalArgumentException $e) {
      Civi::log()->error($e->__toString());
    }
  }

  public function isEnabled(): bool
  {
    $enabled = Civi::settings()->get("civisolraddr_use_solr");
    return ($enabled === 1 || $enabled === true);
  }

  public function spellcheck(string $city, string $dept): CRM_Civisolraddr_SpellcheckResult
  {
    $ret = CRM_Civisolraddr_SpellcheckResult::UNKNOWN;
    try {
      $log = Civi::log();
      if ($this->isEnabled() && $this->isDepartementAvailable($dept)) {
        $client = $this->getSolrClient();
        $handler = join('/', [$this->retrieveCore($dept), $this->getSpellcheckHandler()]);
        $client->setServlet(SolrClient::SEARCH_SERVLET_TYPE, $handler);
        $q = new SolrQuery(SolrUtils::escapeQueryChars($city));
        $response = $client->query($q);
        $response->setParseMode(SolrResponse::PARSE_SOLR_OBJ);
        $solrObj = $response->getResponse();
        $spelled = $solrObj['spellcheck']['correctlySpelled'];
        if ($spelled === TRUE) {
          $ret = CRM_Civisolraddr_SpellcheckResult::RIGHT;
        }
        if ($spelled === FALSE) {
          $ret = CRM_Civisolraddr_SpellcheckResult::WRONG;
        }
      }
    } catch (Exception $e) {
      CRM_Core_Session::setStatus($e->__toString(), "error");
      Civi::log()->error($e->__toString());
    }
    return $ret;
  }

  public function suggest(string $city, string $dept): array
  {
    $ret = [];
    try {
      if ($this->isEnabled() && $this->isDepartementAvailable($dept)) {
        $client = $this->getSolrClient();
        $handler = join('/', [$this->retrieveCore($dept), $this->getSpellcheckHandler()]);
        $client->setServlet(SolrClient::SEARCH_SERVLET_TYPE, $handler);
        $q = new SolrQuery(SolrUtils::escapeQueryChars($city));
        $response = $client->query($q);
        $response->setParseMode(SolrResponse::PARSE_SOLR_OBJ);
        $solrObj = $response->getResponse();
        foreach ($solrObj['suggest'] as $suggester) {
          foreach ($suggester as $term) {
            foreach ($term['suggestions'] as $suggestion) {
              $ret[] = $suggestion['payload'];
            }
          }
        }
      }
    } catch (Exception $e) {
      CRM_Core_Session::setStatus($e->__toString(), "error");
      Civi::log()->error($e->__toString());
    }
    return $ret;

  }

  public function retrieveBAN(CRM_Civisolraddr_Banaddr_Query $query): array
  {
    $ret = [];
    try {


      if ($query && $query->getCity() && $query->getAddr() && $query->getDept() && $this->isEnabled()
        && $this->isDepartementAvailable($query->getDept())
        && $this->spellcheck($query->getCity(), $query->getDept()) == CRM_Civisolraddr_SpellcheckResult::RIGHT) {
        $client = $this->getSolrClient();
        $core = $this->retrieveCore($query->getDept());
        $handler = join('/', [$this->retrieveCore($query->getDept()), $this->getSearchHandler()]);
        $client->setServlet(SolrClient::SEARCH_SERVLET_TYPE, $handler);
        $q = new SolrQuery(SolrUtils::escapeQueryChars($query->getAddr()));
        $q->addFilterQuery("nom_commune:" . SolrUtils::queryPhrase($query->getCity()));
        $response = $client->query($q);
        $response->setParseMode(SolrResponse::PARSE_SOLR_DOC);
        $solrObj = $response->getResponse();
        $docs = $solrObj["response"]["docs"];
        foreach ($docs as $doc) {
          $ret[] = new CRM_Civisolraddr_Banaddr_Document($doc);
        }
      }
    } catch (Exception $e) {
      CRM_Core_Session::setStatus($e->__toString(), "error");
      Civi::log()->error($e->__toString());
    }
    return $ret;
  }


  public function syncAddress(\CRM_Core_BAO_Address $addr, bool $setStatus = false): void
  {

    $elem_id = -1;
    $elem = Civi\Api4\Banaddr::get()->setSelect(["id"])->setWhere([["addr_id", "=", $addr->id]])->execute()->first();
    if ($elem != null && array_key_exists("id", $elem)) {
      $elem_id = $elem["id"];
      Civi\Api4\Banaddr::setStale(false)->setWhere([["id", "=", $elem_id]])->execute();
    }
    $query = CRM_Civisolraddr_Banaddr_Query::analyzeCoreAddress($addr, $setStatus);
    if (!is_null($query)) {
      $result = CRM_Civisolraddr_SolrClient::singleton()->retrieveBAN($query);
      if (count($result) > 0 && $result[0] instanceof CRM_Civisolraddr_Banaddr_Document) {
        $values = CRM_Civisolraddr_BAO_Banaddr::populateToUncheckedArray($addr->id, $result[0]);
        if ($elem_id != -1) {
          Civi\Api4\Banaddr::update(false)->setValues($values)->addWhere('id', '=', $elem_id)->execute();
        } else {
          Civi\Api4\Banaddr::create(false)->setValues($values)->execute();
        }
      }
    }
  }

  public function retrieveDepts(): array
  {
    $res = [];
    $depts = array_keys($this->getRegisteredCores());
    foreach ($depts as $dept) {
      $deptname = (Civi\Api4\StateProvince::get(false)
        ->addWhere('country_id.iso_code', '=', 'FR')
        ->addWhere('abbreviation', '=', $dept)
        ->addSelect('name')->execute()->first())['name'];
      $res[$dept] = $deptname . " ($dept)";
    }
    return $res;
  }

  public function retrieveCities(string $dept, bool $setStatus = false): array
  {
    $ret = [];
    try {
      if ($this->isEnabled() && array_key_exists($dept, $this->getRegisteredCores())) {
        $client = $this->getSolrClient();
        $core = $this->retrieveCore($dept);
        $handler = join('/', [$core, $this->getSearchHandler()]);
        $client->setServlet(SolrClient::SEARCH_SERVLET_TYPE, $handler);
        $q = new SolrQuery("*:*");
        $q->setRows(0);
        $q->setFacet(true);
        $q->setFacetLimit(-1);
        $q->setFacetMinCount(1);
        $q->setFacetMissing(false);
        $q->addFacetField('ville_facet');
        $response = $client->query($q);
        $response->setParseMode(SolrResponse::PARSE_SOLR_OBJ);
        $solrObj = $response->getResponse();
        $facets = $solrObj["facet_counts"]["facet_fields"]["ville_facet"];
        foreach ($facets as $k => $v) {
          $ret[] = $k;
        }
      }
    } catch
    (Exception $e) {

      Civi::log()->error($e->__toString());
      if ($setStatus) {
        CRM_Core_Session::setStatus($e->__toString(), 'Error', 'error');
      }
    }
    return $ret;
  }

  public function retrieveStreets(string $dept, string $city, bool $setStatus = false): array
  {
    $ret = [];
    try {
      if ($this->isEnabled() && array_key_exists($dept, $this->getRegisteredCores())) {
        $client = $this->getSolrClient();
        $core = $this->retrieveCore($dept);
        $handler = join('/', [$core, $this->getSearchHandler()]);
        $client->setServlet(SolrClient::SEARCH_SERVLET_TYPE, $handler);
        $q = new SolrQuery("*:*");
        $q->setRows(0);
        $q->setFacet(true);
        $q->setFacetLimit(-1);
        $q->setFacetMinCount(1);
        $q->setFacetMissing(false);
        $q->addFacetField('voie_facet');
        $q->addFilterQuery("nom_commune:" . SolrUtils::queryPhrase($city));
        $response = $client->query($q);
        $response->setParseMode(SolrResponse::PARSE_SOLR_OBJ);
        $solrObj = $response->getResponse();
        $facets = $solrObj["facet_counts"]["facet_fields"]["voie_facet"];
        foreach ($facets as $k => $v) {
          $ret[] = $k;
        }
      }
    } catch
    (Exception $e) {

      Civi::log()->error($e->__toString());
      if ($setStatus) {
        CRM_Core_Session::setStatus($e->__toString(), 'Error', 'error');
      }
    }
    return $ret;
  }

  public function retrieveNumeroReps(string $dept, string $city, string $street, bool $setStatus = false): array
  {
    $ret = [];
    try {
      if ($this->isEnabled() && array_key_exists($dept, $this->getRegisteredCores())) {
        $client = $this->getSolrClient();
        $core = $this->retrieveCore($dept);
        $handler = join('/', [$core, $this->getSearchHandler()]);
        $client->setServlet(SolrClient::SEARCH_SERVLET_TYPE, $handler);
        $q = new SolrQuery("*:*");
        $q->setRows(0);
        $q->setFacet(true);
        $q->setFacetLimit(-1);
        $q->setFacetMinCount(1);
        $q->setFacetMissing(false);
        $q->addFacetField('numero_rep_facet');
        $q->addFilterQuery("nom_commune:" . SolrUtils::queryPhrase($city));
        $q->addFilterQuery("nom_voie:" . SolrUtils::queryPhrase($street));
        $response = $client->query($q);
        $response->setParseMode(SolrResponse::PARSE_SOLR_OBJ);
        $solrObj = $response->getResponse();
        $facets = $solrObj["facet_counts"]["facet_fields"]["numero_rep_facet"];
        foreach ($facets as $k => $v) {
          $ret[] = $k;
        }
      }
    } catch
    (Exception $e) {

      Civi::log()->error($e->__toString());
      if ($setStatus) {
        CRM_Core_Session::setStatus($e->__toString(), 'Error', 'error');
      }
    }
    return $ret;
  }


  public function retrievePostcodes(string $dept, string $city, string $street, string $numrep, bool $setStatus = false): array
  {
    $ret = [];
    try {
      if ($this->isEnabled() && array_key_exists($dept, $this->getRegisteredCores())) {
        $client = $this->getSolrClient();
        $core = $this->retrieveCore($dept);
        $handler = join('/', [$core, $this->getSearchHandler()]);
        $client->setServlet(SolrClient::SEARCH_SERVLET_TYPE, $handler);
        $q = new SolrQuery("*:*");
        $q->setRows(0);
        $q->setFacet(true);
        $q->setFacetLimit(-1);
        $q->setFacetMinCount(1);
        $q->setFacetMissing(false);
        $q->addFacetField('code_postal_facet');
        $q->addFilterQuery("nom_commune:" . SolrUtils::queryPhrase($city));
        $q->addFilterQuery("nom_voie:" . SolrUtils::queryPhrase($street));
        $q->addFilterQuery("numero_rep:" . SolrUtils::queryPhrase($numrep));

        $response = $client->query($q);
        $response->setParseMode(SolrResponse::PARSE_SOLR_OBJ);
        $solrObj = $response->getResponse();
        $facets = $solrObj["facet_counts"]["facet_fields"]["code_postal_facet"];
        foreach ($facets as $k => $v) {
          $ret[] = $k;
        }
      }
    } catch
    (Exception $e) {

      Civi::log()->error($e->__toString());
      if ($setStatus) {
        CRM_Core_Session::setStatus($e->__toString(), 'Error', 'error');
      }
    }
    return $ret;
  }

  public function pingDept(string $dept): bool
  {
    $res = false;
    try {
      $core = $this->retrieveCore($dept);
      $res = $this->pingCore($core);
    } catch (Exception $e) {
      Civi::log()->error($e->__toString());
    }
    return $res;
  }

  public function pingCore(string $core): bool
  {
    $res = false;
    if ($this->isEnabled()) {
      $client = $this->getSolrClient();
      $handler = join('/', [$core, $this->getPingHandler()]);
      $client->setServlet(SolrClient::PING_SERVLET_TYPE, $handler);
      try {
        $response = $client->ping();
        $res = $response->success();
      } catch (Exception $e) {
        Civi::log()->error($e->__toString());
      }

    }
    return $res;
  }

}
