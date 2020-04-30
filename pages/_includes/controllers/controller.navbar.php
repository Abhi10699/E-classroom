<?php
  session_start();
  // Classroom Models

  require($_SERVER["DOCUMENT_ROOT"] . "/models/Classroom.php");

  // handlers

  if($_SERVER["REQUEST_METHOD"] === "POST" && $_POST["action"] == "logout"){
    logout();
  }

  if($_SERVER["REQUEST_METHOD"] === "POST" && $_POST["action"] == "createClassroom"){
    $classroom_name = $_POST["classroom_name"];
    $clasroom_desc = $_POST["description"];

    createClassroom($classroom_name,$clasroom_desc);
  }
  

  if($_SERVER["REQUEST_METHOD"] === "POST" && $_POST["action"] == "joinClassroom"){
    $cid = intval($_POST["classroom_id"]);

    joinClassroom($cid);
  }
  

  function createClassroom($classroomName,$classroomDescription){
    $classroom = Classroom::NewClassroom($_SESSION["USER_ID"],$classroomName,$classroomDescription);
    $created = $classroom->createClassroom();
    
    $jsonResponse = null;
    
    if($created == false){
      // echo err
      $jsonResponse = array(
        "error" => true,
        "message" => "Cannot Create Classroom"
      );

    }
    else{
      // classroom created
      $jsonResponse = array(
        "error" => false,
        "message" => "Classroom Created Successfully"
      );
    }

    echo json_encode($jsonResponse);
  }

  function joinClassroom($classroomId){
    $classroom = Classroom::GetClassoom($classroomId);

    $joined = $classroom->addParticipant($_SESSION["USER_ID"]);

    $jsonResponse = null;
    
    if( isset($joined["error"]) == true || $joined ==  false){
      // do somethin
      $jsonResponse = array(
        "error" => true,
        "message" => isset($joined["message"]) ? $joined["message"] : "Cannot Join Classroom" 
      );
    }
    else{
      // do something
      $jsonResponse = array(
        "error" => false,
        "message" => "Classroom Joined Successfully"
      );
    }

    echo json_encode($jsonResponse);
  }

  function logout(){
    session_unset();
    return array(
      "logout"=>true
    );
  }
?>