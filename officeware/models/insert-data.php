<?php
    header("Content-type: application/json");
    require_once("../config/connection.php");
    require_once("session.php");

    if(!($userObj && $userObj->role_name == "Administrator")){
        header("Location: ../index.php");
        die();
    }
    require_once("functions.php");

    if(isset($_POST["type"])){

        $type = $_POST["type"];

        if($type == "categories" || $type == "brands" || $type == "colors"){
            $name = $_POST["name"];
            $column_name = $_POST["column-name"];

            if(!preg_match("/\p{Lu}[\p{L}&,\-\d]{1,30}/", $name)){
                echo json_encode(["message"=>"Invalid name format."]);
                http_response_code(406);
            }

            try {
                $insertQuery = $konekcija->prepare("INSERT INTO $type($column_name) VALUES(:name)");
                $insertQuery->bindParam(":name", $name);
                $rez = $insertQuery->execute();
                if($rez){
                    echo json_encode(["message" => "Successfully added item to $type."]);
                    http_response_code(200);
                }
                else {
                    echo json_encode(["message" => "Error adding item. Try again later."]);
                    http_response_code(500);
                }
            }
            catch(PDOException $ex){
                echo json_encode(["message" => "Error adding item. Try again later."]);
                http_response_code(500);
            }
        }

        else if($type == "products"){

            $operation = $_POST["operation"];

            if($operation == "Edit"){
                $id = $_POST["id"];
                $location_params = "operation=Edit&id=$id";
            }
            else {
                $location_params = "operation=New";
            }

            $title = addslashes($_POST["product-title"]);
            if(!preg_match("/^\p{Lu}.{4,99}$/", $title)){
                $error = "Title should be between 5 and 100 characters long start with a capital letter.";
                header("Location: ../admin-product-edit.php?$location_params&error=$error");
                die();
            }

            $desc = addslashes($_POST["product-description"]);
            if(!preg_match("/^\p{Lu}.{19,999}$/", $desc)){
                $error = "Description should be between 20 and 1000 characters long start with a capital letter.";
                header("Location: ../admin-product-edit.php?$location_params&error=$error");
                die();
            }

            $cat_id = $_POST["category"];
            $brand_id = $_POST["brand"];
            $color_id = $_POST["color"];

            $price = addslashes($_POST["product-price"]);
            if(!preg_match("/^\d+\.\d+$/", $price)){
                $error = "Price must be in XX.XX format, use only numbers.";
                header("Location: ../admin-product-edit.php?$location_params&error=$error");
                die();
            }

            $package = addslashes($_POST["product-package"]);
            if(!preg_match("/.{2,20}/", $package)){
                $error = "Invalid package size. Must be between 2 and 20 characters.";
                header("Location: ../admin-product-edit.php?$location_params&error=$error");
                die();
            }

            $fileExists = false;
            if(file_exists($_FILES["product-image"]["tmp_name"])){
                $fileExists = true;
                $temp_img_path = $_FILES["product-image"]["tmp_name"];
                $img_name = $_FILES["product-image"]["name"];
                $ext = array_slice(explode(".", $img_name), -1)[0];
                if(!in_array($ext, ["jpg", "jpeg", "gif", "webp", "png"])){
                    $error = addslashes("Allowed formats for images are: jpg, jpeg, gif, webp, png.");
                    header("Location: ../admin-product-edit.php?$location_params&error=$error");
                    die();
                }

                $time = (string)microtime(true);
                $name_string = str_replace(".", "", str_replace(" ", "", $time));
                $new_img_name = "$name_string.$ext";
            }
            else if ($operation == "New"){
                $error = "You must provide an image.";
                header("Location: ../admin-product-edit.php?$location_params&error=$error");
                die();
            }


            if($operation == "New"){
                try{
                    $insertQuery = $konekcija->prepare("INSERT INTO products(product_title, product_description, category_id, brand_id, color_id, product_price, package_size, product_image) VALUES(:title, :desc, :catid, :brandid, :colorid, :price, :package, :image)");
                    $insertQuery->bindParam(":title", $title);
                    $insertQuery->bindParam(":desc", $desc);
                    $insertQuery->bindParam(":catid", $cat_id);
                    $insertQuery->bindParam(":brandid", $brand_id);
                    $insertQuery->bindParam(":colorid", $color_id);
                    $insertQuery->bindParam(":price", $price);
                    $insertQuery->bindParam(":package", $package);
                    $insertQuery->bindParam(":image", $new_img_name);
                    $rez = $insertQuery->execute();

                    if($rez){
                        $id = $konekcija->lastInsertId();
                        move_uploaded_file($temp_img_path, "../assets/img/$new_img_name");
                        header("Location: ../admin-product-edit.php?$location_params&success=".$id);
                    }
                    else {
                        $error = addslashes("Error creating product. Try again later.");
                        header("Location: ../admin-product-edit.php?$location_params&error=$error");
                    }
                }
                catch(PDOException $ex){
                    $error = addslashes("Error creating product. Try again later.");
                    header("Location: ../admin-product-edit.php?$location_params&error=$error");
                }
                
            }

            else if ($operation == "Edit"){

                try{
                    $image_string = "";
                    if($fileExists){   
                        $image_string = ", product_image = :image";
                    }
                    $updateQuery = $konekcija->prepare("UPDATE products SET product_title = :title, product_description = :desc, category_id = :catid, brand_id = :brandid, color_id = :colorid, product_price =:price, package_size =:package$image_string WHERE product_id = :id");
                    $updateQuery->bindParam(":title", $title);
                    $updateQuery->bindParam(":desc", $desc);
                    $updateQuery->bindParam(":catid", $cat_id);
                    $updateQuery->bindParam(":brandid", $brand_id);
                    $updateQuery->bindParam(":colorid", $color_id);
                    $updateQuery->bindParam(":price", $price);
                    $updateQuery->bindParam(":package", $package);
                    if($fileExists){
                        $updateQuery->bindParam(":image", $new_img_name);
                    }
                    $updateQuery->bindParam(":id", $id);
                    $rez = $updateQuery->execute();

                    if($rez){
                        move_uploaded_file($temp_img_path, "../assets/img/$new_img_name");
                        header("Location: ../product.php?id=$id");
                    }
                    else {
                        $error = addslashes("Error creating product. Try again later.");
                        header("Location: ../admin-product-edit.php?$location_params&error=$error");
                    }
                }
                catch(PDOException $ex){
                    var_dump($ex);
                    die();
                    $error = addslashes("Error creating product. Try again later.");
                    header("Location: ../admin-product-edit.php?$location_params&error=$error");
                }
            }
        }

        else {
            echo json_encode(["message" => "Not found."]);
            http_response_code(404);
        }
    }

    else {
        header("Location: ../index.php");
    }
?>