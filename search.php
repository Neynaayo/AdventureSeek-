<?php
require 'connectDB.php';

$message = '';



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['addActivity'])) {
        // Handle form data
        $activityName = $_POST['activityName'];
        $activityDescription = $_POST['activityDescription'];
        $priceChild = $_POST['priceChild'];
        $priceAdult = $_POST['priceAdult'];
        $locationName = $_POST['locationName'];
        $sportType = $_POST['sportType'];
        
        // Handle file upload
        $pic = $_FILES['pic']['name'];
        $target_dir = "img/";
        $target_file = $target_dir . basename($pic);
        move_uploaded_file($_FILES['pic']['tmp_name'], $target_file);

        // Insert into location table
        $insertLocationSQL = "INSERT INTO location (LocationName, SportType, pic) VALUES (?, ?, ?)";
        $insertLocationStmt = $link->prepare($insertLocationSQL);
        $insertLocationStmt->bind_param('sss', $locationName, $sportType, $pic);
        
        if ($insertLocationStmt->execute()) {
            // Get the last inserted LocationID
            $locationID = $link->insert_id;

            // Insert into activity table
            $insertActivitySQL = "INSERT INTO activity (ActivityName, ActivityDescription, PriceChild, PriceAdult, LocationID) VALUES (?, ?, ?, ?, ?)";
            $insertActivityStmt = $link->prepare($insertActivitySQL);
            $insertActivityStmt->bind_param('ssddi', $activityName, $activityDescription, $priceChild, $priceAdult, $locationID);
            
            if ($insertActivityStmt->execute()) {
                $message = "Activity and Location added successfully.";
            } else {
                $message = "Error adding activity: " . $link->error;
            }
        } else {
            $message = "Error adding location: " . $link->error;
        }
    } elseif (isset($_POST['deleteActivityID'])) {
        // Handle delete activity and location
        $activityID = $_POST['deleteActivityID'];

        // Get the LocationID associated with the activity
        $selectLocationSQL = "SELECT LocationID FROM activity WHERE ActivityID = ?";
        $selectLocationStmt = $link->prepare($selectLocationSQL);
        $selectLocationStmt->bind_param('i', $activityID);
        $selectLocationStmt->execute();
        $result = $selectLocationStmt->get_result();
        $row = $result->fetch_assoc();
        $locationID = $row['LocationID'];

        // Delete the activity first
        $deleteActivitySQL = "DELETE FROM activity WHERE ActivityID = ?";
        $deleteActivityStmt = $link->prepare($deleteActivitySQL);
        $deleteActivityStmt->bind_param('i', $activityID);

        if ($deleteActivityStmt->execute()) {
            // Delete the location after deleting the activity
            $deleteLocationSQL = "DELETE FROM location WHERE LocationID = ?";
            $deleteLocationStmt = $link->prepare($deleteLocationSQL);
            $deleteLocationStmt->bind_param('i', $locationID);

            if ($deleteLocationStmt->execute()) {
                $message = "Activity and Location deleted successfully.";
            } else {
                $message = "Error deleting location: " . $link->error;
            }
        } else {
            $message = "Error deleting activity: " . $link->error;
        }
    } elseif (isset($_POST['editActivityID'])) {
        // Handle edit activity
        $activityID = $_POST['editActivityID'];
        $activityName = $_POST['editActivityName'];
        $activityDescription = $_POST['editActivityDescription'];
        $priceChild = $_POST['editPriceChild'];
        $priceAdult = $_POST['editPriceAdult'];

        $updateActivitySQL = "UPDATE activity SET ActivityName = ?, ActivityDescription = ?, PriceChild = ?, PriceAdult = ? WHERE ActivityID = ?";
        $updateActivityStmt = $link->prepare($updateActivitySQL);
        $updateActivityStmt->bind_param('ssddi', $activityName, $activityDescription, $priceChild, $priceAdult, $activityID);

        if ($updateActivityStmt->execute()) {
            $message = "Activity updated successfully.";
        } else {
            $message = "Error updating activity: " . $link->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Activities</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .form-container {
            margin-bottom: 20px;
        }

        .form-container input,
        .form-container select,
        .form-container textarea {
            margin-bottom: 10px;
            padding: 10px;
            width: 100%;
            box-sizing: border-box;
        }
        
        .form-container button {
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f0f0f0;
            font-weight: bold;
        }

        td img {
            max-width: 50px;
            height: 50px;
            margin-right: 10px;
        }

        .no-results {
            text-align: center;
            margin-top: 20px;
            color: #666;
        }

        button {
            padding: 5px 10px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .back-button {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #007BFF;
            color: #fff;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            width: fit-content;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Manage Activities</h2>
    
    <!-- Add Activity Form -->
    <div class="form-container">
        <h3>Add New Activity and Location</h3>
        <?php if (!empty($message)) { echo "<p>$message</p>"; } ?>
        <form id="addActivityForm" method="post" action="" enctype="multipart/form-data">
            <input type="text" name="activityName" placeholder="Activity Name" required>
            <textarea name="activityDescription" placeholder="Activity Description" required></textarea>
            <input type="number" name="priceChild" placeholder="Price for Children" required>
            <input type="number" name="priceAdult" placeholder="Price for Adults" required>
            <input type="text" name="locationName" placeholder="Location Name" required>
            <input type="text" name="sportType" placeholder="Sport Type" required>
            <input type="file" name="pic" accept="image/*" required>
            <button type="submit" name="addActivity">Add Activity and Location</button>
        </form>
    </div>

    <!-- Existing Activities Table -->

    
    <?php
    $sql = "SELECT a.ActivityID, a.ActivityName, a.ActivityDescription, a.PriceChild, a.PriceAdult, l.SportType, l.pic
            FROM activity a
            JOIN location l ON a.LocationID = l.LocationID";
    $result = $link->query($sql);

    //to call search id sport type from admin edit activities
    if (isset($_POST['sportType'])) {
        $sportType = $_POST['sportType'];
        $sql = "SELECT a.ActivityID, a.ActivityName, a.ActivityDescription, a.PriceChild, a.PriceAdult, l.SportType, l.pic
                FROM activity a
                JOIN location l ON a.LocationID = l.LocationID
                WHERE l.SportType = ?";
        $stmt = $link->prepare($sql);
        $stmt->bind_param('s', $sportType);
        $stmt->execute();
        $result = $stmt->get_result();
    

    if ($result->num_rows > 0) {
        echo "<div class='container'>";
        echo "<h2>Existing Activities:</h2>";
        echo "<table>";
        echo "<thead>
                <tr>
                    <th>Activities Picture & Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Activities Type</th>
                    <th>Action</th>
                </tr>
              </thead>";
        echo "<tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td><img src='img/" . htmlspecialchars($row['pic']) . "' alt='" . htmlspecialchars($row['ActivityName']) . "'><strong>" . htmlspecialchars($row['ActivityName']) . "</strong></td>";
            echo "<td>" . htmlspecialchars($row['ActivityDescription']) . "</td>";
            echo "<td>Child: RM" . htmlspecialchars($row['PriceChild']) . "<br>Adult: RM" . htmlspecialchars($row['PriceAdult']) . "</td>";
            echo "<td>" . htmlspecialchars($row['SportType']) . "</td>";
            echo "<td>
                    <button onclick='editActivity(" . htmlspecialchars($row['ActivityID']) . ")'>Edit</button>
                    <button onclick='deleteActivity(" . htmlspecialchars($row['ActivityID']) . ")'>Delete</button>
                  </td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
        echo "</div>";
    } else {
        echo "<div class='no-results'>No activities found.</p></div>";
    }}
    ?>

    <!-- Edit Activity Form (Hidden by default) -->
    <div class="form-container" id="editActivityForm" style="display: none;">
        <h3>Edit Activity</h3>
        <form method="post" action="">
            <input type="hidden" name="editActivityID" id="editActivityID">
            <input type="text" name="editActivityName" id="editActivityName" placeholder="Activity Name" required>
            <textarea name="editActivityDescription" id="editActivityDescription" placeholder="Activity Description" required></textarea>
            <input type="number" name="editPriceChild" id="editPriceChild" placeholder="Price for Children" required>
            <input type="number" name="editPriceAdult" id="editPriceAdult" placeholder="Price for Adults" required>
            <button type="submit">Save Changes</button>
        </form>
    </div>
</div>
<a href="adminHome.php" class="back-button">Back to Edit Activities</a>

<script>
function deleteActivity(activityID) {
    if (confirm('Are you sure you want to delete this activity?')) {
        const form = document.createElement('form');
        form.method = 'post';
        form.action = '';
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'deleteActivityID';
        input.value = activityID;
        form.appendChild(input);
        document.body.appendChild(form);
        form.submit();
    }
}

function editActivity(activityID) {
    const row = document.querySelector(`tr td button[onclick="editActivity(${activityID})"]`).closest('tr');
    const activityName = row.children[0].textContent.trim();
    const activityDescription = row.children[1].textContent.trim();
    const priceChild = row.children[2].textContent.match(/Child: RM(\d+)/)[1];
    const priceAdult = row.children[2].textContent.match(/Adult: RM(\d+)/)[1];

    document.getElementById('editActivityID').value = activityID;
    document.getElementById('editActivityName').value = activityName;
    document.getElementById('editActivityDescription').value = activityDescription;
    document.getElementById('editPriceChild').value = priceChild;
    document.getElementById('editPriceAdult').value = priceAdult;

    document.getElementById('editActivityForm').style.display = 'block';
}
</script>
</body>
</html>
