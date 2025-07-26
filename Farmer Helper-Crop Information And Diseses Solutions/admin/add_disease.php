<?php
include('partials/dash-header.php');
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "farm";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $symptoms = $_POST['symptoms'];
    $solution_id = $_POST['solution_id'];

    // Insert data into the database
    $stmt = $conn->prepare("INSERT INTO diseases (name, symptoms, solution_id) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $name, $symptoms, $solution_id);
    
    if ($stmt->execute()) {
        echo "<script>alert('Disease Added Successfully!'); window.location.href='manage_diseases.php';</script>";
    } else {
        echo "<script>alert('Error Adding Disease!');</script>";
    }
    
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Disease</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Add New Disease</h2>
        <form method="POST" class="mt-4">
            <div class="mb-3">
                <label for="name" class="form-label">Disease Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="symptoms" class="form-label">Symptoms</label>
                <textarea name="symptoms" id="symptoms" class="form-control" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="solution_id" class="form-label">Solution ID</label>
                <input type="number" name="solution_id" id="solution_id" class="form-control" required>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-success">Add Disease</button>
                <a href="manage_diseases.php" class="btn btn-secondary">Back</a>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
