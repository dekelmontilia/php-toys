<?php 
  header('Content-Type: application/json');
  include "../connect.php";


  $bodyData = file_get_contents('php://input');
  $body = json_decode($bodyData); 


  switch ($_SERVER["REQUEST_METHOD"]){
    case "POST":
     
      $query = "INSERT INTO shop (cat,name,price,image) VALUES (?,?,?,?)";
      $stmnt = $conn->prepare($query);
     $stmnt->bind_param("ssis", $body->cat, $body->name, $body->price, $body->image);
      $stmnt->execute();
      $res = $stmnt->insert_id;
  
      echo "{\"id\":{$res}}";
      break;
    case "DELETE":
      if(!isset($_GET['id'])){
        echo  "{\"msg\":\"You need to send id as query string\"}";
        break;
      }
      $id = (int)$_GET['id'];
      $query = "DELETE FROM shop WHERE id = '{$id}' ";
      $stmnt = $conn->prepare($query);
      $stmnt->execute();
      $res = $stmnt->affected_rows;
      echo "{\"n\":{$res}}";
      break;
    case "PUT":
      if(!isset($_GET['id'])){
        echo  "{\"msg\":\"You need to send id as query string\"}";
        break;
      }
      $id = (int)$_GET['id'];
      
      $query = "UPDATE shop SET cat=? , name=? , price=?, image=? WHERE id = ? ";
      $stmnt = $conn->prepare($query);
      $stmnt->bind_param("ssisi", $body->cat, $body->name, $body->price, $body->image, $id);
      $stmnt->execute();
      $res = $stmnt->affected_rows;
      echo "{\"n\":{$res}}";
      break;
    default:
      echo "{\"msg\":\"You need to send body! and post,put,delete request\"}";
      break;
  }