<?php
    require_once("session.php");
    if($userObj){
        require_once("../config/connection.php");
        require_once("functions.php");
        if(isset($_GET["operation"])){
            $operation = $_GET["operation"];

            if($operation == "add" || $operation == "set"){
                $id = addslashes($_GET["id"]);
                $quantity = addslashes($_GET["quantity"]);
                
                if($operation == "add" && ((int)$quantity<1 || (int)$quantity > 99)){
                    echo json_encode(["message" => "Error. Quantity is wrong."]);
                    http_response_code(406);
                    die();
                }
                
                
                $cartItemExists = selectQuery("cart WHERE user_id = $userObj->user_id AND product_id = $id");

                try{
                    if($cartItemExists){
                        $qtyString = "quantity + ";
                        if($operation == "set"){
                            $qtyString = "";
                        }
                        $updateQuery = $konekcija->prepare("UPDATE cart SET quantity = $qtyString :qty WHERE user_id = :userid AND product_id = :pid");
                        $updateQuery->bindParam(":qty", $quantity);
                        $updateQuery->bindParam(":userid", $userObj->user_id);
                        $updateQuery->bindParam(":pid", $id);
                        $rez = $updateQuery->execute();
                    }
                    else {
                        $insertQuery = $konekcija->prepare("INSERT INTO cart VALUES(:pid, :userid, :qty)");
                        $insertQuery->bindParam(":pid", $id);
                        $insertQuery->bindParam(":userid", $userObj->user_id);
                        $insertQuery->bindParam(":qty", $quantity);
                        $rez = $insertQuery->execute();
                    }

                    if($rez){
                        echo json_encode(["message" => "Successfully added to your cart."]);
                        http_response_code(200);
                    }
                    else{
                        echo json_encode(["message" => "An error occurred. Please try again later."]);
                        http_response_code(500);
                    }

                }
                catch(PDOException $ex){
                    echo json_encode(["message" => "An error occurred. Please try again later.", "errorMessage" => $ex.getMessage()]);
                    http_response_code(500);
                }

            }

            else if($operation == "remove" || $operation == "remove-all"){

                if($operation == "remove"){
                    $id = addslashes($_GET["id"]);
                    $removeIdString = "product_id = $id AND";
                }
                else {
                    $removeIdString = "";
                }

                try{
                    $deleteQuery = $konekcija->prepare("DELETE FROM cart WHERE $removeIdString user_id = :userid");
                    $deleteQuery->bindParam(":userid", $userObj->user_id);
                    $rez = $deleteQuery->execute();
                    if($rez){
                        echo json_encode(["message" => "Successfully removed."]);
                        http_response_code(200);
                    }
                    else{
                        echo json_encode(["message" => "An error occurred. Please try again later."]);
                        http_response_code(500);
                    }
                }
                catch(PDOException $ex){
                    echo json_encode(["message" => "An error occurred. Please try again later.", "errorMessage" => $ex.getMessage()]);
                    http_response_code(500);
                }
            }
        

        else if($operation == "get"){
            try{
                $cartItems = selectQuery("cart WHERE user_id = $userObj->user_id");
                echo json_encode($cartItems);
                http_response_code(200);
            }
            catch(PDOException $ex){
                echo json_encode(["message" => "An error occurred. Please try again later.", "errorMessage" => $ex.getMessage()]);
                http_response_code(500);
            }
            
        }

        else {
            echo json_encode(["message" => "Not found."]);
            http_response_code(404);
            
        }
    }
}
    else {
        header("Location: ../index.php");
    }
?>