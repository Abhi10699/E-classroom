<?php
  // handlers

  if($_SERVER["REQUEST_METHOD"] === "POST" && $_POST["action"] == "logout"){
    logout();
  }

  function logout(){
    session_unset();
    return array(
      "logout"=>true
    );
  }
?>