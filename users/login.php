<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');

include('../connect.php');
if (isset($_POST['user_login'])){
    
    $user_name=$_POST['user_name'];
    $password=$_POST['password'];   
    //$user_id=$_POST['user_id'];

    
    $sql = "SELECT * FROM users where user_name='$user_name'";
    $result = mysqli_query($conn,$sql);
    $rsl=mysqli_num_rows($result);
    $result_row = mysqli_fetch_assoc($result);
    $role=$result_row['role'];
    $user_image =$result_row['user_image'];

    
 // Store user ID and role in the session
    $_SESSION["user_name"] = $user_name;
   $_SESSION["user_image"] =$result_row['$user_image'];
   //$_SESSION["user_id"] = $result_row['user_id']; // Use the correct column name


    //$_SESSION["user_name"] = $user_name;

   // $_SESSION["user_role"] = $user_role;

    if ($rsl>0) {
      if ($role==1) {
        echo "<script>window.location.href = '../admin/index.php';</script>";  # code...
      }
      else{
        echo "<script>window.location.href = '../index.php';</script>";
      }
    }

    else{
        echo "invalid credentials";
    }


}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
    <div class="mb-3 w-50 m-auto">
  <label for="product_name" class="form-label">User name</label>
  <input type="text" class="form-control" id="product_name" placeholder="user name" name="user_name">
</div>
<div class="mb-3 w-50 m-auto">
  <label for="product_description" class="form-label">Password</label>
  <input type="password" class="form-control" id="product_description" placeholder="password" name="password">
</div>


  <div>
 <input type="submit"  class="btn btn-info" name="user_login" value="Login">
 <p class="fw-bold small">Don't have an account?<a href="register.php" class="text-danger">Register</a></p>
 <!--Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores, deleniti? Doloremque mollitia quasi ut. Hic labore quia possimus eaque ex officia voluptatum veritatis doloribus consectetur perferendis facilis tempora, commodi debitis? -->
</div>
    </form>
    



</body>
</html>