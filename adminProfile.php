
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include 'connectDB.php';

    if (!isset($_SESSION['email'])) {
        header("Location: adminLogin.php");
        exit();
    }

    $email = $_SESSION['email'];
    $sql = "SELECT * FROM admin WHERE AdminEmail = ?";
    $stmt = $link->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $admin = $result->fetch_assoc();
    $name = $admin['AdminName'];

    //edit profile
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = trim($_POST['name']);
        $email = $_SESSION['email'];
        
        $sql = "UPDATE admin SET AdminName = ? WHERE AdminEmail = ?";
        $stmt = $link->prepare($sql);
        $stmt->bind_param("ss", $name, $email);
        if ($stmt->execute()) {
            $_SESSION['name'] = $name;
            header("Location: adminProfile.php");
        } else {
            echo "Error updating profile.";
        }
    }

        //Change password

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $currentPassword = trim($_POST['current-password']);
            $newPassword = trim($_POST['new-password']);
            $confirmPassword = trim($_POST['confirm-password']);
            $email = $_SESSION['email'];

            if ($newPassword === $confirmPassword) {
                $sql = "SELECT AdminPassword FROM admin WHERE AdminEmail = ?";
                $stmt = $link->prepare($sql);
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $result = $stmt->get_result();
                $admin = $result->fetch_assoc();

                if (password_verify($currentPassword, $admin['AdminPassword'])) {
                    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                    $sql = "UPDATE admin SET AdminPassword = ? WHERE AdminEmail = ?";
                    $stmt = $link->prepare($sql);
                    $stmt->bind_param("ss", $hashedPassword, $email);
                    if ($stmt->execute()) {
                        header("Location: adminProfile.php");
                    } else {
                        echo "Error updating password.";
                    }
                } else {
                    echo "Current password is incorrect.";
                }
            } else {
                echo "New passwords do not match.";
            }
        }

        ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<section id="profile-logout" class="page">
  <div class="profile-container">
    <div class="profile-details">
      <h3>Edit Profile</h3>
      <form action="adminProfile.php" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>">
        <button type="submit" class="save-btn">Save Profile</button>
      </form>
    </div>
    <div class="change-password">
      <h3>Change Password</h3>
      <form action="adminProfile.php" method="post">
        <label for="current-password">Current Password:</label>
        <input type="password" id="current-password" name="current-password" required>
        <label for="new-password">New Password:</label>
        <input type="password" id="new-password" name="new-password" required>
        <label for="confirm-password">Confirm New Password:</label>
        <input type="password" id="confirm-password" name="confirm-password" required>
        <button type="submit" class="save-btn">Change Password</button>
      </form>
    </div>
    <div class="logout">
      <h3>Logout</h3>
      <p>Are you sure you want to log out?</p>
      <action="logout.php" method="post">
      <a href="logout.php"><button type="submit" class="save-btn" id="confirm-logout">Yes, log out</button></a>
        <a href="adminHome.php"><button type="button" class="save-btn" id="cancel-logout" onclick="showPage('dashboard')">No, go to dashboard</button></a>
      </form>
    </div>
  </div>
</section>
</body>
</html>
