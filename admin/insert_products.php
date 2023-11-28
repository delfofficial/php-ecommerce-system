<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

include('../connect.php');
if (isset($_POST['insert_product'])){
    
    $product_name=$_POST['product_name'];
    $price=$_POST['price'];
    $description=$_POST['description'];
    $keywords=$_POST['keywords'];

    $product_category=$_POST['product_category'];
    $product_brand=$_POST['product_brand'];
    $status ='true';

    $product_image1=$_FILES['image1']['name'];
    $product_image2=$_FILES['image2']['name'];
    $product_image3=$_FILES['image3']['name'];

    $temp_image1=$_FILES['image1']['tmp_name'];
    $temp_image2=$_FILES['image2']['tmp_name'];
    $temp_image3=$_FILES['image3']['tmp_name'];


    move_uploaded_file( $temp_image1,"./product_images/$product_image1");
    move_uploaded_file( $temp_image2,"./product_images/$product_image2");
    move_uploaded_file( $temp_image2,"./product_images/$product_image2");

    
    $sql = "INSERT INTO products (`product_name`, `price`, `description`, `keywords`, `category_id`, `brand_id`, `image1`, `image2`,`image3`, `Time`, `status`) VALUES ('$product_name', '$price', '$description', '$keywords', '$product_category', '$product_brand', '$product_image1', '$product_image2','$product_image3', NOW(), '$status')";
    $result = mysqli_query($conn,$sql);
    if ($result) {
        echo "product added successfully";
    }

    else{
        echo mysqli_error($conn);
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
  <label for="product_name" class="form-label">Product name</label>
  <input type="text" class="form-control" id="product_name" placeholder="product name" name="product_name">
</div>
<div class="mb-3 w-50 m-auto">
  <label for="product_description" class="form-label">Product description</label>
  <input type="text" class="form-control" id="product_description" placeholder="product description" name="description">
</div>
<div class="mb-3 w-50 m-auto">
  <label  class="form-label">product keywords</label>
  <input type="text" class="form-control" name="keywords" placeholder="keywords">
</div>
<select class="form-select w-50 m-auto" name="product_category" required>
  <option selected>select category</option>
  <?php
  $sql = "SELECT * FROM categories";
  $result = mysqli_query($conn, $sql);

  while ($row = mysqli_fetch_assoc($result)) {
    $category_id = $row['category_id'];
    $category_name = $row['category_name'];
    echo "<option value=\"$category_id\">$category_name</option>";
  }
  ?>
</select>
<select class="form-select w-50 m-auto" name="product_brand" required>
  <option selected>select brand</option>
  <?php
  $sql = "SELECT * FROM brands";
  $result = mysqli_query($conn, $sql);

  while ($row = mysqli_fetch_assoc($result)) {
    $brand_id = $row['brand_id'];
    $brand_name = $row['brand_name'];
    echo "<option value=\"$brand_id\">$brand_name</option>";
  }
  ?>
</select>


<div class="mb-3 w-50 m-auto" >
  <label  class="form-label ">image 1</label>
 <input type="file"  class="form-control" name="image1">
</div>
<div class="mb-3 w-50 m-auto" >
  <label class="form-label">image 2</label>
 <input type="file"  class="form-control" name="image2">
</div>
<div class="mb-3 w-50 m-auto" >
  <label class="form-label">image 3</label>
 <input type="file"  class="form-control" name="image3">
</div>
<<div class="mb-3 w-50 m-auto">
  <label class="form-label">Product price</label>
  <input type="number" class="form-control" name="price">
</div>

<div class="mb-3 w-50 m-auto" >
  
 <input type="submit"  class="btn btn-info" name="insert_product" value="insert product">
 <!--Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores, deleniti? Doloremque mollitia quasi ut. Hic labore quia possimus eaque ex officia voluptatum veritatis doloribus consectetur perferendis facilis tempora, commodi debitis? -->
</div>
    </form>
    



</body>
</html>