<?php
// Session and database connection code remains here
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include 'connectDB.php';
if (!isset($_SESSION['email'])) {
  header("Location: adminLogin.php");
  exit();
}
$name = $_SESSION['name'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AdventureSeek Admin Panel</title>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div class="container">
    <header class="top-bar">
      <!--<span class="menu-icon" id="menuToggle" onclick="toggleSidebar(event)">&#9776;</span> NAVIGATION ICON-->
    <h1>AdventureSeek Admin Panel</h1>
    </header>
    <aside class="sidebar" id="sidebar">
      <div class="admin-info">
        <img src="https://i.ibb.co/VtQ16Y0/image-removebg-preview-5.png" alt="Admin Icon" class="admin-icon">
        <p>Hello, <?php echo htmlspecialchars($name); ?></p>
      </div>
      <nav>
        <ul class="sidebar-list">
          <li class="sidebar-list-item" id="dashboard-link" onclick="showPage('dashboard')">
            <span class="material-icons-outlined">dashboard</span> Dashboard
          </li>
          <li class="sidebar-list-item" id="edit-activities-link" onclick="showPage('edit-activities')">
            <span class="material-icons-outlined">edit</span> Edit Activities
          </li>
          <li class="sidebar-list-item" id="bookings-link" onclick="showPage('bookings')">
            <span class="material-icons-outlined">calendar_today</span> Bookings
          </li>
          <li class="sidebar-list-item" id="profile-logout-link" onclick="showPage('profile-logout')">
            <span class="material-icons-outlined">person</span> Profile
          </li>
        </ul>
      </nav>
    </aside>
    <main class="content" id="main-content">
      <?php
      $page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
      
      if ($page == 'dashboard') {
        echo '<section id="dashboard" class="page">';
        echo '<h2>Dashboard</h2>';
        echo '<p>Welcome to the Dashboard!</p>';
        echo '</section>';
      } else {
        switch($page) {
          case 'edit-activities':
            include 'adminEditActivities.php';
            break;
          case 'bookings':
            include 'adminBooking.php';
            break;
          case 'profile-logout':
            include 'adminProfile.php';
            break;
        }
      }
      ?>
    </main>
  </div>
  <div id="overlay" onclick="toggleSidebar()"></div>
    <script src="script.js"></script>
</body>
</html>
