<?php
    header("Content-type: application/json");
    require_once("../config/connection.php");
    require_once("session.php");
    require_once("functions.php");

    if($userObj && isset($_POST["role"])){
        $role = $_POST["role"];

        if($role == "Administrator" && $userObj->role_name == "Administrator"){
            $new_pw = md5(addslashes($_POST["new-pw"]));
            $id = $_POST["id"];
            try {
                $rez = changePassword($id, $new_pw);
                if($rez){
                    echo json_encode(["message" => "Password successfully changed."]);
                    http_response_code(200);
                }
                else {
                    echo json_encode(["message" => "Error changing password."]);
                    http_response_code(500);
                }

            }
            catch(PDOException $ex){
                echo json_encode(["message" => $ex->getMessage()]);
                http_response_code(500);
            }
        }
        else {
            echo json_encode(["message" => "Not found."]);
            http_response_code(404);
        }
    }
?>

