<?php

  require_once 'RequestBodyUtils.php';
  require_once 'ValueFormater.php';

  class HrflowProfile
  {
    const INVALID_FILENAME = ['.', '..'];

    public function __construct($parent) {
      $this->hrflow = $parent;
      $this->json = new HrflowProfileJson($parent);
      $this->rating = new HrflowProfileRating($parent);
      $this->stage = new HrflowProfileStage($parent);
      $this->attachments = new HrflowProfileAttachments($parent);
      $this->parsing = new HrflowProfileParsing($parent);
      $this->revealing = new HrflowProfileRevealing($parent);
      $this->embedding = new HrflowProfileEmbedding($parent);
      $this->scoring = new HrflowProfileScoring($parent);
      $this->reasoning = new HrflowProfileReasoning($parent);
    }

    private static function join_2_path($a, $b) {
      $res = $a;
      if ($a[strlen($a) - 1] != '/' && $b[0] != '/'){
        $res = $res.'/';
      }
      $res = $res.$b;
      return $res;
    }

    // GetFileToSend scan all file in directory and get potential
    // resume paths and return them
    private static function getFileToSend($path, $recurs) {
      $dir_paths = scandir($path);
      $res = [];

      foreach ($dir_paths as $dir_path) {
        $true_path = self::join_2_path($path, $dir_path);

        // when $recurs is true check in subdir
        if (is_dir($true_path) && $recurs) {
            if (!in_array($dir_path, self::INVALID_FILENAME)){
              $res = array_merge($res, self::getFileToSend($true_path, $recurs));
              continue;
            }
        }
        if (ValueFormater::is_extensionValid($dir_path)) {
          $res[] = $true_path;
        }
      }
      return $res;
    }

    private static function serializeSourceIds($source_ids) {
      if (!is_array($source_ids)) {
        $mess = sprintf('Source_ids should be an array.');
        throw new \HrflowApiArgumentException($mess, 1);
      }
      $res = json_encode($source_ids);
      return($res);
    }

    // Check if key is present in query or throw an error
    private static function assert_querykey_exist(array $query, string $key) {
      if (!array_key_exists($key, $query)) {
        throw new \HrflowApiArgumentException($key." is absent and mandatory from query.", 1);
      }
    }


    public function list(array $source_ids, $stage=null, $seniority="all", $date_start="1494539999", $date_end=null, $job_id=null, $job_reference=null, $page=1, $limit=30,
                         $sort_by='date_reception', $order_by=null) {

      $date_end = time();
      $query = [] ;
      $query["source_ids"] = json_encode($source_ids);
      $query["stage"] = $stage;
      $query["seniority"] = $seniority;
      $query["date_end"] = $date_end;
      $query["date_start"] = $date_start;
      if ($job_id){
        $query["job_id"] = $job_id;
      }
      if ($job_reference){
        $query["job_id"] = $job_id ;
      }
      $query["limit"] = $limit;
      $query["page"] = $page;
      $query["sort_by"] = $sort_by;
      $query["order_by"] = $order_by;

      $resp = $this->hrflow->_rest->get("profiles/searching", $query);
      return json_decode($resp->getBody(), true)['data'];
    }

    public function add(string $source_id, string $file_path, $profile_reference=null, $reception_date=null, $training_metadata=null) {

      // ensure that profile reference is a string
      // cause it can be a ProfileReference object or a string
      $profile_reference = ValueFormater::ident_to_string($profile_reference);
      $trainingMetadata = ValueFormater::format_trainingMetadata($training_metadata);

      $payload = array (
        'source_id'           => $source_id
      );
      RequestBodyUtils::add_if_not_null($payload, 'training_metadata', $training_metadata);
      RequestBodyUtils::add_if_not_null($payload, 'profile_reference', $profile_reference);
      RequestBodyUtils::add_if_not_null($payload, 'timestamp_reception', $reception_date);
      if (array_key_exists('timestamp_reception', $payload)){
        $payload['timestamp_reception'] =  ValueFormater::format_dateToTimestamp($reception_date, 'reception_date');
      }

      $resp = $this->hrflow->_rest->postFile("profile", $payload, $file_path);
      return json_decode($resp->getBody(), true)['data'];
    }

    public function addlist(string $source_id, string $dir_path, bool $recurs=false, $reception_date=null, $training_metadata=null) {
      if (!is_dir($dir_path)) {
        throw new \HrflowApiArgumentException("'".$dir_path."' is not a directory.", 1);
      }
      $files_path = self::getFileToSend($dir_path, $recurs);
      $failed_files = [];
      $succeed_files = [];

      foreach ($files_path as $file_path) {
        try {
          $resp = self::add($source_id, $file_path, null, $reception_date, $training_metadata);
          $succeed_files[$file_path] = $resp;
        } catch (\Exception $e) {
          $failed_files[$file_path] = $e;
        }
      }
      // If at least a file failed there is an exp,
      // the exp contains list of suceed file too
      if (!empty($failed_files)) {
        throw new \HrflowApiProfileUploadException($failed_files, $succeed_files);
      }
      return $succeed_files;
    }

    public function get(HrflowProfileIdent $profile_ident, string $source_id, string $profile_id, string $profile_reference) {
      $query = array(
        'source_id'  => $source_id
      );
      if($profile_id){
        $query['profile_id'] = $profile_id ;
      }
      if($profile_reference){
        $query['profile_reference'] = $profile_reference ;
      }
      $profile_ident->addToArray($query);
      $resp = $this->hrflow->_rest->get("profile", $query);

      return json_decode($resp->getBody(), true)['data'];
    }
  }

  /**
   *
   */
  class HrflowProfileAttachments
  {

    public function __construct($parent) {
      $this->hrflow = $parent;
    }

    public function list(string $source_id, string $profile_id, string $profile_reference=null) {
      $query = array(
        'source_id'  => $source_id
      );
      if($profile_id){
        $query['profile_id'] = $profile_id ;
      }
      if($profile_reference){
        $query['profile_reference'] = $profile_reference ;
      }
      $resp = $this->hrflow->_rest->get("profile/attachments", $query);

      return json_decode($resp->getBody(), true)['data'];
    }
  }

  /**
   *
   */
  class HrflowProfileParsing
  {

    public function __construct($parent) {
      $this->hrflow = $parent;
    }

    public function get(string $source_id, string $profile_id, string $profile_reference=null) {
      $query = array(
        'source_id'  => $source_id
      );
      if($profile_id){
        $query['profile_id'] = $profile_id ;
      }
      if($profile_reference){
        $query['profile_reference'] = $profile_reference ;
      }
      $resp = $this->hrflow->_rest->get("profile/parsing", $query);

      return json_decode($resp->getBody(), true)['data'];
    }
  }

