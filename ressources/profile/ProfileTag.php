<?php

require_once  __DIR__.'/../RequestBodyUtils.php';
require_once  __DIR__.'/../ValueFormater.php';

/**
 *
 */
class ProfileTag
{
  public function __construct($parent) {
    $this->client = $parent;
  }

  public function list($source_id, HrflowProfileIdent $profile_ident) {
    $query_param = [
        'source_id'   => $source_id
    ];
    $profile_ident->addToArray($query_param);

    $resp = $this->client->_rest->get("profile/tags", $query_param);

    return json_decode($resp->getBody(), true)['data'];
  }

}

 ?>
