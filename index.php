<?php
//session_start();
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

<style>
  img {
    width: 80px;
    height: 200px;
    object-fit: contain;
}

 .home{
    overflow-x:auto;
    justify-content:space-between;
  }
  a {
    text-decoration:none;

  }
  body {
    background-color:navy-blue;
  }
</style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="index.php">Home</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse d-space-between" id="navbarSupportedContent">
    
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
    }
    ?>
    </li>
    <li class="nav-item active">
        <a class="nav-link" href="users/register.php">Register <span class="sr-only">(current)</span></a>
      </li>
      <form method="POST" action="search.php" class="d-flex" style="width:200px;">
        <input type="text" name="search_query" placeholder="Enter your search query" class="form-control">
        <button type="submit" name="search" class="btn btn-success">Search</button>
    </form>

      
    </ul>

    
    <div class="profSearch d-flex">
    
    <div class="prof" style=" float:right; margin-left:500px;">
    <?php
    if (isset($_SESSION['user_name'])) {
      $user_session_name = $_SESSION['user_name'];

      $sql1 = "SELECT * FROM users WHERE user_name='$user_session_name'";
      $rsl = mysqli_query($conn, $sql1);
      $rsl_row = mysqli_num_rows($rsl);
      $row = mysqli_fetch_assoc($rsl); 
      $user_image = $row['user_image'];



        $image_url = 'users/user_images/' . $user_image;
        
        // Display the user's image

        echo "<a  href='profile.php'><img src='$image_url' alt='User Image' class='card-img-top' style='height:60px; width:60px; object-fit:contain; border-radius:50%;'>
        </a>";
        echo "Your Profile";


    }

    ?>
    </div>
    </div>
  </div>
</nav>

   <div class="container-fluid home">
   
<div class="row" style="margin-top:30px; justify-content:space-between;">
  <div class="products col-md-10 mb-2 d-flex ">
  <?php
  getProducts();

  

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
  <div class="side col-md-2 bg-dark text-light">
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
    echo "<li>" ;
    echo "<a href='index.php?brand=$brand_id'>" . $brand_name . "</a>";
    echo "</li>";
}

echo "</ul>";

?>
  </div>
  <div class="products">

  </div>

</div>
   </div>
   <footer class="page-footer font-small bg-dark text-white" style="margin-top:20px;">


<!-- Footer Links -->
<div class="container text-center text-md-left">

  <!-- Grid row -->
  <div class="row">

    <!-- Grid column -->
    <div class="col-md-3 mx-auto">

      <!-- Links -->
      <h5 class="font-weight-bold text-uppercase mt-3 mb-4">About Us</h5>

      <ul class="list-unstyled">
        <li>
          <a href="#!">Products</a>
        </li>
        <li>
          <a href="#!">Contact</a>
        </li>
        <li>
          <a href="#!">Services</a>
        </li>
        <li>
          <a href="#!">Blog</a>
        </li>
      </ul>

    </div>
    <!-- Grid column -->

    <hr class="clearfix w-100 d-md-none">

    <!-- Grid column -->
    <div class="col-md-3 mx-auto">

      <!-- Links -->
      <h5 class="font-weight-bold text-uppercase mt-3 mb-4">Products</h5>

      <ul class="list-unstyled">
        <li>
          <a href="#!">Purchase</a>

        </li>
        <li>
          <a href="#!">offers</a>
        </li>
        <li>
          <a href="#!">coupon</a>
        </li>
        <li>
          <a href="#!">Buy</a>
        </li>
      </ul>

    </div>
    <!-- Grid column -->

    <hr class="clearfix w-100 d-md-none">

    <!-- Grid column -->
    <div class="col-md-3 mx-auto">

      <!-- Links -->
      <h5 class="font-weight-bold text-uppercase mt-3 mb-4">Support</h5>

      <ul class="list-unstyled">
        <li>
          <a href="#!">Help Center</a>
        </li>
        <li>
          <a href="#!">Management</a>
        </li>
        <li>
          <a href="#!">Terms and Conditions</a>
        </li>

      </ul>

    </div>
    <!-- Grid column -->

    <hr class="clearfix w-100 d-md-none">

    <!-- Grid column -->
    <div class="col-md-3 mx-auto">

      <!-- Links -->
      <h5 class="font-weight-bold text-uppercase mt-3 mb-4">Contact</h5>

      <ul class="list-unstyled">
        <li>
<a href="#"><i class="bi bi-facebook"></i></a> <!-- Bootstrap icon -->
<a href="#"><i class="fas fa-square-twitter"></i></a> <!-- FontAwesome icon -->
        </li>
        <li>
          <a href="#!"><i class="bi bi-reddit"></i> </a>
        </li>
        <li>
          <a href="#!">Link 3</a>
          <i class="fas-brands fas-square-twitter"></i>
        </li>
        <li>
          <a href="#!"><i class="bi bi-tiktok"></i></a>
          <a href="#"><i class="bi bi-facebook"></i></a> <!-- Bootstrap icon -->
<a href="#"><i class="fas fa-square-twitter"></i></a> <!-- FontAwesome icon -->

        </li>
      </ul>

    </div>
    <!-- Grid column -->

  </div>
  <!-- Grid row -->

</div>
<!-- Footer Links -->

<!-- Copyright -->
<div class="footer-copyright text-center py-3">
    <small>© 2023 Copyright:
        <a href="/"> Delfin Kerubo</a></small>
</div>
<!-- Copyright -->

</footer>
<!-- Footer -->
</body>
</html>