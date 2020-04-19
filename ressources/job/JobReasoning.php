<?php

require_once  __DIR__.'/../RequestBodyUtils.php';

/**
 *
 */
class JobReasoning
{

  public function __construct($parent) {
    $this->client = $parent;
  }

  public function list() {
    $resp = [];
    return json_decode($resp->getBody(), true);
  }
}

 ?>
