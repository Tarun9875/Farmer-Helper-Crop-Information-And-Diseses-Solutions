<?php
include('partials/dash-header.php');
// Database connection

include('database/db.php');
// Handle Add Expert Request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add') {
    $name = $_POST['name'];
    $specialization = $_POST['specialization'];
    $contact_info = $_POST['contact_info'];

    $stmt = $conn->prepare("INSERT INTO experts (name, specialization, contact_info) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $specialization, $contact_info);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Expert added successfully."]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to add expert."]);
    }

    $stmt->close();
    exit;
}

// Handle Update Expert Request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update') {
    $expert_id = $_POST['expert_id'];
    $name = $_POST['name'];
    $specialization = $_POST['specialization'];
    $contact_info = $_POST['contact_info'];

    $stmt = $conn->prepare("UPDATE experts SET name = ?, specialization = ?, contact_info = ? WHERE expert_id = ?");
    $stmt->bind_param("sssi", $name, $specialization, $contact_info, $expert_id);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Expert updated successfully."]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to update expert."]);
    }

    $stmt->close();
    exit;
}

// Handle Delete Expert Request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete') {
    $expert_id = $_POST['expert_id'];

    $stmt = $conn->prepare("DELETE FROM experts WHERE expert_id = ?");
    $stmt->bind_param("i", $expert_id);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Expert deleted successfully."]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to delete expert."]);
    }

    $stmt->close();
    exit;
}

// Fetch Experts
$experts = [];
$sql = "SELECT * FROM experts";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $experts[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Experts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            background: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        
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
        /* Sidebar styling */
.sidebar {
    width: 250px;
    height: 100vh;
    background-color: #343a40;
    color: white;
    padding: 20px;
    position: fixed;
    left: 0;
    top: 0;
    overflow-y: auto;
    box-shadow: 2px 0 5px rgba(0,0,0,0.1);
}

.sidebar h2 {
    text-align: center;
    margin-bottom: 20px;
    font-size: 22px;
    font-weight: bold;
    color: #f8f9fa;
}

.sidebar ul {
    list-style: none;
    padding: 0;
}

.sidebar ul li {
    padding: 10px;
    margin-bottom: 5px;
    font-size: 16px;
    border-radius: 5px;
    transition: background 0.3s ease-in-out;
}

.sidebar ul li a {
    color: white;
    text-decoration: none;
    display: block;
}

.sidebar ul li:hover {
    background-color: #495057;
    cursor: pointer;
}

.sidebar ul li.active {
    background-color: #007bff;
}

.logout {
    margin-top: 20px;
    text-align: center;
}

.logout a {
    color: red;
    font-weight: bold;
}

    </style>
</head>
<body>

<div class="container">
    <h2>Manage Experts</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Expert ID</th>
                    <th>Name</th>
                    <th>Specialization</th>
                    <th>Contact Info</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="expertTableBody">
                <?php if (!empty($experts)): ?>
                    <?php foreach ($experts as $expert): ?>
                        <tr>
                            <td><?= htmlspecialchars($expert['expert_id']) ?></td>
                            <td><?= htmlspecialchars($expert['name']) ?></td>
                            <td><?= htmlspecialchars($expert['specialization']) ?></td>
                            <td><?= htmlspecialchars($expert['contact_info']) ?></td>
                            <td>
                                <button class="btn btn-warning btn-sm" onclick="editExpert(<?= htmlspecialchars(json_encode($expert)) ?>)">Edit</button>
                                <button class="btn btn-danger btn-sm" onclick="deleteExpert(<?= htmlspecialchars($expert['expert_id']) ?>)">Delete</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="5" class="text-center">No experts found</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Add Expert Button -->
    <div class="text-center mt-4">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addExpertModal">Add Expert</button>
    </div>
</div>

<!-- Add/Edit Expert Modal -->
<div class="modal fade" id="addExpertModal" tabindex="-1" aria-labelledby="addExpertModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addExpertModalLabel">Add/Edit Expert</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addEditExpertForm" method="POST">
                    <input type="hidden" id="action" name="action" value="add">
                    <input type="hidden" id="expert_id" name="expert_id">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="specialization" class="form-label">Specialization</label>
                        <input type="text" class="form-control" id="specialization" name="specialization" required>
                    </div>
                    <div class="mb-3">
                        <label for="contact_info" class="form-label">Contact Info</label>
                        <input type="text" class="form-control" id="contact_info" name="contact_info" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-success">Save Expert</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function editExpert(expert) {
        document.getElementById('action').value = 'update';
        document.getElementById('expert_id').value = expert.expert_id;
        document.getElementById('name').value = expert.name;
        document.getElementById('specialization').value = expert.specialization;
        document.getElementById('contact_info').value = expert.contact_info;
        new bootstrap.Modal(document.getElementById('addExpertModal')).show();
    }

    function deleteExpert(expertId) {
        if (confirm('Are you sure you want to delete this expert?')) {
            const formData = new FormData();
            formData.append('action', 'delete');
            formData.append('expert_id', expertId);

            fetch('', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                if (data.success) {
                    location.reload();
                }
            });
        }
    }
</script>

</body>
</html>