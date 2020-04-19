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
    $query = [];
    $job_ident->addToArray($query);
    $resp = $this->client->_rest->get("job/embedding", $query);

    return json_decode($resp->getBody(), true);
  }
}
 ?>
