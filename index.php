<?php 
// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include 'connectDB.php';
include 'header.php';

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
    <title>Adventure Website</title>
    <link rel="stylesheet" href="styling.css">
    <style> 
         /* Hero section styles */
         .hero-section {
        position: relative;
        height: 100vh;
        background-image: url('img/bgHome.jpg'); 
        background-size: cover;
        background-position: center;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: white;
    }

    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5); 
    }

    .hero-content {
        position: relative;
        z-index: 1;
        max-width: 800px;
        padding: 20px;
    }

    .hero-section h1 {
        font-size: 3.5rem;
        margin-bottom: 20px;
    }

    .hero-section p {
        font-size: 1.2rem;
        margin-bottom: 30px;
    } 
    

    .cta-button {
        display: inline-block;
        padding: 12px 24px;
        background-color: #15832b; 
        color: white;
        text-decoration: none;
        font-size: 1.1rem;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .cta-button:hover {
        background-color: #e65c00;
    }
     /* Trending activities styles */
     .trending-activities {
            padding: 50px 20px;
            background-color: #f9f9f9;
            
        }

        .trending-activities h2 {
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 40px;
        }

        .activity-section {
            margin-bottom: 40px;
        }

        .activity-title {
            font-size: 1.5rem;
            margin-bottom: 20px;
            text-align: center;
        }

        .activity-group {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        .activity {
            position: relative;
            width: 300px;
            height: 400px;
            margin: 20px;
            overflow: hidden;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .activity img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .activity-info {
            position: absolute;
            bottom: 0;
            width: 100%;
            background: rgba(0, 0, 0, 0.5);
            color: white;
            text-align: center;
            padding: 10px 0;
        }

        .activity-info h3 {
            margin: 0;
            font-size: 1.2rem;
        }
        /*Video for index*/
        .video-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
        }

        .video-overlay h2 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        .video-overlay p {
            font-size: 1.2rem;
        }

    </style>
</head>
<body>
<?php
// Fetch all unique locations along with associated images from the database
$sql = "SELECT LocationID, SportType, LocationName, pic FROM location ORDER BY SportType";
$result = $link->query($sql);
$locations = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $locations[$row['SportType']][] = $row; // Group by SportType
    }
}
?> 
        
    <div class="hero-section">
        <div class="hero-content">
            <h1>Start your endless journey with us<br><?php echo htmlspecialchars($customerName); ?></h1>
            <p>Born out of wild countryside and a desire for informed luxury travel, Exotic Hill is a chic destination resort for unique, responsible holidaying.</p>
            <a href="searching.php" class="cta-button">Explore Now</a>
        </div>
    </div>

    <section class="video-teaser">
    <video id="teaser-video" autoplay loop playsinline>
        <source src="vid/AdventureSeekVideo.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <div class="video-overlay">
        <h2>Experience Adventure</h2>
        <p>Discover the thrill of our activities</p>
        <button id="mute-toggle" class="mute-button">Mute</button>
    </div>
</section>

    <!-- Trending Activities -->
    <section class="trending-activities">
        <h2>What We Offer</h2>
        <?php foreach ($locations as $sportType => $locationGroup): ?>
            <div class="activity-section">
                <h3 class="activity-title"><?php echo $sportType; ?></h3>
                <div class="activity-group">
                    <?php foreach ($locationGroup as $location): ?>
                        <div class="activity">
                            <img src="img/<?php echo $location['pic']; ?>" alt="<?php echo $location['SportType']; ?>">
                            <div class="activity-info">
                                <h3><?php echo $location['LocationName']; ?></h3>
                                <a href="searching.php?location=<?php echo $location['LocationID']; ?>" class="activity-link">→</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </section>

            <!--For Testimonial section-->
            <?php
                // Fetch reviews with customer information
            $reviewSql = "SELECT r.ReviewText, r.ReviewRating, r.ActivityName, c.CustName, c.CustPic 
                        FROM review r 
                        JOIN customer c ON r.CustEmail = c.CustEmail 
                        ORDER BY r.ReviewDateTime DESC 
                        LIMIT 5"; // Limit to 5 most recent reviews
            $reviewResult = $link->query($reviewSql);
            $reviews = [];
            if ($reviewResult->num_rows > 0) {
                while ($row = $reviewResult->fetch_assoc()) {
                    $reviews[] = $row;
                }
            }?>

    <!-- User Testimonials -->
        <section class="testimonials">
            <h2>User Testimonials</h2>
            <div class="testimonial-container">
                <?php foreach ($reviews as $review): ?>
                    <div class="testimonial">
                        <img src="img/<?php echo htmlspecialchars($review['CustPic']); ?>" alt="<?php echo htmlspecialchars($review['CustName']); ?>">
                        <div class="testimonial-info">
                            <h3><?php echo htmlspecialchars($review['CustName']); ?></h3>
                            <div class="rating">
                                <?php
                                for ($i = 1; $i <= 5; $i++) {
                                    if ($i <= $review['ReviewRating']) {
                                        echo '<span class="star filled">★</span>';
                                    } else {
                                        echo '<span class="star">☆</span>';
                                    }
                                }
                                ?>
                            </div>
                            <p><?php echo htmlspecialchars($review['ReviewText']); ?></p>
                            <small>Activity: <?php echo htmlspecialchars($review['ActivityName']); ?></small>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

    <script>
        const isLoggedIn = <?php echo isset($_SESSION['email']) ? 'true' : 'false'; ?>;

        function redirectToSearch(locationID) {
            window.location.href = 'searching.php?location=' + locationID;
        }
        function redirectToActivity(activityID) {
            window.location.href = 'searching.php?activity=' + activityID;
        }

        //mute video function
        document.addEventListener('DOMContentLoaded', function() {
        var video = document.getElementById('teaser-video');
        var muteToggle = document.getElementById('mute-toggle');

            // Start with sound on
            video.muted = false;

            // Try to play the video
            var playPromise = video.play();

            if (playPromise !== undefined) {
                playPromise.then(_ => {
                    // Autoplay started
                    console.log("Video autoplay started");
                }).catch(error => {
                    // Autoplay was prevented
                    console.log("Video autoplay prevented");
                    video.muted = true;
                    video.play();
                });
            }

            muteToggle.addEventListener('click', function() {
                if (video.muted) {
                    video.muted = false;
                    muteToggle.textContent = 'Mute';
                } else {
                    video.muted = true;
                    muteToggle.textContent = 'Unmute';
                }
            });
        });
    </script>
    <script src="scripts.js"></script>

    <?php include 'footer.php'; ?>
</body>
</html>
