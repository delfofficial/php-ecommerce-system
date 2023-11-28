<table>
        <thead class="px-20 mx-20">
            <tr class="bg-info text-light px-30">
                <th>User Name</th>
                <th>Email</th>
                <th>Image</th>

            </tr>
        </thead>
        <tbody>
<?php
 $sql = "select * from users";
 $result = mysqli_query($conn, $sql);
 
 while ($row = mysqli_fetch_assoc($result)) {
    $user_name=$row['user_name'];
    $email=$row['email'];
   // $user_image='';

   // if (isset($_FILES['user_image']) && $_FILES['user_image']['error'] === UPLOAD_ERR_OK) {

    $user_image=$row['user_image'];
    echo '<tr class="bg-dark text-light">';
                echo "<td>$user_name</td>"; // Corrected variable interpolation
                echo "<td>$email</td>"; // Corrected variable interpolation
                echo '<td><img src="user_images/' . $user_image . '" alt=""></td>'; // Updated image source path

                echo '</tr>';

 }
?>
 ?>
        </tbody>
    </table>