<?php 
// Connection to MySQL
$host = "localhost";
$username = "root";
$password = "";
$database = "adventureseek";

// Create connection
$link = mysqli_connect($host, $username, $password, $database);

// Check connection
if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
