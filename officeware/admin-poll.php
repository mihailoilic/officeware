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

    $poll_answers = selectQuery("SELECT choice_title, COUNT(pa.choice_id) AS vote_count FROM poll_answers pa RIGHT OUTER JOIN poll_choices pc ON pa.choice_id = pc.choice_id GROUP BY choice_title", true);

?>

    <main id="admin-poll" class="container-lg position-relative bg-light-trans mx-auto p-5 mb-5">
        <h1 class="text-muted my-5 pb-4 font-weight-light h3 mx-auto">
            Poll Management
        </h1>
        <div id="poll-results" class="containter-fluid pt-5 mx-auto">
            <?php
                if(Count($poll_answers) > 0):
                    echo '<h2 class="font-weight-light h5">What is your favorite writing implement?</h2>';
                    foreach($poll_answers as $answer):
            ?>
                <div class="choice py-3 border-bottom font-weight-light h6">
                    <div class="my-2"><span class="fas fa-poll color-primary"></span> <?=$answer->choice_title?></div>
                    <div class="my-2">Votes: <?=$answer->vote_count?></div>
                </div>
            <?php
                    endforeach;
                else:
            ?>
                <p class="font-weight-light h5">There are no votes yet.</p>
            <?php
                endif;
            ?>
        </div>
    </main>


<?php
    require_once("views/footer.php");
?>