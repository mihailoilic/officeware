const data = {};
$(document).ready(function(){
    loadMobileMenu();
    pageRelatedFeatures();
});

function ajaxData(url, method, data = {}){
    return new Promise((resolve, reject) => {
        $.ajax({
            url: url,
            method: method,
            dataType: "json",
            data: data,
            success: function(data){
                resolve(data);
            },
            error: function(xhr){
                reject("Error communicating with " + url + ", status: " + xhr.status);
                console.log(xhr);
            }
        });
    });
}

function getNavHeight(){
    let navHeight = parseFloat($("#header").css("height"));
    let adminPanelHeight = 0;
    if($("#admin-panel").length){
        adminPanelHeight = parseFloat($("#admin-panel").css("height")) + 4;
    }
    return navHeight + adminPanelHeight;
}
function loadMobileMenu(){
    $("#menu-button").click(function(){
        $("#responsive-menu-wrapper")
        .css("top",`${getNavHeight()}px`)
        .toggle(300);
    });
}
function loadMainContainerPosition(){
    $("main").css("top",`${getNavHeight() + 100}px`);
    $("footer")
        .css({"top":`${getNavHeight() + 100}px`})
        .removeClass("w-100 border-top")
        .addClass("container mx-auto");
}

function pageRelatedFeatures(){
    if($("main#home").length){
        loadHomePage();
    }
    else if($("main#login").length){
        loadLoginPage();
        loadMainContainerPosition();
    }
    else if($("main#register").length){
        loadRegisterPage();
        loadMainContainerPosition();
    }
    else if($("main#shop").length){
        loadShopPage();
    }
    else if($("main#product").length){
        loadProductPage();
        loadMainContainerPosition();
    }
    else if($("main#cart").length){
        loadCartPage();
        loadMainContainerPosition();
    }
    else if($("main#admin-products").length){
        loadAdminProductsPage();
        loadMainContainerPosition();
    }
    else if($("main#admin-product-edit").length){
        loadAdminEditProductPage();
        loadMainContainerPosition();
    }
    else if($("main#admin-users").length){
        loadAdminUsersPage();
        loadMainContainerPosition();
    }
    else if($("main#account").length){
        loadAccountPage();
        loadMainContainerPosition();
    }
    else if($("main#contact").length){
        loadContactPage();
        loadMainContainerPosition();
    }
    else if($("main#admin-messages").length){
        loadMainContainerPosition();
    }
    else if($("main#poll").length){
        loadPoll();
        loadMainContainerPosition();
    }
    else if($("main#admin-poll").length){
        loadMainContainerPosition();
    }
    else if($("main#author").length){
        loadMainContainerPosition();
    }
}
function loadHomePage(){
    $("#slider").slick({
        "prevArrow": "<a href='#!' class='slick-prev'><span class='fas fa-long-arrow-alt-left'></span></a>",
        "nextArrow": "<a href='#!' class='slick-next'><span class='fas fa-long-arrow-alt-right'></span></a>"
    });

    $(".fake-poll-button").click(function(e){
        e.preventDefault();

        $(".login-notice").remove();
        $(`<p class="login-notice">You must <a href="login.php">login</a> or <a href="register.php">register</a> first.</p>`)
            .hide()
            .insertAfter(this)
            .fadeIn();
    });
}
function loadLoginPage(){
    $("#login-form").submit(function(e){ 
        resetFormErrors();
        let regUsername = /^\w{3,30}$/;
        let regPw = /^(?=.*\p{Uppercase_Letter})(?=.*\p{Lowercase_Letter})(?=.*\d)(?=.{6,})/u;
        
        testFormElement($("#username"), regUsername, 30);
        testFormElement($("#password"), regPw, 50);

        if(data.error){
            e.preventDefault(); 
        }
    });
}
function loadRegisterPage(){
    $("#register-form").submit(function(e){
        resetFormErrors();

        let regFullName = /^\p{Uppercase_Letter}\p{Letter}{1,14}(\s\p{Uppercase_Letter}\p{Letter}{1,14}){1,3}$/u;
        let regEmail = /^[a-z]((\.|-|_)?[a-z0-9]){2,}@[a-z]((\.|-)?[a-z0-9]+){2,}\.[a-z]{2,6}$/i;
        let regUsername = /^\w{3,30}$/;
        let regPw = /^(?=.*\p{Uppercase_Letter})(?=.*\p{Lowercase_Letter})(?=.*\d)(?=.{6,})/u;
        
        if($("#password-repeat").val() != $("#password").val()){
            formError($("#password-repeat"), "Passwords do not match.");
        }
        if(!testFormElement($("#password"), regPw, 50, " Password should be at least 6 characters long and contain at least one uppercase letter, one lowercase letter and one number.")){
            $("#password-repeat").val("");
        }
        testFormElement($("#username"), regUsername, 30, " Username should be at least 3 characters long and contain only letters, numbers and symbol _");
        testFormElement($("#full-name"), regFullName, 50, " All words must begin with a capital letter.");
        testFormElement($("#email"), regEmail, 50, " Use only letters, numbers and symbols @.-_");

        if(data.error){
            e.preventDefault(); 
        }
    });
}
function testFormElement(element, regex, length, message = ""){
    let elementName = $(element).data("title");
    if(!$(element).val()){
        formError($(element), `Please input ${elementName}.`);
        return false;
    }
    else if($(element).val().length > length){
        formError($(element), `Maximum characters for ${elementName}: ${length}`);
        return false;
    }
    else if(!regex.test($(element).val())){
        formError($(element), `Please enter a valid ${elementName}.${message}`);
        return false;
    }
    return true;
}
function resetFormErrors(){
    $(".form-error").remove();
    data.error = false;
}
function formError(element, message){
    $(`<p class="text-danger small form-error">${message}</p>`).insertAfter(element);
    data.error = true;
}

