<?php 
  header('Content-Type: application/json');
include_once "../classesProj/token.php";

  $token = getallheaders();

  if(!isset($token["auth-token"])){
   
    die("{\"err\":\"you must send token\"}");
  }

 $checkToken = Token::validateToken($token["auth-token"]);
  if(!$checkToken){
    die("{\"err\":\"token not valid or expired\"}");
  }