<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/classes/database.php");
class Comment {
  
  private $classroomId;
  private $comment;
  private $conn;
  private $userId;


  // TODO: Replies

  public function __construct()
  {
    $this->conn = Database::getDbConnection();    
  }

  // new comment

  public static function NewComment($userId,$classroomId,$comment){
    $instance = new self();
    $instance->userId = $userId;
    $instance->classroomId = $classroomId;
    $instance->comment = $comment;

    return $instance;
  }

  public static function GetComments($classroomId){
    $instance = new self();
    $instance->classroomId = $classroomId;
    
    return $instance;
  }


  public function createComment(){

    $statement = "insert into Comments(FK_class_id,FK_user_id,comment) values (?,?,?)";
    $params = array(
      "dTypes" => "iis",
      "params" => array($this->classroomId,$this->userId,$this->comment)
    );


    return Database::PrepareUpdateCall($this->conn,$statement,$params);
  }

  
  public function _getComments(){
    $statement = "select Comments.comment,Users.username from Comments inner join Classroom on Classroom.classroom_id=Comments.FK_class_id inner join Users on Users.id=Comments.FK_user_id where FK_class_id = ?";
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

        $row = $response["data"];
        $comments = array();


        while($r = $row->fetch_assoc()){
          array_push($comments,$r);
        }

        $returnResponse = array(
          "error" => false,
          "comments" => $comments
        );
      }

      return $returnResponse;
    });
  }

}