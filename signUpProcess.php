<?php
include 'connectDB.php';

// Get form data
if (isset($_POST['full_name'], $_POST['email'], $_POST['password'], $_POST['confirm_password'])) {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
}

// Validate form data
if ($password !== $confirm_password) {
    echo "<script>alert('Passwords do not match.'); window.location.href = 'signUp.php';</script>";
    exit;
}

// Hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert data into the database
$query = "INSERT INTO customer(CustName, CustEmail, CustPassword) VALUES ('$full_name', '$email', '$hashed_password')";
$result = mysqli_query($link, $query) or die("Query failed");

// Check if insertion was successful
if ($result) {
    header("Location: login.php");
} else {
    echo "Problem occurred!";
}

mysqli_close($link); // Close the database connection
?>
