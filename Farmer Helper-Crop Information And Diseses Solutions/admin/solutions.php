<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Crop Solutions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .sidebar {
            width: 250px;
            height: 100vh;
            background: #343a40;
            color: white;
            padding: 20px;
            position: fixed;
        }
        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
        }
        .sidebar a:hover {
            background: #495057;
        }
        .container-content {
            margin-left: 270px;
            padding: 20px;
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
        .btn-custom {
            border-radius: 8px;
            padding: 10px 20px;
        }
    </style>
</head>
<body>
    
    <div class="sidebar">
        
  
        <h2 style="text-align: center;">Admin Panel</h2>
        <a href="index.php">Dashboard</a>
        <a href="productlist.php">Manage Crops</a>
     <!--   <a href="managefarmer.php">Manage Users</a>-->
        <a href="solutions.php">Manage Crop Solutions</a>
      <!--  <a href="queryolutions.php">Manage Query Solution</a>-->
        <a href="cropdiseases.php">Manage Crop Diseases</a>
        <a href="expert.php">Expert Panel</a>
        <a href="\index.php">Logout</a>
    </div>
    <div class="container-content">
        <h1 class="mb-4">Manage Crop Solutions</h1>
        <div class="form-container">
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Pesticides</label>
                    <input type="text" name="pesticides" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Remedies</label>
                    <input type="text" name="remedies" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3" required></textarea>
                </div>
                <button type="submit" name="add_solution" class="btn btn-success">Add Solution</button>
            </form>
        </div>
        <table class="table table-bordered mt-4">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Pesticides</th>
                    <th>Remedies</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Sample Pesticide</td>
                    <td>Sample Remedy</td>
                    <td>Sample Description</td>
                    <td>
                        <a href="#" class="btn btn-primary btn-sm">Edit</a>
                        <a href="#" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
