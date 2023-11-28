<?php
    if (isset($_GET['add_to_cart'])) {
        global $conn;
        $get_product_id= $_GET['add_to_cart'];
        $user_id = 12;

       // $quantity=$_POST['quantity'];
        $sql="select * from products where  product_id=$get_product_id";

        $result =mysqli_query($conn,$sql);
        $row_count= mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);
        $product_name =$row['product_name'];
        if ($row_count>0) {
            echo "<script>item already in cart</script>";
            echo "<script>window.open('index.php','_self')</script>";

        }
        else{
            $sql1="insert into `cart-details` ( product_id, user_id, product_name, quantity) values( '$get_product_id','$user_id','$product_name',0)";


        }

        

    }

       include('footer.php');

?>