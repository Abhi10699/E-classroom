<?php
require($_SERVER["DOCUMENT_ROOT"] . "/classes/database.php");
require "./entities/User.php";

class Classroom{
  private $classroomId;
  private $adminId;
  private $classroom_name;
  private $classroom_description;
  private $conn;

  function __construct()
  {
    $conn = getDbConnection();
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
    $instacnce->classroomId = $classroomId;

    return $instacnce;
  }

  public function createClassroom() : bool{
    // create classroom query

    $statement = "insert into Classroom (classroom_name,description,FK_admin_id ) values (?,?,?)";
    $params = array(
      "dType" => "ssi",
      "params" => array($this->classroom_name,$this->classroom_description,$this->adminId)
    );

    return PrepareUpdateCall($this->conn,$statement,$params);

  }

  
  // fetch classroom from database
  public function fetchClassroom(){

    $statement = "select * from Classroom where id = ?";
    $params = array(
      "dTypes" => "i",
      "params" => array($this->classroomId)
    );

    $result = PrepareFetchCall($this->conn,$statement,$params,function($response){

    });

    return $result;
  }

  // add students in classroom

  public function addParticipant(User $_user){
    // find participant
    $user = $_user->findUserById();

    if($user["isUser"] == false){
      die("cannot find user");
      return;
    }
    
    // add user to the participants table

    $stmt = $this->conn->prepeare("insert into Participants (K_class_id,FK_user_id) values (?,?)");
    
    $stmt->bind_param("ii",$this->classroomId,$user["user"]->id);
  }
}