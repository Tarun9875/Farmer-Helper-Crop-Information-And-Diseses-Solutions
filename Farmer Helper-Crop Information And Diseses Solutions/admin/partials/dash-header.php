<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Farmer Helper</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            background-color: #f8f9fa;
        }
        .sidebar {
            width: 250px;
            background-color: #333;
            color: white;
            height: 100vh;
            padding-top: 20px;
            position: fixed;
        }
        .sidebar a {
            display: block;
            color: white;
            padding: 15px;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #4CAF50;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
            width: calc(100% - 250px);
        }
        .header {
            background-color: #4CAF50;
            padding: 20px;
            text-align: center;
            color: white;
            font-size: 24px;
        }
        .dashboard {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .card {
            background-color: #f4f4f4;
            padding: 20px;
            width: 30%;
            text-align: center;
            border-radius: 5px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
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
    <div class="sidebar">
        <h2 style="text-align: center;">Admin Panel</h2>
        <a href="index.php">Dashboard</a>
        <a href="productlist.php">Manage Crops</a>
       <!-- <a href="managefarmer.php">Manage Users</a>-->
        <a href="solutions.php">Manage Crop Solutions</a>
      <!--  <a href="queryolutions.php">Manage Query Solution</a>-->
        <a href="cropdiseases.php">Manage Crop Diseases</a>
        <a href="expert.php">Expert Panel</a>
        <a href="\index.php">Logout</a>
    </div>