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
    <main id="cart" class="container position-relative bg-light-trans py-3 mb-5">
        <h1 class="text-muted my-5 font-weight-light h3 px-4">Your Cart</h1>
        <div id="cart-items">
        </div>
        
    </main>

<?php
    require_once("views/footer.php");
?>
