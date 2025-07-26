<?php

include('partials/dash-header.php');
// Database connection
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Query Solutions</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }
        .container {
            width: 90%;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        table th {
            background-color: #f4f4f4;
            color: #333;
        }
        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        table tr:hover {
            background-color: #f1f1f1;
        }
        .add-button {
            display: block;
            width: 200px;
            margin: 20px auto;
            padding: 10px;
            background-color: #28a745;
            color: #fff;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
        }
        .add-button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Manage Query Solutions</h1>
        <table>
            <thead>
                <tr>
                    <th>Response ID</th>
                    <th>Query ID</th>
                    <th>Expert ID</th>
                    <th>Solution ID</th>
                    <th>Response Date</th>
                </tr>
            </thead>
            <tbody>
                <tr><td colspan='5'>No data available</td></tr>
            </tbody>
        </table>
        <a href="add_query_solution.php" class="add-button">Add Query Solution</a>
    </div>
</body>
</html>
