<?php

class Classroom{
  private string $classroomId;
  private string $adminId;

  function __construct($classroomId,$adminId)
  {
    $this->classroomId = $classroomId;
    $this->adminId = $adminId;
  }
  
}

?>