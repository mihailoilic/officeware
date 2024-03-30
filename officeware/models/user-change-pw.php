<?php
    header("Content-type: application/json");
    require_once("../config/connection.php");
    require_once("session.php");
    require_once("functions.php");

    if($userObj && isset($_POST["btn-change-pw"])){

        $reg_pw = "/^(?=.*\p{Lu})(?=.*\p{Ll})(?=.*\d)(?=.{6,50})/";
        if(!preg_match($reg_pw, $_POST["new-pw"])){
            $error = "Password too weak, or invalid password format.";
            header("Location: ../account.php?error=$error");
            die();
        }
        
        $old_pw = md5(addslashes($_POST["old-pw"]));
        $new_pw = md5(addslashes($_POST["new-pw"]));
        $confirm_pw = md5(addslashes($_POST["confirm-pw"]));
        $id = $userObj->user_id;

        if($old_pw != $userObj->password){
            $error = "Incorrect old password.";
            header("Location: ../account.php?error=$error");
            die();
        }

        if($new_pw != $confirm_pw){
            $error = "Passwords do not match.";
            header("Location: ../account.php?error=$error");
            die();
        }

        try {
            $rez = changePassword($id, $new_pw);
            if($rez){
                $message =  "Password successfully changed.";
                header("Location: ../account.php?message=$message");
            }
            else {
                $error = "Error changing password. Try again later.";
                header("Location: ../account.php?error=$error");
            }

        }
        catch(PDOException $ex){
            $error = "Error changing password. Try again later.";
            header("Location: ../account.php?error=$error");
        }
    }
    else {
        header("Location: ../index.php");
    }
?>