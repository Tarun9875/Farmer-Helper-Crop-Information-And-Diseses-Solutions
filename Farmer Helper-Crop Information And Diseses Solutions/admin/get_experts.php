<?php
// Database Connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "farm";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Database Connection Failed: " . $conn->connect_error]));
}

// Fetch Experts
$query = "SELECT * FROM experts ORDER BY expert_id DESC";
$result = $conn->query($query);

$experts = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $experts[] = $row;
    }
}
echo json_encode($experts);
$conn->close();
?>
