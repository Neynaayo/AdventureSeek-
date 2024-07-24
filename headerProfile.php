<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/styleProfile.css">
    <title>Header Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            height: 2000px; /* Added for scrolling demonstration */
        }

        .nav {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
        }

        .menu-button {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: #333;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            box-shadow: 0 2px 10px rgba(0,0,0,0.3);
        }

        .menu-button span {
            width: 25px;
            height: 3px;
            background-color: white;
            margin: 2px 0;
            transition: 0.3s;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            bottom: 60px;
            right: 0;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            border-radius: 5px;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        .show {
            display: block;
        }

        .nav.active .menu-button span:nth-child(1) {
            transform: rotate(-45deg) translate(-5px, 6px);
        }

        .nav.active .menu-button span:nth-child(2) {
            opacity: 0;
        }

        .nav.active .menu-button span:nth-child(3) {
            transform: rotate(45deg) translate(-5px, -6px);
        }
    </style>
</head>
<body>
    <nav class="nav" id="nav">
        <div class="menu-button" id="menuButton">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <div class="dropdown-content" id="dropdownContent">
            <a href="profile.php">Profile</a>
            <a href="updateProfile.php">Update Profile</a>
            <a href="review.php">Review</a>
            <a href="deleteAcc.php">Delete Account</a>
        </div>
    </nav>

    <script>
        const navbar = document.getElementById('nav');
        const menuButton = document.getElementById('menuButton');
        const dropdownContent = document.getElementById('dropdownContent');

        menuButton.addEventListener('click', function() {
            navbar.classList.toggle('active');
            dropdownContent.classList.toggle('show');
        });

        // Close the dropdown if the user clicks outside of it
        window.addEventListener('click', function(event) {
            if (!navbar.contains(event.target)) {
                navbar.classList.remove('active');
                dropdownContent.classList.remove('show');
            }
        });
    </script>
</body>
</html>