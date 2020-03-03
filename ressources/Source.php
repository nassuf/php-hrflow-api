<?php


  class HrflowSource
  {
    public function __construct($parent) {
      $this->hrflow = $parent;
    }

    public function list() {
      $resp = $this->hrflow->_rest->get("sources");

      return json_decode($resp->getBody(), true)['data'];
    }

    public function get(string $source_id) {
      $query = array('source_id' => $source_id);
      $resp = $this->hrflow->_rest->get("source", $query);

      return json_decode($resp->getBody(), true)['data'];
    }
  }
 ?>