async function loadShopPage(){
    try {
        await loadProductsFilters("categories", "category_id", "category_name");
        await loadProductsFilters("brands", "brand_id", "brand_name");
        await loadProductsFilters("colors", "color_id", "color_name");
        loadProductsGrid();
        $(`#search-products, #sort-products, #paginate-products, #max-price`).change(function(){
            loadProductsGrid();
        });
        $("#clear-filters").click(clearFilters);
    }
    catch(c) {
        $("#products-grid").append(`<p class="ajax-error">Can't fetch products. Please try again later.</p>`);
        console.log(c);
    }
}
async function loadProductsFilters(name, idColumn, nameColumn) {
    data[name] = await ajaxData("models/get-data.php", "get", {"type": name});
    for(item of data[name]){
        $(`#${name}`).append(`<li class="form-check">
            <input class="form-check-input" type="checkbox" id="${name}-${item[idColumn]}" value="${item[idColumn]}"/>
            <label class="form-check-label" for="${name}-${item[idColumn]}">
            ${item[nameColumn]}
            </label>
        </li>`);
    }
    $(`#${name} input`).change(function(){
        loadProductsGrid();
    });
    
}
function clearFilters(){
    $("#categories, #brands, #colors").find("input").prop("checked", false);
    $("#search-products, #max-price").val("");
    loadProductsGrid();
}
async function loadProductsGrid(pageNo = 1){
    filterChangeDetector();
    let maxPrice = checkMaxPriceInput();
    let dataObj = {
        "type": "products",
        "max-price": maxPrice,
        "category": getCheckedFilters("categories"),
        "brand": getCheckedFilters("brands"),
        "color": getCheckedFilters("colors"),
        "search": $("#search-products").val(),
        "order": $("#sort-products").val(),
        "pagination": $("#paginate-products").val(),
        "page": String(pageNo)
    }

    let response = await ajaxData("models/get-data.php", "get", dataObj);
    data.products = response.products;
    let noOfPages = response.pages;
    $("#pagination").html("");

    if(data.products.length){
        let html = "";
        for(product of data.products){
            let price = formatPrice(product.product_price);
            html += `<div class="product-wrapper col-12 col-md-6 col-lg-4 col-xl-3 p-2">
                <a class="product-link" href="product.php?id=${product.product_id}">
                    <div class="product card border-0 rounded-0 text-dark text-center">
                        <img class="card-img" src="assets/img/${product.product_image}" alt="${product.product_title}" />
                        <div class="card-body py-4 px-1">
                            <h3 class="card-title h5 font-weight-light">${product.product_title}</h3>
                            <p class="card-text h5 color-primary">${price}</p>
                        </div>
                    </div>
                </a>
            </div>`;
        }
        $("#products-grid").html(html);
        if(noOfPages > 0) {
            paginateProducts(noOfPages, pageNo);
        }
    }
    else {
        $("#products-grid").html(`<p class="p-3 mt-5 h4 font-weight-light">There are no products for the selected criteria.</p>`);
    }
}
function filterChangeDetector(){
    let change = false;
    if($("#categories, #brands, #colors").find("input:checked").length){
        change = true;
    }
    else if ($("#search-products").val() + $("#max-price").val() != ""){
        change = true;
    }
    if(change){
        $("#clear-filters").show();
    }
    else {
        $("#clear-filters").hide();
    }
}
function checkMaxPriceInput(){
    let maxPriceInput = $("#max-price").val();
    if(isNaN(maxPriceInput)){
        return "";
    }
    else {
        return maxPriceInput;
    }
}
function formatPrice(price){
    return Number(price).toLocaleString("en-US",{style: 'currency', currency: 'USD'});
}
function getCheckedFilters(name){
    let array = [];
    $(`#${name} input:checked`).each(function(){
        array.push($(this).val());
    });
    return array.join(",");
}
function paginateProducts(noOfPages, page){
    for(let i=1; i<=noOfPages; i++){
        $("#pagination").append(`<a href="#!" class="${page == i ? "active" : ""} products-page-link p-2 border">${i}</a>`);
        $(".products-page-link:last").click(function(){
            loadProductsGrid(i);
            $(window).scrollTop($("#shop-image").height()-50);
        });
    }
}

