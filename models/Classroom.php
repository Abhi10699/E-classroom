<?php
require($_SERVER["DOCUMENT_ROOT"] . "/classes/database.php");
require "./entities/User.php";

class Classroom{
  private $classroomId;
  private $adminId;
  private $classroom_name;
  private $conn;

  function __construct()
  {
    $conn = getDbConnection();
  }
  
  // static function to build new classroom
  public static function NewClassroom(int $adminId,string $classroom_name){
    $instacnce = new self();
    $instacnce->adminId = $adminId;
    $instacnce->classroom_name = $classroom_name;
    
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

    $stmt = $this->conn->prepare("insert into Classroom (classroom_name,FK_admin_id ) values (?,?)");
    $stmt->bind_param("si",$this->classroom_name,$this->adminId);

    $err = $stmt->execute();

    if($err == false){
      return false;
    }
    else{
      return true;
    }
  }

  
  // fetch classroom from database
  public function fetchClassroom(){
    $stmt = $this->con->prepare("select * from Classroom where id = ?");
    $stmt->bind_param("i",$this->classroomId);

    $err = $stmt->execute();

    // handle err

    $result = $stmt->get_result();

    if($result->num_rows > 0){
      // send classrom 
    }
    else{
      // classroom not found
    }
  }

  // add students in classroom

  public function addParticipant(User $_user){
    // find participant
    $user = $_user->findUser();

    if($user["isUser"] == false){
      die("cannot find user");
      return;
    }
    
    // add user to the participants table

    $stmt = $this->conn->prepeare("insert into Participants (K_class_id,FK_user_id) values (?,?)");
    
    $stmt->bind_param("ii",$this->classroomId,$user["user"]->id);
  }

}
