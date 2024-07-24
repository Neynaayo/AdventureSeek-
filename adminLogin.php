<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="styleAdminLogin.css"> <!-- Link to an external CSS file for cleaner structure -->
</head>
<body>
    <div class="container">
        <form class="form" action="adminloginProcess.php" method="POST">
            <div class="title-2"><span>ADMIN</span></div>
            <div class="title-2"><span>SPACE</span></div>
            <div class="input-container">
                <input class="input-mail" type="email" name="email" placeholder="Enter email" required>
            </div>

            <section class="bg-stars">
                <span class="star"></span>
                <span class="star"></span>
                <span class="star"></span>
                <span class="star"></span>
            </section>

            <div class="input-container">
                <input class="input-pwd" type="password" name="password" placeholder="Enter password" required>
            </div>
            <button type="submit" class="submit">
                <span class="sign-text">Sign in</span>
            </button>

        </form>
    </div>
</body>
</html>
