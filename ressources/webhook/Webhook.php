<?php

  /**
   *
   */
  class Webhook
  {
    private const SIGNATURE_HEADER = 'HTTP-HRFLOW-SIGNATURE';

    public function __construct($parent) {
      $this->client = $parent;
      $this->handlers = [
          HrflowEvents::PROFILE_PARSING_SUCCESS     => null,
          HrflowEvents::PROFILE_PARSING_ERROR       => null,
          HrflowEvents::PROFILE_EMBEDDING_SUCCESS   => null,
          HrflowEvents::PROFILE_EMBEDDING_ERROR     => null,
          HrflowEvents::JOB_PARSING_SUCCESS         => null,
          HrflowEvents::JOB_PARSING_ERROR           => null,
          HrflowEvents::JOB_EMBEDDING_SUCCESS       => null,
          HrflowEvents::JOB_EMBEDDING_ERROR         => null,
          HrflowEvents::ACTION_STAGE_SUCCESS        => null,
          HrflowEvents::ACTION_STAGE_ERROR          => null,
          HrflowEvents::ACTION_RATING_SUCCESS       => null,
          HrflowEvents::ACTION_RATING_ERROR         => null
      ];
    }

    public function check($url, $type) {
      $json = ['url' => $url, 'type' => $type] ;
      $resp = $this->client->_rest->postJson("webhook/check", $json);

      return json_decode($resp->getBody(), true);
    }

    public function test() {
      $resp = $this->client->_rest->post("webhook/test");

      return json_decode($resp->getBody(), true);
    }

    // Add an handler for a given event.
    public function setHandler($eventName, $callback) {
      if (!array_key_exists($eventName, $this->handlers)){
        throw new \HrflowApiArgumentException($eventName." is not a valid event.");
      }
      if (!is_callable($callback)){
        throw new \HrflowApiArgumentException($callback." is not callable.");
      }
      $this->handlers[$eventName] = $callback;
    }

    public function isHandlerPresent($eventName) {
      if (!array_key_exists($eventName, $this->handlers)){
        throw new \HrflowApiArgumentException($eventName." is not a valid event.");
      }
      return $this->handlers[$eventName] != null;
    }

    public function removeHandler($eventName) {
      if (!array_key_exists($eventName, $this->handlers)){
        throw new \HrflowApiArgumentException($eventName." is not a valid event.");
      }
      $this->handlers[$eventName] = null;
    }

    private static function base64UrlDecode($inp) {
      return base64_decode(strtr($inp, '-_', '+/'));
    }

    private function is_signature_valid($sign, $payload) {
      $exp_sign = hash_hmac('sha256', $payload, $this->client->webhookSecret, $raw=true);
      return $sign === $exp_sign;
    }

    private function decode_request($encodedRequest) {
      list($encoded_sign, $payload) = explode('.', $encodedRequest, 2);
      if (empty($encoded_sign) || empty($payload)) {
        throw new \HrflowApiArgumentException("Error invalid request. Maybe it's not the 'HTTP_HRFLOW_SIGNATURE' field");
      }

      $sign = self::base64UrlDecode($encoded_sign);
      $data = self::base64UrlDecode($payload);
      if (!$this->is_signature_valid($sign, $data)) {
        throw new \HrflowApiWebhookException("Error: invalid signature.");
      }

      return json_decode($data, true);
    }

    private function getHandlerForEvent($eventName) {
      if (!array_key_exists($eventName, $this->handlers)) {
        throw new \HrflowApiWebhookException("Error: ".$eventName." is a invalid event.");
      }
      $handler = $this->handlers[$eventName];
      return $handler;
    }

    private function getEncodedHeader($data) {
      if (is_array($data)) {
        if (array_key_exists(self::SIGNATURE_HEADER, $data)) {
          return $data[self::SIGNATURE_HEADER];
        }
        throw new \HrflowApiWebhookException("Error header does not contains ".self::SIGNATURE_HEADER);
      }
      return $data;
    }

    public function handle($encodedHeader) {
      if (is_null($this->hrflow->webhookSecret)) {
        throw new \HrflowApiWebhookException("No webhook secret.");
      }
      $encodedHeader = $this->getEncodedHeader($encodedHeader);
      $decoded_request = $this->decode_request($encodedHeader);

      if (!array_key_exists('type', $decoded_request)) {
        throw new \HrflowApiWebhookException("Error: Invalid request: no 'type' field found.");
      }
      $handler = $this->getHandlerForEvent($decoded_request['type']);
      if (is_null($handler)){
        return;
      }

      $handler($decoded_request, $decoded_request['type']);
    }
  }

 ?>
