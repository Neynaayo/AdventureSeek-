<?php
session_start();
include 'connectDB.php';

$email = $_POST['email'];
$password = $_POST['password'];


// Query the database to check the user credentials
$sql = "SELECT * FROM admin WHERE AdminEmail = '$email' AND AdminPassword = '$password'";
$result = mysqli_query($link, $sql);

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        // Set session variables
        $_SESSION['user_id'] = $user['id']; 
        $_SESSION['email'] = $user['AdminEmail']; 
        $_SESSION['name']= $user['AdminName'];
        header('Location: adminHome.php');
        exit;
    } else {
        echo "Invalid email or password.";
    }
} else {
    echo "Error: " . mysqli_error($link);
}

mysqli_close($link);
?>