async function loadProductPage(){
    try {
        let response = await ajaxData("models/get-data.php", "get", {"type": "products"});
        data.products = response.products;
        loadProductInfo();
    }
    catch(c) {
        $("#product").append(`<p class="ajax-error">Can't fetch product. Please try again later.</p>`);
        console.log(c);
    }
}
function loadProductInfo(){
    let productId = $("#product-name").data("product-id");
    let product = data.products.find(x => x.product_id == productId);
    let price = formatPrice(product.product_price);
    $("#product-name").text(product.product_title);
    $("#product-image")
        .attr("src", `assets/img/${product.product_image}`)
        .attr("alt", product.product_title);
    $("#product-package").text(product.package_size);
    $("#product-color").text(product.color_name);
    $("#product-description").text(product.product_description);
    $("#product-price").text(price);

    if($("#add-to-cart-fake").length){
        $("#add-to-cart-fake").click(function(){
            $(".login-notice").remove();
            $(`<p class="login-notice">You must <a href="login.php">login</a> or <a href="register.php">register</a> first.</p>`)
                .hide()
                .insertAfter($(this).next())
                .fadeIn();
        });
    }
    else {
        $("#add-to-cart").click(addToCart);
    }
}
async function addToCart(){
    let productId = $("#add-to-cart").data("product-id");
    let productQuantity = $("#add-to-cart-quantity").val();
    try {
        let response = await ajaxData("models/cart-operations.php", "get", {"operation": "add", "id": productId, "quantity":productQuantity});
        $(".success-message").remove();
        $(`<p class="success-message">${response.message}</p>`).hide().insertAfter($(this).next()).fadeIn().delay(1500).fadeOut(500, function(){$(this).remove()});
    }
    catch(c){
        $(".form-error").remove();
        formError($(this).next(), c.message);
        console.log(c);
    }
}
async function loadCartPage(){
    try {
        data.cart = await ajaxData("models/cart-operations.php", "get", {"operation": "get"});
        let response = await ajaxData("models/get-data.php", "get", {"type": "products"});
        data.products = response.products;
        loadCartInfo();
    }
    catch(c) {
        $("#cart").append(`<p class="ajax-error">Can't fetch cart items. Please try again later.</p>`);
        console.log(c);
    }
}
function loadCartInfo(){
    let html = "";
    if(data.cart.length){
        for(item of data.cart){
            let product = data.products.find(x => x.product_id == item.product_id);
            let price = formatPrice(Number(product.product_price)*Number(item.quantity));
            html += `
            <div class="cart-item row m-0 containter-fluid align-items-center">
                <div class="col-4 col-md-2 p-2">
                    <img src="assets/img/${product.product_image}" class="img-fluid" alt="${product.product_title}"/>
                </div>
                <div class="col-8 col-md-5 p-2">
                    ${product.product_title}
                </div>
                <div class="col-7 col-md-3 p-2">
                    <input type="number" class="cart-item-quantity pl-2 pr-0 form-control d-inline-block" min="1" data-product-id="${product.product_id}" value="${item.quantity}" onchange="if (this.value<1) {this.value=1;}"/>
                    <span class="color-primary ml-2 h5">${price}</span>
                </div>
                <div class="col-5 col-md-2 p-2 text-right">
                    <a href="#!" class="cart-item-remove btn btn-primary" data-product-id="${product.product_id}"><span class="fas fa-times"></span> Remove</a>
                </div>
            </div>`;
        }
        $("#cart-items").html(html);
        $(".cart-item-quantity").change(changeCartItemQuantity);
        $(".cart-item-remove").click(function(){
            removeCartItem($(this).data("product-id"));
        });
        insertCartTotal();
    }
    else {
        $("#cart-items").html(`<p class="p-4 my-5">Your cart is empty. Visit our <a href="shop.php">shop</a> to add items.</p>`);
        $("#cart-total").remove();
    }
}
function insertCartTotal(){
    let totalPrice =  0;
    for(item of data.cart){
        let unitPrice = data.products.find(x => x.product_id == item.product_id).product_price;
        totalPrice += (Number(unitPrice) * Number(item.quantity));
    }
    $("#cart-total").remove();
    $(`<div id="cart-total" class="mt-5">
        <div class="m-1 h5 font-weight-light">Total: <span id="cart-total-price" class="color-primary h5">${formatPrice(totalPrice)}</span></div>
        <a href="#!" id="cart-checkout" class="btn btn-primary m-1"><span class="fas fa-shopping-cart"></span> Checkout now</a>
        <a href="#!" id="clear-cart" class="btn btn-primary m-1"><span class="fas fa-times"></span> Remove all</a>
    </div>`).insertAfter($("#cart-items"));

    $("#clear-cart").click(clearCart);
}
async function changeCartItemQuantity(){
    let id = $(this).data("product-id");
    let quantity = $(this).val();

    try {
        await ajaxData("models/cart-operations.php", "get", {"operation":"set", "id": id, "quantity": quantity});
        let unitPrice = data.products.find(x => x.product_id == id).product_price;
        let qtyPrice = formatPrice(Number(unitPrice) * Number(quantity));
        $(this).next().text(`${qtyPrice}`);
        data.cart.find(x => x.product_id == id).quantity = quantity;
        insertCartTotal();
    }
    catch(c){
        $(".form-error").remove();
        formError($(this).next(), "Error changing quantity.");
        console.log(c);
    }

}
async function removeCartItem(id){

    try {
        await ajaxData("models/cart-operations.php", "get", {"operation":"remove", "id": id});
        data.cart = data.cart.filter(x => x.product_id != id);
        loadCartInfo();
    }
    catch(c){
        $(".form-error").remove();
        formError($(this), "Error removing item.");
        console.log(c);
    }

}
async function clearCart(){

    try {
        await ajaxData("models/cart-operations.php", "get", {"operation":"remove-all"});
        data.cart = [];
        loadCartInfo();
    }
    catch(c){
        $(".form-error").remove();
        formError($(this), "Error removing items.");
        console.log(c);
    }

}

