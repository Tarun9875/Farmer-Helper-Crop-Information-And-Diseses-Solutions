<?php
// Database Connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "farm"; // Your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch Crops Data
$crops = [];
$result = $conn->query("SELECT * FROM crops");
while ($row = $result->fetch_assoc()) {
    $crops[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crop List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h1 class="text-center text-primary mb-4">Crop List</h1>

    <table class="table table-bordered table-hover">
        <thead class="table-primary">
            <tr>
                <th>Crop ID</th>
                <th>Name</th>
                <th>Type</th>
                <th>Ideal Condition</th>
                <th>Growth Duration</th>
                <th>Crop Image</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($crops as $crop): ?>
                <tr>
                    <td><?= htmlspecialchars($crop['crop_id']) ?></td>
                    <td><?= htmlspecialchars($crop['name']) ?></td>
                    <td><?= htmlspecialchars($crop['type']) ?></td>
                    <td><?= htmlspecialchars($crop['ideal_condition']) ?></td>
                    <td><?= htmlspecialchars($crop['growth_duration']) ?></td>
                    <td><img src="<?= htmlspecialchars($crop['image']) ?>" alt="Crop Image" class="img-thumbnail" style="width: 80px; height: 80px;"></td>
                    <td><?= htmlspecialchars($crop['description']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php $conn->close(); ?>