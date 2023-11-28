<?php
include('./connect.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/*
//get categories
function get_category(){
    global $conn;
    if (!isset($_GET['category'])) {
        if(!isset($_GET['brand'])){
            $sql="select * from products order by rand() limit 0,9";
            $result=mysqli_query($conn,$sql);
        while ($row=mysqli_fetch_assoc($result)) {
          $product_name=$row['product_name'];
          $price=$row['price'];
          $description=$row['description'];
          $product_category=$row['category_id'];
          $product_brand=$row['brand_id'];
          $product_image1=$row['image1'];
          $product_image2=$row['image2'];
          echo '<div class="card col-md-4 mb-" style="width: 18rem;">
          <img src="./admin/product_images/' . $product_image1 . '" class="card-img-top" alt="...">
          <div class="card-body">
                  <h5 class="card-title">' . $product_name . '</h5>
                  <p class="card-text">' . $price . '</p>
                  <p class="card-text">' . $description . '</p>
                  <p class="card-text">' . $product_category . '</p>
              </div>
          </div>';
        }

        }
      
    }

   
} */
//get unique categories
function get_unique_category(){
    global $conn;
    if (isset($_GET['category'])) {
        $category_id = $_GET['category']; // Corrected variable name
        
        $sql = "SELECT * FROM products WHERE category_id = $category_id";
        $result = mysqli_query($conn, $sql);
        $num_rows=mysqli_num_rows($result);
        if ($num_rows===0) {
            echo "<h2 class='text-center text-danger'>No stock for this category </h2>";
        }
        
        while ($row = mysqli_fetch_assoc($result)) {
            $product_name = $row['product_name'];
            $price = $row['price'];
            $description = $row['description'];
            $product_category = $row['category_id'];
            $product_brand = $row['brand_id'];
            $product_image1 = $row['image1'];
            $product_image2 = $row['image2'];
            
            echo '<div class="card col-md-4 mb-" style="width: 18rem;">
                <img src="./admin/product_images/' . $product_image1 . '" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">' . $product_name . '</h5>
                    <p class="card-text">' . $price . '</p>
                    <p class="card-text">' . $description . '</p>
                    <p class="card-text">' . $product_category . '</p>

                    
                </div>
            </div>';
        }
    }
}

//get products
function getProducts() {
    global $conn;
    if (!isset($_GET['category'])) {
        if (!isset($_GET['brand'])) {
            $sql = "select * from products order by rand() limit 0,8";
            $result = mysqli_query($conn, $sql);
            
            // Start the row container
            echo '<div class="row">';
            
            while ($row = mysqli_fetch_assoc($result)) {
                $product_id = $row['product_id']; // Add product_id
                $product_name = $row['product_name'];
                $price = $row['price'];
                $description = $row['description'];
                $product_category = $row['category_id'];
                $product_brand = $row['brand_id'];
                $product_image1 = $row['image1'];
                $product_image2 = $row['image2'];

                // Product card
                // Product card
echo '<div class="col-md-4 my-4 mx-0"> <!-- Use my-2 instead of my-0 -->
<div class="card" style="width: 18rem;">
    <div class="card-image-container" style="height: 200px; overflow: hidden;">
        <img src="./admin/product_images/' . $product_image1 . '" class="card-img-top img-fluid" alt="...">
    </div>
    <div class="card-body">
        <h5 class="card-title">' . $product_name . '</h5>
        <p class="card-text"> Ksh ' . $price . '</p>
        <a class="btn btn-info" href="index.php?add_to_cart=' . $product_id . '">Add to cart</a>
        <a class="btn btn-secondary view-more-link" href="viewmore.php?viewmore=' . $product_id . '">View More</a>
    </div>
</div>
</div>';

            }
            
            // End the row container
            echo '</div>';
        }
    }
}

//get all products
function getAllProducts() {
    global $conn;
    if (!isset($_GET['category'])) {
        if (!isset($_GET['brand'])) {
            $sql = "select * from products order by rand() ";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $product_id = $row['product_id'];
                $product_name = $row['product_name'];
                $price = $row['price'];
                $description = $row['description'];
                $product_category = $row['category_id'];
                $product_brand = $row['brand_id'];
                $product_image1 = $row['image1'];
                $product_image2 = $row['image2'];

                echo '<div class="col-md-4 my-4 mx-0"> <!-- Use my-2 instead of my-0 -->
<div class="card" style="width: 18rem;">
    <div class="card-image-container" style="height: 200px; overflow: hidden;">
        <img src="./admin/product_images/' . $product_image1 . '" class="card-img-top img-fluid" alt="...">
    </div>
    <div class="card-body">
        <h5 class="card-title">' . $product_name . '</h5>
        <p class="card-text"> Ksh ' . $price . '</p>
        <a class="btn btn-info" href="index.php?add_to_cart=' . $product_id . '">Add to cart</a>
        <a class="btn btn-secondary view-more-link" href="viewmore.php?viewmore=' . $product_id . '">View More</a>
    </div>
</div>
</div>';
            }
        }
    }
}






        
   
