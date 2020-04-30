<?php
// session_start();
require_once($_SERVER["DOCUMENT_ROOT"] . "/models/common/Comment.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["action"] == "postComment") {

  $comment = $_POST["comment_body"];
  postComment($comment);
}


function postComment($comment_body)
{
  session_start();
  $userId = $_SESSION["USER_ID"];

  $classroomId = $_SESSION["CLASSROOM_ID"];

  $comment = Comment::NewComment($userId, $classroomId, $comment_body);
  $commentPosted = $comment->createComment();

  $jsonResponse = null;
  if ($commentPosted) {
    $jsonResponse = array(
      "error" => false,
    );
  } else {
    $jsonResponse = array(
      "error" => true,
    );
  }

  echo json_encode($jsonResponse);
}
