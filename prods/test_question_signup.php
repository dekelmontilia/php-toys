<?php 
header('Content-Type: application/json');
include "../connect.php";


$queryString = "SELECT * FROM shop";
$query = $conn->prepare($queryString);
 


if(isset($_GET['id'])){
  $queryString = "SELECT * FROM shop WHERE id = ?";
  $query = $conn->prepare($queryString);
  $query->bind_param('s',$_GET['id']);
}

$query->execute();
$res = $query->get_result();
$json_ar = [];
while($row = mysqli_fetch_assoc($res)){
  array_push($json_ar,(object)$row);
}

echo json_encode($json_ar);