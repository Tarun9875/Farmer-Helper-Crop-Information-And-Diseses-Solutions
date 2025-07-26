<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farmer Helper - Admin Home</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        header {
            background-color: #4CAF50;
            color: white;
            padding: 10px 0;
            text-align: center;
        }
        nav {
            display: flex;
            justify-content: center;
            background-color: #333;
        }
        nav a {
            color: white;
            padding: 14px 20px;
            text-decoration: none;
            text-align: center;
        }
        nav a:hover {
            background-color: #ddd;
            color: black;
        }
        .container {
            padding: 20px;
        }
        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            width: 100%;
            bottom: 0;
        }
    </style>
</head>
<body>
    <header>
        <h1>Welcome To Our Website</h1>
    </header>
    <nav>
    <a href="#">Home</a>
        <a href="productlist.php">Crops</a>
        <a href="cropdiseasessolutions.php">Disease</a>
        <a href="solution.php">Solution</a>
        <a href="farmerqueries.php">Farmer Queries</a>
        <a href="expert.php">Expert</a>
        <a href="#">Logout</a>
    </nav>
    <div class="container">
        <h2>Welcome to the Customer Side</h2>
        <p>Here you can manage crop information and disease solutions.</p>
    </div>
    <footer>
        <p>&copy; Best Service For Farmer.......</p>
    </footer>
    <script>
        // Add your JavaScript here
        console.log("Welcome to the Admin Dashboard");
    </script>
</body>
</html>