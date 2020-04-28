<?php

require_once  __DIR__.'/../RequestBodyUtils.php';


class JobEmbedding
{
  public function __construct($parent)
  {
    $this->client = $parent;
  }

  public function get(HrflowJobIdent $job_ident)
  {
    $params = [];
    $job_ident->addToArray($params);
    $resp = $this->client->_rest->get("job/embedding", $params);

    return json_decode($resp->getBody(), true);
  }
}
 ?>
