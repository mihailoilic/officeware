<?php
    header("Content-type: application/json");
    require_once("../config/connection.php");
    require_once("session.php");

    if(!($userObj && $userObj->role_name == "Administrator")){
        header("Location: ../index.php");
        die();
    }

    if(isset($_GET["type"])){

        $type = $_GET["type"];
        $id = $_GET["id"];

        if($type == "categories" || $type == "brands" || $type == "colors"){

            $column_name = $_GET["column-name"];

            if(Count(selectQuery("products WHERE $column_name = $id"))>0){
                echo json_encode(["message" => "Can't remove this!"]);
                http_response_code(406);
                die();
            }
            try {
                
                $deleteQuery = $konekcija->prepare("DELETE FROM $type WHERE $column_name = :id");
                $deleteQuery->bindParam(":id", $id);
                $rez = $deleteQuery->execute();

                if($rez){
                    echo json_encode(["message" => "Item successfully removed from $type."]);
                    http_response_code(200);
                }
                else {
                    echo json_encode(["message" => "Error removing item. Try again later."]);
                    http_response_code(500);
                }

            }
            catch(PDOException $ex){
                echo json_encode(["message" => "Error removing item. ".$ex->getMessage()]);
                http_response_code(500);
            }
        }

        else if($type == "products"){
         
            try {

                $deleteQuery = $konekcija->prepare("DELETE p, c FROM products p LEFT JOIN cart c on p.product_id = c.product_id WHERE p.product_id = :id");
                $deleteQuery->bindParam(":id", $id);
                $rez = $deleteQuery->execute();

                if($rez){
                    header("Location: ../shop.php");
                }
                else {
                    $error = "Error removing product. Try again later.";
                    header("Location: ../shop.php?error=$error");
                }

            }
            catch(PDOException $ex){
                $error = "Error removing product. Try again later.";
                header("Location: ../shop.php?error=$error");
            }
        }

        else if($type == "users"){

            try {

                $deleteQuery = $konekcija->prepare("DELETE FROM users WHERE user_id = :id AND role_id <> 2");
                $deleteQuery->bindParam(":id", $id);
                $rez = $deleteQuery->execute();

                if($rez){
                    echo json_encode(["message" => "User successfully removed."]);
                    http_response_code(200);
                }
                else {
                    echo json_encode(["message" => "Error removing user. Try again later."]);
                    http_response_code(500);
                }

            }
            catch(PDOException $ex){
                echo json_encode(["message" => $ex->getMessage()]);
                http_response_code(500);
            }
        }

        else {
            header("Location: ../index.php");
        }
    }
?>