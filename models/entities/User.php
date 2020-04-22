<?php

// load database class;
require($_SERVER["DOCUMENT_ROOT"] . "/classes/database.php");

class User
{
  private $username = null;
  private $password = null;
  private $email = null;
  private $id = null;
  private $dbcon = null;


  function __construct()
  {
    $this->dbcon = getDbConnection();
  }

  public static function NewUser(string $username, string $email, string $password): User
  {
    $instance = new self();
    $instance->username = $username;
    $instance->email = $email;
    $instance->password = $password;
    return $instance;
  }

  public static function ExistingUser(string $email, string $password): User
  {

    $instance = new self();
    $instance->email = $email;
    $instance->password = $password;
    return $instance;
  }

  public static function FromRow($row): User
  {
    $instance = new self();
    $instance->id = $row["id"];
    $instance->username = $row["username"];
    $instance->email = $row["email"];
    return $instance;
  }


  // save user to database;
  public function saveUser(): bool
  {

    $userExists = $this->findUser();
    if ($userExists["isUser"]) {

      // cannot create user because user with that email already exists;
      return false;
    }

    $statement = $this->dbcon->prepare("insert into Users (username,email,password) values(?,?,?);");
    $statement->bind_param("sss", $this->username, $this->email, $this->password);

    $err = $statement->execute();

    if ($err == false) {
      return false;
    } else {
      return true;
    }
  }


  // check functions

  public function findUser(): array
  {
    $statement = $this->dbcon->prepare("select id from Users where email = ?;");
    $statement->bind_param("s", $this->email);

    $result = $statement->execute();

    $f = $statement->get_result();

    if ($f->num_rows > 0) {
      // user exists 
      $row = $f->fetch_assoc();
      $newUser = User::FromRow($row);

      return array(
        "isUser"=>true,
        "user"=>$newUser
      );


    } else {
      // user doesnot exists
      return array(
        "isUser"=>false
      );

      return false;
    }
  }

  public function authenticate(): bool
  {
    $statement = $this->dbcon->prepare("select id,username,email from Users where email = ? and password = ?;");
    $statement->bind_param("ss", $this->email, $this->password);

    $result = $statement->execute();

    $data = $statement->get_result();

    if ($data->num_rows > 0) {
      // user exists
      $row = $data->fetch_assoc();
      return true;
    } else {
      // user doesnot exists
      return false;
    }
  }
}
