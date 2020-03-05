<?php


  class HrflowSource
  {
    public function __construct($parent) {
      $this->hrflow = $parent;
    }

    public function list($name=null, $page=1, $limit=30, $sort_by='date', $order_by='desc') {
      $payload = [] ;
      if($name){
        $payload['name'] = $name ;
      }
      $payload['page'] = $page;
      $payload['limit'] = $limit;
      $payload['sort_by'] = $sort_by ;
      $payload['order_by'] = $order_by;
      $resp = $this->hrflow->_rest->get("sources", $payload);

      return json_decode($resp->getBody(), true)['data'];
    }

    public function get(string $source_id) {
      $query = ['source_id' => $source_id];
      $resp = $this->hrflow->_rest->get("source", $query);

      return json_decode($resp->getBody(), true)['data'];
    }
  }
 ?>
