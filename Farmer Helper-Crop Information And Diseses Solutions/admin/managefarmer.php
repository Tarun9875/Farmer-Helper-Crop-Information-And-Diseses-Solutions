<?php

include('partials/dash-header.php');
// Database Connection

include('database/db.php');

// Handle Adding a New Farmer
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $contact = trim($_POST['contact']);

    // Validate inputs
    if (!empty($name) && !empty($email) && !empty($password) && !empty($contact)) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Encrypt password

            // Prepare and bind
            $stmt = $conn->prepare("INSERT INTO farmers (name, email, password, contact) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $name, $email, $hashedPassword, $contact);

            if ($stmt->execute()) {
                echo "<script>alert('Farmer added successfully!');</script>";
            } else {
                echo "<script>alert('Error adding farmer: " . $stmt->error . "');</script>";
            }

            $stmt->close();
        } else {
            echo "<script>alert('Invalid email format.');</script>";
        }
    } else {
        echo "<script>alert('All fields are required.');</script>";
    }
}

// Handle Updating a Farmer
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $farmer_id = $_POST['farmer_id'];
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $contact = trim($_POST['contact']);

    if (!empty($name) && !empty($email) && !empty($contact)) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $stmt = $conn->prepare("UPDATE farmers SET name=?, email=?, contact=? WHERE farmer_id=?");
            $stmt->bind_param("sssi", $name, $email, $contact, $farmer_id);

            if ($stmt->execute()) {
                echo "<script>alert('Farmer updated successfully!');</script>";
            } else {
                echo "<script>alert('Error updating farmer: " . $stmt->error . "');</script>";
            }

            $stmt->close();
        } else {
            echo "<script>alert('Invalid email format.');</script>";
        }
    } else {
        echo "<script>alert('All fields are required.');</script>";
    }
}

// Handle Deleting a Farmer
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $farmer_id = $_POST['farmer_id'];

    $stmt = $conn->prepare("DELETE FROM farmers WHERE farmer_id=?");
    $stmt->bind_param("i", $farmer_id);

    if ($stmt->execute()) {
        echo "<script>alert('Farmer deleted successfully!');</script>";
    } else {
        echo "<script>alert('Error deleting farmer: " . $stmt->error . "');</script>";
    }

    $stmt->close();
}

// Fetch Farmers Data
$queryFarmers = [];
$result = $conn->query("SELECT * FROM farmers");
while ($row = $result->fetch_assoc()) {
    $queryFarmers[] = $row;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Farmers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
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
<body class="bg-light">

<div class="container mt-5">
    <h1 class="text-center text-primary">Manage Farmers</h1>

    <table class="table table-bordered table-striped mt-4">
        <thead class="table-dark">
            <tr>
                <th>Farmer ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Contact Info</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($queryFarmers as $farmer): ?>
                <tr>
                    <td><?= htmlspecialchars($farmer['farmer_id']) ?></td>
                    <td><?= htmlspecialchars($farmer['name']) ?></td>
                    <td><?= htmlspecialchars($farmer['email']) ?></td>
                    <td><?= htmlspecialchars($farmer['contact']) ?></td>
                    <td>
                        <form method="POST" class="d-inline">
                            <input type="hidden" name="farmer_id" value="<?= $farmer['farmer_id'] ?>">
                            <input type="text" name="name" value="<?= htmlspecialchars($farmer['name']) ?>" required class="form-control mb-2">
                            <input type="text" name="email" value="<?= htmlspecialchars($farmer['email']) ?>" required class="form-control mb-2">
                            <input type="text" name="contact" value="<?= htmlspecialchars($farmer['contact']) ?>" required class="form-control mb-2">
                            <button type="submit" name="update" class="btn btn-success btn-sm">Update</button>
                        </form>

                        <form method="POST" class="d-inline">
                            <input type="hidden" name="farmer_id" value="<?= $farmer['farmer_id'] ?>">
                            <button type="submit" name="delete" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2 class="text-center text-secondary mt-5">Add New Farmer</h2>
    <form method="POST" class="mt-3">
        <div class="mb-3">
            <input type="text" name="name" placeholder="Name" required class="form-control">
        </div>
        <div class="mb-3">
            <input type="email" name="email" placeholder="Email" required class="form-control">
        </div>
        <div class="mb-3">
            <input type="password" name="password" placeholder="Password" required class="form-control">
        </div>
        <div class="mb-3">
            <input type="text" name="contact" placeholder="Contact Info" required class="form-control">
        </div>
        <button type="submit" name="add" class="btn btn-primary">Add Farmer</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php $conn->close(); ?>