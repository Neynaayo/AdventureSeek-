<?php
session_start();
require 'connectDB.php';

// Ensure the user is logged in
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit;
}

// Fetch customer email from session
$custEmail = $_SESSION['email'];

// Fetch customer details
$cust_query = mysqli_query($link, "SELECT * FROM `customer` WHERE `CustEmail` = '$custEmail'");
$customer = mysqli_fetch_assoc($cust_query);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $updatedName = $_POST['name'];
    $updatedEmail = $_POST['email'];
    $updatedPhone = $_POST['phone'];

    // Handle image upload
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
        $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
        $filename = $_FILES["profile_picture"]["name"];
        $filetype = $_FILES["profile_picture"]["type"];
        $filesize = $_FILES["profile_picture"]["size"];

        // Verify file extension
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if (!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");

        // Verify file size - 5MB maximum
        $maxsize = 5 * 1024 * 1024;
        if ($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");

        // Verify MYME type of the file
        if (in_array($filetype, $allowed)) {
            // Check whether file exists before uploading it
            if (file_exists("img/" . $filename)) {
                echo $filename . " is already exists.";
            } else {
                move_uploaded_file($_FILES["profile_picture"]["tmp_name"], "img/" . $filename);
                echo "Your file was uploaded successfully.";
            }
        } else {
            echo "Error: There was a problem uploading your file. Please try again.";
        }

        // Update database with new image filename
        $update_image_query = mysqli_query($link, "UPDATE `customer` SET `CustPic` = '$filename' WHERE `CustEmail` = '$custEmail'");
    }

    $update_query = mysqli_query($link, "UPDATE `customer` SET `CustName` = '$updatedName', `CustEmail` = '$updatedEmail', `CustNoPhone` = '$updatedPhone' WHERE `CustEmail` = '$custEmail'");

    if ($update_query) {
        $_SESSION['email'] = $updatedEmail; // Update session email if changed
        header('Location: profile.php');
        exit;
    } else {
        echo "Error updating profile.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <link rel="stylesheet" href="styleProfile.css">
    <style>
        .update-profile {
            background-color: var(--secondary-color);
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .update-profile form {
            display: flex;
            flex-direction: column;
        }

        .update-profile label {
            margin-top: 15px;
            color: var(--primary-color);
            display: block;
        }

        .update-profile input[type="text"],
        .update-profile input[type="email"],
        .update-profile input[type="file"] {
            padding: 10px;
            margin-top: 5px;
            border: 1px solid var(--accent-color);
            border-radius: 5px;
            background-color: var(--text-color);
            color: var(--secondary-color);
            width: 100%;
            box-sizing: border-box;
        }

        .update-profile input[type="file"] {
            background-color: var(--background-color);
            color: var(--text-color);
            padding: 5px;
        }



        .update-profile input[type="submit"] {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: var(--primary-color);
            color: var(--secondary-color);
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .update-profile input[type="submit"]:hover {
            background-color: #1ed760;
        }

        .current-image {
            margin-top: 20px;
            text-align: center;
        }

        .current-image img {
            max-width: 200px;
            border-radius: 50%;
        }
    </style>
</head>
<body>

<?php include 'header.php';
include 'headerProfile.php' ?>

<div class="container">
    <section class="update-profile">
        <h1 class="heading">Update Profile</h1>

        <?php if ($customer): ?>
            <form action="" method="post" enctype="multipart/form-data">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo $customer['CustName']; ?>" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $customer['CustEmail']; ?>" required>

                <label for="phone">Phone Number:</label>
                <input type="text" id="phone" name="phone" value="<?php echo $customer['CustNoPhone']; ?>" required>

                <label for="profile_picture">Profile Picture:</label>
                <input type="file" id="profile_picture" name="profile_picture" accept="image/*">

                <?php if (!empty($customer['CustPic'])): ?>
                    <div class="current-image">
                        <p>Current Profile Picture:</p>
                        <img src="img/<?php echo $customer['CustPic']; ?>" alt="Current Profile Picture">
                    </div>
                <?php endif; ?>

                <input type="submit" value="Update Profile">
            </form>
        <?php else: ?>
            <p>User not found.</p>
        <?php endif; ?>
    </section>
</div>

</body>
</html>