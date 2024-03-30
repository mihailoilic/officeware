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

    if(isset($_GET["operation"])){
        $operation = $_GET["operation"];
    }
    else {
        header("Location: index.php");
        die();
    }
    $categories = selectQuery("categories");
    $brands = selectQuery("brands");
    $colors = selectQuery("colors");
    if($operation == "Edit"){
        $id = $_GET["id"];
        $product = selectQuery("products WHERE product_id = $id")[0];
    }
?>

    <main id="admin-product-edit" class="container position-relative bg-light-trans mx-auto p-5 mb-5">
        <?php
            
            if(isset($_GET["success"])){
                echo '<p class="alert alert-info mt-3 mx-auto">Product successfully added. You can view it <a href="product.php?id='.$_GET["success"].'">here</a>.</p>';
            }
            if(isset($_GET["error"])){
                echo '<p class="alert alert-danger mt-3 mx-auto">'.$_GET["error"].'</p>';
            }


            if($operation == "Edit"):
        ?>
            <a href="product.php?id=<?=$product->product_id?>"><span class="fas fa-chevron-left"></span> Back to product</a>
        <?php
            endif;
        ?>
        <h1 class="text-muted my-5 font-weight-light h3 mx-auto">
            <?=$operation?> Product
        </h1>
        <form method="POST" action="models/insert-data.php" enctype="multipart/form-data">
            <input type="hidden" id="product-operation" name="operation" value="<?=$operation?>"/>
            <input type="hidden" name="type" value="products"/>
            <?php
                if($operation == "Edit"):
            ?>
                <input type="hidden" name="id" value="<?=$id?>" />
            <?php
                endif;
            ?>
            <div class="form-group">
                <label for="product-title" class="font-weight-light">Product title</label>
                <input type="text" data-title="title" class="form-control" id="product-title" name="product-title" value="<?=$operation == "Edit" ? $product->product_title : ""?>"/>
            </div>
            <div class="form-group mt-3">
                <label for="product-description" class="font-weight-light">Product description</label>
                <textarea type="text" data-title="description" class="form-control" id="product-description" name="product-description"><?=$operation == "Edit" ? $product->product_description : ""?></textarea>
            </div>
            <div class="form-group">
                <label for="product-image" class="font-weight-light">Product image</label><br/>
                <input type="file" class="" id="product-image" name="product-image" />
            </div>

            <?php
                echo '<div class="form-group mt-2">
                <h3 class="font-weight-light h6">Product category</h3>
                <select name="category" class="form-control">';
                foreach($categories as $cat){
                    $selected = "";
                    if($operation == "Edit" && $cat->category_id == $product->category_id){
                        $selected = "selected = 'selected'";
                    }
                    echo "<option value='$cat->category_id' $selected>$cat->category_name</option>";
                }
                echo '</select></div>';

                echo '<div class="form-group mt-3">
                <h3 class="font-weight-light h6">Product brand</h3>
                <select name="brand" class="form-control">';
                foreach($brands as $brand){
                    $selected = "";
                    if($operation == "Edit" && $brand->brand_id == $product->brand_id){
                        $selected = "selected = 'selected'";
                    }
                    echo "<option value='$brand->brand_id' $selected>$brand->brand_name</option>";
                }
                echo '</select>';

                echo '<div class="form-group mt-3">
                <h3 class="font-weight-light h6">Product color</h3>
                <select name="color" class="form-control">';
                foreach($colors as $color){
                    $selected = "";
                    if($operation == "Edit" && $color->color_id == $product->color_id){
                        $selected = "selected = 'selected'";
                    }
                    echo "<option value='$color->color_id' $selected>$color->color_name</option>";
                }
                echo '</select>';

            ?>
            <div class="form-group mt-3">
                <label for="product-package" class="font-weight-light">Product package size</label>
                <input type="text" data-title="package size" class="form-control" id="product-package" name="product-package" value="<?=$operation == "Edit" ? $product->package_size : ""?>"/>
            </div>
            <div class="form-group">
                <label for="product-price" class="font-weight-light">Product Price</label>
                <input type="text" data-title="price" class="form-control" id="product-price" name="product-price" placeholder="For example: 19.99" value="<?=$operation == "Edit" ? $product->product_price : ""?>"/>
            </div>
            <button type="sumbit" class="btn btn-primary" id="btn-submit" name="btn-submit">Submit</button>
        </form>
    </main>


<?php
    require_once("views/footer.php");
?>