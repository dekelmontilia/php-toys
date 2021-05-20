<?php 

   header('Content-Type: application/json');
  include "./connect.php";

  $bodyData = file_get_contents('php://input');
    $phpData = json_decode($bodyData);

    switch ($_SERVER["REQUEST_METHOD"]){
    case "POST":

      
      $phpData->pass = password_hash($phpData->pass , PASSWORD_DEFAULT);
      $q = "INSERT INTO users (name,email,pass) VALUES ('{$phpData->name}','{$phpData->email}','{$phpData->pass}');";
      $conn->query($q);
     
      echo "{\"id\":".$conn->insert_id."}";
      break;
    case "GET":
      echo "{\"id\":\"you need to send body widh name , email and password props\"}";
  }
