<?php

require_once  __DIR__.'/../RequestBodyUtils.php';
require_once  __DIR__.'/../ValueFormater.php';

/**
 *
 */
class ProfileRevealing
{

  public function __construct($parent) {
    $this->client = $parent;
  }


  public function get(HrflowProfileIdent $profile_ident, HrflowJobIdent $job_ident, string $source_id) {
    $params = [
      'source_id'  => $source_id
    ];
    $profile_ident->addToArray($params);
    $job_ident->addToArray($params);
    $resp = $this->client->_rest->get("profile/revealing", $params);

    return json_decode($resp->getBody(), true);
  }
}


 ?>
