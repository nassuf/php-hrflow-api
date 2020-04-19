<?php

require_once  __DIR__.'/../RequestBodyUtils.php';
require_once  __DIR__.'/../ValueFormater.php';

/**
 *
 */
class ProfileReasoning
{
  public function __construct($parent) {
    $this->client = $parent;
  }

  public function get() {
    $resp = [] ;
    return json_decode($resp->getBody(), true);
  }
}

 ?>
