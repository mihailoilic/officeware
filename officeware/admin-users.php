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

?>

    <main id="admin-users" class="container-lg position-relative bg-light-trans mx-auto p-5 mb-5">
        <h1 class="text-muted my-5 pb-4 font-weight-light h3 mx-auto">
            User Management
        </h1>
        <span class="fas fa-search text-muted"></span>
        <input type="text" id="search-users" class="form-control d-inline" placeholder="Search by username or e-mail" />
        <div id="users-wrapper" class="containter-fluid pt-5">
            <div class="user-info row m-0 border-bottom">
                <div class="col-1 user-id h5 font-weight-light">ID</div>
                <div class="col-2 username h5 font-weight-light">Username</div>
                <div class="col-3 user-email h5 font-weight-light">E-mail</div>
                <div class="col-2 user-full-name h5 font-weight-light">Full Name</div>
                <div class="col-2 user-date-created h5 font-weight-light">Date created</div>
                <div class="col-2 h5 font-weight-light text-right pr-4">Options</div>
            </div>
            <div id="users">
            </div>
        </div>
    </main>


<?php
    require_once("views/footer.php");
?>