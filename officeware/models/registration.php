<?php
    session_start();
    require_once("../config/connection.php");
    if(isset($_POST["btn-register"])){

        $reg_user = "/^\w{3,30}$/";
        if(!preg_match($reg_user, $_POST["username"])){
            header("Location: ../login.php?error=Invalid%20username.");
            die();
        }
        $reg_pw = "/^(?=.*\p{Lu})(?=.*\p{Ll})(?=.*\d)(?=.{6,})/";
        if(!preg_match($reg_pw, $_POST["password"])){
            header("Location: ../login.php?error=Invalid%20password.");
            die();
        }
        $reg_email = "/^[a-z]((\.|-|_)?[a-z0-9]){2,}@[a-z]((\.|-)?[a-z0-9]+){2,}\.[a-z]{2,6}$/i";
        if(!preg_match($reg_email, $_POST["email"])){
            header("Location: ../login.php?error=Invalid%20e-mail.");
            die();
        }
        $reg_full_name = "/^\p{Lu}\p{L}{1,14}(\s\p{Lu}\p{L}{1,14}){1,3}$/";
        if(!preg_match($reg_full_name, $_POST["full-name"])){
            header("Location: ../login.php?error=Invalid%20full%20name.");
            die();
        }

        $user = addslashes($_POST["username"]);
        $pw = md5(addslashes($_POST["password"]));
        $email = addslashes($_POST["email"]);
        $full_name = addslashes($_POST["full-name"]);

        $userQuery = $konekcija->prepare("SELECT username, email FROM users WHERE username = :user OR email=:email");
        $userQuery->bindParam(":user", $user);
        $userQuery->bindParam(":email", $email);
        $userQuery->execute();
        $userObj = $userQuery->fetch();
        
        if($userObj){
            if($userObj->email == $email){
                $error = addslashes("This e-mail address has already been used by another person.");
            }
            else {
                $error = addslashes("This username has already been taken.");
            }
            header("Location: ../register.php?error=".$error);
        }
        else {
            try {
                $registerQuery = $konekcija->prepare("INSERT INTO users(username, password, email, full_name) VALUES(:user, :pw, :email, :fname)");
                $registerQuery->bindParam(":user", $user);
                $registerQuery->bindParam(":email", $email);
                $registerQuery->bindParam(":pw", $pw);
                $registerQuery->bindParam(":fname", $full_name);
                $rez = $registerQuery->execute();
                if($rez){
                    $message = addslashes("Registration successful. You can login now.");
                    header("Location: ../login.php?message=".$message);
                }
                else {
                    $error = addslashes("Database error, registration has failed. Please try again later.");
                    header("Location: ../register.php?error=".$error);
                }
            }
            catch(PDOException $ex){
                $error = addslashes("Database error, registration has failed. Please try again later.");
                echo $ex->getMessage();
                header("Location: ../register.php?message=".$error);
            }
        }
        
    }
    else {
        header("Location: ../index.php");
    }
?>