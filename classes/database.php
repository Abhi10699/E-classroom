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
  } else {
    return $conn;
  }
}

function PrepareFetchCall(mysqli $conn,string $query, array $params, callable $cb)
{
  // create query statement
  $statement = $conn->prepare($query);

  // check if parameters exists

  if (isset($params)) {
    // set parameters
    $statement->bind_param($params["dTypes"], ...$params["params"]);
  }


  // execute query

  $statement->execute();

  // get result

  $data = $statement->get_result();

  if ($data->num_rows > 0) {
    $result = array(
      "error" => false,
      "data" => $data,
    );
    // pass row into a callback function
    return $cb($result);
  } else {
    $errResult = array(
      "error" => true,
      "message" => "No data found"
    );

    return $cb($errResult);
  }
}


// for insert,update actions
function PrepareUpdateCall(mysqli $conn,string $query, array $params)
{
  // create query prepare statement
  $statement = $conn->prepare($query);

  // check if parameters exists
  if (isset($params)) {
    // set parameters
    $statement->bind_param($params["dTypes"], ...$params["params"]);
  }

  // execute query

  $err = $statement->execute();


  if ($err == false) {
    return false;
  } else {
    return true;
  }
}
