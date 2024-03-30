<?php 
    require_once("config/connection.php");
    require_once("models/session.php");
    require_once("models/functions.php");
    require_once("views/head.php");
    require_once("views/nav.php");
?>
    <main id="login" class="container position-relative bg-light-trans mx-auto p-4 mb-5">
        <h1 class="text-muted my-5 font-weight-light h2 mx-auto">
            Login
        </h1>
        <form id="login-form" class="mx-auto my-5" name="loginForm" method="post" action="models/login.php">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" data-title="username" class="form-control"/>
            </div>
            <div class="form-group">
                <label for="username">Password:</label>
                <input type="password" name="password" id="password" data-title="password" class="form-control"/>
            </div>
            <input type="submit" value="Login" name="btn-login" class="btn btn-primary"/>
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
