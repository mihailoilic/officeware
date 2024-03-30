<?php
    define("SERVER", "localhost");
    define("DB", "officeware");
    define("USER", "root");
    define("PW", "");
    try {
        $konekcija = new PDO("mysql:host=".SERVER.";dbname=".DB.";charset=utf8", USER, PW);
        $konekcija->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $konekcija->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $c){
        echo "Database connection failed!<br/><br/>".$c->getMessage();
    }
?>