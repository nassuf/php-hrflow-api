<?php

  require_once 'RequestBodyUtils.php';

  class HrflowJob
  {
    public function __construct($parent) {
      $this->hrflow = $parent;
      $this->json = new HrflowJobJson($parent);
      $this->parsing = new HrflowJobParsing($parent);
      $this->scoring = new HrflowJobScoring($parent);
      $this->reasoning = new HrflowJobReasoning($parent);
    }

    public function list(string $name=null) {
      $query = [] ;
      if($name){
        $query['name'] = $name ;
      }
      $resp = $this->hrflow->_rest->get("jobs/searching");
      return json_decode($resp->getBody(), true)['data'];
    }

    public function get(RiminderJobIdent $job_ident, $job_reference=null) {
      $query = [];
      $job_ident->addToArray($query);
      if($job_reference){
        $query['job_reference'] = $job_reference ;
      }
      $resp = $this->hrflow->_rest->get("job", $query);

      return json_decode($resp->getBody(), true)['data'];
    }
  }


class HrflowJobJson
{
  public function __construct($parent) {
    $this->hrflow = $parent;
  }

  public function add($name, $agent_id, array $job_json, $job_reference, $timestamp_reception=null, $job_labels=[], $job_metadatas=[]) {

    $trainingMetadata = ValueFormater::format_trainingMetadata($trainingMetadata);
    if (!empty($profile_reference) && $profile_reference instanceof ProfileReference) {
      $profile_reference = $profile_reference->getValue();
    }
    $timestamp_reception = ValueFormater::format_dateToTimestamp($timestamp_reception, 'timestamp_reception');

    $payload = array(
        "name"            => $name,
        "agent_id"        => $agent_id,
        "job_reference"   => $job_reference,
        "job_json"        => $job_json,
        "job_labels"      => $job_labels,
        "job_metadatas"   => $job_metadatas
    );

    RequestBodyUtils::add_if_not_null($payload, 'timestamp_reception', $timestamp_reception);

    $data = ["data" => json_encode($payload)] ;
    $resp = $this->hrflow->_rest->postData("job", $data);

    return json_decode($resp->getBody(), true)['data'];
  }
}


/**
 *
 */
class HrflowJobParsing
{

  public function __construct($parent) {
    $this->hrflow = $parent;
  }
  public function get(HrflowJobIdent $job_ident, string $job_reference=null) {
    $query = [] ;
    if($job_reference){
      $query['job_reference'] = $job_reference ;
    }
    $job_ident->addToArray($query);
    $resp = $this->hrflow->_rest->get("job/parsing", $query);

    return json_decode($resp->getBody(), true)['data'];
  }
}

/**
 *
 */
class HrflowJobScoring
{

  public function __construct($parent) {
    $this->hrflow = $parent;
  }


  public function list() {
    $resp = [];
    return json_decode($resp->getBody(), true)['data'];
  }
}


/**
 *
 */
class HrflowJobReasoning
{

  public function __construct($parent) {
    $this->hrflow = $parent;
  }


  public function list() {
    $resp = [];
    return json_decode($resp->getBody(), true)['data'];
  }
}
 ?>
