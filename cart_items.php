<?php
session_start();
include('connect.php');
include('functions/common_functions.php');

// Check if the form was submitted


// Fetch cart items for the user
$user_name = $_SESSION['user_name'];
$sql = "SELECT c.product_id, p.product_name, p.image1, c.quantity, p.price FROM cart_details c
        JOIN products p ON c.product_id = p.product_id
        WHERE c.user_name='$user_name'";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("SQL Error: " . mysqli_error($conn));
}

//$total_price = 0; // Initialize total price

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
        .product_image {
            width: 80px;
            height: 80px;
            object-fit: contain;
        }

        .button-contents {
            border: box 5px;
            align-items: center;
        }

        .button-contents a {
            text-decoration: none;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
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
    <form action="" method="post">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Product Name</th>
                    <th scope="col">Product Image</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Price</th>
                    <th scope="col">Subtotal</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // ... (previous code)
                
                $total_price = 0; // Initialize total price
                
                while ($row = mysqli_fetch_assoc($result)) {
                    $product_id = $row['product_id'];
                    $product_name = $row['product_name'];
                    $product_image = $row['image1'];
                    $quantity = intval($row['quantity']); // Ensure quantity is an integer
                    $price = $row['price'];
                
                    // Calculate the subtotal for this item
                    $subtotal = $quantity * $price;
                    $total_price += $subtotal; // Add subtotal to the total price
                
                    echo "<tr>";
                    echo "<td>{$product_name}</td>";
                    echo "<td><img src='./admin/product_images/{$product_image}' class='product_image' alt='...'></td>";
                    echo "<td><input type='number' name='qty' class='form-input w-50' value='{$quantity}' min='1'></td>"; // Ensure minimum quantity is 1
                    if (isset($_POST['update_cart'])) {
                        $user_name = $_SESSION['user_name'];
                        
                        // Loop through the submitted quantities and update them in the database
                        
                                // Ensure that $quantity is a positive integer or handle validation as needed
                                $quantity = $_POST['qty'];
                    
                                // Update the quantity in the database
                                $update_query = "UPDATE cart_details SET quantity = '$quantity' WHERE user_name = '$user_name' ";

                                $result1 = mysqli_query($conn, $update_query);
                                $subtotal= $price*$quantity;
                    
                                if (!$result1) {
                                    die("SQL Error: " . mysqli_error($conn));
                                }
                            
                        
                    }
                    echo "<td>{$price}</td>";
                    echo "<td>{$subtotal}</td>"; // Display subtotal
                    echo "<td><input type='submit' class='btn btn-primary' name='update_cart' value='Update'></td>";
                    echo "<td><input type='submit' class='btn btn-danger' name='delete' value='Delete'></td>";
                    echo "</tr>";
                }
                ?>
                
            </tbody>
            
            
        </table>
        
        <p>Total Price: <?php echo $total_price; ?></p>
    </form>
    <div class="button-contents d-flex">
        <a href="index.php" class="btn btn-secondary">Continue Shopping</a>
        <a href="checkout.php" class="btn btn-info">Checkout</a>
    </div>
</body>
</html>
