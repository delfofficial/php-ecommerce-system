<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

include('../connect.php');
if (isset($_POST['register_user'])){
    
    $user_name=$_POST['user_name'];
    $password=$_POST['password'];
    $email=$_POST['email'];
   // $user_image='';

   // if (isset($_FILES['user_image']) && $_FILES['user_image']['error'] === UPLOAD_ERR_OK) {

    $user_image=$_FILES['user_image']['name'];
    $temp_image=$_FILES['user_image']['tmp_name'];
    $sql1="SELECT * FROM users where  user_name='$user_name' or  email='$email'";
    $rsl=mysqli_query($conn,$sql1);
    $rsl_row =mysqli_num_rows($rsl);
    if ($rsl_row>0) {
      echo "name and email already exist in database";
      # code...
    }
    else{
      $sql = "INSERT INTO users (`user_name`, `password`, `email`, `user_image`) VALUES ('$user_name', '$password', '$email', '$user_image')";
    move_uploaded_file( $temp_image,"./user_images/$user_image");

    $result = mysqli_query($conn,$sql);
    if ($result) {
        echo "registered successfully";
        echo "<script>window.location.href = '../users/login.php';</script>";

    }

    else{
        echo mysqli_error($conn);
    }
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
<div class="mb-3 w-50 m-auto">
  <label  class="form-label">Email</label>
  <input type="email" class="form-control" name="email" placeholder="email">
</div>


<div class="mb-3 w-50 m-auto" >
  <label  class="form-label ">User Image</label>
 <input type="file"  class="form-control" name="user_image">
</div>

  
 <input type="submit"  class="btn btn-info" name="register_user" value="Register">
 <!--Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores, deleniti? Doloremque mollitia quasi ut. Hic labore quia possimus eaque ex officia voluptatum veritatis doloribus consectetur perferendis facilis tempora, commodi debitis? -->
</div>
    </form>
    



</body>
</html>