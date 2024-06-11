<?php
$servername = "localhost";
$username = "root";
$password = "Admin1234%";
$dbname = "apotek";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
