<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="stylesignUp.css">
</head>
<body>
    <div class="container">
        <h1>Hello Traveler! Welcome Back!</h1>
        <div class="form-container">
            <h2>LOG IN</h2>
            <form action="loginProcess.php" method="post">
                <div class="form-group">
                    <label for="email">EMAIL ADDRESS</label>
                    <div class="input-group">
                        <i class="fa fa-envelope"></i>
                        <input type="email" id="email" name="email" placeholder="johndoe@gmail.com" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">PASSWORD</label>
                    <div class="input-group">
                        <i class="fa fa-lock"></i>
                        <input type="password" id="password" name="password" placeholder="Password" required>
                        <i class="fa fa-eye" id="toggle-password"></i>
                    </div>
                </div>
                <button type="submit" class="btn">Log In</button>
            </form>
            <p>Don't have an account? <a href="signup.php">Join us heree!</a></p>
            <p>Log in as Admin <a href="adminLogIn.php">Admin area</a></p>
        </div>
    </div>

    <script>
    const passwordInput = document.getElementById('password');
    const togglePassword = document.getElementById('toggle-password');
    const confirmPasswordInput = document.getElementById('confirm-password');
    const toggleConfirmPassword = document.getElementById('toggle-confirm-password');

    togglePassword.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.classList.toggle('fa-eye-slash');
    });

    toggleConfirmPassword.addEventListener('click', function() {
        const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        confirmPasswordInput.setAttribute('type', type);
        this.classList.toggle('fa-eye-slash');
    });
    </script>

    <!-- Font Awesome icons -->
    <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" data-auto-replace-svg="nest"></script>
</body>
</html>