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

// Fetch query details
$query = "SELECT * FROM farmer_queries WHERE query_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $query_id);
$stmt->execute();
$result = $stmt->get_result();
$query_data = $result->fetch_assoc();

if (!$query_data) {
    die("Query not found.");
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $diagnosis_status = isset($_POST['diagnosis_status']) ? trim($_POST['diagnosis_status']) : '';

    if (!empty($diagnosis_status)) {
        $update_query = "UPDATE farmer_queries SET diagnosis_status = ? WHERE query_id = ?";
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param("si", $diagnosis_status, $query_id);

        if ($stmt->execute()) {
            echo "<script>alert('Diagnosis status updated successfully!'); window.location.href='admin_queries.php';</script>";
            exit();
        } else {
            echo "<script>alert('Error updating status: " . $stmt->error . "');</script>";
        }
    }
}

$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Query</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Edit Query</h2>
        <div class="card p-4 shadow-sm">
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Query Description</label>
                    <textarea class="form-control" rows="4" readonly><?= htmlspecialchars($query_data['description']) ?></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Diagnosis Status</label>
                    <select class="form-select" name="diagnosis_status" required>
                        <option value="Pending" <?= $query_data['diagnosis_status'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
                        <option value="In Progress" <?= $query_data['diagnosis_status'] == 'In Progress' ? 'selected' : '' ?>>In Progress</option>
                        <option value="Completed" <?= $query_data['diagnosis_status'] == 'Completed' ? 'selected' : '' ?>>Completed</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="admin_queries.php" class="btn btn-secondary">Back</a>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php $conn->close(); ?>
