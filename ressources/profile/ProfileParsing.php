<?php

require_once  __DIR__.'/../RequestBodyUtils.php';
require_once  __DIR__.'/../ValueFormater.php';

  /**
   *
   */
  class ProfileParsing
  {

    public function __construct($parent) {
      $this->client = $parent;
    }

    public function get(string $source_id, HrflowProfileIdent $profile_ident) {
      $params = [
        'source_id'  => $source_id
      ];
      $profile_ident->addToArray($params);
      $resp = $this->client->_rest->get("profile/parsing", $params);

      return json_decode($resp->getBody(), true)['data'];
    }
  }

 ?>
