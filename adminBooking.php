<?php
require 'connectDB.php';

// Fetch all orders by default
$sql = "SELECT od.OrderID, c.CustName AS CustomerName, ct.ActivityName, ct.quantityAdult + ct.quantityChild AS Quantity, od.totalAmount, p.paymentStatus
        FROM orderdetails od
        JOIN payment p ON od.paymentID = p.paymentID
        JOIN cart ct ON od.cartID = ct.CartID
        JOIN customer c ON od.CustEmail = c.CustEmail
        ORDER BY od.OrderID DESC";

$result = $link->query($sql);

// Handle AJAX search request
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $orderID = intval($_GET['search']);
    $sql = "SELECT od.OrderID, c.CustName AS CustomerName, ct.ActivityName, ct.quantityAdult + ct.quantityChild AS Quantity, od.totalAmount, p.paymentStatus
            FROM orderdetails od
            JOIN payment p ON od.paymentID = p.paymentID
            JOIN cart ct ON od.cartID = ct.CartID
            JOIN customer c ON od.CustEmail = c.CustEmail
            WHERE od.OrderID = ?";
    
    $stmt = $link->prepare($sql);
    $stmt->bind_param('i', $orderID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Return search results as JSON
    $orders = [];
    while ($row = $result->fetch_assoc()) {
        $orders[] = $row;
    }
    echo json_encode($orders);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Bookings</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container">
        <h2>Customer Booking List</h2>
        <form id="searchForm">
            <header class="search-bar">
                <input type="text" id="orderID" name="orderID" placeholder="Enter Order ID">
                <button type="submit">SEARCH</button>
            </header>
        </form>
        <section class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer Name</th>
                        <th>Package Name</th>
                        <th>Quantity</th>
                        <th>Total Order</th>
                        <th>Payment Status</th>
                    </tr>
                </thead>
                <tbody id="orderTableBody">
                    <?php
                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['OrderID']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['CustomerName']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['ActivityName']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['Quantity']) . "</td>";
                            echo "<td>RM " . number_format($row['totalAmount'], 2) . "</td>";
                            echo "<td>" . htmlspecialchars($row['paymentStatus']) . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6' class='no-results'>No orders found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </div>

    <script>
    $(document).ready(function() {
        $('#searchForm').on('submit', function(e) {
            e.preventDefault();
            var orderID = $('#orderID').val();
            
            $.ajax({
                url: 'adminBooking.php',
                type: 'GET',
                data: { search: orderID },
                dataType: 'json',
                success: function(data) {
                    var tableBody = $('#orderTableBody');
                    tableBody.empty();
                    
                    if (data.length > 0) {
                        $.each(data, function(index, order) {
                            var row = "<tr>" +
                                "<td>" + order.OrderID + "</td>" +
                                "<td>" + order.CustomerName + "</td>" +
                                "<td>" + order.ActivityName + "</td>" +
                                "<td>" + order.Quantity + "</td>" +
                                "<td>RM " + parseFloat(order.totalAmount).toFixed(2) + "</td>" +
                                "<td>" + order.paymentStatus + "</td>" +
                                "</tr>";
                            tableBody.append(row);
                        });
                    } else {
                        tableBody.html("<tr><td colspan='6' class='no-results'>No orders found.</td></tr>");
                    }
                },
                error: function() {
                    alert('An error occurred while searching.');
                }
            });
        });
    });
    </script>
</body>
</html>