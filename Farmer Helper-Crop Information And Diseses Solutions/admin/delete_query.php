<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "farm";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($query_id > 0) {
    $delete_query = "DELETE FROM farmer_queries WHERE query_id = ?";
    $stmt = $conn->prepare($delete_query);
    $stmt->bind_param("i", $query_id);

    if ($stmt->execute()) {
        echo "<script>alert('Query deleted successfully!'); window.location.href='admin_queries.php';</script>";
        exit();
    } else {
        echo "<script>alert('Error deleting query: " . $stmt->error . "');</script>";
    }
}

$stmt->close();
$conn->close();
?>
