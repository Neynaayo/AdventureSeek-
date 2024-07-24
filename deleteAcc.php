<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require 'connectDB.php';

// Ensure the user is logged in
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit;
}

// Fetch customer email from session
$custEmail = $_SESSION['email'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_account'])) {
    // Delete from cart table
    $delete_cart_query = "DELETE FROM `cart` WHERE `CustEmail` = '$custEmail'";
    mysqli_query($link, $delete_cart_query);

    // Delete from review table
    $delete_review_query = "DELETE FROM `review` WHERE `CustEmail` = '$custEmail'";
    mysqli_query($link, $delete_review_query);

    // Delete from customer table
    $delete_customer_query = "DELETE FROM `customer` WHERE `CustEmail` = '$custEmail'";
    mysqli_query($link, $delete_customer_query);

     // Delete from payment table
     $delete_payment_query = "DELETE FROM `payment` WHERE `CustEmail` = '$custEmail'";
     mysqli_query($link, $delete_payment_query);

      // Delete from orderdetails table
    $delete_orderdetails_query = "DELETE FROM `orderdetails` WHERE `CustEmail` = '$custEmail'";
    mysqli_query($link, $delete_orderdetails_query);

    // Destroy the session
    session_destroy();

    // Redirect to a confirmation page or home page
    echo "<script>alert('See you again Next time! We will mmiss you!'); window.location.href = 'login.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Account</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .heading {
            font-size: 2rem;
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .delete-form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .delete-form input[type="submit"] {
            margin-top: 15px;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #ff9800;
            color: #fff;
            cursor: pointer;
        }

        .delete-form input[type="submit"]:hover {
            background-color: #333;
        }
    </style>
</head>
<body>
<?php include 'header.php'; 
include 'headerProfile.php' ?>

<div class="container">
    <h1 class="heading">Delete Account</h1>
    <p>Are you sure you want to delete your account? This action cannot be undone.</p>
    <form action="deleteAcc.php" method="post" class="delete-form">
        <input type="submit" name="delete_account" value="Delete Account">
    </form>
</div>
</body>
</html>
