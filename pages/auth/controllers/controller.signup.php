<?php
session_start();
// load User model
require ($_SERVER["DOCUMENT_ROOT"] . "/models/entities/User.php");

// error handler messages
$error_username = "";
$error_email = "";
$error_password = "";
$error_confirm = "";
$error_general = "";
// success handler messages

$success_message = "";


// handle form submit

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $formResponse = validate();
  // check if form is valid

  if($formResponse["valid"] == true){
    // create user;
   createUser($formResponse);
  }
}

// create user function

function createUser(array $userData) : void{

  $user = User::NewUser($userData["username"],$userData["email"],$userData["password"]);
  $userAdded = $user->saveUser();

  $jsonResponse = null;

  if($userAdded){
    $_SESSION["authenticated"] = "1";
    $jsonResponse = array("userCreated"=>true);
    echo json_encode($jsonResponse);
  }
  else{
    $_SESSION["authenticated"] = "0";
    $jsonResponse = array("userCreated"=>false);
    echo json_encode($jsonResponse);
  }
}

// form validation function  
// TODO: Add constraints to inputs

function validate(): array
{
  // Error messages
  global $error_username, $error_confirm, $error_email, $error_password;

  // validation status
  $valid = false;
  $username = $_POST["username"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $confirmPassword = $_POST["confirmPassword"];

  // check username

  if (empty($username)) {
    $error_username = "Username is required.";
    $valid = false;
  } else {
    $valid = true;
  }

  // check email

  if (empty($email)) {
    $error_email = "Email is required.";
    $valid = false;
  } else {
    $valid = true;
  }

  // check password

  if (empty($password)) {
    $error_password = "Password is required.";
    $valid = false;
  } else {
    $valid = true;
  }

  // check confirm password

  if (empty($confirmPassword) && ($password == $confirmPassword)) {
    $error_confirm = "Passwords donot match.";
    $valid = false;
  } else {
    $valid = true;
  }


  if ($valid == false) {
    return array(
      "valid" => $valid,
    );
  } else {
    return array(
      "valid" => $valid,
      "username" => $username,
      "password" => $password,
      "email" => $email
    );
  }
}
