<?php 
    require_once("config/connection.php");
    require_once("models/session.php");

    if(!$userObj){
        header("Location: index.php");
        die();
    }

    require_once("models/functions.php");
    require_once("views/head.php");
    require_once("views/nav.php");


?>
    <main id="poll" class="container position-relative bg-light-trans py-3 mb-5">

        <h1 class="text-muted my-5 mx-auto font-weight-light h3 px-4">Poll</h1>

        <?php
        if(isset($_GET["error"])){
                echo "<p class='alert alert-danger mt-3 mx-auto'>".$_GET["error"]."</p>";
        }
        if(isset($_GET["message"])){
            echo "<p class='alert alert-info mt-3 mx-auto'>".$_GET["message"]."</p>";
        }
        ?>

        <section id="poll" class="p-4 h6 font-weight-light mx-auto">
            <h2 class="font-weight-light h5">What is your favorite writing implement?</h2>
            <?php
                if(!checkParticipation($userObj->user_id)):
                    $choices = selectQuery("poll_choices");
                    echo '<form name="poll" action="models/poll-vote.php" method="post">';
                    foreach($choices as $choice):
            ?>
                <div class="form-check my-1">
                    <input class="form-check-input" type="radio" name="poll-choice" id="poll-choice-<?=$choice->choice_id?>" value="<?=$choice->choice_id?>">
                    <label class="form-check-label" for="poll-choice-<?=$choice->choice_id?>">
                        <?=$choice->choice_title?>
                    </label>
                </div>
            <?php
                    endforeach;
                    echo '<input type="submit" value="Vote" class="btn btn-primary mt-2" name="btn-vote" id="btn-vote"/></form>';
                else:
            ?>
                <p class="p-3"><span class="fas fa-check color-primary"></span>  You have already voted.</p>
            <?php
                endif;
            ?>
        </section>
        
    </main>

<?php
    require_once("views/footer.php");
?>
