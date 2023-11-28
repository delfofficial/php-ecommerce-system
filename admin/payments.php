<table>
        <thead class="px-20 mx-20">
            <tr class="bg-info text-light px-30">
                <th>Order ID</th>
                <th>Invoice number</th>
                <th>Amount</th>
                <th>Payment mode</th>

            </tr>
        </thead>
        <tbody>
<?php
 $sql = "select * from user_payment";
 $result = mysqli_query($conn, $sql);
 
 while ($row = mysqli_fetch_assoc($result)) {
    $order_id=$row['order_id'];
    $invoice_number=$row['invoice_number'];
    $amount=$row['amount'];
    $payment_mode=$row['payment_mode'];
   // $user_image='';

   // if (isset($_FILES['user_image']) && $_FILES['user_image']['error'] === UPLOAD_ERR_OK) {

    echo '<tr class="bg-dark text-light">';
                echo "<td>$order_id</td>"; // Corrected variable interpolation
                echo "<td>$invoice_number</td>"; // Corrected variable interpolation
                echo "<td>$amount</td>"; // Corrected variable interpolation
                echo "<td>$payment_mode</td>"; // Corrected variable interpolation



                echo '</tr>';

 }
?>
 ?>
        </tbody>
    </table>