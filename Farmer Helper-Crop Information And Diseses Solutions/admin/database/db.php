<?php
$host = "localhost";
$user = "root"; // Change if needed
$pass = ""; // Change if needed
$dbname = "farm";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
