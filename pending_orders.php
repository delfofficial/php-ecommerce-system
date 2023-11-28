<?php
session_start();
include('connect.php');

$user_name = $_SESSION["user_name"];
$sql = "SELECT * FROM orders WHERE user_name='$user_name' AND order_status='pending'";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- ... (your head content) ... -->
</head>
<body>
    <?php
    // Check if there are orders for this user
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $amount = $row['amount'];
        $invoice_number = $row['invoice_number'];
        $total_products = $row['total_products'];
        $order_date = $row['order_date'];
        $order_status = $row['order_status'];
        ?>
        <table>
            <thead class="px-20 mx-20">
                <tr class="bg-info text-light px-30">
                    <th>user name</th>
                    <th>Amount</th>
                    <th>invoice number</th>
                    <th>Total Products</th>
                    <th>Order date</th>
                    <th>Order status</th>
                </tr>
            </thead>
            <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    $order_id = $row['order_id'];
                    $amount = $row['amount'];
                    $invoice_number = $row['invoice_number'];
                    $total_products = $row['total_products'];
                    $order_date = $row['order_date'];
                    $order_status = $row['order_status'];
                    ?>
                    <tr class="bg-dark text-light">
                        <td><a href="single_order.php?single_order=<?php echo $order_id; ?>"><?php echo $order_id; ?></a></td>
                        <td><?php echo $amount; ?></td>
                        <td><?php echo $invoice_number; ?></td>
                        <td><?php echo $total_products; ?></td>
                        <td><?php echo $order_date; ?></td>
                        <td><?php echo $order_status; ?></td>
                    </tr>
                    <?php
                }
                ?>
        </table>
        <?php
    } else {
        // No orders found for this user
        echo "<h2 class='text-success'> No pending orders</h2>";
    }
    ?>
</body>
</html>
