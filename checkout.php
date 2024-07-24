<?php
session_start();
require 'connectDB.php';

if(isset($_POST['order_btn'])) {
   $email = $_SESSION['email'];
   $method = $_POST['method'];
   $paymentStatus = ($method === 'paypal') ? 'pending' : 'success';

   // Insert order details into payment table
   $detail_query = mysqli_query($link, "INSERT INTO `payment` (CustEmail, PaymentMethod, PaymentStatus) VALUES ('$email', '$method', '$paymentStatus')") or die('query failed');

   if($detail_query){
      $paymentID = mysqli_insert_id($link); // Get the inserted payment ID
      $orderDate = date('Y-m-d');
      $orderStatus = 'Pending';
      $grand_total = 0;

      // Fetch cart items for the user
      $select_cart = mysqli_query($link, "SELECT * FROM `cart` WHERE CustEmail = '$email' AND cartStatus = 'active'");
      if(mysqli_num_rows($select_cart) > 0){
         while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            $total_price = ($fetch_cart['PriceAdult'] * $fetch_cart['quantityAdult']) + ($fetch_cart['PriceChild'] * $fetch_cart['quantityChild']);
            $grand_total += $total_price;
            $cartID = $fetch_cart['cartID'];

            // Insert into orderDetails table
            $insert_order_detail = mysqli_query($link, "INSERT INTO `orderDetails` (orderDate, orderStatus, totalAmount, custEmail, paymentID, cartID) VALUES ('$orderDate', '$orderStatus', '$total_price', '$email', '$paymentID', '$cartID')") or die('query failed');

            // Update cart with paymentID and change status to 'ordered'
            $update_cart = mysqli_query($link, "UPDATE `cart` SET paymentID = '$paymentID', cartStatus = 'ordered' WHERE cartID = '$cartID'") or die('query failed');
         }
      }

      echo "
      <div class='order-message-container'>
      <div class='message-container'>
         <h3>Thank you for shopping!</h3>
         
         <div class='customer-details'>
            <p>Your email: <span>".$email."</span></p>
            <p>Your payment mode: <span>".$method."</span></p>
            <p>Payment status: <span>".$paymentStatus."</span></p>
            <p>(Thank you for purchasing, check your email to complete the payment)</p>
         </div>
         <a href='searching.php' class='btn'>Continue shopping</a>
      </div>
      </div>
      ";
   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Checkout</title>

   <!-- Font awesome CDN link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- Custom CSS file link  -->
   <link rel="stylesheet" href="style.css">

</head>
<body>

<?php include 'header.php'; ?>

<div class="container">

<section class="checkout-form">

   <h1 class="heading">Complete your order</h1>

   <div class="display-order">
      <h2>Your Order Purchase:</h2>
      <?php
         $email = $_SESSION['email'];
         $select_cart = mysqli_query($link, "SELECT * FROM `cart` WHERE CustEmail = '$email' AND cartStatus = 'active'");
         $grand_total = 0;
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
               $total_price = ($fetch_cart['PriceAdult'] * $fetch_cart['quantityAdult']) + ($fetch_cart['PriceChild'] * $fetch_cart['quantityChild']);
               $grand_total += $total_price;
      ?>
      <div class="order-item">
         <h3><?php echo $fetch_cart['ActivityName']; ?></h3>
         <p>Quantity of Adults: <span><?php echo $fetch_cart['quantityAdult']; ?></span></p>
         <p>Quantity of Children: <span><?php echo $fetch_cart['quantityChild']; ?></span></p>
         <p>Date: <span><?php echo $fetch_cart['cartDate']; ?></span></p>
         <p>Time: <span><?php echo $fetch_cart['cartTime']; ?></span></p>
         <p>Total: <span>RM<?php echo $total_price; ?>/-</span></p>
      </div>
      <hr>
      <?php
            }
         } else {
            echo "<span>Your cart is empty!</span>";
         }
      ?>
      <div class="grand-total"><strong>Grand Total: RM<?php echo $grand_total; ?>/-</strong></div>
   </div>

   <form action="" method="post">
      <div class="flex">
         <div class="inputBox">
            <span>Your email</span>
            <input type="email" name="email" value="<?php echo $email; ?>" readonly>
         </div>
         <div class="inputBox">
            <span>Payment method</span>
            <select name="method">
               <option value="Touch n Go" selected>Touch n Go</option>
               <option value="credit card">Credit card</option>
               <option value="paypal">Paypal</option>
            </select>
         </div>
      </div>
      <input type="submit" value="Order now" name="order_btn" class="btn">
   </form>

</section>

</div>

<!-- Custom JS file link  -->
<script src="script.js"></script>
   
</body>
</html>
