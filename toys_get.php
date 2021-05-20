<?php 
    header('Content-Type: application/json');
    include_once "./connect.php";

    $per = (isset($_GET["per"])) ? (int)$_GET["per"] : 10;
    $page = (isset($_GET["page"]))? (int)$_GET["page"] * $per : 0;
    $minprice = (isset($_GET["min"])) ?  (int)$_GET["min"] : 0;
    $maxprice = (isset($_GET["max"])) ?  (int)$_GET["max"] : 999999;

    $query = "SELECT * FROM toys WHERE true";

    if(isset($_GET["id"])){
        $id = (int)$_GET["id"];
        $query = "SELECT * FROM toys WHERE id = '{$id}'";
    }
    if(isset($_GET["cat"])){
        $cat = $conn->real_escape_string($_GET['cat']);
        $query = "SELECT * FROM toys WHERE cat = '{$cat}'";

    }
    if(isset($_GET["search"])){
        $search = $conn->real_escape_string($_GET['search']);
        $query .= " AND (name like '%{$search}%' OR cat like '%{$search}%')";
        
    }
$query .= " AND price > {$minprice} AND price < {$maxprice}";

if(isset($_GET["sort"])){
    $sort = $conn->real_escape_string($_GET['sort']);
    $query .= " ORDER BY {$sort} DESC";

}

    $query .= " LIMIT {$page},{$per}";
$res = $conn->query($query);
$ar =[];

while($row = mysqli_fetch_assoc($res)){
    array_push($ar, (object)$row);
}

echo json_encode($ar);
    
?>