<?php

require_once  __DIR__.'/../RequestBodyUtils.php';
require_once  __DIR__.'/../ValueFormater.php';

/**
 *
 */
class ProfileFeedback
{
  public function __construct($parent) {
    $this->hrflow = $parent;
  }

  public function set(HrflowProfileIdent $profile_ident, HrflowJobIdent $job_ident, string $stage=null, int $rating=null) {
    $payload = array(
        'stage'       => $stage,
        'rating'   => $rating,
    );
    $profile_ident->addToArray($payload);
    $job_ident->addToArray($payload);
    $resp = $this->hrflow->_rest->patch("profile/action", $payload);

    return json_decode($resp->getBody(), true)['data'];
  }

}

 ?>
