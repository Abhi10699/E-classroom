<?php

// require_once($_SERVER["DOCUMENT_ROOT"] . "/classes/database.php");
class Teacher
{

  public static function getClassroms(mysqli $dbcon, int $adminId)
  {
    $statment = "select Classroom.classroom_id,Classroom.classroom_name,Classroom.description from Classroom inner join Users on Users.id = Classroom.FK_admin_id where Users.id = ?";
    $params = array(
      "dTypes" => "i",
      "params" => array($adminId)
    );

    return Database::PrepareFetchCall($dbcon, $statment, $params, function ($response) {

      if ($response["error"] == true) {
        return array(
          "error" => true,
          "message" => "You dont conduct any classrooms"
        );
      } else {
        $classrooms = array();
        while ($row = $response["data"]->fetch_assoc()) {
          array_push($classrooms, $row);
        }

        return $classrooms;
      }
    });
  }
}
