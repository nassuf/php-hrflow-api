<?php

require_once  __DIR__.'/../RequestBodyUtils.php';


/**
 *
 */
class JobParsing
{

  public function __construct($parent) {
    $this->client = $parent;
  }
  public function get(HrflowJobIdent $job_ident, string $job_reference=null) {
    $params = [] ;
    $job_ident->addToArray($params);
    $resp = $this->client->_rest->get("job/parsing", $params);

    return json_decode($resp->getBody(), true);
  }
}

?>
