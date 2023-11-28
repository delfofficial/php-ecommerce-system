<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
        <thead class="px-20 mx-20">
            <tr class="bg-info text-light px-30">
                <th>Brand Id</th>
                <th>Brand name</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM brands";
            $result = mysqli_query($conn, $sql);

            while ($row = mysqli_fetch_assoc($result)) {
                $brand_id = $row['brand_id']; // Retrieve the brand_id
                $brand_name = $row['brand_name'];

                echo '<tr class="bg-dark text-light">';
                echo "<td>$brand_id</td>"; // Corrected variable interpolation
                echo "<td>$brand_name</td>"; // Corrected variable interpolation
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
</body>
</html>
