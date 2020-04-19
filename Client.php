<?php

require_once __DIR__ . '/ressources/job/Job.php';
require_once __DIR__ . '/ressources/profile/Profile.php';
require_once __DIR__ . '/ressources/source/Source.php';
require_once __DIR__ . '/ressources/webhook/Webhook.php';
require_once __DIR__ . '/ressources/GuzzleWrapper.php';

class Client
{
  public $DEFAULT_HOST = "https://api.hrflow.ai/";
  public $DEFAULT_HOST_BASE = "v1/";

  public function __construct($apiSecret, $webhookSecret=null) {
    $this->auth = array();
    $this->webhookSecret = $webhookSecret;

    $this->_rest = new GuzzleWrapper(array(
      "base_url"     => $this->DEFAULT_HOST . $this->DEFAULT_HOST_BASE,
      "headers"      => ["X-API-KEY"     => $apiSecret],
    ), $this->DEFAULT_HOST . $this->DEFAULT_HOST_BASE);
    $this->job   = new Job($this);
    $this->profile  = new Profile($this);
    $this->source   = new Source($this);
    $this->webhooks  = new Webhook($this);
  }

}
?>
