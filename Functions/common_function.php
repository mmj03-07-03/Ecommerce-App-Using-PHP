<?php
    // Including connect.php in includes folder to access the connection variable $con.
    include('./includes/connect.php');

    // Function for getting limited products from database 
    function getProducts() {
        // We are saying that use the Global variable $con otherwise it will give error as this function does not have any local var $con.
        global $con;

        // If any brand and category is not clicked then all the products are shown. 
        if(!isset($_GET['brand']) and !isset($_GET['category'])) {
            $query_to_select_all_products = "select * from `products` order by rand() LIMIT 0,9";
            $query_result = mysqli_query($con, $query_to_select_all_products);

            while($table_row = mysqli_fetch_assoc($query_result)) {
                $product_id = $table_row['product_id'];
                $product_title = $table_row['product_title'];
                $product_description = $table_row['product_description'];
                $category_id = $table_row['category_id'];
                $brand_id = $table_row['brand_id'];
                $product_image = $table_row['product_image1'];
                $product_price = $table_row['product_price'];

                echo "
                    <div class='product_1 col-md-4 mb-4'>
                        <div class='card h-100'>
                            <img src='./ADMIN/Images/$product_image' class='card-img-top my-2' alt='$product_title'>
                            <div class='card-body d-flex flex-column'> 
                                <h5 class='card-title mt-2'>$product_title</h5>
                                <p class='card-text mb-auto'>$product_description</p>
                                <p class='card-text mt-3 fw-bold'>&#8377; $product_price</p>
                                <div class='buttons mt-2'>
                                    <a href='index.php?add_to_cart=$product_id' class='btn btn-primary'>Add to Cart</a>
                                    <a href='product_details.php?product_id=${product_id}' class='btn btn-dark px-3'>View More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                ";
            }
        }
    }

    // Function for getting all the products from database 
    function getAllProducts() {
        // We are saying that use the Global variable $con otherwise it will give error as this function does not have any local var $con.
        global $con;

        // If any brand and category is not clicked then all the products are shown. 
        if(!isset($_GET['brand']) and !isset($_GET['category'])) {
            $query_to_select_all_products = "select * from `products` order by rand()";
            $query_result = mysqli_query($con, $query_to_select_all_products);

            while($table_row = mysqli_fetch_assoc($query_result)) {
                $product_id = $table_row['product_id'];
                $product_title = $table_row['product_title'];
                $product_description = $table_row['product_description'];
                $category_id = $table_row['category_id'];
                $brand_id = $table_row['brand_id'];
                $product_image = $table_row['product_image1'];
                $product_price = $table_row['product_price'];

                echo "
                    <div class='product_1 col-md-4 mb-4'>
                        <div class='card h-100'>
                            <img src='./ADMIN/Images/$product_image' class='card-img-top my-2' alt='$product_title'>
                            <div class='card-body d-flex flex-column'> 
                                <h5 class='card-title mt-2'>$product_title</h5>
                                <p class='card-text mb-auto'>$product_description</p>
                                <p class='card-text mt-3 fw-bold'>&#8377; $product_price</p>
                                <div class='buttons mt-2'>
                                    <a href='index.php?add_to_cart=$product_id' class='btn btn-primary'>Add to Cart</a>
                                    <a href='product_details.php?product_id=${product_id}' class='btn btn-dark px-3'>View More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                ";
            }
        }
    }

    // Function for getting specific brand or category products from database 
    function getUniqueProducts() {
        // We are saying that use the Global variable $con otherwise it will give error as this function does not have any local var $con.
        global $con;

        // If any brand is clicked then that brands products are shown.
        if(isset($_GET['brand'])) {
            $product_brand_id = $_GET['brand']; 
            $query_to_select_all_products = "select * from `products` where brand_id = $product_brand_id";
            $query_result = mysqli_query($con, $query_to_select_all_products);
            $number_of_rows = mysqli_num_rows($query_result);

            // If number of rows == 0 which means there are no products available of that brand
            if($number_of_rows == 0) {
                echo "<h2 class='products_not_available text-center text-danger'>Sorry! Products are not available.</h2>";
            }

            while($table_row = mysqli_fetch_assoc($query_result)) {
                $product_id = $table_row['product_id'];
                $product_title = $table_row['product_title'];
                $product_description = $table_row['product_description'];
                $category_id = $table_row['category_id'];
                $brand_id = $table_row['brand_id'];
                $product_image = $table_row['product_image1'];
                $product_price = $table_row['product_price'];

                echo "
                    <div class='product_1 col-md-4 mb-4'>
                        <div class='card h-100'>
                            <img src='./ADMIN/Images/$product_image' class='card-img-top my-2' alt='$product_title'>
                            <div class='card-body d-flex flex-column'> 
                                <h5 class='card-title mt-2'>$product_title</h5>
                                <p class='card-text mb-auto'>$product_description</p>
                                <p class='card-text mt-3 fw-bold'>&#8377; $product_price</p>
                                <div class='buttons mt-2'>
                                    <a href='index.php?add_to_cart=$product_id' class='btn btn-primary'>Add to Cart</a>
                                    <a href='product_details.php?product_id=${product_id}' class='btn btn-dark px-3'>View More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                ";
            }
        }

        // If any category is clicked then that categories products are shown.
        if(isset($_GET['category'])) {
            $product_category_id = $_GET['category']; 
            $query_to_select_all_products = "select * from `products` where category_id = $product_category_id";
            $query_result = mysqli_query($con, $query_to_select_all_products);
            $number_of_rows = mysqli_num_rows($query_result);

            // If number of rows == 0 which means there are no products available of that category
            if($number_of_rows == 0) {
                echo "<h2 class='products_not_available text-center text-danger'>Sorry! Products are not available.</h2>";
            }

            while($table_row = mysqli_fetch_assoc($query_result)) {
                $product_id = $table_row['product_id'];
                $product_title = $table_row['product_title'];
                $product_description = $table_row['product_description'];
                $category_id = $table_row['category_id'];
                $brand_id = $table_row['brand_id'];
                $product_image = $table_row['product_image1'];
                $product_price = $table_row['product_price'];

                echo "
                    <div class='product_1 col-md-4 mb-4'>
                        <div class='card h-100'>
                            <img src='./ADMIN/Images/$product_image' class='card-img-top my-2' alt='$product_title'>
                            <div class='card-body d-flex flex-column'> 
                                <h5 class='card-title mt-2'>$product_title</h5>
                                <p class='card-text mb-auto'>$product_description</p>
                                <p class='card-text mt-3 fw-bold'>&#8377; $product_price</p>
                                <div class='buttons mt-2'>
                                    <a href='index.php?add_to_cart=$product_id' class='btn btn-primary'>Add to Cart</a>
                                    <a href='product_details.php?product_id=${product_id}' class='btn btn-dark px-3'>View More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                ";
            }
        }
    }

    // Function for getting all the brands from database 
    function getAllBrands() {
        // We are saying that use the Global variable $con otherwise it will give error as this function does not have any local var $con.
        global $con;

        // Query to get data from brands table
        $select_brands_query = "Select * from `brands`";

        // Result of the above query => it contains both the columns of the brands table.
        $query_result = mysqli_query($con, $select_brands_query);

        // Here mysqli_fetch_assoc($query_result) gives the value of next row starting from row number 2.
        // Here mysqli_fetch_assoc($query_result) will return row value till it reaches last row of table and then it will have null value and will terminate the loop. 
        while($result_data = mysqli_fetch_assoc($query_result)) {
            // Accessing the brand title from $result_data which contains row value.
            $brand_title = $result_data['brand_title'];

            // Accessing the brand id from $result_data which contains row value.
            $brand_id = $result_data['brand_id'];
            
            // Inserting into the DOM the brand title.
            echo "
                <li class='nav-item'>
                    <a class='nav-link text-light fs-5' href='index.php?brand=$brand_id'>$brand_title</a>
                </li>
            ";
        }
    } 

    // Function for getting all the categories from database 
    function getAllCategories() {
        // We are saying that use the Global variable $con otherwise it will give error as this function does not have any local var $con.
        global $con;

        // Query to get data from categories table
        $select_categories_query = "select * from `categories`";

        // Result of the above query => it contains both the columns of the categories table.
        $query_result = mysqli_query($con, $select_categories_query);

        // Here mysqli_fetch_assoc($query_result) gives the value of next row starting from row number 2.
        // Here mysqli_fetch_assoc($query_result) will return row value till it reaches last row of table and then it will have null value and will terminate the loop. 
        while($result_data = mysqli_fetch_assoc($query_result)) {
            // Accessing the category title from $result_data which contains row value.
            $category_title = $result_data['category_title'];

            // Accessing the category id from $result_data which contains row value.
            $category_id = $result_data['category_id'];

            // Inserting into the DOM the category title.
            echo "
                <li class='nav-item'>
                    <a class='nav-link text-light fs-5' href='?category=$category_id'>$category_title</a>
                </li>
            ";
        }
    } 

    // Function for getting all the products from database that matches the searched query 
    function search_product() {
        // We are saying that use the Global variable $con otherwise it will give error as this function does not have any local var $con.
        global $con;

        if(isset($_GET['search_data_product'])) {
            $search_data = $_GET['search_data'];
            $search_query = "select * from `products` where product_keywords like '%$search_data%'";
            $query_result = mysqli_query($con, $search_query);
            $number_of_rows = mysqli_num_rows($query_result);

            // If number of rows == 0 which means there are no products available of that brand
            if($number_of_rows == 0) {
                echo "<h2 class='products_not_available text-center text-danger'>Sorry! No Result Found.</h2>";
            }

            while($table_row = mysqli_fetch_assoc($query_result)) {
                $product_id = $table_row['product_id'];
                $product_title = $table_row['product_title'];
                $product_description = $table_row['product_description'];
                $category_id = $table_row['category_id'];
                $brand_id = $table_row['brand_id'];
                $product_image = $table_row['product_image1'];
                $product_price = $table_row['product_price'];

                echo "
                    <div class='product_1 col-md-4 mb-4'>
                        <div class='card h-100'>
                            <img src='./ADMIN/Images/$product_image' class='card-img-top my-2' alt='$product_title'>
                            <div class='card-body d-flex flex-column'> 
                                <h5 class='card-title mt-2'>$product_title</h5>
                                <p class='card-text mb-auto'>$product_description</p>
                                <p class='card-text mt-3 fw-bold'>&#8377; $product_price</p>
                                <div class='buttons mt-2'>
                                    <a href='index.php?add_to_cart=$product_id' class='btn btn-primary'>Add to Cart</a>
                                    <a href='product_details.php?product_id=${product_id}' class='btn btn-dark px-3'>View More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                ";
            }
        }
    }
    
    // Function for getting the product from database for which the user has clicked on view more button 
    function viewMore() {
        // We are saying that use the Global variable $con otherwise it will give error as this function does not have any local var $con.
        global $con;

        // If any brand and category is not clicked then all the products are shown. 
        if(isset($_GET['product_id'])) {
            $product_id = $_GET['product_id'];
            $query_to_select_all_products = "select * from `products` where product_id = $product_id";
            $query_result = mysqli_query($con, $query_to_select_all_products);

            while($table_row = mysqli_fetch_assoc($query_result)) {
                $product_id = $table_row['product_id'];
                $product_title = $table_row['product_title'];
                $product_description = $table_row['product_description'];
                $category_id = $table_row['category_id'];
                $brand_id = $table_row['brand_id'];
                $product_image1 = $table_row['product_image1'];
                $product_image2 = $table_row['product_image2'];
                $product_image3 = $table_row['product_image3'];
                $product_price = $table_row['product_price'];

                echo "
                    <div class='product_carousel m-auto'>
                        <div id='carouselExample' class='carousel slide'>
                            <button class='carousel-control-prev prev' type='button' data-bs-target='#carouselExample' data-bs-slide='prev'>
                                <span class='carousel-control-prev-icon product_prev_btn' aria-hidden='true'></span>
                                <span class='visually-hidden'>Previous</span>
                            </button>
                            <div class='carousel-inner'>
                                <div class='carousel-item active'>
                                    <img src='./ADMIN/Images/$product_image1' class='carousel_image d-block w-100' alt='$product_title'>
                                </div>
                                <div class='carousel-item'>
                                    <img src='./ADMIN/Images/$product_image2' class='carousel_image d-block w-100' alt='$product_title'>
                                </div>
                                <div class='carousel-item'>
                                    <img src='./ADMIN/Images/$product_image3' class='carousel_image d-block w-100' alt='$product_title'>
                                </div>
                            </div>
                            <button class='carousel-control-next next' type='button' data-bs-target='#carouselExample' data-bs-slide='next'>
                                <span class='carousel-control-next-icon product_next_btn' aria-hidden='true'></span>
                                <span class='visually-hidden'>Next</span>
                            </button>
                        </div>
                    </div>
                    <div class='product_details d-flex flex-column align-items-center mt-2 mb-4 text-center'>
                        <h2 class='my-4 fs-1'>$product_title</h2>
                        <p class='mt-4 mb-2 fs-4'>About this product</p>
                        <p class='product_description fs-5 w-75 mb-4'>$product_description</p>
                        <p class='fs-3'>Price:  &#8377; $product_price</p>
                    </div>
                    <div class='buttons mt-2 d-flex justify-content-center column-gap-5 my-4'>
                        <a href='index.php?add_to_cart=$product_id' class='btn btn-primary fs-5'>Add to Cart</a>
                        <a href='./display_all_products.php' class='btn btn-dark px-3 fs-5'>Continue Shopping</a>
                    </div>
                ";
            }
        }
    }

    // Function to store Cart details in Database
    function cart() {
        // We are saying that use the Global variable $con otherwise it will give error as this function does not have any local var $con.
        global $con;

        // If Add to Cart button is clicked then this block is executed. 
        if(isset($_GET['add_to_cart'])) {
            $product_id = $_GET['add_to_cart'];
            $ip_address = getIPAddress();
            $quantity = 0;

            $select_query = "select * from `cart_details` where ip_address = '$ip_address' and product_id = $product_id";
            $select_query_result = mysqli_query($con, $select_query);
            $number_of_rows = mysqli_fetch_assoc($select_query_result);

            if($number_of_rows > 0) {
                echo "
                    <script>
                        alert('Product already Added in the Cart!');
                    </script>
                ";
            }
            else {
                $insert_query = "insert into `cart_details` (product_id, ip_address, quantity) values ($product_id, '$ip_address', $quantity)";
                $insert_query_result = mysqli_query($con, $insert_query);
                if($insert_query_result) {
                    echo "
                        <script>
                            alert('Product added Successfully in the Cart.');
                        </script>
                    ";
                }
            }
            echo "
                <script>
                    window.open('index.php', '_self');
                </script>
            ";
        }
    }

    // Function to get number of Items in the Cart from Database
    function getNumberOfCartItems() {
        // We are saying that use the Global variable $con otherwise it will give error as this function does not have any local var $con.
        global $con;

        $ip_address = getIPAddress();

        $select_query = "select * from `cart_details` where ip_address = '$ip_address'";
        $select_query_result = mysqli_query($con, $select_query);
        $number_of_cart_items = mysqli_num_rows($select_query_result);
        
        echo $number_of_cart_items;
    }

    // Function to get the IP address of the User. 
    function getIPAddress() {  
        //whether ip is from the share internet  
        if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
            $ip = $_SERVER['HTTP_CLIENT_IP'];  
        }  
        //whether ip is from the proxy  
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
        }  
        //whether ip is from the remote address  
        else{  
            $ip = $_SERVER['REMOTE_ADDR'];  
        }  
        return $ip;  
    }  

    // Function to get the price of all the items and calculate the total price
    function getTotalCartPrice() {
        // We are saying that use the Global variable $con otherwise it will give error as this function does not have any local var $con.
        global $con;

        $ip_address = getIPAddress();
        $total_price = 0;

        $select_query = "select * from `cart_details` where ip_address = '$ip_address'";
        $select_query_result = mysqli_query($con, $select_query);

        while($table_row = mysqli_fetch_array($select_query_result)) {
            $product_id = $table_row['product_id'];
            $product_query = "select * from `products` where product_id = '$product_id'";
            $product_query_result = mysqli_query($con, $product_query);

            $table_row = mysqli_fetch_assoc($product_query_result);
            $product_price = $table_row['product_price'];
            $total_price += $product_price;
        }
        echo $total_price;
    }
?>