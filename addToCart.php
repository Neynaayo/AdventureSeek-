<?php
session_start();
include 'connectDB.php';

if (isset($_POST['activity']) && isset($_SESSION['email'])) {
    $activity = $_POST['activity'];
    $custEmail = $_SESSION['email'];
    $currentDate = date('Y-m-d');
    $currentTime = date('H:i:s');

    // Fetch activity details from the database
    $sql = "SELECT a.ActivityName, a.ActivityDescription, a.PriceChild, a.PriceAdult, l.pic
            FROM activity a
            INNER JOIN location l ON a.LocationID = l.LocationID
            WHERE a.ActivityName = '$activity'";
    $result = mysqli_query($link, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Add activity to the cart table
        $sql = "INSERT INTO cart (ActivityName, ActivityPicture, PriceAdult, PriceChild, CustEmail, cartDate, cartTime)
                VALUES ('$row[ActivityName]', '$row[pic]', '$row[PriceAdult]', '$row[PriceChild]', '$custEmail', '$currentDate', '$currentTime')";
        if (mysqli_query($link, $sql)) {
            echo 'success';
        } else {
            echo 'error';
        }
    } else {
        echo 'error';
    }

    mysqli_close($link); // Close the database connection
} else {
    echo 'error';
}
?>
