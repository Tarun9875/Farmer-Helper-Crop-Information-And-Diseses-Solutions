<?php  
session_start();

// Database Configuration
$servername = "localhost";
$username = "root";  // Change if needed
$password = "";      // Change if needed
$dbname = "farm";

// Create database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(["error" => "Database Connection Failed: " . $conn->connect_error]));
}

// Handle login request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    header("Content-Type: application/json");

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($email) || empty($password)) {
        echo json_encode(["error" => "All fields are required!"]);
        exit;
    }

    // Check if user exists using email
    $query = "SELECT id, email, password FROM admin WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($id, $email, $hashedPassword);
        $stmt->fetch();

        // Debugging: Check what password is fetched
        // echo json_encode(["debug_password" => $hashedPassword]); exit;

        // Check if password is stored as hashed or plain text
        if (password_verify($password, $hashedPassword) || $password === $hashedPassword) {
            $_SESSION['admin_id'] = $id;
            $_SESSION['admin_email'] = $email;
            echo json_encode(["message" => "Login successful!", "redirect" => "index.php"]);
        } else {
            echo json_encode(["error" => "Incorrect password!"]);
        }
    } else {
        echo json_encode(["error" => "No admin account found!"]);
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
    <title>Admin Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        .login-container h2 {
            margin-bottom: 20px;
            text-align: center;
        }
        .login-container input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .login-container button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .login-container button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <h2>Admin Login</h2>
        <form id="loginForm">
            <input type="email" id="email" placeholder="Email" required>
            <input type="password" id="password" placeholder="Password" required>
            <button type="submit">Login</button>
            <a href="index.php">Login</a>
        </form>
    </div>

    <script>
        document.getElementById('loginForm').addEventListener('submit', async function(event) {
            event.preventDefault();

            const formData = new FormData();
            formData.append("email", document.getElementById('email').value);
            formData.append("password", document.getElementById('password').value);

            try {
                const response = await fetch(window.location.href, {
                    method: 'POST',
                    body: formData
                });

                const data = await response.json();
                
                if (data.message) {
                    alert(data.message);
                    window.location.href = data.redirect;
                } else {
                    alert(data.error);
                }
            } catch (error) {
                alert('Error connecting to the server');
            }
        });
    </script>
</body>
</html>
