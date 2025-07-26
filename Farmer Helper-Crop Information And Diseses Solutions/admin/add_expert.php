<?php

include('partials/dash-header.php');
// Database Connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "farm";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Database Connection Failed: " . $conn->connect_error]));
}

// Handle Adding an Expert
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $specialization = isset($_POST['specialization']) ? trim($_POST['specialization']) : '';
    $contact_info = isset($_POST['contact_info']) ? trim($_POST['contact_info']) : '';

    if (empty($name) || empty($specialization) || empty($contact_info)) {
        echo json_encode(["success" => false, "message" => "All fields are required."]);
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO experts (name, specialization, contact_info) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $specialization, $contact_info);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Expert added successfully"]);
    } else {
        echo json_encode(["success" => false, "message" => "Error: " . $stmt->error]);
    }
    $stmt->close();
}
$conn->close();
?>
