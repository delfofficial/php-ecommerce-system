<?php
// Amount
session_start();
include('connect.php');
include('./functions/common_functions.php');

$user_name = $_SESSION['user_name'];
$invoice_number = mt_rand();
$order_status = 'pending';

if (isset($user_name)) {
    $sql = "SELECT * FROM cart_details WHERE user_name='$user_name'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $total_products = mysqli_num_rows($result);
        $amount = 0;

        while ($row = mysqli_fetch_assoc($result)) {
            $product_id = $row['product_id'];

            $sql1 = "SELECT * FROM products WHERE product_id='$product_id'";
            $rsl = mysqli_query($conn, $sql1);

            if ($rsl) {
                while ($row_product = mysqli_fetch_assoc($rsl)) {
                    $product_price = $row_product['price'];
                    $product_amount = $product_price * $row['quantity'];
                    $amount += $product_amount;
                }
            }
        }

        $sql2 = "INSERT INTO orders (`user_name`, `amount`, `invoice_number`, `total_products`, `order_date`, `order_status`)
                 VALUES ('$user_name', '$amount', '$invoice_number', '$total_products', NOW(), '$order_status')";
        $rsl2 = mysqli_query($conn, $sql2);

        if ($rsl2) {
            // Order insertion successful, now remove items from the cart
            $sql3 = "DELETE FROM cart_details WHERE user_name='$user_name'";
            $rsl3 = mysqli_query($conn, $sql3);

            if (!$rsl3) {
                die("Error removing items from the cart: " . mysqli_error($conn));
            }
        } else {
            die("SQL Error inserting order: " . mysqli_error($conn));
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- ... (your head content) ... -->
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>user name</th>
                <th>Amount</th>
                <th>invoice number</th>
                <th>Total Products</th>
                <th>Order date</th>
                <th>Order status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo $user_name; ?></td>
                <td><?php echo $amount; ?></td>
                <td><?php echo $invoice_number; ?></td>
                <td><?php echo $total_products; ?></td>
                <td><?php echo date('Y-m-d H:i:s'); ?></td>
                <td><?php echo $order_status; ?></td>
                <?php
                 $sql = "SELECT * FROM orders WHERE user_name='$user_name'";
                 $select_query = mysqli_query($conn, $sql);
                 while ($select_row = mysqli_fetch_assoc($select_query)) {
                    $orderid= $select_row['order_id'];
                    # code...
                 }
                
                ?>

            
            </td>

            </tr>
        </tbody>
    </table>
    <a href="profile.php"><button class="btn btn-success">Proceed to your profile</button></a>
    <?php include('footer.php'); ?>
</body>
</html>
