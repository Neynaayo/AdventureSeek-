
<?php 
session_start();
include 'connectDB.php';

$email = $_POST['email'];
$password = $_POST['password'];

// Query the database to check the user credentials
$sql = "SELECT * FROM customer WHERE CustEmail = '$email'";
$result = mysqli_query($link, $sql);

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        // Verify the hashed password
        if (password_verify($password, $user['CustPassword'])) {
            // Password is correct, set session variables
            $_SESSION['user_id'] = $user['id']; 
            $_SESSION['email'] = $user['CustEmail']; 
            $_SESSION['name'] = $user['CustName'];
            header('Location: profile.php');
            exit;
        } else {
            // Password is incorrect
            echo "<script>alert('Invalid email or password.'); window.location.href = 'login.php';</script>";
        }
    } else {
        // No user found with that email
        echo "<script>alert('Invalid email or password.'); window.location.href = 'login.php';</script>";
    }
} else {
    echo "Error: " . mysqli_error($link);
}

mysqli_close($link);
?>
