<?php 
    require_once("config/connection.php");
    require_once("models/session.php");
    require_once("models/functions.php");
    require_once("views/head.php");
    require_once("views/nav.php");
?>
    <main id="register" class="container position-relative bg-light-trans mx-auto p-4 mb-5">
        <?php
            if(isset($_GET["message"])){
                echo "<p class='alert alert-info mt-3 mx-auto'>".$_GET["message"]."</p>";
            }
        ?>
        <h1 class="text-muted my-5 font-weight-light h2 mx-auto">
            Registration
        </h1>
        <form id="register-form" class="mx-auto my-5" name="registerForm" method="post" action="models/registration.php">
            <div class="form-group">
                <label for="full-name">Full Name:</label>
                <input type="text" name="full-name" id="full-name" data-title="full name" class="form-control"/>
            </div>
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="text" name="email" id="email" data-title="e-mail" class="form-control"/>
            </div>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" data-title="username" class="form-control"/>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" data-title="password" class="form-control"/>
            </div>
            <div class="form-group">
                <label for="password-repeat">Confirm password:</label>
                <input type="password" name="password-repeat" id="password-repeat" data-title="password repeat" class="form-control"/>
            </div>
            <input type="submit" value="Register" name="btn-register" class="btn btn-primary"/>
        </form>
        
        <?php
            if(isset($_GET["error"])){
                echo "<p class='alert alert-danger mt-3 mx-auto register-error'>".$_GET["error"]."</p>";
            }
        ?>
        
    </main>
<?php
    require_once("views/footer.php");
?>
