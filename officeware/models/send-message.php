<?php 
    require_once("../config/connection.php");
    if(isset($_POST["btn-send"])){

        $reg_email = "/^[a-z]((\.|-|_)?[a-z0-9]){2,}@[a-z]((\.|-)?[a-z0-9]+){2,}\.[a-z]{2,6}$/i";
        if(!preg_match($reg_email, $_POST["email"])){
            $error = "Invalid e-mail address.";
            header("Location: ../contact.php?error=$error");
            die();
        }

        $reg_name = "/^\p{Lu}\p{L}{1,14}(\s\p{Lu}\p{L}{1,14}){0,3}$/";
        if(!preg_match($reg_name, $_POST["name"])){
            $error = "Invalid name.";
            header("Location: ../contact.php?error=$error");
            die();
        }

        $reg_message = "/^.{20,1000}$/";
        if(!preg_match($reg_message, $_POST["message"])){
            header("Location: ../contact.php?error=$error");
            die();
        }
        
        $name = addslashes($_POST["name"]);
        $email = addslashes($_POST["email"]);
        $message = addslashes($_POST["message"]);

        try {
            $insertQuery = $konekcija->prepare("INSERT INTO messages(sender_name, sender_email, message_text) VALUES(:name, :email, :message)");
            $insertQuery->bindParam(":name", $name);
            $insertQuery->bindParam(":email", $email);
            $insertQuery->bindParam(":message", $message);
            $rez = $insertQuery->execute();
            if($rez){
                $message = addslashes("Message sent successfully.");
                header("Location: ../contact.php?message=".$message);
            }
            else {
                $error = addslashes("Error sending message. Please try again later.");
                echo $ex->getMessage();
                header("Location: ../contact.php?error=".$error);
            }
        }
        catch(PDOException $ex){
            $error = addslashes("Error sending message. Please try again later.");
            echo $ex->getMessage();
            header("Location: ../contact.php?error=".$error);
        }
    }
    else {
        header("Location: ../index.php");
    }
?>