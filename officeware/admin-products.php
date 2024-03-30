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

    $categories = selectQuery("categories");
    $brands = selectQuery("brands");
    $colors = selectQuery("colors");
?>

    <main id="admin-products" class="container position-relative bg-light-trans mx-auto p-5 mb-5">
        <h1 class="text-muted my-5 font-weight-light h3 mx-auto">
            Product Management
        </h1>
        <p class="alert alert-info mt-3 mx-auto">You can edit or remove products by visiting their page in the <a href="shop.php">shop</a>.</p>
        <div class="row container-fluid mt-5">
            <div class="col-12 col-md-6 p-0 p-md-2">
                <div class="row m-0">
                    <h2 class="h5 font-weight-light col-12">Add new category</h2>
                    <input type="text" id="new-category" class="col-8 col-sm-9 col-lg-10 form-control d-inline max-width-400" />
                    <button type="button" id="new-category-btn" data-type="categories" class="btn btn-primary align-baseline col-4 col-sm-3 col-lg-2"><span class="fas fa-plus"></span></button>
                </div>
            </div>
            <div class="col-12 col-md-6 p-0 row m-0 mt-2 mt-md-0">
                <h2 class="h5 font-weight-light col-12">Remove category</h2>
                <select name="categories" id="categories" class="form-control col-8 col-sm-9 col-lg-10"></select>
                <button type="button" id="remove-category-btn" data-type="categories" class="btn btn-primary align-baseline col-4 col-sm-3 col-lg-2 py-0"><span class="fas fa-trash-alt"></span></button>
            </div>
        </div>
            
        <div class="row container-fluid mt-5">
            <div class="col-12 col-md-6 p-0 p-md-2">
                <div class="row m-0">
                    <h2 class="h5 font-weight-light col-12">Add new brand</h2>
                    <input type="text" id="new-brand" class="col-8 col-sm-9 col-lg-10 form-control d-inline max-width-400" />
                    <button type="button" id="new-brand-btn" data-type="brands" class="btn btn-primary align-baseline col-4 col-sm-3 col-lg-2"><span class="fas fa-plus"></span></button>
                </div>
            </div>
            <div class="col-12 col-md-6 p-0 row m-0 mt-2 mt-md-0">
                <h2 class="h5 font-weight-light col-12">Remove brand</h2>
                <select name="brands" id="brands" class="form-control col-8 col-sm-9 col-lg-10"></select>
                <button type="button" id="remove-brand-btn" data-type="brands" class="btn btn-primary align-baseline col-4 col-sm-3 col-lg-2 py-0"><span class="fas fa-trash-alt"></span></button>
            </div>
        </div>

        <div class="row container-fluid mt-5">
            <div class="col-12 col-md-6 p-0 p-md-2">
                <div class="row m-0">
                    <h2 class="h5  font-weight-light col-12">Add new color</h2>
                    <input type="text" id="new-color" class="col-8 col-sm-9 col-lg-10 form-control d-inline max-width-400" />
                    <button type="button" id="new-color-btn" data-type="colors" class="btn btn-primary align-baseline col-4 col-sm-3 col-lg-2"><span class="fas fa-plus"></span></button>
                </div>
            </div>
            <div class="col-12 col-md-6 p-0 row m-0 mt-2 mt-md-0">
                <h2 class="h5 font-weight-light col-12">Remove color</h2>
                <select name="colors" id="colors" class="form-control col-8 col-sm-9 col-lg-10"></select>
                <button type="button" id="remove-color-btn" data-type="colors" class="btn btn-primary align-baseline col-4 col-sm-3 col-lg-2 py-0"><span class="fas fa-trash-alt"></span></button>
            </div>
    </div>

    <h2 class="h5 mt-5 p-4 font-weight-light">Add new product</h2>
    <p><a href="admin-product-edit.php?operation=New" class="ml-4 btn btn-primary">Click here to add</a></p>
    </main>


<?php
    require_once("views/footer.php");
?>