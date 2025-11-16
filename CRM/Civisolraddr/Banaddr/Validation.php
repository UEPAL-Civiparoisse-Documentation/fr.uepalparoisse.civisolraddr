<?php

use CRM_Civisolraddr_ExtensionUtil as E;
enum CRM_Civisolraddr_Banaddr_Validation : string
{
  case UNCHECKED="unchecked";
  case  VALID="valid";
  case INVALID="invalid";
  case STALE="stale";

  public static function getValues(): array
  {
    $res=[];
   foreach(static::cases() as $c)
    {
     $res[$c->value]=['id'=>$c->value,'name'=>$c->value,'label'=>E::ts($c->value)];
    }
   return $res;
  }
}



