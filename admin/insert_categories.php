<?php
/*
include('../connect.php');
if (isset($_POST['insert_category'])) {
    $category_name=$_POST['category_name'];
    $sql="insert into `categories` (category_name) values('$category_name')";
    $result=mysqli_query($conn, $sql);
    if ($result) {
        echo 'category nserted successfully';
    }
    else
    echo 'error inserting category';
}
*/
include('../connect.php');


if (isset($_POST['insert_category'])) {
    $category_name =$_POST['category_name'];
    $sql = "INSERT INTO categories (category_name) VALUES ('$category_name')";
    
    if (mysqli_query($conn, $sql)) {
        echo 'Category inserted successfully';
    } else {
        echo 'Error inserting category: ' . mysqli_error($conn);
    }

    mysqli_close($conn);
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <div class="input-group">
        <input type="text" placeholder="insert Categories" name="category_name">
        </div>
        <div class="input-group">
        <input type="submit"  name="insert_category" value="insert categories">

        </div>
    </form>
</body>
</html>