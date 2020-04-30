<?php
  session_start();

  // Handle requests

  if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["action"] == "logout"){
    // echo "asd";
    logout();
  }

  function logout(){
    session_unset();
    $jsonResponse = array(
      "logout"=>true
    );

    echo json_encode($jsonResponse);
  }
?>
