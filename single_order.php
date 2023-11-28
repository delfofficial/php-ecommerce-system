<?php
session_start();
include('connect.php');
include('./functions/common_functions.php');

if (isset($_GET['single_order'])) {
    $orderid = $_GET['single_order'];
    $select_query = "select * from orders where order_id='$orderid'";
    $result_query=mysqli_query($conn,$select_query);
    $row_query = mysqli_fetch_assoc($result_query);
    $user_name = $row_query['user_name'];
    $amount = $row_query['amount'];
    $status = $row_query['order_status'];

    $invoice_number = $row_query['invoice_number'];

}

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

    <table>
        <thead>
            <tr>
                <th>order id</th>
                <th>user name</th>
                <th>Amount</th>
                <th>invoice number</th>
                <th>status</th>




            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo $orderid ?></td>
                <td><?php echo $user_name ?></td>
                <td><?php echo $amount ?></td>
                <td><?php echo $invoice_number ?></td>
                <?php
                if ($status == 'paid') {
                    echo "
                    <td> paid </td>
                    ";
                    # code...
                }
                else {
                    echo "<td><a href='payment.php?pay_order=$orderid'>confirm</a></td>";
                }
                
                
                ?>


            </tr>
        </tbody>
    </table>
    <?php     include('footer.php'); ?>

</body>
</html>