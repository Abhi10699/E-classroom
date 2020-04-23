<?php
session_start();
  $_SESSION['test'] = 'test';
  if($_SESSION["authenticated"] == "0"){
    header("Location: /pages/auth/signin.php");  
  }

  // Fetch user using id stored in session

  $myUser = User::FromId($_SESSION["USER_ID"])["user"];

  // fetch classrooms as student
  $s = Student::getAllClassrooms($myUser->getConnection(),$myUser->getUserId());  
  
  // fetch classrooms as a teacher
?>