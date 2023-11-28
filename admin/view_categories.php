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
                <th>Category Id</th>
                <th>Category name</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM categories";
            $result = mysqli_query($conn, $sql);

            while ($row = mysqli_fetch_assoc($result)) {
                $category_id = $row['category_id']; // Retrieve the category_id
                $category_name = $row['category_name'];

                echo '<tr class="bg-dark text-light">';
                echo "<td>$category_id</td>"; // Corrected variable interpolation
                echo "<td>$category_name</td>"; // Corrected variable interpolation
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
</body>
</html>
