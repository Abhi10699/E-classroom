<?php
session_start();
// load User model
require($_SERVER["DOCUMENT_ROOT"] . "/models/entities/User.php");

// error messsages
$error_email = null;
$error_password = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $response = validate();
  if ($response["valid"] = true) {
    authenticateUser($response);
  }
}

function authenticateUser(array $userData): void
{

  $user = User::ExistingUser($userData["email"], $userData["password"]);
  $authenticated = $user->authenticate();

  $_SESSION["authenticated"] = $authenticated;

  if ($authenticated["isUser"]) {
    $jsonResponse = array(
      "authenticated" => $authenticated
    );

    echo json_encode($jsonResponse);
  } else {
    $jsonResponse = array(
      "authenticated" => $authenticated,
      "error" => "User not found"
    );

    echo json_encode($jsonResponse);
  }
}

// validate user data;
function validate(): array
{
  $email = $_POST["email"];
  $password = $_POST["password"];

  $valid = false;

  global $error_email, $error_password;
  if (empty($email)) {
    $error_email = "Please enter email..";
  } else {
    $valid = true;
  }

  if (empty($password)) {
    $error_password = "Please ente password..";
  } else {
    $valid = true;
  }

  if ($valid) {
    return array(
      "valid" => $valid,
      "email" => $email,
      "password" => $password
    );
  }

  return array(
    "valid" => $valid
  );
}
