<?php
session_start();
include('connect.php');
include('./functions/common_functions.php');


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>


</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="index.php">Home</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="AllProducts.php">Products <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="cart_items.php"><i class="fa-solid fa-cart-shopping"></i><sup><?php cart_item() ?></sup></a>
      </li>
      <li class="nav-item">
    <?php
    if (isset($_SESSION['username'])) {
        echo "<a class='nav-link' href='#'>{$_SESSION['username']}</a>";
    } else {
        echo "<a class='nav-link' href='#'>Link</a>";
    }
    ?>
    <li class="nav-item">
    <?php
    if (isset($_SESSION['user_name'])) {
        echo "<a class='nav-link' href='#'>{$_SESSION['user_name']}</a>";
    } else {
        echo "<a class='nav-link' href='users/login.php'>login</a>";
    }
    ?>
    </li>
    
    <li class="nav-item">
    <?php
    if (isset($_SESSION['user_name'])) {
        echo "<a class='nav-link' href='users/logout.php'>logout</a>";
    } else {
        echo "<a class='nav-link' href='#'>Link</a>";
    }
    ?>
    </li>

      


      
    </ul>

    
    <form method="POST" action="search.php">
        <input type="text" name="search_query" placeholder="Enter your search query">
        <button type="submit" name="search">Search</button>
    </form>
  </div>
</nav>
<div class="main" style="margin-top: 30px; overflow-x: hidden;">
  <div class="container">
    <div class="row">
      <div class="col-md-10">
        <div class="products d-flex flex-wrap">
  <?php
  getAllProducts();

  

  get_unique_category();
  get_unique_brand();
  cart();

  /*
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
*/
?> 
   </div>
      </div>
      <div class="col-md-2 bg-dark text-light">
        <h2>categories</h2>
        <!-- categories -->
        <!-- categories -->
        <?php
        echo "<ul>";
        $sql = "select * from categories";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            $category_id = $row['category_id']; // Retrieve the category_id
            $category_name = $row['category_name'];
            echo "<li>";
            echo "<a href='index.php?category=$category_id'>" . $category_name . "</a>";
            echo "</li>";
        }

        echo "</ul>";

        ?>
        <h2>brands</h2>
        <!-- brands -->
        <?php

        echo "<ul>";
        $sql = "select * from brands";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            $brand_id = $row['brand_id']; // Retrieve the brand_id
            $brand_name = $row['brand_name'];
            echo "<li>";
            echo "<a href='index.php?brand=$brand_id'>" . $brand_name . "</a>";
            echo "</li>";
        }

        echo "</ul>";

        ?>
      </div>
    </div>
  </div>
</div>
<?php include('footer.php'); ?>


</body>
</html>