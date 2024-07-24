<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include 'connectDB.php';

$profilePicture = "img/user.jpg"; // Default image
if (isset($_SESSION['email'])) {
    $custEmail = $_SESSION['email'];
    $result = mysqli_query($link, "SELECT custPic FROM customer WHERE CustEmail = '$custEmail'");
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if (!empty($row['custPic']) && file_exists("img/" . $row['custPic'])) {
            $profilePicture = "img/" . $row['custPic'];
        }
    }
}

// Fetch customer name if email is set in the session
$customerName = "Guest"; // Default name
if (isset($_SESSION['email'])) {
    $custEmail = $_SESSION['email'];
    $nameSql = "SELECT CustName FROM customer WHERE CustEmail = ?";
    $nameStmt = $link->prepare($nameSql);
    $nameStmt->bind_param('s', $custEmail);
    $nameStmt->execute();
    $nameResult = $nameStmt->get_result();
    if ($nameResult->num_rows > 0) {
        $nameRow = $nameResult->fetch_assoc();
        $customerName = $nameRow['CustName'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .header-wrapper {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
        }
        .upper-section {
            background: linear-gradient(to bottom, rgba(51, 51, 51, 0.8) 0%, rgba(51, 51, 51, 0) 100%);
            padding: 1rem;
            transition: background 0.3s ease;
        }
        .upper-section:hover {
            background: rgba(51, 51, 51, 0.8);
        }
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
        }
        .nav-left a, .nav-right a {
            margin-left: 10px;
            text-decoration: none;
            color: #fff;
            font-weight: bold;
            transition: color 0.3s ease;
        }
        .nav-left a:hover, .nav-right a:hover {
            color: #ff6600;
        }
        .profile-img {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            object-fit: cover;
            margin-left: 10px;
            border: 2px solid #fff;
        }
        .content {
            padding-top: 80px; /* Adjust based on your header height */
        }
        .profile-img {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            object-fit: cover;
            margin-left: 10px;
            border: 2px solid #fff;
            background-color: #ccc; /* Fallback background color */
        }
    </style>
</head>
<body>
    <div class="header-wrapper">
        <div class="upper-section">
            <nav class="navbar">
                <div class="nav-left">
                    <a href="index.php">Home</a>
                    <a href="searching.php">Search & Filters</a>
                    <a href="cart.php">Cart</a>
                    <a href="faqInterface.php">Help</a>
                </div>
                <div class="nav-right">
                    <?php if (isset($_SESSION['email'])): ?>
                        <a href="profile.php"><?php echo htmlspecialchars($customerName); ?></a>
                        <a href="logout.php">Logout</a>
                        <img src="<?php echo $profilePicture; ?>" alt="User Profile" class="profile-img">
                    <?php else: ?>
                        <a href="login.php">Login</a>
                        <img src="img/user.jpg" alt="User Profile" class="profile-img">
                    <?php endif; ?>
                </div>
            </nav>
        </div>
    </div>

    <div class="content">
        <!-- Your main content here -->
    </div>
</body>
</html>