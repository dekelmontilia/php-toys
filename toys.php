<?php 
    header('Content-Type: application/json');
    include_once "./connect.php";
    include "./prods/auth.php";

    $body = file_get_contents('php://input');
    $phpBody = json_decode($body);

    switch($_SERVER["REQUEST_METHODE"]){
        case "DELETE":
            if(!isset($_GET["id"])){
                echo "{\"msg\":\"Enter prod id\"}";
                break;
            }
            $delId = (int)$_GET["id"];
            $query ="DELETE FROM toys WHERE id = ? AND iduser = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ii", $delId, $checkToken);
            $stmt->execute();
            $res = $stmt->affected_rows;
            echo "{\"n\":{$res
            }}";
            break;

            case "PUT":
                if(!isset($_GET["id"])){
                    echo "{\"msg\":\"Enter prod id\"}";
                    break;
                }
                $editId = (int)$_GET["id"];
                $query = "UPDATE toys SET name = ? , cat = ? , img = ? , price = ? WHERE id = ? AND iduser = ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("sssdii", $phpBody->name, $phpBody->cat, $phpbody->img, $phpBody->price, $editId, $checkToken);
                $stmt->execute();
                $res = $stmt->affected_rows;
            echo "{\"n\":{$res
            }}";
            break;

            case "POST":
               $query = "INSERT INTO toys (name, cat, img, price, iduser) VALUES (?, ?, ?, ?, ?)";
               $stmt = $conn->prepare($query);
               $stmt->bind_param("sssdi", $phpBody->name, $phpbody->cat, $phpBody->img, $phpBody->price, $checkToken);
               $stmt->execute();
               $res = $stmt->insert_id;
               echo "{\"n\":{$res
               }}";
               break;
                


    }



?>