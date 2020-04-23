<?php
  // load user base class
  // require($_SERVER["DOCUMENT_ROOT"] . "/classes/database.php");
  // require($_SERVER["DOCUMENT_ROOT"] . "/models/entities/User.php");
  
  class Student {
    
    public static function getAllClassrooms($conn,int $userId){
      $statement = "select Classroom.classroom_id,Classroom.classroom_name,Classroom.description from Classroom inner join Participants on Participants.FK_class_id=Classroom.classroom_id inner join Users on Users.id = Participants.FK_user_id where Participants.FK_user_id = ?";
      $params = array(
        "dTypes" => "i",
        "params"=> array($userId)
      );

      return PrepareFetchCall($conn,$statement,$params,function($response){
        if($response["error"]){
          echo "err";
        }
        else{
          $classrooms = array();
          while($row = $response["data"]->fetch_assoc()){
            array_push($classrooms,$row);
          }

         return $classrooms;
        }
      });
    }
  }
?>