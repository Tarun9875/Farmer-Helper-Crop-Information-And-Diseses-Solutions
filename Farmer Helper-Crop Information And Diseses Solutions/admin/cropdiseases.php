<?php

include('partials/dash-header.php');
// Database connection

include('database/db.php');

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
    $name = $_POST['name'];
    $symptoms = $_POST['symptoms'];
    $solution_id = $_POST['solution_id'];

    // Insert data into the database
    $stmt = $conn->prepare("INSERT INTO diseases (name, symptoms, solution_id) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $name, $symptoms, $solution_id);
    
    if ($stmt->execute()) {
        echo "<script>alert('Disease Added Successfully!'); window.location.href='cropdiseases.php';</script>";
    } else {
        echo "<script>alert('Error Adding Disease!');</script>";
    }
    
    $stmt->close();
}

// Handle delete request
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM diseases WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    echo "<script>alert('Disease Deleted Successfully!'); window.location.href='cropdiseases.php';</script>";
}

// Fetch records from the diseases table
$sql = "SELECT * FROM diseases";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Disease</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 900px;
        }
        .form-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .table {
            background: white;
            border-radius: 10px;
            overflow: hidden;
        }
        .btn-primary {
            border-radius: 8px;
            padding: 10px 20px;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        input, textarea {
            border-radius: 8px !important;
        }
    </style>
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
                <button type="submit" name="add" class="btn btn-success">Add Disease</button>
            </div>
        </form>

        <h2 class="text-center mt-5">Diseases List</h2>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Symptoms</th>
                    <th>Solution ID</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['symptoms']; ?></td>
                            <td><?php echo $row['solution_id']; ?></td>
                            <td>
                                <a href="editdisease.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="cropdiseases.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">No records found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>