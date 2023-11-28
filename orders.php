<?php
session_start();
include('connect.php');
//include('./functions/common_functions.php');


$user_name = $_SESSION["user_name"];
$sql = "SELECT * FROM orders WHERE user_name='$user_name'";
$result = mysqli_query($conn, $sql);

// Check if there are orders for this user

// ... (previous code)

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $amount = $row['amount'];
    $invoice_number = $row['invoice_number'];
    $total_products = $row['total_products'];
    $order_id = $row['order_id']; // Corrected variable name
    $order_date = $row['order_date'];
    $order_status = $row['order_status'];
} else {
    // No orders found for this user
    $amount = "N/A";
    $invoice_number = "N/A";
    $total_products = "N/A";
    $order_id = "N/A"; // Corrected variable name
    $order_date = "N/A";
    $order_status = "N/A";
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
   
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

 <!-- ... (your head content) ... -->
 <style>
        
        a{
            text-decoration:none;
            color: inherit; /* Inherit text color from parent */



        }
    </style>
</head>
<body>

<h2> All orders</h2>

    <table>
        <thead class="px-20 mx-20">
            <tr class="bg-info text-light px-30">
                <th>Order Id</th>
                <th>Amount</th>
                <th>invoice number</th>
                <th>Total Products</th>
                <th>Order date</th>
                <th>Order status</th>
            </tr>
        </thead>
        <tbody>
        <?php
            // Loop through the result set to display all orders
            while ($row = mysqli_fetch_assoc($result)) {
                $amount = $row['amount'];
                $invoice_number = $row['invoice_number'];
                $total_products = $row['total_products'];
                $order_id = $row['order_id']; // Corrected variable name
                $order_date = $row['order_date'];
                $order_status = $row['order_status'];

                echo '<tr class="bg-dark text-light">';
                echo '<td><a href="single_order.php?single_order=' . $order_id . '" class="single_order.php">' . $order_id . '</a></td>';
                echo '<td><a href="single_order.php?single_order=' . $order_id . '" class="single_order.php">' . $amount . '</a></td>';
                echo '<td><a href="single_order.php?single_order=' . $order_id . '" class="single_order.php">' . $invoice_number . '</a></td>';
                echo '<td><a href="single_order.php?single_order=' . $order_id . '" class="single_order.php">' . $total_products . '</a></td>';
                echo '<td><a href="single_order.php?single_order=' . $order_id . '" class="single_order.php">' . $order_date . '</a></td>';
                echo '<td><a href="single_order.php?single_order=' . $order_id . '" class="single_order.php">' . $order_status . '</a></td>';
                echo '</tr>';
            }
            ?>

        </tbody>
    </table>
<?php include('footer.php'); ?>
</body>
</html>
