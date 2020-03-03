<?php

  require_once 'Ident.php';
  /**
   *
   */
  class HrflowJobIdent extends HrflowIdent
  { }

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

  class JobID extends HrflowJobIdent
  {

    function __construct($value)
    {
      $this->name = 'job_id';
      $this->value = $value;
    }
  }


 ?>
