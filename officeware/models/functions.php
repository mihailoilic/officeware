<?php
    //BAZA
    function selectQuery($from, $custom = false){
        global $konekcija;
        if($custom){
            $query = $konekcija->query($from);
        }
        else {
            $query = $konekcija->query("SELECT * FROM $from");
        }
        return $query->fetchAll();
    }

    //NAVIGACIJA
    function getNavigationLinks(){
        $navLinks = selectQuery("navigation");
        $navLinksString = "";
        foreach($navLinks as $link){
            $active = strpos($_SERVER["PHP_SELF"], $link->href) ? "active" : "";
            $navLinksString .= "<li class='m-2'>
            <a class='$active' href='$link->href'>$link->title</a>
            </li>";
        }
        return $navLinksString;
    }
    function getAdminPanelLinks(){
        $adminPanelLinks = selectQuery("admin_panel");
        $adminPanelLinksString = "";
        foreach($adminPanelLinks as $link){
            $adminPanelLinksString .= "<span class='mr-3 d-inline-block'>
            <a class='color-primary' href='$link->href'><span class='fas fa-tools'></span> $link->title</a>
        </span>";
        }
        return $adminPanelLinksString;
    }

    //HOME
    function getSliderImages(){
        $sliderImages = selectQuery("slider");
        $sliderHTML = "";
        foreach($sliderImages as $image){
            $sliderHTML .= "<div>
            <img src='assets/img/$image->filename' class='w-100' alt='$image->title'/>
            </div>";
        }
        return $sliderHTML;
    }

    //SHOP
    function getProducts($category, $brand, $color, $search, $max_price, $order){

            $where = "";

            if(!empty($category)){
                $queryString = "c.category_id IN ($category)";
                if(!empty($where)){
                    $where .= " AND $queryString";
                }
                else {
                    $where .= "WHERE $queryString";
                }
            }
            if(!empty($brand)){
                $queryString = "b.brand_id IN ($brand)";
                if(!empty($where)){
                    $where .= " AND $queryString";
                }
                else {
                    $where .= "WHERE $queryString";
                }
            }
            if(!empty($color)){
                $queryString = "cls.color_id IN ($color)";
                if(!empty($where)){
                    $where .= " AND $queryString";
                }
                else {
                    $where .= "WHERE $queryString";
                }
            }
            if(!empty($search)){
                $queryString = "LOWER(product_title) LIKE '%$search%'";
                if(!empty($where)){
                    $where .= " AND $queryString";
                }
                else {
                    $where .= "WHERE $queryString";
                }
            }
            if(!empty($max_price)){
                $queryString = "product_price < $max_price";
                if(!empty($where)){
                    $where .= " AND $queryString";
                }
                else {
                    $where .= "WHERE $queryString";
                }
            }
            if(!empty($order)){
                $where .= " ORDER BY $order";
            }

            return selectQuery("products p JOIN categories c ON c.category_id = p.category_id JOIN brands b ON b.brand_id = p.brand_id JOIN colors cls ON cls.color_id = p.color_id $where");
            
    }
    function getProductsPage($products, $pagination, $page){
        $productsOnPage = array_slice($products, $pagination * ($page - 1), $pagination);
        return $productsOnPage;
    }

    //USER
    function changePassword($id, $new){
        global $konekcija;
        $updateQuery = $konekcija->prepare("UPDATE users SET password = :pw WHERE user_id = :id AND role_id <> 2");
        $updateQuery->bindParam(":pw", $new);
        $updateQuery->bindParam(":id", $id);
        return $updateQuery->execute();
    }

    //POLL
    function checkParticipation($id){
        $existing = selectQuery("poll_answers WHERE user_id = $id");
        if(Count($existing) > 0){
            return true;
        }
        else {
            return false;
        }
    }
?>