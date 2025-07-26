<?php
// Database connection
$servername = "localhost"; // Change if needed
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$database = "farm"; // Your database name

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the database
$sql = "SELECT * FROM diseases";
$result = $conn->query($sql);

$diseases = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $diseases[] = $row;
    }
}

// Return JSON data
echo json_encode($diseases);

$conn->close();
?>
