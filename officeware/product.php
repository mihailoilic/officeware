<?php 
    if(!isset($_GET["id"])){
        header("Location: index.php");
        die();
    }
    require_once("config/connection.php");
    require_once("models/session.php");
    require_once("models/functions.php");
    require_once("views/head.php");
    require_once("views/nav.php");
?>

    <main id="product" class="container position-relative bg-light-trans mx-auto p-5 mb-5">
        <a href="shop.php" class="m-2 d-inline-block"><span class="fas fa-chevron-left"></span> Back to shop</a>
        <?php
            if($userObj && $userObj->role_name == "Administrator"):
        ?>
            <a href="models/delete-data.php?type=products&id=<?=$_GET["id"]?>" class="btn btn-primary text-right float-right ml-2"><span class="fas fa-times"></span> Remove</a>
            
            <a href="admin-product-edit.php?operation=Edit&id=<?=$_GET["id"]?>" class="btn btn-primary text-right float-right"><span class="fas fa-tools"></span> Edit</a>
        <?php
            endif;
        ?>
        <h1 id="product-name" data-product-id=<?=$_GET["id"]?> class="text-muted my-5 font-weight-light h3 mx-auto">
        </h1>
        <div id="product-wrapper" class="row container-fluid">
            <div class="col12 col-md-6">
                <img src="assets/img/logo.png" alt = "Product Image" id="product-image" class="img-fluid" />
            </div>
            <div class="col12 col-md-6 mt-3">
                <p>
                    <span class="font-weight-bold">Package: </span>
                    <span id="product-package"></span>
                </p>
                <p>
                    <span class="font-weight-bold">Color: </span>
                    <span id="product-color"></span>
                </p>
                <p id="product-description"></p>
                <p class="color-primary h4" id="product-price"><p>
                <div>
                    <?php
                        $fake_cart = "-fake";
                        if($userObj){
                            $fake_cart = "";
                        }
                    ?>
                    <a href="#!" id="add-to-cart<?=$fake_cart?>" data-product-id=<?=$_GET["id"]?> class="btn btn-primary align-top">Add to cart</a>
                    <input type="number" id="add-to-cart-quantity" class="pl-2 pr-0 form-control d-inline-block" value="1" min="1", max="99" onchange="if (this.value<1) {this.value=1;} if(this.value>99){this.value=99;}"/>
                </div>
            </div>
        </div>
        
        
    </main>

<?php
    require_once("views/footer.php");
?>