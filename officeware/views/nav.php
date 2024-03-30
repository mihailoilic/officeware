<?php
    try {
        $navLinksString = getNavigationLinks();
    }
    catch(PDOException $ex){
        echo "Can't load navigation: " + $ex->getMessage();
    }
?>

<header id="header" class="position-fixed w-100 m-0 row align-items-center bg-light-trans">
        <div class="col-3 col-sm-6 col-md-4 col-lg-3">
            <!-- logo -->
            <a class="font-weight-bold" href="index.php">
                <img src="assets/img/logo.png" alt="officeware" id="logo-img"/>
                <span id="logo-title" class="d-none d-sm-inline"> officeware</span>
            </a>
        </div>
        <!-- glavni meni -->
        <nav class="col-6 col-md-5 col-lg-6 d-none d-md-block">
            <ul id="menu" class="w-100 m-0 d-flex justify-content-start">
                <?=$navLinksString?>
            </ul>
        </nav>
        <!-- opcije vezane za nalog, responsive meni toggle -->
        <div id="side-togglers" class="col-9 col-sm-6 col-md-3 text-right">
            <?php
                if($userObj):
            ?>

            <a class="position-relative d-inline mx-2 color-primary" href="account.php">
                <span class="fas fa-user-cog"></span>
            </a>
            <a class="position-relative d-inline mx-2 color-primary" href="cart.php">
                <span class="fas fa-shopping-cart"></span>
            </a> 
            <a class="position-relative d-inline mx-2 color-primary" href="models/logout.php">
                <span class="fas fa-sign-out-alt"></span>
            </a>

            <?php
                else:
            ?>

            <a class="position-relative d-inline mx-2 color-primary" href="login.php">
                Login
            </a>
            <a class="position-relative d-inline mx-2 color-primary" href="register.php">
                Register
            </a>

            <?php
                endif;
            ?>

            <a id="menu-button" class="position-relative d-inline d-md-none ml-3 mr-2 color-primary" href="#!">
                <span class="fas fa-bars"></span>
            </a>
        </div>
        <!-- admin panel -->
        <?php
            if($userObj && $userObj->role_name == "Administrator"):
                $adminPanelLinksString = getAdminPanelLinks();
        ?>

            <div id="admin-panel" class="position-absolute w-100 bg-light-trans row p-2 m-0">
                <span class="col-12 col-sm-3 text-muted small">Admin panel</span>
                <div class="col-12 col-sm-9">
                    <?=$adminPanelLinksString?>
                </div>
            </div>

        <?php
            endif;
        ?>
        <!-- responsive meni -->
        <nav id="responsive-menu-wrapper" class="position-absolute w-100 py-3 bg-light-trans d-md-none">
            <ul id="responsive-menu" class="w-100 m-0 d-flex flex-column align-items-center">
                <?=$navLinksString?>
            </ul>
        </nav>
</header>