function loadAdminProductsPage(){
    loadRemoveDataDDL("brands", "brand");
    loadRemoveDataDDL("categories", "category");
    loadRemoveDataDDL("colors", "color");
    $("#new-category-btn, #new-brand-btn, #new-color-btn").click(insertNewData);
    $("#remove-category-btn, #remove-brand-btn, #remove-color-btn").click(removeData);
}
async function loadRemoveDataDDL(type, nameBase){
    try{
        data[type] = await ajaxData("models/get-data.php", "get", {"type": type});
        $(`#${type}`).html("");
        for(item of data[type]){
            let id = item[nameBase+"_id"];
            let name = item[nameBase+"_name"];
            $(`#${type}`).append(`<option value=${id}>${name}</option>`);
        }
    }
    catch(c){
        $("#admin-products").append(`<p class="ajax-error">Can't fetch data. Try again later.</p>`);
        console.log(c);
    }

}
async function insertNewData(){
    let name = $(this).prev().val();
    if(!/\p{Uppercase_Letter}[\p{Letter}&,\-\d]{1,30}/u.test(name)){
        $(".form-error, .insert-success").remove();
        formError(this, "&nbsp;&nbsp;Name is invalid. It must begin with a capital letter.");
    }
    else {
        let type = $(this).data("type");
        let columnName = $(this).prev().attr("id").split("-")[1]+"_name";
        try {
            let response = await ajaxData("models/insert-data.php", "post", {"type":type, "name": name, "column-name":columnName});
            $(".form-error, .insert-success").remove();
            $(`<p class="insert-success">&nbsp;&nbsp;${response.message}</p>`).insertAfter(this);
            $(this).prev().val("");
            loadRemoveDataDDL(type, columnName.split("_")[0]);
        }
        catch(c){
            $(".form-error, .insert-success").remove();
            formError($(this), "Error inserting item.");
            console.log(c);
        }
    }
}
async function removeData(){
    let id = $(this).prev().val();
    let type = $(this).data("type");
    let columnName = $(this).attr("id").split("-")[1]+"_id";
    console.log(columnName)
    try {
        let response = await ajaxData("models/delete-data.php", "get", {"type":type, "id":id, "column-name":columnName});
        $(".form-error, .insert-success").remove();
        $(`<p class="insert-success float-right pr-5">${response.message}</p>`).insertAfter(this);
        loadRemoveDataDDL(type, columnName.split("_")[0]);
    }
    catch(c){
        $(".form-error, .insert-success").remove();
        formError($(this), "Error removing this item. You must remove all products of this type first.");
        console.log(c);
    }
}
function loadAdminEditProductPage(){
    $("#btn-submit").click(function(e){
        
        resetFormErrors();

        let regexTitle = /^\p{Uppercase_Letter}.{4,99}$/u;
        let regexDescription = /^\p{Uppercase_Letter}.{19,999}$/u;
        let regexPrice = /^\d+\.\d+$/;
        
        testFormElement($("#product-title"), regexTitle, 100, " Title should be between 5 and 100 characters long start with a capital letter.");
        testFormElement($("#product-description"), regexDescription, 1000, " Description should be between 20 and 1000 characters long start with a capital letter.");
        testFormElement($("#product-price"), regexPrice, 100, " Price must be in XX.XX format, use only numbers.");
        testFormElement($("#product-package"), /.{2,20}/, 20);

        let productImage = $("#product-image").val();
        if($("#product-operation").val()=="New" && productImage == ""){
            formError($("#product-image"), "You must provide a product picture when creating a new product.");
        }
        let allowedFormats = ["jpg", "jpeg", "gif", "png", "webp"];
        if(productImage != "" && !allowedFormats.includes(productImage.split(".").pop())){
            formError($("#product-image"), "Allowed formats for images are jpg, jpeg, gif, webp, png.");
        }

        if(data.error){
            e.preventDefault();
        }

    });
}

