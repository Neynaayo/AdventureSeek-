<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .footer {
            background-color: #f1f1f1;
            padding: 2rem 1rem;
            border-top: 1px solid #ccc;
            margin-top: 2rem;
        }
        .footer-content {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            max-width: 1200px;
            margin: 0 auto;
        }
        .footer-section {
            flex: 1;
            min-width: 200px;
            margin-bottom: 1rem;
        }
        .footer a {
            color: #333;
            text-decoration: none;
            display: block;
            margin-bottom: 0.5rem;
        }
        .footer .social-media {
            display: flex;
            justify-content: center;
            margin-top: 1rem;
        }
        .footer .social-btn {
            margin: 0 0.5rem;
            font-size: 1.5rem;
        }
        .footer .back-to-top {
            display: block;
            text-align: center;
            margin: 1rem 0;
        }
        .footer .copyright {
            text-align: center;
            margin-top: 1rem;
        }
    </style>
</head>
<body>
<div class="footer">
    <div class="footer-content">
        <div class="footer-section">
            <h3>Contact Information</h3>
            <p>Email: contact@adventureseek.com</p>
            <p>Phone: +60 234 567 890</p>
        </div>

        <div class="footer-section">
            <h3>Sitemap</h3>
            <a href="index.php">Home</a>
            <a href="searching.php">Search & Filters</a>
            <a href="cart.php">Cart</a>
            <a href="faqInterface.php">Help</a>
            <a href="profile.php">Profile</a>
        </div>

        <div class="footer-section">
            <h3>Related Documents</h3>
            <a href="legal.php">Privacy Policy</a>
            <a href="legal.php">Terms of Service</a>
        </div>
    </div>

    <a href="#top" class="back-to-top">Back to Top</a>

    <div class="social-media">
        <a href="https://www.facebook.com" target="_blank" class="social-btn facebook">
            <i class="fab fa-facebook-f"></i>
        </a>
        <a href="https://www.twitter.com" target="_blank" class="social-btn twitter">
            <i class="fab fa-twitter"></i>
        </a>
        <a href="https://www.instagram.com" target="_blank" class="social-btn instagram">
            <i class="fab fa-instagram"></i>
        </a>
        <a href="https://www.linkedin.com" target="_blank" class="social-btn linkedin">
            <i class="fab fa-linkedin-in"></i>
        </a>
        <a href="#" target="_blank" class="social-btn envelope">
            <i class="fas fa-envelope"></i>
        </a>
    </div>

    <div class="copyright">
        <p>Authored by: AdventureSeek Team</p>
        <p>&copy; 2024 AdventureSeek. All rights reserved.</p>
    </div>
</div>
</body>
</html>