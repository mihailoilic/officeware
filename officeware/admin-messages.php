<?php 
    require_once("config/connection.php");
    require_once("models/session.php");
    if(!($userObj && $userObj->role_name == "Administrator")){
        header("Location: index.php");
        die();
    }
    require_once("models/functions.php");
    require_once("views/head.php");
    require_once("views/nav.php");

    $messages = selectQuery("messages");

?>

    <main id="admin-messages" class="container-lg position-relative bg-light-trans mx-auto p-5 mb-5">
        <h1 class="text-muted my-5 pb-4 font-weight-light h3 mx-auto">
            Message Management
        </h1>
        <?php
                    if(isset($_GET["error"])){
                        echo "<p class='alert alert-danger mt-3 mx-auto'>".$_GET["error"]."</p>";
                    }
                    if(isset($_GET["message"])){
                    echo "<p class='alert alert-info mt-3 mx-auto'>".$_GET["message"]."</p>";
                    }
                ?>
        <div id="messages-wrapper" class="containter-fluid pt-5 mx-auto">
        <?php
            if(Count($messages) > 0):
                foreach($messages as $message):
        ?>
            <div class="message py-2 border-bottom">
                <div class="message-id h5 font-weight-light">#<?=$message->message_id?></div>
                <div class="sender-name my-1"><span class="fas fa-signature color-primary"></span> <?=$message->sender_name?></div>
                <div class="sender-email my-1"><span class="fas fa-envelope color-primary"></span> <?=$message->sender_email?></div>
                <div class="message-date my-1"><span class="fas fa-calendar-alt color-primary"></span> <?=$message->date_sent?></div>
                <div class="message-text my-2"><?=$message->message_text?></div>
                <a href="models/delete-message.php?id=<?=$message->message_id?>" class="btn btn-primary my-2">Delete</a>
            </div>
        <?php
                endforeach;
            else:
        ?>
            <p class="h5 font-weight-light">The inbox is empty.</p>
        <?php
            endif;
        ?>
        </div>
    </main>


<?php
    require_once("views/footer.php");
?>