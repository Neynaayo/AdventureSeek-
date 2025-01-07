<?php
session_start();
include 'connectDB.php';
include 'header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search & Filters</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Open+Sans:wght@400;600&display=swap');
        body {
            font-family: 'Open Sans', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .search-filters {
            background-color: white;
            padding: 40px 20px;
            text-align: center;
            margin-bottom: 30px;
        }
        .search-filters h1 {
            margin-bottom: 20px;
            color: #333;
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
        }
        .search-filters input {
            padding: 10px;
            margin: 0 10px;
            width: 300px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-family: 'Open Sans', sans-serif;
        }
        .search-filters button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
            font-family: 'Open Sans', sans-serif;
        }
        .search-filters button:hover {
            background-color: #0056b3;
        }
        #activities-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        .activity {
            display: flex;
            background-color: white;
            margin-bottom: 30px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            border-radius: 8px;
            overflow: hidden;
        }
        .activity-image {
            flex: 1;
            max-width: 50%;
            background-size: cover;
            background-position: center;
        }
        .activity-info {
            flex: 1;
            padding: 20px;
        }
        .activity-info h3 {
            margin-top: 0;
            color: #333;
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
        }
        .activity-info p {
            color: #666;
            margin-bottom: 10px;
            font-family: 'Open Sans', sans-serif;
            font-size: 1rem;
        }
        .activity-info button {
            padding: 10px 15px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
            font-family: 'Open Sans', sans-serif;
        }
        .activity-info button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <section class="search-filters">
        <h1>Find Your Adventure</h1>
        <input type="text" id="SportType-search" list="activities" placeholder="Search for activities ...">
        <input type="text" id="location-search" list="locations" placeholder="Search for locations...">
        <button onclick="searchActivities()">Search</button>
    </section>

    <div id="activities-container">
        <h2>Trending Activities</h2>
        <?php
        // Check if a specific location or activity is requested
        $locationID = isset($_GET['location']) ? $_GET['location'] : '';
        $activityID = isset($_GET['activity']) ? $_GET['activity'] : '';

        // Modify the SQL query based on the request
        if ($locationID) {
            $sql = "SELECT a.ActivityName, a.ActivityDescription, a.PriceChild, a.PriceAdult, l.SportType, l.LocationName, l.pic
                    FROM activity a
                    INNER JOIN location l ON a.LocationID = l.LocationID
                    WHERE l.LocationID = ?";
            $stmt = $link->prepare($sql);
            $stmt->bind_param('i', $locationID);
        } elseif ($activityID) {
            $sql = "SELECT a.ActivityName, a.ActivityDescription, a.PriceChild, a.PriceAdult, l.SportType, l.LocationName, l.pic
                    FROM activity a
                    INNER JOIN location l ON a.LocationID = l.LocationID
                    WHERE a.ActivityID = ?";
            $stmt = $link->prepare($sql);
            $stmt->bind_param('i', $activityID);
        } else {
            $sql = "SELECT a.ActivityName, a.ActivityDescription, a.PriceChild, a.PriceAdult, l.SportType, l.LocationName, l.pic
                    FROM activity a
                    INNER JOIN location l ON a.LocationID = l.LocationID";
            $stmt = $link->prepare($sql);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='activity'>";
                echo "<div class='activity-image' style='background-image: url(\"img/{$row['pic']}\");'></div>";
                echo "<div class='activity-info'>";
                echo "<h3>{$row['ActivityName']}</h3>";
                echo "<p>{$row['ActivityDescription']}</p>";
                echo "<p>Price (Child): RM{$row['PriceChild']}</p>";
                echo "<p>Price (Adult): RM{$row['PriceAdult']}</p>";
                echo "<p>Location: {$row['LocationName']}</p>";
                echo "<p>Sport Type: {$row['SportType']}</p>";
                echo "<button onclick=\"addToCart('{$row['ActivityName']}')\">";
                echo "<i class='fas fa-cart-plus'></i> Add to Cart";
                echo "</button>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<p>No activities found.</p>";
        }
        $stmt->close();
        mysqli_close($link);
        ?>
    </div>

    <?php include 'footer.php'; ?>

    <script src="scripts.js"></script>
</body>
</html>
