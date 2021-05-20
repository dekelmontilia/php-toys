<?php 
  include "./auth.php";
  include "../connect.php";

$query = "SELECT * FROM users WHERE id = {$checkToken}";
  $res = $conn->query($query);

  $user = (object)mysqli_fetch_assoc($res);
  // מוחק את המאפיין מהאובייקט
  unset($user->pass);
  
  echo json_encode($user);