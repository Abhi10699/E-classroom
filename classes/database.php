<?php
function getDbConnection()
{
  $hostname = "database";
  $user = "root";
  $password = "root";
  $dbName = "classroomDb";

  $conn = new mysqli($hostname, $user, $password, $dbName);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    
  }
  else{
    return $conn;
  }
}
