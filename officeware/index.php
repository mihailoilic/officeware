<?php 
    require_once("config/connection.php");
    require_once("models/session.php");
    require_once("models/functions.php");
    require_once("views/head.php");
    require_once("views/nav.php");
?>
    <main id="home" class="container-fluid position-relative bg-light-trans mx-auto p-0 pb-5">
        <section id="slider-wrapper" class="overflow-hidden position-relative d-flex justify-content-center align-items-center">
            <div id="hero" class="position-absolute w-100 d-flex flex-column justify-content-center align-items-center">
                <h1 class="d-inline">Quality Above Everything</h1>
                <p class="d-inline mt-1">We provide the best office supplies for you. Find everything you need at one place.</p>
                <a href="#visit-shop" class="button p-2 text-white">Learn more</a>
            </div>
            <div id="slider" class="w-100 position-relative d-flex align-items-center">
                <?=getSliderImages()?>
            </div>
        </section>
        <section id="visit-shop" class="p-4 mt-5 pt-5 text-center">
            <span class="small color-primary">Everything you need</span>
            <h2 class="font-weight-light h3">Online Shop</h2>
            <div class="row mx-0 mt-5 align-items-center">
                <div class="col-12 col-md-6 text-right">
                    <img src="assets/img/visit-shop.png" class="w-50" alt="office-supplies"/>
                </div>
                <div class="col-12 col-md-6">
                    <p class="text-left font-weight-light"><span class="fas fa-shopping-basket"></span> Check out all our products here!<br/> <a href="shop.php" class="btn btn-primary mt-2">Visit shop</a></p>
                </div>
            </div>
        </section>
        <section id="visit-poll" class="p-4 mt-5 text-center">
            <span class="small color-primary">Help us improve</span>
            <h2 class="font-weight-light h3">Take a Poll</h2>
            <div class="row mx-0 mt-5 align-items-center">
                <div class="col-12 col-md-6 text-right">
                    <img src="assets/img/visit-poll.png" class="w-50" alt="poll"/>
                </div>
                <div class="col-12 col-md-6">
                    <?php
                        $fake_poll_button = "";
                        if(!$userObj){
                            $fake_poll_button = "fake-poll-button";
                        }
                    ?>
                    <p class="text-left font-weight-light"><span class="fas fa-poll"></span> 
                    What is your favorite writing implement?<br/> <a href="poll.php" class="btn btn-primary mt-2 <?=$fake_poll_button?>">Answer</a></p>
                </div>
            </div>
        </section>
    </main>

<?php
    require_once("views/footer.php");
?>
