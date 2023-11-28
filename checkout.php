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
    <style>
        img{
            width:100%;
            height:200px;
        }
    </style>


</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <a href="www.paypal.com" target="">
                    <img src="images/paypal.jpg" alt="">

                </a>
            </div>
           <?php
           $user_name= $_SESSION['user_name'];
           $sql="select * from cart_details";
           $result =mysqli_query($conn,$sql);
           while ($row=mysqli_fetch_assoc($result)) {

            # code...
           }
           echo"
            <div class='col-md-6'>
                
            <a href='order.php?order_user_name=$user_name' class='text-info'><h2>Pay Offline</h2></a>

        </div>
        ";
           ?>
        </div>
    </div>
    <?php     include('footer.php'); ?>

</body>
</html>