<?php
    session_start();
    $userObj = false;
    if(isset($_SESSION["user"])){
        $userObj = $_SESSION["user"];
    }
?>