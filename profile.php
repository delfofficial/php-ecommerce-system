<?php 
session_start();
include('connect.php');
include('./functions/common_functions.php');
//echo "<pre>";
//print_r($_SESSION);
//echo "</pre>";



/*
    $user_session_name = $_SESSION['user_name'];
    echo $user_session_name;
    $sql1 = "SELECT * FROM users WHERE user_name='$user_session_name'";
    $rsl = mysqli_query($conn, $sql1);
    $rsl_row = mysqli_num_rows($rsl);
    $row = mysqli_fetch_assoc($rsl);
   // $image = $row['user_image'];
    // Rest of your code here...
}
 else {
    // Handle the case where 'user_name' is not set in the session
    // Redirect the user to a login page or display an error message.
}
*/

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
        .card-img-top{
            width:100%;
            height:80px;
            object-fit: contain;
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
    
    
    <li>
    <?php
    if (isset($_SESSION['user_name'])) {
      $user_name6 = $_SESSION["user_name"];


        echo "<a class='nav-link' href='profile.php'>Your Profile</a>";
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

      


      
    </ul>

    
    <form method="POST" action="search.php" class="d-flex">
        <input type="text" name="search_query" placeholder="Enter your search query" class="form-control">
        <button type="submit" name="search" class="btn btn-success">Search</button>
    </form>
  </div>
</nav>
    
    <div class="container mx-0">
        <div class="row">
            <div class="col-md-2">
                <ul class="navbar-nav bg-secondary text-center">
                    
                    <?php


// Check if the user is logged in (you should have a mechanism to determine this)
if (isset($_SESSION['user_name'])) {
    // Retrieve the user's image path from your database
    $user_name = $_SESSION['user_name'];
    $sql = "SELECT user_image FROM users WHERE user_name='$user_name'";
    $result = mysqli_query($conn, $sql);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $user_image = $row['user_image'];
        
        // Construct the image URL based on your website's structure
        $image_url = 'users/user_images/' . $user_image;
        
        // Display the user's image
        echo "<img src='$image_url' alt='User Image' class='card-img-top'>";
    } else {
        // Handle the case where the user's image information is not found in the database
        echo "User's image not found";
    }
} else {
    // Handle the case where the user is not logged in
    echo "User not logged in";
}

?>
<!-- Rest of your HTML code -->
<li class="nav-item bg-info">
                        <a href="" class="nav-link text-light">Your Profile</a>
                    </li>


/<!--<img src="../users/user_images<//php echo $image; ?>" alt=""> -->

                    <li class="nav-item">
                        <a href="profile.php?pending_orders" class="nav-link text-light">Pending orders</a>
                    </li>
                    <li class="nav-item">
    <a href="profile.php?edit_account" class="nav-link text-light">Edit account</a>
</li>

                    <li class="nav-item">
                        <a href="profile.php?get_orders" class="nav-link text-light">my orders</a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link text-light">Delete account</a>
                    </li>
                    <li class="nav-item text-center">
                        <a href="users/logout.php" class="nav-link text-light">Logout</a>
                    </li>
                </ul>


            </div>
            <div class="col-md-10 show-prof-items">
            <?php
            if (isset($_GET['get_orders'])) {
                include('orders.php');
        
            }
            if (isset($_GET['pending_orders'])) {
                include('pending_orders.php');
        
            }
            if (isset($_GET['edit_account'])) {
                include('edit_account.php');
            }    

            if (isset($_GET['insert_products'])) {
                include('insert_products.php');
            }   
                
            
            ?>

            </div>
        </div>
    </div>
    <?php     include('footer.php'); ?>

</body>
</html>