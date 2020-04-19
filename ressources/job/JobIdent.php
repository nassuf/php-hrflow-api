<?php

require_once  __DIR__.'/../RequestBodyUtils.php';

  /**
   *
   */
  class HrflowJobIdent extends HrflowIdent
  { }

class JobID extends HrflowJobIdent
{

  function __construct($value)
  {
    $this->name = 'job_id';
    $this->value = $value;
  }
}

  /**
   *
   */
  class JobReference extends HrflowJobIdent
  {

    function __construct($value)
    {
      $this->name = 'job_reference';
      $this->value = $value;
    }
  }


 ?>
