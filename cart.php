<?php
session_start();
include 'connectDB.php';

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    // Redirect to login page or display a notification
    echo "<script>alert('Please log in to access your cart.'); window.location.href = 'login.php';</script>";
    exit;
}

// Handle quantity update
if (isset($_POST['update_update_btn'])) {
    $update_adult = $_POST['update_adult_quantity'];
    $update_child = $_POST['update_child_quantity'];
    $update_date = $_POST['update_date'];
    $update_time = $_POST['update_time'];
    $update_id = $_POST['update_quantity_id'];
    $custEmail = $_SESSION['email'];

    $update_quantity_query = mysqli_query($link, "UPDATE cart SET quantityAdult = '$update_adult', quantityChild = '$update_child', cartDate = '$update_date', cartTime = '$update_time' WHERE cartID = '$update_id' AND CustEmail = '$custEmail' AND cartStatus = 'active'");
    if ($update_quantity_query) {
        header('Location: cart.php');
    }
}

// Handle item removal
if (isset($_GET['remove'])) {
    $remove_id = $_GET['remove'];
    $custEmail = $_SESSION['email'];

    mysqli_query($link, "DELETE FROM cart WHERE cartID = '$remove_id' AND CustEmail = '$custEmail' AND cartStatus = 'active'");
    header('Location: cart.php');
}

// Handle all items removal
if (isset($_GET['delete_all'])) {
    $custEmail = $_SESSION['email'];
    mysqli_query($link, "DELETE FROM cart WHERE CustEmail = '$custEmail' AND CartStatus = 'active'");
    header('Location: cart.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="cartStyling.css">
</head>
<body>
<?php include 'header.php'; ?>

<div class="container">
    <section class="shopping-cart">
        <h1 class="heading">Shopping Cart</h1>
        <table>
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price (Adult)</th>
                    <th>Price (Child)</th>
                    <th>Adult Quantity</th>
                    <th>Child Quantity</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Total Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                    <?php 
                    $custEmail = $_SESSION['email'];
                    $select_cart = mysqli_query($link, "SELECT * FROM `cart` WHERE CustEmail = '$custEmail' AND cartStatus = 'active'");
                    $grand_total = 0;
                    if (mysqli_num_rows($select_cart) > 0) {
                        while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
                    ?>
                    <tr>
                        <td><img src="img/<?php echo $fetch_cart['ActivityPicture']; ?>" height="100" alt=""></td>
                        <td><?php echo $fetch_cart['ActivityName']; ?></td>
                        <td>RM<?php echo number_format($fetch_cart['PriceAdult']); ?></td>
                        <td>RM<?php echo number_format($fetch_cart['PriceChild']); ?></td>
                        <td>
                            <form action="" method="post">
                                <input type="hidden" name="update_quantity_id" value="<?php echo $fetch_cart['cartID']; ?>">
                                <input type="number" name="update_adult_quantity" min="1" value="<?php echo $fetch_cart['quantityAdult']; ?>">
                        </td>
                        <td>
                                <input type="number" name="update_child_quantity" min="0" value="<?php echo $fetch_cart['quantityChild']; ?>">
                        </td>
                        <td>
                                <input type="date" name="update_date" value="<?php echo $fetch_cart['cartDate']; ?>">
                        </td>
                        <td>
                                <input type="time" name="update_time" min="08:00" max="20:00" value="<?php echo $fetch_cart['cartTime']; ?>">
                        </td>
                        <td>RM<?php 
                            $sub_total = ($fetch_cart['PriceAdult'] * $fetch_cart['quantityAdult']) + ($fetch_cart['PriceChild'] * $fetch_cart['quantityChild']);
                            echo number_format($sub_total); 
                        ?></td>
                        <td>
                                <input type="submit" value="Update" name="update_update_btn" class="option-btn" style="margin-bottom: 5px;">
                            </form>
                            <a href="cart.php?remove=<?php echo $fetch_cart['cartID']; ?>" onclick="return confirm('Remove item from cart?')" class="delete-btn"> <i class="fas fa-trash"></i> Remove</a>
                        </td>
                    </tr>
                    <?php
                        $grand_total += $sub_total;
                        }
                    } else {
                        echo "<tr><td colspan='10'>Your cart is empty.</td></tr>";
                    }
                    ?>
                <tr class="table-bottom">
                    <td><a href="searching.php" class="option-btn" style="margin-top: 0;">Continue Shopping</a></td>
                    <td colspan="6">Grand Total</td>
                    <td>RM<?php echo number_format($grand_total); ?></td>
                    <td><a href="cart.php?delete_all" onclick="return confirm('Are you sure you want to delete all?');" class="delete-btn"> <i class="fas fa-trash"></i> Delete All </a></td>
                </tr>
            </tbody>
        </table>
        <div class="checkout-btn">
            <a href="checkout.php" class="btn <?= ($grand_total > 1) ? '' : 'disabled'; ?>">Proceed to Checkout</a>
        </div>
    </section>
</div>

<script src="script.js"></script>
</body>
</html>
