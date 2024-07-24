<?php
session_start();
require 'connectDB.php';

// Ensure the user is logged in
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit;
}

// Check if an order ID is provided
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    $_SESSION['error'] = "Invalid order ID.";
    header('Location: profile.php');
    exit;
}

$orderId = $_GET['id'];
$custEmail = $_SESSION['email'];

// Verify that the order belongs to the logged-in user and is in a cancellable state
$check_query = "SELECT * FROM `orderdetails` WHERE `OrderID` = ? AND `custEmail` = ? AND `orderStatus` IN ('Pending', 'Confirmed')";
$stmt = mysqli_prepare($link, $check_query);
mysqli_stmt_bind_param($stmt, "is", $orderId, $custEmail);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) == 0) {
    $_SESSION['error'] = "Order not found or cannot be cancelled.";
    header('Location: profile.php');
    exit;
}

// Update the order status to 'Cancelled'
$update_query = "UPDATE `orderdetails` SET `orderStatus` = 'Cancelled' WHERE `OrderID` = ?";
$stmt = mysqli_prepare($link, $update_query);
mysqli_stmt_bind_param($stmt, "i", $orderId);

if (mysqli_stmt_execute($stmt)) {
    $_SESSION['success'] = "Order successfully cancelled.";
} else {
    $_SESSION['error'] = "Error cancelling order. Please try again.";
}

// Close the statement
mysqli_stmt_close($stmt);

// Redirect back to the profile page
header('Location: profile.php');
exit;
?>