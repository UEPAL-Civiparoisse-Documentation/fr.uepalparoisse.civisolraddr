<?php

class CRM_Civisolraddr_Banaddr_Query
{
  protected string $addr;
  protected string $city;
  protected string $dept;

  public function getAddr(): string
  {
    return $this->addr;
  }

  public function setAddr(string $addr): void
  {
    $this->addr = $addr;
  }

  public function getCity(): string
  {
    return $this->city;
  }

  public function setCity(string $city): void
  {
    $this->city = $city;
  }

  public function getDept(): string
  {
    return $this->dept;
  }

  public function setDept(string $dept): void
  {
    $this->dept = $dept;
  }

  public function __construct(string $addr, string $city, string $dept)
  {
    $this->setAddr($addr);
    $this->setCity($city);
    $this->setDept($dept);
  }

  public static function analyzeCoreAddress(CRM_Core_BAO_Address $addr, bool $setStatus = true): ?CRM_Civisolraddr_Banaddr_Query
  {
    $ret = null;
    try {


      $city = $addr->city;
      $country_id = $addr->country_id;
      $street_address = $addr->street_address;
      $state_province_id = $addr->state_province_id;
      $postcode = $addr->postal_code;
      $country = new CRM_Core_BAO_Country();
      $state_province = new CRM_Core_DAO_StateProvince();
      if (is_null($street_address) || $street_address == "") {
        throw new Exception("Street address not filled");
      }
      if (is_null($city) || $city == "") {
        throw new Exception("City not filled");
      }
      if (!$country_id) {
        throw new Exception("Country not filled");
      }
      $country->id = $country_id;

      if (!$country->find(true)) {
        throw new Exception("Country not found");
      }
      if ($country->iso_code != 'FR') {
        throw new Exception("Only FR is supported");
      }
      if (is_null($state_province_id) || $state_province_id=="null") {
        Civi::log()->info("Deducing Dept from CP");
        if (!is_null($postcode) && $postcode != "") {
          $deptId = substr($postcode, 0, 2);
          $apiProvince = \Civi\Api4\StateProvince::get(false)->setSelect(['id'])
            ->setWhere([['abbreviation', '=', $deptId], ['country_id', '=', $country_id]])
            ->execute()->first();
          if (is_array($apiProvince) && array_key_exists('id', $apiProvince)) {
            $state_province->id = $apiProvince['id'];
          } else {
            throw new Exception("Could not deduce Departement from postcode");
          }
        } else {
          throw new Exception("Departement not set and Postcode not set");
        }

      } else {
        $state_province->id = $state_province_id;
      }
      if (!$state_province->find(true)) {
        throw new Exception("State_Province not found");
      }
      $dept = $state_province->abbreviation;
      $ret = new CRM_Civisolraddr_Banaddr_Query($street_address, $city, $dept);
    } catch (Exception $e) {
      Civi::log()->warning("For ADDR ID : " . $addr->id . " : " . $e->__toString());
      if ($setStatus) {
        CRM_Core_Session::setStatus($e->__toString(), 'error');
      }
    }


    return $ret;
  }
}
