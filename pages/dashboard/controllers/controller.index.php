<?php
  session_start();

  // load user class
  require_once($_SERVER["DOCUMENT_ROOT"] . "/models/entities/User.php");
  require_once($_SERVER["DOCUMENT_ROOT"] . "/models/entities/Student.php");
  require_once($_SERVER["DOCUMENT_ROOT"] . "/models/entities/Teacher.php");

  if( !isset($_SESSION["authenticated"]) || $_SESSION["authenticated"] == "0"){
    header("Location: /pages/auth/signin.php");  
  }

  // Fetch user using id stored in session

  $myUser = User::FromId($_SESSION["USER_ID"])["user"];


  $MyClassrooms_student = Student::getAllClassrooms($myUser->getConnection(),$myUser->getUserId());
  $MyClassrooms_teacher = Teacher::getClassroms($myUser->getConnection(),$myUser->getUserId());