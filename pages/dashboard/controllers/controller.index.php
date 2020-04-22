<?php
session_start();
  $_SESSION['test'] = 'test';
  if($_SESSION["authenticated"] == "0"){
    header("Location: /pages/auth/signin.php");  
  }
?>