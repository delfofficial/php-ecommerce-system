<?php
session_start();
include('connect.php');

$invoice_number1 = ''; // Initialize with an empty string
$amount1 = ''; // Initialize with an empty string

if (isset($_GET['pay_order'])) {
    $order_id = $_GET['pay_order'];

    $sql = "SELECT * FROM orders WHERE order_id='$order_id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        $invoice_number1 = $row['invoice_number'];
        $amount1 = $row['amount'];
    } else {
        echo "No orders";
    }
}

// ... rest of your code ...


// ... rest of your code ...


if (isset($_POST['confirm_payment'])) {
    $invoice_number= $_POST['invoice_number'];
    $amount= $_POST['amount'];
    $payment_mode= $_POST['payment_mode'];

    $insert_query ="insert into user_payment(order_id,invoice_number,amount,payment_mode) values('$order_id','$invoice_number','$amount','$payment_mode')";
    $rsl =mysqli_query($conn,$insert_query);
    if ($rsl) {
        echo "alert('Payment made successfully');";
        $sql2= "UPDATE orders SET order_status='paid'";
        $rsl2 =mysqli_query($conn,$sql2);
        if ($rsl2) {
            echo "status updated";
            header('Location: orders.php');
            exit();
        }
        else {
            echo "status not updated";
        }

        //echo "<script>window.location.href = './orders.php';</script>";

    }
    else{
        echo "alert('Item not added to cart. Error: " . mysqli_error($conn) . "');";
        echo "window.open('orders.php','_self');";
    }   
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>

</head>

<body>
    <h2 class="success">Payment page</h2>
    <form action="" method="POST">
        <div class="mb-3 w-50 m-auto">
            <label for="invoice_number" class="form-label">Invoice Number</label>
            <input type="text" class="form-control" id="invoice_number" 
                name="invoice_number" value="<?php echo $invoice_number1; ?>">
        </div>
        <div class="mb-3 w-50 m-auto">
            <label for="amount" class="form-label">Amount</label>
            <input type="text" class="form-control" id="amount"  name="amount"
                value="<?php echo $amount1; ?>">
        </div>
        <label  class="form-label">Payment Mode</label>
        <select class="form-select mb-3 w-50 m-auto" aria-label="Payment Mode" name="payment_mode">
            <option selected>Open this select menu</option>
            <option value="M-pesa">M-PESA</option>
            <option value="PayPal">PayPal</option>
            <option value="Airtel money">Airtel Money</option>
            <option value="PesaPal">PesaPal</option>
        </select>
        

        <input type="submit" class="btn btn-success d-center" value="Confirm Payment" name="confirm_payment">
    </form>
    <?php     include('footer.php'); ?>


</body>

</html>