function loadAdminUsersPage(){
    showAdminUserPanel();
    $("#search-users").on("keyup", insertUserData);
}
async function showAdminUserPanel(){
    try {
        data.users = await ajaxData("models/get-data.php", "get", {"type": "users"});
        insertUserData();

        $(".show-change-pw").click(function(){
            let id = $(this).data("id");
            $(`.change-pw-container[data-id=${id}]`).stop().toggle(200);
            $(this).toggleClass("active");
        });
        $(".show-remove-user").click(function(){
            let id = $(this).data("id");
            $(`.remove-user-container[data-id=${id}]`).stop().toggle(200);
            $(this).toggleClass("active");
        });
    
        $(".change-pw").click(adminChangeUserPassword);
        $(".remove-user").click(removeUser);
    }
    catch(c){
        $("#admin-users").append(`<p class="ajax-error">Can't fetch users. Try again later.</p>`);
        console.log(c);
    }

}

function insertUserData(){
    let search = $("#search-users").val();
    let filteredUsers = data.users;
    
    if(search != ""){
        filteredUsers = data.users.filter(x => x.username.includes(search) || x.email.includes(search));
    }

    let html="";
    if(filteredUsers.length){
        for(user of filteredUsers){
            html += `
                <div class="user-info row m-0 py-3 align-items-center">
                    <div class="col-1 user-id">${user.user_id}</div>
                    <div class="col-2 username">${user.username}</div>
                    <div class="col-3 user-email">${user.email}</div>
                    <div class="col-2 user-full-name">${user.full_name}</div>
                    <div class="col-2 user-date-created">${user.date_created}</div>
                    <div class="col-2 text-right">
                        <a href="#!" class="show-change-pw btn btn-primary" data-id="${user.user_id}" class="btn btn-primary"><span class="fas fa-key"></span></a>
                        <a href="#!" class="show-remove-user btn btn-primary" data-id="${user.user_id}" class="btn btn-primary"><span class="fas fa-trash"></span></a>
                    </div>
                    <div class="change-pw-container col-12 m-2 text-right" data-id="${user.user_id}">
                        <input type="password" placeholder="New password" class="form-control  d-inline w-25" data-title="password"/>
                        <a href="#!" class="change-pw btn btn-primary align-baseline" data-id="${user.user_id}">Change</a>
                    </div>
                    <div class="remove-user-container col-12 m-2 text-right" data-id="${user.user_id}">
                        Are you sure you want to remove this user?
                        <a href="#!" class="remove-user btn btn-primary" data-id="${user.user_id}">Remove</a>
                    </div>
                </div>`;
        }
    }
    else {
        html+= `<p class="m-4 font-weight-light h5">No users found.</p>`;
    }
    $("#users").html(html);
}

