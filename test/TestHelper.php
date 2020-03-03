<?php
  class TestHelper
  {
    static public $APISECRET = "ask_cbe04b31bde4c51c6bf0d320d4b285c2";
    static public $WEBHOOKSECRET = "totalynotfake";
    static public $SOURCE_TEST_NAME = [];

    static public function getSecret() {
      return self::$APISECRET;
    }

    static public function getWebhookSecret() {
      return self::$WEBHOOKSECRET;
    }

    static public function getSourceTestName() {
      return self::$SOURCE_TEST_NAME;
    }

    static private $lastError = null;

    static public function  getLastError() {
      return self::$lastError;
    }
    // use './vendor/bin/phpunit --verbose --bootstrap vendor/autoload.php test/RiminderJobTest.php'
    // to run tests
    static public function assertArrayHasKeys($testCase, $toTest, $refKeys) {

      foreach ($refKeys as $refKey) {
        $testCase->assertArrayHasKey($refKey, $toTest);
      }
    }

    static public function assertDateObj($testCase, $toTest) {
      $refKeys = array('date', 'timezone_type', 'timezone');

      self::assertArrayHasKeys($testCase, $toTest, $refKeys);
    }

    static public function useApiFuncWithIgnoredErr($testCase, $func) {
      $resp;
      try {
        $resp = $func();
        return $resp;

      } catch (\HrflowApiException $e) {
        // I didn't see anything..
        self::$lastError = $e;
      }
      return array();
    }

    static public function useApiFuncWithReportedErr($testCase, $func) {
      try {
        $resp = $func();
        return $resp;

      } catch (\HrflowApiResponseException $e) {
        $testCase->fail('Test failed cause of invalid response: ' . $e);
      } catch (\HrflowApiArgumentException $e) {
        $testCase->fail('Test failed cause of invalid argument: ' . $e);
      } catch (\HrflowApiProfileUploadException $e) {
        $testCase->fail('Test failed cause of failed upload: ' . $e);
      } catch (\HrflowApiException $e) {
        $testCase->markTestSkipped('Test skipped cause of: ' . $e);
      }
    }

    static public function useApiFuncWithReportedErrAsSkip($testCase, $func) {
      try {
        $resp = $func();
        return $resp;

      } catch (\HrflowApiException $e) {
        $testCase->markTestSkipped('Test skipped cause of: ' . $e);
      }
    }

    static public function useApiFuncWithExpectedErr($testCase, $func, $expectedExp) {

      try {
        $resp = $func();
      }catch (\HrflowApiResponseException $e) {
        $testCase->assertInstanceOf($expectedExp, $e);
        return $e;
      } catch (\HrflowApiArgumentException $e) {
        $testCase->assertInstanceOf($expectedExp, $e);
        return $e;
      } catch (\HrflowApiException $e) {
        $testCase->assertInstanceOf($expectedExp, $e);
        return $e;
      }
      //$testCase->fail('Expected an error of type ' . $expectedExp);
      return null;
    }

    static public function generateWebhookRequest($type) {
      $data = [
        'type'    => $type,
        'message' => 'something good append',
        'profile' => ['profile_id' => 1, 'profile_reference' => 'hi']
        ];
      $json_data   = json_encode($data);
      $encoded_sig = hash_hmac('sha256',$json_data, self::$WEBHOOKSECRET, true);
      $signature   = base64_encode($encoded_sig).".".base64_encode($json_data);

      $res     = array('HTTP-HRFLOW-SIGNATURE' => $signature);

      return $res;
    }
  }
 ?>
