<?php
session_start();
include('../connect.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
<style>
    .button-contents{
        border: box 5px;
    }
    .button-contents a {
      text-decoration: none;
    }
</style>

</head>
<body>
    <p><a href="../index.php">home</a></p>
<h2>Admin Panel</h2>
    <div class="container-fluid d-flex align-items-center">
        
        <div>
            <?php
    if (isset($_SESSION['user_name'])) {
        echo "<p>{$_SESSION['user_name']}</p>";
        //echo '<img src="./admin/product_images/. {$_SESSION['user_image']} " class="card-img-top" alt="...">
        //';


    } else {
        echo "<p>Admin</p>";
    }
    ?>
            
        </div>
        <div class="button-contents">
            <button class="" ><a href="index.php?insert_products">Insert Products</a></button>
            <button><a href="">view Products</a></button>
            <button><a href="index.php?insert_categories">Insert Categories</a></button>
            <button><a href="index.php?view_categories">View categories</a></button>
            <button><a href="index.php?insert_brand">Insert Brands</a></button>
            <button><a href="index.php?view_brands">view brands</a></button>
            <button><a href="index.php?orders">All orders</a></button>
            <button><a href="index.php?payments">All Payments</a></button>
            <button><a href="index.php?allusers">All Users</a></button>
            <button><a href="">Logout</a></button>
        </div>
        
    </div>
    <div class="show">
            <?php
            if (isset($_GET['insert_categories'])) {
                include('insert_categories.php');
        
            }
            if (isset($_GET['insert_brand'])) {
                include('insert_brands.php');
        
            }
            if (isset($_GET['insert_products'])) {
                include('insert_products.php');
            } 
            if (isset($_GET['view_categories'])) {
                include('view_categories.php');
            }  
            if (isset($_GET['allusers'])) {
                include('allusers.php');
            }  
            if (isset($_GET['view_brands'])) {
                include('view_brands.php');
            }  
            if (isset($_GET['orders'])) {
                include('orders.php');
            }  
            if (isset($_GET['payments'])) {
                include('payments.php');
            }  
   


                
            
            ?>
        </div>
</body>
</html>