<?php 
header('Content-Type: application/json');
  include "../connect.php";

  $perPage = (isset($_GET['perPage'])) ? (int)$_GET['perPage'] : 5;
  $page = (isset($_GET['page'])) ? (int)$_GET['page'] * $perPage : 0;
  $min = (isset($_GET['min'])) ? (int)$_GET['min'] : 0;
  $max = (isset($_GET['max'])) ? (int)$_GET['max'] : 9999;
  
  $query = "SELECT * FROM shop WHERE true ";
  
  if(isset($_GET['prodId'])){


    $prodId = (int)$_GET['prodId'];
    $query = "SELECT * FROM shop WHERE id = '{$prodId}' ";
  }

  if(isset($_GET['catName'])){
        

    $catName = $conn->real_escape_string($_GET['catName']);
      
    $query = "SELECT * FROM shop WHERE cat = '{$catName}' ";
  }

  if(isset($_GET['search'])){
    $searchFor = $conn->real_escape_string($_GET['search']);
    $query .= " AND (name like '%{$searchFor}%' OR cat like '%{$searchFor}%')";
  }

   $query .= " AND price > {$min} AND price < {$max}";

  if(isset($_GET['sort'])){
  
    $sortBy = $conn->real_escape_string($_GET['sort']);
    $query .= " ORDER BY {$sortBy} DESC";
  }

  $query .= " LIMIT {$page},{$perPage}";
   $res = $conn->query($query);

  $json_ar = [];
  while($row = mysqli_fetch_assoc($res)){
    array_push($json_ar,(object)$row);
  }

  echo json_encode($json_ar);