/**
 *
 */
  class HrflowProfileScoring
  {

    public function __construct($parent) {
      $this->hrflow = $parent;
    }


    public function list(array $source_ids, string $job_id, string $stage, $limit=10, $use_agent=1) {
      $query = array(
        'source_ids'  => json_encode($source_ids)
      );
      if($job_id){
        $query['job_id'] = $job_id ;
      }
      if($stage){
        $query['stage'] = $stage ;
      }
      $query['limit'] = $limit ;
      $query['use_agent'] = $use_agent ;
      $resp = $this->hrflow->_rest->get("profiles/scoring", $query);

      return json_decode($resp->getBody(), true)['data'];
    }
  }

/**
 *
 */
class HrflowProfileRevealing
{

  public function __construct($parent) {
    $this->hrflow = $parent;
  }


  public function get(HrflowProfileIdent $profile_ident, HrflowFilterIdent $job_ident, string $source_id) {
    $query = array(
      'source_id'  => $source_id
    );
    $profile_ident->addToArray($query);
    $job_ident->addToArray($query);
    $resp = $this->hrflow->_rest->get("profile/revealing", $query);

    return json_decode($resp->getBody(), true)['data'];
  }
}


/**
 *
 */
class HrflowProfileEmbedding
{

  public function __construct($parent) {
    $this->hrflow = $parent;
  }


  public function get(HrflowProfileIdent $profile_ident, $fields) {
    $query = array(
        'fields'  => $fields
    );
    $profile_ident->addToArray($query);
    $resp = $this->hrflow->_rest->get("profile/embedding", $query);

    return json_decode($resp->getBody(), true)['data'];
  }
}

/**
 *
 */
class HrflowProfileReasoning
{
  public function __construct($parent) {
    $this->hrflow = $parent;
  }

  public function get() {
    $resp = [] ;
    return json_decode($resp->getBody(), true)['data'];
  }
}

  /**
   *
   */
  class HrflowProfileStage
  {

    public function __construct($parent) {
      $this->hrflow = $parent;
    }

    public function set(HrflowProfileIdent $profile_ident, string $source_id, RHrflowJobIdent $job_ident, string $stage) {
      $payload = array(
        'stage'       => $stage,
        'source_id'   => $source_id,
      );
      $profile_ident->addToArray($payload);
      $job_ident->addToArray($payload);
      $resp = $this->hrflow->_rest->patch("profile/stage", $payload);

      return json_decode($resp->getBody(), true)['data'];
    }
  }

  /**
   *
   */
  class HrflowProfileRating
  {
    public function __construct($parent) {
      $this->hrflow = $parent;
    }

    public function set(HrflowProfileIdent $profile_ident, string $source_id, HrflowJobIdent $job_ident, int $rating) {
      $payload = array(
        'rating'       => $rating,
        'source_id'   => $source_id,
      );
      $profile_ident->addToArray($payload);
      $job_ident->addToArray($payload);
      $resp = $this->hrflow->_rest->patch("profile/rating", $payload);

      return json_decode($resp->getBody(), true)['data'];
    }

  }

  class HrflowProfileJson
  {
    public function __construct($parent) {
      $this->hrflow = $parent;
    }

    public function check(array $profileData, array $trainingMetadata=[]) {

      $trainingMetadata = ValueFormater::format_trainingMetadata($trainingMetadata);
      $payload = array(
        'profile_json'       => $profileData,
        'training_metadata'  => $trainingMetadata
      );
      $resp = $this->hrflow->_rest->post("profile/json/check", $payload);

      return json_decode($resp->getBody(), true)['data'];
    }

    public function add(string $source_id, array $profile_json, $profile_reference=null, $profile_labels=[], $profile_metadatas=[], $sync_parsing=0, $timestamp_reception=null) {

      $trainingMetadata = ValueFormater::format_trainingMetadata($trainingMetadata);
      if (!empty($profile_reference) && $profile_reference instanceof ProfileReference) {
        $profile_reference = $profile_reference->getValue();
      }
      $timestamp_reception = ValueFormater::format_dateToTimestamp($timestamp_reception, 'timestamp_reception');

      $payload = array(
          'source_id'           => $source_id,
          'profile_json'        => $profile_json,
          'profile_type'        => 'json',
          'profile_reference'   => $profile_reference,
          'profile_labels'      => $profile_labels,
          'profile_metadatas'   => $profile_metadatas,
          'sync_parsing'        => $sync_parsing
      );

      RequestBodyUtils::add_if_not_null($payload, 'timestamp_reception', $timestamp_reception);
      $resp = $this->hrflow->_rest->post("profile", $payload);

      return json_decode($resp->getBody(), true)['data'];
    }
}
 ?>
