<?php

require_once __DIR__ . '/ressources/Job.php';
require_once __DIR__ . '/ressources/Profile.php';
require_once __DIR__ . '/ressources/Source.php';
require_once __DIR__ . '/ressources/Webhook.php';
require_once __DIR__ . '/ressources/GuzzleWrapper.php';

class Hrflow
{
  public $DEFAULT_HOST = "https://www.rimstaging.net/sf/public/api/";
  public $DEFAULT_HOST_BASE = "v1.0/";

  public function __construct($apiSecret, $webhookSecret=null) {
    $this->auth = array();
    $this->webhookSecret = $webhookSecret;

    $this->_rest = new GuzzleWrapper(array(
      "base_url"     => $this->DEFAULT_HOST . $this->DEFAULT_HOST_BASE,
      "headers"      => ["X-API-KEY"     => $apiSecret],
    ), $this->DEFAULT_HOST . $this->DEFAULT_HOST_BASE);
    $this->job   = new HrflowJob($this);
    $this->profile  = new HrflowProfile($this);
    $this->source   = new HrflowSource($this);
    $this->webhooks  = new HrflowWebhook($this);
  }

}
?>
