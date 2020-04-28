<?php
  session_start();
  // load comment class
  require_once($_SERVER["DOCUMENT_ROOT"] . "/models/common/Comment.php");
  require_once($_SERVER["DOCUMENT_ROOT"] . "/models/Classroom.php");

  // Put clasroom id in session
  $_SESSION["CLASSROOM_ID"] = $_GET["id"];
 
  
  // check if the participant is actually the part of classroom

  $validClassroom = Classroom::GetClassoom($_GET["id"])->checkParticipant($_SESSION["USER_ID"]);

  
  if($validClassroom == false){
    header("Location : /pages/dashboard/");
  }

  function fetchClassroomInfo($id){
    $classroomData = Classroom::GetClassoom($id)->fetchClassroom();
    $comments = Comment::GetComments($id)->_getComments();
    $participants = Classroom::GetClassoom($id)->fetchParticipants();
    
    return array(
      "metadata" => $classroomData["data"]->fetch_assoc(),
      "discussions" => $comments["comments"],
      "participants" => $participants["participants"]
    );
  }

  $classroomInfo = fetchClassroomInfo($_GET["id"]);
  $comments = $classroomInfo["discussions"];
  $participants = $classroomInfo["participants"];
  $metadata = $classroomInfo["metadata"];
