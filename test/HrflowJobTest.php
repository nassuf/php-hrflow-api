<?php
declare(strict_types=1);
require __DIR__ . '/../vendor/autoload.php';
require_once 'TestHelper.php';


use PHPUnit\Framework\TestCase;

final class HrflowJobTest extends TestCase {

  public function testGetJobs(): void {
      $api = new Hrflow(TestHelper::getSecret());
      $refKeys = array('Job_id', 'filter_reference', 'name', 'archive', 'date_creation');

      $getFilters = function () use ($api) { return $api->filter->list(); };

      $resp = TestHelper::useApiFuncWithReportedErr($this, $getFilters);
      if (empty($resp)) {
        $this->markTestSkipped('No datas retrieved!');
        return;
      }
      TestHelper::assertArrayHasKeys($this, $resp[0], $refKeys);
      TestHelper::assertDateObj($this, $resp[0]['date_creation']);
  }

  public function testGetJob(): void {
      $api = new Hrflow(TestHelper::getSecret());
      $refKeys = array('job_id',
        'job_reference',
        'name',
        'description',
        'score_threshold',
        'hob',
        'seniority',
        'skills',
        'countries',
        'archive',
        'stages'
        );
      $refJobKeys = array('name');
      $refStagesKeys = array('count_yes', 'count_later', 'count_no');

      $getJobs = function () use ($api) {  return $api->job->list(); };
      $jobs = TestHelper::useApiFuncWithReportedErrAsSkip($this, $getJobs);
      if (empty($jobs)) {
        $this->markTestSkipped('No jobs retrieved!');
        return;
      }
      $job_id = $jobs[0]['job_id'];
      $job_reference = $jobs[0]['filter_reference'];
      $getJob = function () use ($api, $job_id, $job_reference) {  return $api->filter->get(new FilterID($job_id)); };
      $resp = TestHelper::useApiFuncWithReportedErr($this, $getJob, $job_id);
      if (empty($resp)) {
        $this->fail('No datas retrieved!');
        return;
      }

      // var_dump($resp);
      TestHelper::assertArrayHasKeys($this, $resp, $refKeys);
      TestHelper::assertArrayHasKeys($this, $resp['jobs'], $refJobKeys);
      TestHelper::assertArrayHasKeys($this, $resp['stages'], $refStagesKeys);
      TestHelper::assertDateObj($this, $resp['date_creation']);
  }

  public function testGetJob_reference(): void {
      $api = new Hrflow(TestHelper::getSecret());
      $refKeys = array('job_id',
        'filter_reference',
        'name',
        'description',
        'score_threshold',
        'filter',
        'seniority',
        'skills',
        'countries',
        'archive',
        'stages'
        );
      $refJobKeys = array('name');
      $refStagesKeys = array('count_yes', 'count_later', 'count_no');

      $getJobs = function () use ($api) {  return $api->filter->list(); };
      $jobs = TestHelper::useApiFuncWithReportedErrAsSkip($this, $getJobs);
      if (empty($filters)) {
        $this->markTestSkipped('No filters retrieved!');
        return;
      }
      $job_id = $filters[0]['job_id'];
      $filter_reference = $filters[0]['filter_reference'];
      $getFilter = function () use ($api, $job_id, $filter_reference) {  return $api->filter->get(new JobReference($filter_reference)); };
      $resp = TestHelper::useApiFuncWithReportedErr($this, $getJobs, $job_id);
      if (empty($resp)) {
        $this->fail('No datas retrieved!');
        return;
      }

      // var_dump($resp);
      TestHelper::assertArrayHasKeys($this, $resp, $refKeys);
      TestHelper::assertArrayHasKeys($this, $resp['filter'], $refJobKeys);
      TestHelper::assertArrayHasKeys($this, $resp['stages'], $refStagesKeys);
      TestHelper::assertDateObj($this, $resp['date_creation']);
  }


  public function testGetJobWithInvalidFilterId(): void {
      $api = new Hrflow(TestHelper::getSecret());

      $job_id = 'zap';
      $filter_reference = '$filters[0][]';
      $getFilter = function () use ($api, $job_id, $filter_reference) {  return $api->filter->get(new JobID($job_id)); };
      $resp = TestHelper::useApiFuncWithExpectedErr($this, $getFilter, 'HrflowApiResponseException');
  }

}
 ?>
