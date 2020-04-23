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

  // static functions that returns User object 

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

  public static function FromId(int $id)
  {
    $instance = new self();
    $instance->id = $id;

    $newUser = $instance->findUserById();

    if ($newUser["isUser"] == false) {
      die("user does not exists");
    }
    return $newUser;
  }

  // save user to database;
  public function saveUser(): bool
  {

    $userExists = $this->findUserByEmail();
    var_dump($userExists);
    if ($userExists["isUser"]) {

      // cannot create user because user with that email already exists;
      return false;
    }

    $statement = "insert into Users (username,email,password) values(?,?,?)";
    $params = array(
      "dTypes" => "sss",
      "params" => array($this->username,$this->email,$this->password)
    );

    $result = PrepareUpdateCall($this->dbcon,$statement,$params);

    return $result;

  }


  // find user by id
  public function findUserById()
  {

    $statement = "select * from Users where id = ?";
    $params = array(
      "dTypes" => "i",
      "params" => array($this->id)
    );

    return PrepareFetchCall($this->dbcon,$statement, $params, function ($response) {

      $returnResonse = null;

      if ($response["error"] == true) {
        $returnResonse = array("isUser" => false);
  
      } else {

        // get the column
        $userData = $response["data"]->fetch_assoc();
        $returnResonse = array(
          "isUser" => true,
          "user" => User::FromRow($userData)
        );
      }

      return $returnResonse;

    });
  }

  // check functions

  public function findUserByEmail(): array
  {
    $statement = "select id from Users where email = ?;";
    $params = array(
      "dTypes"=>"s",
      "params"=>array($this->email),
    );

    return PrepareFetchCall($this->dbcon,$statement,$params,function($response){
      
      $returnResonse = null;
      if($response["error"]){
      
        $returnResonse = array(
          "isUser" => false
        );
      
      }

      else{
        $userData = $response["data"]->fetch_assoc();
        $returnResonse = array(
          "isUser" => true,
          "user" => User::FromRow($userData)
        );
      }


      return $returnResonse;
    });
  }


  // simple authentication function

  public function authenticate(): array
  {
    $statement = "select id from Users where email = ? and password = ?";
    $params = array(
      "dTypes"=>"ss",
      "params"=>array($this->email,$this->password)
    );

    return PrepareFetchCall($this->dbcon,$statement,$params,function($response){
      
      $returnResonse = null;

      if($response["error"]){

        $returnResonse = array(
          "isUser"=>false
        );
      }
      else{
        $userData = $response["data"]->fetch_assoc();
        $returnResonse = array(
          "isUser"=>true,
          "userId"=>$userData["id"]
        );
      }

      return $returnResonse;
    });
  }

  // getters

  public function getConnection(){
    return $this->dbcon;
  }

  public function getUserId(){
    return $this->id;
  }
}
