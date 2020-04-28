<?php

require_once  __DIR__.'/../RequestBodyUtils.php';
require_once  __DIR__.'/../ValueFormater.php';

require_once __DIR__ . '/ProfileFeedback.php';
require_once __DIR__ . '/ProfileAttachment.php';
require_once __DIR__ . '/ProfileTag.php';
require_once __DIR__ . '/ProfileMetadata.php';
require_once __DIR__ . '/ProfileParsing.php';
require_once __DIR__ . '/ProfileRevealing.php';
require_once __DIR__ . '/ProfileEmbedding.php';
require_once __DIR__ . '/ProfileSearching.php';
require_once __DIR__ . '/ProfileScoring.php';
require_once __DIR__ . '/ProfileReasoning.php';

  class Profile
  {
    const INVALID_FILENAME = ['.', '..'];

    public function __construct($parent) {
      $this->client       = $parent;
      $this->feedback     = new ProfileFeedback($parent);
      $this->attachment   = new ProfileAttachment($parent);
      $this->tag          = new ProfileTag($parent);
      $this->metadata     = new ProfileMetadata($parent);
      $this->parsing      = new ProfileParsing($parent);
      $this->revealing    = new ProfileRevealing($parent);
      $this->embedding    = new ProfileEmbedding($parent);
      $this->searching    = new ProfileSearching($parent);
      $this->scoring      = new ProfileScoring($parent);
      $this->reasoning    = new ProfileReasoning($parent);
    }


    public function addJson(string $source_id, array $profile_json, $profile_reference=null, $timestamp_reception=null,
                             $profile_labels=[], $profile_tags=[], $profile_metadatas=[])
    {
      if (!empty($profile_reference) && $profile_reference instanceof ProfileReference) {
        $profile_reference = $profile_reference->getValue();
      }
      $timestamp_reception = ValueFormater::format_dateToTimestamp($timestamp_reception, 'timestamp_reception');

      $data = [
          'source_id'           => $source_id,
          'profile_type'        => 'json',
          'profile_reference'   => $profile_reference,
          'profile_labels'      => json_encode($profile_labels),
          'profile_tags'        => json_encode($profile_tags),
          'profile_metadatas'   => json_encode($profile_metadatas),
          'profile_json'        => json_encode($profile_json),

      ];

      RequestBodyUtils::add_if_not_null($data, 'timestamp_reception', $timestamp_reception);
      $resp = $this->client->_rest->postData("profile", $data);

      return json_decode($resp->getBody(), true);
    }

    public function addFile(string $source_id, $profile_file, $profile_content_type=null, $profile_reference=null, $timestamp_reception=null,
                             $profile_labels=[], $profile_tags=[], $profile_metadatas=[], $sync_parsing=0)
    {

      // ensure that profile reference is a string
      // cause it can be a ProfileReference object or a string
      $profile_reference = ValueFormater::ident_to_string($profile_reference);

      $data = [
          'source_id'           => $source_id,
          'profile_type'        => 'file',
          'profile_content_type'=> $profile_content_type,
          'profile_reference'   => $profile_reference,
          'profile_labels'      => json_encode($profile_labels),
          'profile_tags'        => json_encode($profile_tags),
          'profile_metadatas'   => json_encode($profile_metadatas),
          'sync_parsing'        => $sync_parsing

      ];

      if (array_key_exists('timestamp_reception', $data)){
        $data['timestamp_reception'] =  ValueFormater::format_dateToTimestamp($timestamp_reception, 'reception_date');
      }


      $resp = $this->client->_rest->postFile("profile", $data, $profile_file);
      return json_decode($resp->getBody(), true)['data'];
    }

    public function addFolder(string $source_id, string $dir_path, bool $recurs=false, $timestamp_reception=null, $sync_parsing=0)
    {
      if (!is_dir($dir_path)) {
        throw new \HrflowApiArgumentException("'".$dir_path."' is not a directory.", 1);
      }
      $files_path = self::getFileToSend($dir_path, $recurs);
      $failed_files = [];
      $succeed_files = [];

      foreach ($files_path as $file_path) {
        try {
          $profile_content = fopen($file_path, "rb");
          $resp = self::add_file($source_id, $profile_content, null, null, $timestamp_reception, [], [], [], $sync_parsing);
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

  }

 ?>
