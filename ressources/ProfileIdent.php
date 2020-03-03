<?php

  require_once 'Ident.php';
  /**
   *
   */
  class HrflowProfileIdent extends HrflowIdent
  { }

  /**
   *
   */
  class ProfileReference extends HrflowProfileIdent
  {

    function __construct($value)
    {
      $this->name = 'profile_reference';
      $this->value = $value;
    }
  }

  class ProfileID extends HrflowProfileIdent
  {

    function __construct($value)
    {
      $this->name = 'profile_id';
      $this->value = $value;
    }
  }


 ?>
