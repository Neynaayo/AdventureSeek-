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

// If customer is found, fetch cart and reviews
if ($customer) {
    $custID = $customer['CustID'];

    // Fetch cart details
    $cart_query = mysqli_query($link, "SELECT * FROM `cart` WHERE `CustEmail` = '$custEmail'");

    // Fetch review details
    $review_query = mysqli_query($link, "SELECT * FROM `review` WHERE `CustEmail` = '$custEmail'");
} else {
    $customer = null;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>User Profile</title>

   <!-- Font Awesome CDN link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="styleProfile.css">
   <!-- Google Fonts -->
   <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">

</head>
<body>

<?php include 'header.php'; 
include 'headerProfile.php' ?>

<div class="container">

<section class="user-profile">

   <h1 class="heading">User Profile</h1>

   <div class="profile-details">
   <?php if ($customer): ?>
      <div class="profile-card">
         <div class="profile-image">
            <?php 
            if (!empty($customer['CustPic']) && file_exists("img/" . $customer['CustPic'])) {
               echo "<img src='img/" . $customer['CustPic'] . "' alt='Profile Picture'>";
            } else {
               echo strtoupper(substr($customer['CustName'], 0, 1));
            }
            ?>
         </div>
         <div class="profile-info">
            <h2><?php echo $customer['CustName']; ?></h2>
            <p><strong>Email:</strong> <?php echo $customer['CustEmail']; ?></p>
            <p><strong>Phone:</strong> <?php echo $customer['CustNoPhone']; ?></p>
         </div>
      </div>
      <a href="updateProfile.php" class="btn">Edit Profile</a>

         <div class="stats">
            <div class="stat-item">
               <div class="stat-value"><?php echo mysqli_num_rows($cart_query); ?></div>
               <div class="stat-label">Bookings</div>
            </div>
            <div class="stat-item">
               <div class="stat-value"><?php echo mysqli_num_rows($review_query); ?></div>
               <div class="stat-label">Reviews</div>
            </div>
            <!--<div class="stat-item">
               <div class="stat-value">RM<?php echo number_format($grand_total); ?></div>
               <div class="stat-label">Total Spent</div>-->
            </div>
         </div>
      <?php else: ?>
         <p>User not found.</p>
      <?php endif; ?>
   </div>

   <div class="booking-history">
   <h2>Upcoming Bookings</h2>
   <table>
      <thead>
         <tr>
            <th>Order ID</th>
            <th>Activity</th>
            <th>Image</th>
            <th>Adult Price</th>
            <th>Child Price</th>
            <th>Adult Qty</th>
            <th>Child Qty</th>
            <th>Total</th>
            <th>Order Date</th>
            <th>Status</th>
            <th>Action</th>
         </tr>
      </thead>
      <tbody>
         <?php 
         $upcoming_total = 0;
         if ($customer) {
            $order_query = mysqli_query($link, "SELECT o.*, c.* FROM `orderdetails` o JOIN `cart` c ON o.cartID = c.CartID WHERE o.custEmail = '$custEmail' AND o.orderStatus IN ('Pending', 'Confirmed') ORDER BY o.orderDate DESC");
            
            if (mysqli_num_rows($order_query) > 0) {
               while ($fetch_order = mysqli_fetch_assoc($order_query)) {
                  $sub_total = ($fetch_order['PriceAdult'] * $fetch_order['quantityAdult']) + ($fetch_order['PriceChild'] * $fetch_order['quantityChild']);
                  $upcoming_total += $sub_total;
         ?>
         <tr>
            <td><?php echo $fetch_order['OrderID']; ?></td>
            <td><?php echo $fetch_order['ActivityName']; ?></td>
            <td><img src="img/<?php echo $fetch_order['ActivityPicture']; ?>" alt=""></td>
            <td>RM<?php echo number_format($fetch_order['PriceAdult']); ?></td>
            <td>RM<?php echo number_format($fetch_order['PriceChild']); ?></td>
            <td><?php echo $fetch_order['quantityAdult']; ?></td>
            <td><?php echo $fetch_order['quantityChild']; ?></td>
            <td>RM<?php echo number_format($sub_total); ?></td>
            <td><?php echo date('Y-m-d H:i', strtotime($fetch_order['orderDate'])); ?></td>
            <td><?php echo $fetch_order['orderStatus']; ?></td>
            <td>
               <a href="cancel_order.php?id=<?php echo $fetch_order['OrderID']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to cancel this booking?')">Cancel</a>
               <?php
                  if (isset($_SESSION['success'])) {
                     echo "<div class='alert alert-success'>" . $_SESSION['success'] . "</div>";
                     unset($_SESSION['success']);
                  }
                  if (isset($_SESSION['error'])) {
                     echo "<div class='alert alert-danger'>" . $_SESSION['error'] . "</div>";
                     unset($_SESSION['error']);
                  }
                  ?>
            </td>
         </tr>
         <?php
               }
            } else {
               echo "<tr><td colspan='11'>No upcoming bookings found</td></tr>";
            }
         }
         ?>
      </tbody>
      <tfoot>
         <tr>
            <td colspan="7">Upcoming Total</td>
            <td colspan="4">RM<?php echo number_format($upcoming_total); ?></td>
         </tr>
      </tfoot>
   </table>

   <h2>Completed Bookings</h2>
   <table>
      <thead>
         <tr>
            <th>Order ID</th>
            <th>Activity</th>
            <th>Image</th>
            <th>Adult Price</th>
            <th>Child Price</th>
            <th>Adult Qty</th>
            <th>Child Qty</th>
            <th>Total</th>
            <th>Order Date</th>
            <th>Status</th>
         </tr>
      </thead>
      <tbody>
         <?php 
         $completed_total = 0;
         if ($customer) {
            $completed_query = mysqli_query($link, "SELECT o.*, c.* FROM `orderdetails` o JOIN `cart` c ON o.cartID = c.CartID WHERE o.custEmail = '$custEmail' AND o.orderStatus = 'Completed' ORDER BY o.orderDate DESC");
            
            if (mysqli_num_rows($completed_query) > 0) {
               while ($fetch_completed = mysqli_fetch_assoc($completed_query)) {
                  $sub_total = ($fetch_completed['PriceAdult'] * $fetch_completed['quantityAdult']) + ($fetch_completed['PriceChild'] * $fetch_completed['quantityChild']);
                  $completed_total += $sub_total;
         ?>
         <tr>
            <td><?php echo $fetch_completed['OrderID']; ?></td>
            <td><?php echo $fetch_completed['ActivityName']; ?></td>
            <td><img src="img/<?php echo $fetch_completed['ActivityPicture']; ?>" alt=""></td>
            <td>RM<?php echo number_format($fetch_completed['PriceAdult']); ?></td>
            <td>RM<?php echo number_format($fetch_completed['PriceChild']); ?></td>
            <td><?php echo $fetch_completed['quantityAdult']; ?></td>
            <td><?php echo $fetch_completed['quantityChild']; ?></td>
            <td>RM<?php echo number_format($sub_total); ?></td>
            <td><?php echo date('Y-m-d H:i', strtotime($fetch_completed['orderDate'])); ?></td>
            <td><?php echo $fetch_completed['orderStatus']; ?></td>
         </tr>
         <?php
               }
            } else {
               echo "<tr><td colspan='10'>No completed bookings found</td></tr>";
            }
         }
         ?>
      </tbody>
      <tfoot>
         <tr>
            <td colspan="7">Completed Total</td>
            <td colspan="3">RM<?php echo number_format($completed_total); ?></td>
         </tr>
      </tfoot>
   </table>
</div>

   <div class="review-history">
      <h2>Review History</h2>
      <table>
         <thead>
            <tr>
               <th>Review ID</th>
               <th>Review Text</th>
               <th>Rating</th>
            </tr>
         </thead>
         <tbody>
            <?php 
            if ($customer && mysqli_num_rows($review_query) > 0) {
               while ($fetch_review = mysqli_fetch_assoc($review_query)) {
            ?>
            <tr>
               <td><?php echo $fetch_review['ReviewID']; ?></td>
               <td><?php echo $fetch_review['ReviewText']; ?></td>
               <td><?php echo $fetch_review['ReviewRating']; ?>/5</td>
            </tr>
            <?php
               }
            } else {
               echo "<tr><td colspan='3'>No reviews found</td></tr>";
            }
            ?>
         </tbody>
      </table>
   </div>

</section>

</div>

<!-- Custom JS file link -->
<script src="js/script.js"></script>

</body>
</html>