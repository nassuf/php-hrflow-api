<?php

require_once  __DIR__.'/../RequestBodyUtils.php';

/**
 *
 */
class JobSearching
{

  public function __construct($parent) {
    $this->client = $parent;
  }

  public function get(string $name=null) {
    $query = [] ;
    if($name){
      $query['name'] = $name ;
    }
    $resp = $this->client->_rest->get("jobs/searching");
    return json_decode($resp->getBody(), true);
  }
}

 ?>
