<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/classes/database.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/models/entities/User.php");

class Classroom{
  private $classroomId;
  private $adminId;
  private $classroom_name;
  private $classroom_description;
  private $conn;

  function __construct()
  {
    $this->conn = Database::getDbConnection();
  }
  
  // static function to build new classroom
  public static function NewClassroom(int $adminId,string $classroom_name,string $classroom_description){
    $instacnce = new self();
    $instacnce->adminId = $adminId;
    $instacnce->classroom_name = $classroom_name;
    $instacnce->classroom_description = $classroom_description;


    return $instacnce;
  }
  
  // static function to get existing classrooms
  public static function GetClassoom(int $classroomId){
    $instacnce = new self();
    $instacnce->classroomId = $classroomId;require_once($_SERVER["DOCUMENT_ROOT"] . "/classes/database.php");
    return $instacnce;
  }

  public function createClassroom() : bool{
    // create classroom query

    $statement = "insert into Classroom (classroom_name,description,FK_admin_id ) values (?,?,?)";
    $params = array(
      "dTypes" => "ssi",
      "params" => array($this->classroom_name,$this->classroom_description,$this->adminId)
    );

    return Database::PrepareUpdateCall($this->conn,$statement,$params);

  }

  
  // fetch classroom from database
  public function fetchClassroom(){

    $statement = "select classroom_name,description from Classroom where classroom_id = ?";
    $params = array(
      "dTypes" => "i",
      "params" => array($this->classroomId)
    );

    $result = Database::PrepareFetchCall($this->conn,$statement,$params,function($response){
      
      if($response["error"]){
        return array(
          "isClassroom"=>false
        );
      }
      else{
        return array(
          "isClassroom"=>true,
          "data"=>$response["data"]
        );
      }
    });

    return $result;
  }


  // check if student exists in the classroom
  public function checkParticipant(int $userId){
    $statement = "select * from Participants where FK_user_id = ? and FK_class_id = ?";
    $params = array(
      "dTypes" => "ii",
      "params" => array($userId,$this->classroomId)
    );

    return Database::PrepareFetchCall($this->conn,$statement,$params,function($response){

      if($response["error"] == true){
        return false;
      }
      else{
        // yes, already participated;
        return true;
      }
    });
  }

  // add students in classroom

  public function addParticipant(int $userID){


    // find participant
    $user = User::FromId($userID);
    // check if classroom exists

    $classroomExists = $this->fetchClassroom()["isClassroom"];
    if($classroomExists == false){
      return array(
        "error"   => true,
        "message" => "Classroom doesnot exists"
      );
    }

    // check if student is already enrolled in that classroom

    $participated = $this->checkParticipant($userID);

    if($participated){
      return array(
        "error" => true,
        "message" => "You are already in that classroom"
      );
    }

    // if no then add student in the classroom
    
    $statement = "insert into Participants (FK_class_id,FK_user_id) values (?,?)";
    // var_dump($user);
    // die();
    $params = array(
      "dTypes"=>"ii",
      "params"=>array($this->classroomId,$user["user"]->getUserId())
    );

    return Database::PrepareUpdateCall($this->conn,$statement,$params);
  }

  public function fetchParticipants(){
    $statement = "select Users.username from Classroom inner join Participants on Participants.FK_class_id=Classroom.classroom_id inner join Users on Users.id = Participants.FK_user_id where Classroom.classroom_id = ?";
    $params = array(
      "dTypes" => "i",
      "params" => array($this->classroomId)
    );

    return Database::PrepareFetchCall($this->conn,$statement,$params,function($response){
      $returnResponse = null;

      if($response["error"]){
        $returnResponse = array(
          "error" => true
        );
      }
      else{
        $participants = array();

        while($row = $response["data"]->fetch_assoc()){
          array_push($participants,$row);
        }

          $returnResponse = array(
          "error" => false,
          "participants" => $participants
        );
      }

      return $returnResponse;
    });
 
  }
}