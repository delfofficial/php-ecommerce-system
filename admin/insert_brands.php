<?php

include('../connect.php');
if (isset($_POST['insert_brand'])) {
    $brand_name=$_POST['brand_name'];
    $sql="insert into brands (brand_name) values('$brand_name')";
    $result=mysqli_query($conn, $sql);
    if ($result) {
        echo 'brand nserted successfully';
    }
    else
    echo 'error inserting brand';
} 
/*
if (isset($_POST['insert_brand'])) {
    $brand_name = $_POST['brand_name'];
    $sql = "INSERT INTO brands (brand_name) VALUES ('$brand_name')";
    
    if (mysqli_query($conn, $sql)) {
        echo 'brand inserted successfully';
    } else {
        echo 'Error inserting brand: ' . mysqli_error($conn);
    }

} */
mysqli_close($conn);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Insert brands</h2>
    <form action="" method="post">
        <div class="input-group">
        <input type="text" placeholder="insert brand" name="brand_name">
        </div>
        <div class="input-group">
        <input type="submit"  name="insert_brand" value="insert brand">

        </div>
    </form>
</body>
</html>