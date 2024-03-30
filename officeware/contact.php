<?php 
    require_once("config/connection.php");
    require_once("models/session.php");
    require_once("models/functions.php");
    require_once("views/head.php");
    require_once("views/nav.php");

    $name = "";
    $email = "";
    if($userObj){
        $name = $userObj->full_name;
        $email = $userObj->email;
    }
?>
    <main id="contact" class="container position-relative bg-light-trans mx-auto p-4 mb-5">
        <h1 class="text-muted my-5 font-weight-light h2 mx-auto">
            Send Us a Message
        </h1>
        <form id="contact-form" class="mx-auto my-5" name="contact-form" method="post" action="models/send-message.php">
            <div class="form-group">
                <label for="name">Your name:</label>
                <input type="text" name="name" id="name" data-title="name" class="form-control" value="<?=$name?>"/>
            </div>
            <div class="form-group">
                <label for="username">E-mail:</label>
                <input type="text" name="email" id="email" data-title="e-mail" class="form-control" value="<?=$email?>"/>
            </div>
            <div class="form-group">
                <label for="username">Your message:</label>
                <textarea class="form-control" id="message" name="message" data-title="message"></textarea>
            </div>
            <input type="submit" value="Send" name="btn-send" id="btn-send" class="btn btn-primary"/>
        </form>
        
        <?php
            if(isset($_GET["error"])){
                echo "<p class='alert alert-danger mt-3 mx-auto'>".$_GET["error"]."</p>";
            }
            if(isset($_GET["message"])){
                echo "<p class='alert alert-info mt-3 mx-auto'>".$_GET["message"]."</p>";
            }
        ?>
        
    </main>
<?php
    require_once("views/footer.php");
?>