//cart proucts
//cart proucts
function cart(){
    global $conn;
    // Start the session to access session variables

    if (isset($_GET['add_to_cart'])) {
        $get_product_id = $_GET['add_to_cart'];

        // Check if the user is logged in and user_name is set in the session
        if (isset($_SESSION['user_name'])) {
            $user_name = $_SESSION['user_name']; // Get the user_name from the session
            echo "User Name: $user_name";

            $quantity = 0;

            // Check if the product is already in the cart
            $check_sql = "SELECT * FROM cart_details WHERE product_id = '$get_product_id' AND user_name = '$user_name'";
            $check_result = mysqli_query($conn, $check_sql);

            if ($check_result) {
                // If the product is already in the cart, show an alert
                if (mysqli_num_rows($check_result) > 0) {
                    echo "<script>";
                    echo "alert('Item is already in the cart.');";
                    echo "window.open('index.php','_self');";
                    echo "</script>";
                } else {
                    // Product is not in the cart, so add it
                    $sql = "SELECT * FROM products WHERE product_id = '$get_product_id'";
                    $result = mysqli_query($conn, $sql);

                    if ($result) {
                        // Check if a row was returned
                        if (mysqli_num_rows($result) > 0) {
                            $row = mysqli_fetch_assoc($result);
                            $product_name = $row['product_name'];

                            // Insert into the cart-details table with explicit column references.
                            $sql1 = "INSERT INTO `cart_details` (product_id, user_name, product_name, quantity) VALUES ('$get_product_id', '$user_name', '$product_name', '$quantity')";
                            $result1 = mysqli_query($conn, $sql1);

                            // Execute the SQL query to insert into the cart-details table.
                            if ($result1) {
                                echo "<script>";
                                echo "alert('Item added to cart successfully');";
                                echo "window.open('index.php','_self');";
                                echo "</script>";
                            } else {
                                echo "<script>";
                                echo "alert('Item not added to cart. Error: " . mysqli_error($conn) . "');";
                                echo "window.open('index.php','_self');";
                                echo "</script>";
                            }
                        } else {
                            echo "<script>";
                            echo "alert('Product not found');";
                            echo "window.open('index.php','_self');";
                            echo "</script>";
                        }
                    } else {
                        echo "<script>";
                        echo "alert('Error: " . mysqli_error($conn) . "');";
                        echo "window.open('index.php','_self');";
                        echo "</script>";
                    }
                }
            }
        } else {
            echo "<script>";
            echo "alert('User is not logged in');";
            echo "window.open('./users/login.php','_self');"; // Redirect to login page
            echo "</script>";
        }
    }
}

//cart items number
function cart_item(){
    global $conn;
    if (isset( $_SESSION['user_name'])) {
        # code...
        $user_name = $_SESSION['user_name']; // Define $user_name here

    if (isset($_GET['add_to_cart'])) {
        $sql = "SELECT * from cart_details where user_name = '$user_name'";
        $result = mysqli_query($conn, $sql);
        $result1 = mysqli_num_rows($result);
        if ($result1 > 0) {
            echo $result1;
        }
    } else {
        $sql = "SELECT * from cart_details where user_name = '$user_name'";
        $result = mysqli_query($conn, $sql);
        $result1 = mysqli_num_rows($result);
        if ($result1 > 0) {
            echo $result1;
        }
    }
    }
    
}
//getting cart items
//<th scope="col">Product Name</th>
     // <th scope="col">product image</th>
      //<th scope="col">Quantity </th>
      //<th scope="col">price</th>
      
      //<th scope="col">Action</th>



// Brands
function get_unique_brand(){
    global $conn;
    if (isset($_GET['brand'])) {
        $brand_id = $_GET['brand']; // Corrected variable name
        
        $sql = "SELECT * FROM products WHERE brand_id = $brand_id";
        $result = mysqli_query($conn, $sql);
        $num_rows=mysqli_num_rows($result);
        if ($num_rows===0) {
            echo "<h2 class='text-center text-danger'>No stock for this brand </h2>";
        }
        
        while ($row = mysqli_fetch_assoc($result)) {
            $product_name = $row['product_name'];
            $price = $row['price'];
            $description = $row['description'];
            $product_category = $row['category_id'];
            $product_brand = $row['brand_id'];
            $product_image1 = $row['image1'];
            $product_image2 = $row['image2'];
            
            echo '<div class="card col-md-4 mb-" style="width: 18rem;">
                <img src="./admin/product_images/' . $product_image1 . '" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">' . $product_name . '</h5>
                    <p class="card-text">' . $price . '</p>
                    <p class="card-text">' . $description . '</p>
                    <p class="card-text">' . $product_category . '</p>
                </div>
            </div>';
        }
    }
}




?>