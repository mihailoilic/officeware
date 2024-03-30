<?php
    session_start();
    require_once("../config/connection.php");
    if(isset($_POST["btn-login"])){

        $reg_user = "/^\w{3,30}$/";
        if(!preg_match($reg_user, $_POST["username"])){
            header("Location: ../login.php?error=Invalid%20username.");
            die();
        }
        $reg_pw = "/^(?=.*\p{Lu})(?=.*\p{Ll})(?=.*\d)(?=.{6,})/";
        if(!preg_match($reg_user, $_POST["password"])){
            header("Location: ../login.php?error=Invalid%20password.");
            die();
        }

        $user = addslashes($_POST["username"]);
        $pw = md5(addslashes($_POST["password"]));

        $loginQuery = $konekcija->prepare("SELECT * FROM users u JOIN roles r ON u.role_id = r.role_id  WHERE username = :user AND u.password = :pw");
        $loginQuery->bindParam(":user", $user);
        $loginQuery->bindParam(":pw", $pw);
        $loginQuery->execute();
        $userObj = $loginQuery->fetch();
        
        if($userObj){
            $_SESSION["user"] = $userObj;
            header("Location: ../index.php");
        }
        else {
            $error = addslashes("Invalid username and/or password.");
            header("Location: ../login.php?error=".$error);
        }
        
    }
    else {
        header("Location: ../index.php");
    }
?>