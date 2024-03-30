<?php 
    require_once("../config/connection.php");
    require_once("session.php");

    if(!$userObj){
        header("Location: ../index.php");
        die();
    }

    if(isset($_POST["btn-vote"])){
        $choice = $_POST["poll-choice"];
        $id = $userObj->user_id;

        try {
            $insertQuery = $konekcija->prepare("INSERT INTO poll_answers(user_id, choice_id) VALUES(:id, :choice)");
            $insertQuery->bindParam(":id", $id);
            $insertQuery->bindParam(":choice", $choice);
            $rez = $insertQuery->execute();
            if($rez){
                $message = "Thank you for voting!";
                header("Location: ../poll.php?message=$message");
            }
            else {
                $error = "Error recording your vote. Try again later.";
                header("Location: ../poll.php?error=$error");
            }
        }
        catch(PDOException $ex){
            echo $ex->getMessage();
            $error = "Error recording your vote. Try again later.";
            header("Location: ../poll.php?error=$error");
        }
        
    }
    else {
        header("Location: ../index.php");
    }


?>