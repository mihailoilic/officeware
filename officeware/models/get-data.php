<?php
    header("Content-type: application/json");
    require_once("../config/connection.php");
    require_once("session.php");
    require_once("functions.php");

    if(isset($_GET["type"])){
        $table = $_GET["type"];

        if($table == "products"){

            $category = isset($_GET["category"]) ? $_GET["category"] : "";
            $brand = isset($_GET["brand"]) ? $_GET["brand"] : "";
            $color = isset($_GET["color"]) ? $_GET["color"] : "";
            $search = isset($_GET["search"]) ? strtolower(addslashes($_GET["search"])) : "";
            $max_price = isset($_GET["max-price"]) ? $_GET["max-price"] : "";
            $order = isset($_GET["order"]) ? $_GET["order"] : "";
            $pagination = isset($_GET["pagination"]) ? (int)$_GET["pagination"] : "";
            $page = isset($_GET["page"]) ? (int)$_GET["page"] : "";

            try{
                $products = getProducts($category, $brand, $color, $search, $max_price, $order);

                $noOfPages = 0;
                if($pagination > 0){
                    $noOfPages = Count($products) / (int)$pagination;
                    if(Count($products) % (int)$pagination > 0){
                        $noOfPages += 1;
                    }
                    $products = getProductsPage($products, $pagination, $page);
                }

                echo json_encode(["products"=> $products, "pages" => $noOfPages]);
                http_response_code(200);
            }
            catch(PDOException $ex){
                echo json_encode($ex);
                http_response_code(500);

            }
        }

        else if($table == "brands" || $table == "categories" || $table == "colors"){

            try {
                $data = selectQuery($table);
                echo json_encode($data);
                http_response_code(200);
            }
            catch(PDOException $ex){
                echo json_encode($ex);
                http_response_code(500);
            }
        }

        else if($table == "users" && $userObj && $userObj->role_name == "Administrator"){
            try {
                $users = selectQuery("users WHERE role_id != 2");
                echo json_encode($users);
                http_response_code(200);
            }
            catch(PDOException $ex){
                echo json_encode($ex);
                http_response_code(500);
            }
        }

        else {

            echo json_encode(["message" => "Not found"]);
            http_response_code(404);
        }

    }
    else {
        header("Location: ../index.php");
    }
    
?>