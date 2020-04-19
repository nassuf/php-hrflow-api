<?php

require_once  __DIR__.'/../RequestBodyUtils.php';
require_once  __DIR__.'/../ValueFormater.php';

  /**
   *
   */
  class ProfileAttachment
  {

    public function __construct($parent) {
      $this->client = $parent;
    }

    public function list(string $source_id, HrflowProfileIdent $profile_ident) {
      $query = array(
        'source_id'  => $source_id
      );
      $profile_ident->addToArray($query);

      $resp = $this->client->_rest->get("profile/attachments", $query);

      return json_decode($resp->getBody(), true);
    }
  }

 ?>
