<?php
session_start();
include('connect.php');
if (isset($_GET['viewmore'])) {
    $product_id = $_GET['viewmore'];
    $select_query = "select * from products where product_id='$product_id'";
    $result_query=mysqli_query($conn,$select_query);
    $row_query = mysqli_fetch_assoc($result_query);
    $product_name = $row_query['product_name'];
    $price = $row_query['price'];
    $description = $row_query['description'];
   



    $image1 = $row_query['image1'];
    $image2 = $row_query['image2'];
    $image3 = $row_query['image3'];







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

<style>
    .img2{
        height:120px;
        width: 120px;
        object-fit:contain;
    }
    .img1{
        height:250px;
        width: 200px;
        object-fit:contain;
    }
</style>
</head>
<body>
    <div class="row">
        <div class="col-md-6">
        <img src="./admin/product_images/<?php echo $image1?>" class="card-img-top img1" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?php echo  $product_name ?></h5>
                    <p class="card-text"> <?php echo $price ?></p>
                    <p class="card-text"> <?php echo $description ?></p>
                    <a class="btn btn-success" href="index.php?add_to_cart=' . $product_id . '">Add to cart</a>
                            <a class="btn btn-secondary view-more-link" href="viemore.php?viewmore=' . $product_id . '">GO back</a>

                </div>

        </div>
        <div class="col-md-6">
        <h2 class="info">Related Products</h2>

        <div class="card-body">
        <img src="./admin/product_images/<?php echo $image2 ?>" class="card-img-top img2" alt="...">
        <img src="./admin/product_images/<?php echo $image3 ?>" class="card-img-top img2" alt="...">


                    <h5 class="card-title"><?php echo $product_name ?> </h5>
                    
                </div>

        </div>
    </div>

</body>
</html
