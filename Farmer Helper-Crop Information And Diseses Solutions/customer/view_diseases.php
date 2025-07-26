<?php
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

// Fetch all diseases
$sql = "SELECT diseases.disease_id, diseases.name, diseases.symptoms, solutions.description AS solution 
        FROM diseases 
        LEFT JOIN solutions ON diseases.solution_id = solutions.solution_id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Diseases</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Crop Diseases and Solutions</h2>
        <table class="table table-bordered table-hover mt-4">
            <thead class="table-success">
                <tr>
                    <th>Disease Name</th>
                    <th>Symptoms</th>
                    <th>Solution</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['symptoms']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['solution']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3' class='text-center'>No disease records found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
