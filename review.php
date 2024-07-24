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
$cust_query = mysqli_query($link, "SELECT * FROM customer WHERE CustEmail = '$custEmail'");
$customer = mysqli_fetch_assoc($cust_query);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_review'])) {
    if (isset($_POST['activity_name'])) {
        $activity_name = $_POST['activity_name'];
    } else {
        echo "activity_name is not set in POST request";
        exit;
    }

    $review_text = mysqli_real_escape_string($link, $_POST['review_text']);
    $review_rating = (int) $_POST['review_rating'];
    $current_time = date("Y-m-d H:i:s");

    // Check if the review already exists
    $check_review_query = "SELECT * FROM review WHERE CustEmail = ? AND ActivityName = ?";
    $stmt = mysqli_prepare($link, $check_review_query);
    mysqli_stmt_bind_param($stmt, 'ss', $custEmail, $activity_name);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        // Update existing review
        $update_review_query = "UPDATE review SET ReviewText = ?, ReviewRating = ?, ReviewDateTime = ? WHERE CustEmail = ? AND ActivityName = ?";
        $stmt = mysqli_prepare($link, $update_review_query);
        mysqli_stmt_bind_param($stmt, 'sisss', $review_text, $review_rating, $current_time, $custEmail, $activity_name);
        mysqli_stmt_execute($stmt);
    } else {
        // Insert new review
        $insert_review_query = "INSERT INTO review (ActivityName, ReviewText, ReviewDateTime, ReviewRating, CustEmail) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($link, $insert_review_query);
        mysqli_stmt_bind_param($stmt, 'sssds', $activity_name, $review_text, $current_time, $review_rating, $custEmail);
        mysqli_stmt_execute($stmt);
    }
}

// Fetch user's previous activities
$select_cart_query = "SELECT * FROM cart WHERE CustEmail = '$custEmail'";
$cart_result = mysqli_query($link, $select_cart_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave a Review</title>
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

        .review-form {
            display: flex;
            flex-direction: column;
        }

        .review-form select, 
        .review-form textarea, 
        .review-form input[type="submit"] {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .review-form textarea {
            resize: vertical;
        }

        .review-form input[type="submit"] {
            background-color: #ff9800;
            color: #fff;
            cursor: pointer;
        }

        .review-form input[type="submit"]:hover {
            background-color: #333;
        }
    </style>
</head>
<body>
<?php include 'header.php';
include 'headerProfile.php'; ?>

<div class="container">
    <h1 class="heading">Leave a Review</h1>
    <form action="review.php" method="post" class="review-form">
        <label for="activity_name">Select Activity</label>
        <select name="activity_name" id="activity_name" required>
            <option value="">-- Select Activity --</option>
            <?php
            if (mysqli_num_rows($cart_result) > 0) {
                while ($row = mysqli_fetch_assoc($cart_result)) {
                    echo '<option value="' . $row['ActivityName'] . '">' . $row['ActivityName'] . '</option>';
                }
            } else {
                echo '<option value="">No activities found</option>';
            }
            ?>
        </select>

        <label for="review_text">Your Review</label>
        <textarea name="review_text" id="review_text" rows="5" required></textarea>

        <label for="review_rating">Rating</label>
        <select name="review_rating" id="review_rating" required>
            <option value="1">1 - Poor</option>
            <option value="2">2 - Fair</option>
            <option value="3">3 - Good</option>
            <option value="4">4 - Very Good</option>
            <option value="5">5 - Excellent</option>
        </select>

        <input type="submit" name="submit_review" value="Submit Review">
    </form>
</div>
</body>
</html>
