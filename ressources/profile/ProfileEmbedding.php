<?php

require_once  __DIR__.'/../RequestBodyUtils.php';
require_once  __DIR__.'/../ValueFormater.php';

/**
 *
 */
class ProfileEmbedding
{

  public function __construct($parent) {
    $this->client = $parent;
  }


  public function get($source_id, HrflowProfileIdent $profile_ident, $fields=[]) {
    $params = ['source_id' => $source_id];

    if($fields){
      $params['fields'] = json_encode($fields) ;
    }
    $profile_ident->addToArray($params);
    $resp = $this->client->_rest->get("profile/embedding", $params);

    return json_decode($resp->getBody(), true);
  }
}

 ?>
