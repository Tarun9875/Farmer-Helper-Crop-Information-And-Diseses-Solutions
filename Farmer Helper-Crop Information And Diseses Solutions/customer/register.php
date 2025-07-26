<?php
// Database Configuration
$servername = "localhost";
$username = "root";  // Change if needed
$password = "";      // Change if needed
$dbname = "farm";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(["error" => "Database Connection Failed: " . $conn->connect_error]));
}

// Process form submission (AJAX request)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    header("Content-Type: application/json");

    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']); // ❌ This will store the password as plain text

    if (empty($username) || empty($email) || empty($password)) {
        echo json_encode(["error" => "All fields are required!"]);
        exit;
    }

    // Check if email or username already exists
    $checkQuery = "SELECT id FROM admin WHERE email = ? OR username = ?";
    $stmt = $conn->prepare($checkQuery);
    $stmt->bind_param("ss", $email, $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo json_encode(["error" => "Username or Email already exists!"]);
        exit;
    }

    // Insert into database (PLAIN TEXT PASSWORD)
    $insertQuery = "INSERT INTO admin (username, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($insertQuery);
    $stmt->bind_param("sss", $username, $email, $password);

    if ($stmt->execute()) {
        echo json_encode(["message" => "Admin registered successfully!"]);
    } else {
        echo json_encode(["error" => "Registration failed!"]);
    }

    $stmt->close();
    $conn->close();
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .register-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        .register-container h2 {
            margin-bottom: 20px;
            text-align: center;
        }
        .register-container input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .register-container button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            border: none;
            border-radius: 5px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }
        .register-container button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>Admin Register</h2>
        <form id="registerForm">
            <input type="text" id="username" placeholder="Username" required>
            <input type="email" id="email" placeholder="Email" required>
            <input type="password" id="password" placeholder="Password" required>
            <button type="submit">Register</button>
        </form>
    </div>

    <script>
        document.getElementById('registerForm').addEventListener('submit', async function(event) {
            event.preventDefault();

            const formData = new FormData();
            formData.append("username", document.getElementById('username').value);
            formData.append("email", document.getElementById('email').value);
            formData.append("password", document.getElementById('password').value);

            try {
                const response = await fetch(window.location.href, { 
                    method: 'POST',
                    body: formData
                });

                const data = await response.json();
                alert(data.message || data.error);
            } catch (error) {
                alert('Error connecting to the server');
            }
        });
    </script>
</body>
</html>
