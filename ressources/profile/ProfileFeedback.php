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
    $data = array(
        'stage'       => $stage,
        'rating'   => $rating,
    );
    $profile_ident->addToArray($data);
    $job_ident->addToArray($data);
    $resp = $this->hrflow->_rest->patch("profile/action", $data);

    return json_decode($resp->getBody(), true)['data'];
  }

}

 ?>
