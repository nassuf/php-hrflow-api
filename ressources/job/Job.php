<?php

require_once  __DIR__.'/../RequestBodyUtils.php';

require_once __DIR__ . '/JobParsing.php';
require_once __DIR__ . '/JobEmbedding.php';
require_once __DIR__ . '/JobSearching.php';
require_once __DIR__ . '/JobScoring.php';
require_once __DIR__ . '/JobReasoning.php';


  class Job
  {
    public function __construct($parent) {
      $this->client      = $parent;
      $this->parsing     = new JobParsing($parent);
      $this->embedding   = new JobEmbedding($parent);
      $this->searching   = new JobSearching($parent);
      $this->scoring     = new JobScoring($parent);
      $this->reasoning   = new JobReasoning($parent);
    }


  public function add_json($name, $agent_id, $job_reference, $job_tags =[], $job_metadatas=[], $timestamp_reception=null, $kwargs =[]) {


    $timestamp_reception = ValueFormater::format_dateToTimestamp($timestamp_reception, 'timestamp_reception');

    $payload = array(
        "name"            => $name,
        "agent_id"        => $agent_id,
        "job_reference"   => $job_reference,
        "job_tags"        => $job_tags,
        "job_metadatas"   => $job_metadatas
    );
    $data = array_merge($payload, $kwargs);

    RequestBodyUtils::add_if_not_null($payload, 'timestamp_reception', $timestamp_reception);

    $resp = $this->client->_rest->postData("job", $data);

    return json_decode($resp->getBody(), true);
  }
}

 ?>
