<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');

include('./connect.php');

if (isset($_GET['edit_account'])) {
    $user_name = "";
    $email = "";
    $user_session_name = $_SESSION['user_name'];

    $sql1 = "SELECT * FROM users WHERE user_name='$user_session_name'";
    $result = mysqli_query($conn, $sql1);

    if ($row_fetch = mysqli_fetch_assoc($result)) {
        $user_name = $row_fetch['user_name'];
        $user_id = $row_fetch['user_id'];
        $email = $row_fetch['email'];
        $image = $row_fetch['user_image'];

        if (isset($_POST['update_account'])) {
            $user_name = $_POST['user_name'];
            $update_id = $user_id;
            $email = $_POST['email'];

            // Handling user image upload
            $user_image = $_FILES['user_image']['name'];
            $temp_image = $_FILES['user_image']['tmp_name'];

            // Validate and handle uploaded image
            if (!empty($user_image) && is_uploaded_file($temp_image)) {
                $upload_dir = "users/user_images/";
                $allowed_extensions = ["jpg", "jpeg", "png", "gif"]; // Add more if needed
                $file_extension = strtolower(pathinfo($user_image, PATHINFO_EXTENSION));

                if (in_array($file_extension, $allowed_extensions)) {
                    // Generate a unique filename
                    $new_image_name = uniqid() . "." . $file_extension;
                    $target_path = $upload_dir . $new_image_name;

                    // Move the uploaded file
                    if (move_uploaded_file($temp_image, $target_path)) {
                        // Update query
                        $update_query = "UPDATE users SET user_name='$user_name', email='$email', user_image='$new_image_name' WHERE user_id=$update_id";
                        if (mysqli_query($conn, $update_query)) {
                            echo "<script>alert('User details updated successfully');</script>";
                            echo "<script>window.open('index.php', '_self');</script>";
                        } else {
                            echo "<script>alert('Failed to update user details');</script>";
                        }
                    } else {
                        echo "<script>alert('Failed to move uploaded file');</script>";
                    }
                } else {
                    echo "<script>alert('Invalid file format');</script>";
                }
            } else {
                // Update query without changing the image
                $update_query = "UPDATE users SET user_name='$user_name', email='$email' WHERE user_id=$update_id";
                if (mysqli_query($conn, $update_query)) {
                    echo "<script>alert('User details updated successfully');</script>";
                    echo "<script>window.open('index.php', '_self');</script>";
                } else {
                    echo "<script>alert('Failed to update user details');</script>";
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Account</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Edit Account
                    </div>
                    <div class="card-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="user_name" class="form-label">User name</label>
                                <input type="text" class="form-control" id="user_name" placeholder="User name" name="user_name" value="<?php echo $user_name; ?>">
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Email" name="email" value="<?php echo $email; ?>">
                            </div>

                            <div class="mb-3">
                                <label for="user_image" class="form-label">User Image</label>
                                <input type="file" class="form-control" name="user_image" accept="image/*">
                                <?php if (!empty($image)) : ?>
                                    <img src="users/user_images/<?php echo $image; ?>" alt="User Image" class="mt-2" style="max-width: 100px;">
                                <?php endif; ?>
                            </div>

                            <input type="submit" class="btn btn-info" name="update_account" value="Update">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
