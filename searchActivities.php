<?php
include 'connectDB.php'; // Ensure this file includes your database connection code

$sportTypeSearch = $_GET['sportTypeSearch']; // Assuming using GET method
$locationSearch = $_GET['locationSearch']; // Assuming using GET method

// Construct SQL query to fetch activities based on search criteria
$sql = "SELECT a.ActivityName, a.ActivityDescription, a.PriceChild, a.PriceAdult, l.SportType, l.LocationName, l.pic
        FROM activity a
        INNER JOIN location l ON a.LocationID = l.LocationID
        WHERE (l.SportType LIKE '%$sportTypeSearch%' OR '$sportTypeSearch' = '')
        AND (l.LocationName LIKE '%$locationSearch%' OR '$locationSearch' = '')";

$result = mysqli_query($link, $sql);

$activities = [];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $activities[] = $row;
    }
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($activities);
?>
