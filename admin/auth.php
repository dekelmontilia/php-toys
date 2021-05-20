<?php 
  header('Content-Type: application/json');
  
  include_once "../classesProj/token.php";


  $token = getallheaders();
// בדוק אם נשלח טוקן
  if(!isset($token["auth-token"])){
    
    die("{\"err\":\"you must send token\"}");
  }

//בודק אם הטוקן תקין
  $checkToken = $token::validateToken($token["auth-token"]);
  if(!$checkToken){
    die("{\"err\":\"token not valid or expired\"}");
  }