async function adminChangeUserPassword(){
    resetFormErrors();
    $(".form-success").remove();

    let id = $(this).data("id");
    let newPw = $(this).prev().val();

    let regPw = /^(?=.*\p{Uppercase_Letter})(?=.*\p{Lowercase_Letter})(?=.*\d)(?=.{6,50})/u;
    if(!regPw.test(newPw)){
        formError(this, "Password must be between 6 and 50 characters and contain 1 uppercase, 1 lowercase letter and 1 number.");
    }
    else{
        try{
            let response = await ajaxData("models/admin-change-pw.php", "post", {"role":"Administrator", "id":id, "new-pw":newPw});
            $(`<p class="form-success">${response.message}</p>`).hide().insertAfter(this).show(300);
            $(this).prev().val("");

        }
        catch(c){
            $(".form-error").remove();
            formError($(this), "Error changing password. Try again later.");
            console.log(c);
        }

    }

}
async function removeUser(){
    
    let id = $(this).data("id");

    try{
        let response = await ajaxData("models/delete-data.php", "get", {"type":"users", "id":id});
        $(this).parent().parent().remove();
        data.users = data.users.filter(x => x.user_id != id);
    }
    catch(c){
        $(".form-error").remove();
        formError($(this), "Error removing user. Try again later.");
        console.log(c);
    }

}

function loadAccountPage(){
    $("#btn-change-pw").click(userChangePassword);
}
function userChangePassword(e){
    resetFormErrors();
    data.error = false;

    let regPw = /^(?=.*\p{Uppercase_Letter})(?=.*\p{Lowercase_Letter})(?=.*\d)(?=.{6,50})/u;

    testFormElement($("#old-pw"), /./, 50);
    testFormElement($("#new-pw"), regPw, 50, " Password should be at least 6 characters long and contain at least one uppercase letter, one lowercase letter and one number.");
    if($("#new-pw").val() != $("#confirm-pw").val()){
        formError($("#confirm-pw"), "Passwords don't match.");
    }

    if(data.error){
        e.preventDefault();
    }
}

function loadContactPage(){
    $("#btn-send").click(validateContactForm);
}
function validateContactForm(e){
    resetFormErrors();
    data.error=false;

    let regName = /^\p{Uppercase_Letter}\p{Letter}{1,14}(\s\p{Uppercase_Letter}\p{Letter}{1,14}){0,3}$/u;
    let regEmail = /^[a-z]((\.|-|_)?[a-z0-9]){2,}@[a-z]((\.|-)?[a-z0-9]+){2,}\.[a-z]{2,6}$/i;

    testFormElement($("#name"), regName, 50, " All words must begin with a capital letter.");
    testFormElement($("#email"), regEmail, 50, " Use only letters, numbers and symbols @.-_");
    testFormElement($("#message"), /^.{20,1000}$/, 1000, " Message should be at least 20 characters long.");

    if(data.error){
        e.preventDefault();
    }

}

function loadPoll(){
    $("#btn-vote").click(function(e){
        resetFormErrors();
        if($("#poll input:radio:checked").length == 0){
            formError(this, "You must choose an answer.");
            e.preventDefault();
        }
    });
}