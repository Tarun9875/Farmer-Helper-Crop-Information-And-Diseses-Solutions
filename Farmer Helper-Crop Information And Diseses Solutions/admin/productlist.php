<?php

include('partials/dash-header.php');

include('database/db.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $crop_id = $_POST['crop_id'] ?? '';
    $name = $_POST['name'];
    $type = $_POST['type'];
    $ideal_condition = $_POST['ideal_condition'];
    $growth_duration = $_POST['growth_duration'];
    $description = $_POST['description'];

    $image = '';
    if (!empty($_FILES['image']['name'])) {
        $image = 'uploads/' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $image);
    }

    if (!empty($crop_id)) {
        if ($image) {
            $stmt = $conn->prepare("UPDATE crops SET name=?, type=?, ideal_condition=?, growth_duration=?, image=?, description=? WHERE crop_id=?");
            $stmt->bind_param("ssssssi", $name, $type, $ideal_condition, $growth_duration, $image, $description, $crop_id);
        } else {
            $stmt = $conn->prepare("UPDATE crops SET name=?, type=?, ideal_condition=?, growth_duration=?, description=? WHERE crop_id=?");
            $stmt->bind_param("sssssi", $name, $type, $ideal_condition, $growth_duration, $description, $crop_id);
        }
    } else {
        $stmt = $conn->prepare("INSERT INTO crops (name, type, ideal_condition, growth_duration, image, description) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $name, $type, $ideal_condition, $growth_duration, $image, $description);
    }
    $stmt->execute();
    echo json_encode(["success" => true, "message" => "Crop saved successfully"]);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Crops</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        
        .container {
            max-width: 800px;
        }
        
        
    </style>
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center text-primary mb-4">Manage Crop List</h1>

    <div class="form-container mx-auto">
        <h2 class="text-center text-success mb-3" id="form-title">Add New Crop</h2>
        <form id="crop-form" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="crop_id" id="crop_id">
            <div class="row g-3">
                <div class="col-md-6"><input type="text" name="name" id="name" class="form-control" placeholder="Name" required></div>
                <div class="col-md-6"><input type="text" name="type" id="type" class="form-control" placeholder="Type" required></div>
                <div class="col-md-6"><input type="text" name="ideal_condition" id="ideal_condition" class="form-control" placeholder="Ideal Condition" required></div>
                <div class="col-md-6"><input type="text" name="growth_duration" id="growth_duration" class="form-control" placeholder="Growth Duration" required></div>
                <div class="col-md-6"><input type="file" name="image" id="image" class="form-control"></div>
                <div class="col-md-6"><textarea name="description" id="description" class="form-control" placeholder="Description" required></textarea></div>
            </div>
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary">Save Crop</button>
            </div>
        </form>
    </div>

    <table class="table table-bordered table-hover mt-5">
        <thead class="table-primary">
            <tr>
                <th>Crop ID</th>
                <th>Name</th>
                <th>Type</th>
                <th>Ideal Condition</th>
                <th>Growth Duration</th>
                <th>Image</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="cropTableBody">
            <!-- Dynamic Data Loading -->
        </tbody>
    </table>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        loadCrops();

        document.getElementById("crop-form").addEventListener("submit", function (event) {
            event.preventDefault();
            let formData = new FormData(this);
            
            fetch("manage_crops.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then(result => {
                alert(result.message);
                if (result.success) {
                    loadCrops();
                    document.getElementById("crop-form").reset();
                }
            })
            .catch(error => console.error("Error:", error));
        });
    });
</script>

</body>
</html>