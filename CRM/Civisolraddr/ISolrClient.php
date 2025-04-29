<?php
interface CRM_Civisolraddr_ISolrClient
{
  public function getRegisteredCores(): array;
  public function isDepartementAvailable(string $dept): bool;
  public function isEnabled(): bool;
  public function spellcheck(string $city, string $dept): CRM_Civisolraddr_SpellcheckResult;
  public function suggest(string $city, string $dept): array;
  public function retrieveBAN(CRM_Civisolraddr_Banaddr_Query $query): array;
  public function syncAddress(\CRM_Core_BAO_Address $addr, bool $setStatus = false): void;
  public function retrieveDepts(): array;
  public function retrieveCities(string $dept, bool $setStatus = false): array;
  public function retrieveStreets(string $dept, string $city, bool $setStatus = false): array;
  public function retrieveNumeroReps(string $dept, string $city, string $street, bool $setStatus = false): array;
  public function retrievePostcodes(string $dept, string $city, string $street, string $numrep, bool $setStatus = false): array;

}
