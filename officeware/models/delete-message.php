<?php
    require_once("../config/connection.php");
    require_once("session.php");

    if(!($userObj && $userObj->role_name == "Administrator")){
        header("Location: ../index.php");
        die();
    }

    if(isset($_GET["id"])){
        $id = $_GET["id"];

        try {

            $deleteQuery = $konekcija->prepare("DELETE FROM messages WHERE message_id = :id");
            $deleteQuery->bindParam(":id", $id);
            $rez = $deleteQuery->execute();

            if($rez){
                $message = "Message deleted successfully.";
                header("Location: ../admin-messages.php?message=$message");
            }
            else {
                $error = "Error deleting message. Try again later.";
                header("Location: ../admin-messages.php?error=$error");
            }

        }
        catch(PDOException $ex){
            echo $ex->getMessage();
            $error = "Error deleting message. Try again later.";
            header("Location: ../admin-messages.php?error=$error");
        }
        
    }
    else {
        header("Location: ../index.php");
    }

?>