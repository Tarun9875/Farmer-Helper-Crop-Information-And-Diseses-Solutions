<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "farm";

$conn = new mysqli($servername, $username, $password, $dbname);
$result = $conn->query("SELECT * FROM crops");

while ($row = $result->fetch_assoc()) {
    echo "<div><h3>{$row['name']}</h3><img src='{$row['image']}' style='width:100px'><p>{$row['description']}</p></div>";
}

$conn->close();
?>
