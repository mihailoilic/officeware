<?php 
    require_once("config/connection.php");
    require_once("models/session.php");
    require_once("models/functions.php");
    require_once("views/head.php");
    require_once("views/nav.php");
?>
    <main id="shop" class="container-fluid position-relative bg-light-trans mx-auto p-0">
        <section id="shop-image" class="page-image w-100 d-flex flex-column justify-content-center align-items-center">
            <h1 class="d-inline">Shop</h1>
            <h2 class="d-inline mt-1 h5">Find everything you need right here!</h2>
        </section>
        <?php
            if(isset($_GET["error"])){
                echo "<p class='alert alert-danger mt-4 container mx-auto mb-0'>".$_GET["error"]."</p>";
            }
        ?>
        <section id="products-wrapper" class="row mx-auto mt-5 py-4">
            <div id="products-filters" class="col-12 col-sm-5 col-md-4 col-lg-4 col-xl-2 m-0">
                <div class="form-group">
                    <label for="max-price" class="font-weight-light h5">Max. price ($):</label>
                    <input type="text" id="max-price" class="form-control" placeholder="For example: 15"/>
                </div>                
                <div>
                    <a href="#!" id="clear-filters"><span class="fas fa-times"></span> Clear all filters</a>&nbsp;
                </div>
                <div class="my-5">
                    <h3 class="h5 font-weight-light">Categories: </h3>
                    <ul id="categories">
                        
                    </ul>
                </div>
                <div class="my-5">
                    <h3 class="h5 font-weight-light">Brands: </h3>
                    <ul id="brands">
                    </ul>
                </div>
                <div class="my-5">
                    <h3 class="h5 font-weight-light">Colors: </h3>
                    <ul id="colors">
                    </ul>
                </div>
            </div>
            <div id="products-panel" class="col-12 col-sm-7 col-md-8 col-lg-8 col-xl-10 m-0">
                <div id="products-grid-options" class="row justify-content-between">
                    <div class="col-12 col-sm-12 col-xl-5 my-2 m-md-none">
                        <span><span class="fas fa-search"></span> Search products:</span>
                        <div class="row m-0">
                            <input type="text" class="form-control col-10" value="" id="search-products" placeholder="Enter keywords here"/>
                            <a href="#!" id="search-products-btn" class="col-2 btn btn-primary"><span class="fas fa-search"></span></a>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-xl-4 my-2 m-md-none">
                        <span><span class="fas fa-sort"></span> Sort by:</span>
                        <select class="form-control" id="sort-products">
                            <option value="product_price asc">Price ascending</option>
                            <option value="product_price desc">Price descending</option>
                            <option value="product_title asc">Name ascending</option>
                            <option value="product_title desc">Name descending</option>
                          </select>
                    </div>
                    <div class="col-12 col-sm-6 col-xl-3 my-2 m-md-none">
                        <span><span class="fas fa-layer-group"></span> Pagination:</span>
                        <select class="form-control" id="paginate-products">
                            <option value="0">None</option>
                            <option value="12" selected="selected">12 products per page</option>
                            <option value="24">24 products per page</option>
                          </select>
                    </div>
                </div>
                <div id="products-grid" class="row m-0 mt-4">
                </div>
                <div id="pagination" class="mt-5 text-center">
                </div>
            </div>
            
        </section>
    </main>

<?php
    require_once("views/footer.php");
?>
