<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "farm";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch solutions from the database
$solutions = [];
$sql = "SELECT * FROM solutions";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $solutions[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crop Solutions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container my-4">
    <h1 class="mb-4">Crop Solutions</h1>
    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>Solution ID</th>
                <th>Pesticides</th>
                <th>Remedies</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($solutions)): ?>
                <?php foreach ($solutions as $solution): ?>
                    <tr>
                        <td><?= $solution['id'] ?></td>
                        <td><?= $solution['pesticides'] ?></td>
                        <td><?= $solution['remedies'] ?></td>
                        <td><?= $solution['description'] ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" class="text-center">No solutions available</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php $conn->close(); ?>