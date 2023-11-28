<!DOCTYPE html>
<html>
<head>
    <title>Search Page</title>
    <style>
        /* Add your CSS styles here for result formatting */
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            margin-bottom: 20px;
            border: 1px solid #ddd;
            padding: 10px;
        }
        img {
            max-width: 100px;
        }
    </style>
</head>
<body>
    <h1>Results for Product Search</h1>

    <?php
    include('connect.php'); // Include your database connection script
    include('functions/common_functions.php');
    
    // Handle the search query
    if (isset($_POST['search'])) {
        // Get the search query and sanitize it (consider using prepared statements)
        $search_query = mysqli_real_escape_string($conn, $_POST['search_query']);

        // Construct and execute the SQL query
        $sql = "SELECT products.*, brands.brand_name, categories.category_name
                FROM products
                JOIN brands ON products.brand_id = brands.brand_id
                JOIN categories ON products.category_id = categories.category_id
                WHERE product_name LIKE '%$search_query%'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<h2>Search Results:</h2>";
            echo "<ul>";
            while ($row = $result->fetch_assoc()) {
                echo "<li>";
                echo "<img src='admin/product_images/" . $row['image1'] . "' alt='" . $row['product_name'] . "' width='100'>";
                echo "<h3>" . $row['product_name'] . "</h3>";
                echo "<p>Brand: " . $row['brand_name'] . "</p>";
                echo "<p>Category: " . $row['category_name'] . "</p>";
                echo "<p>Price: $" . $row['price'] . "</p>";
                echo '<a class="btn btn-secondary" href="index.php.php?add_to_cart=' . $row['product_id']. '">Add to cart</a>';
                echo '<a class="btn btn-secondary" href="viewmore.php?viewmore=' . $row['product_id']. '">View More</a>';

                echo "</li>";
            }
            echo "</ul>";
        } else {
            echo "<p>No results found.</p>";
        }

        // Close the database connection
        $conn->close();
    }
    ?>

</body>
</html>
