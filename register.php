<?php

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'tools_project';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$registration_successful = false;
$registration_error = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($email) || empty($username) || empty($password)) {
        $registration_error = "Please fill in all fields.";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $registration_error = "Invalid email format.";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO register (email, name, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sss", $email, $username, $hashed_password);

        if ($stmt->execute()) {
            $registration_successful = true;
        } else {
            if ($conn->errno == 1062) {
                $registration_error = "Email already exists. Please use a different email.";
            } else {
                $registration_error = "An error occurred during registration. Please try again later. Error: " . $stmt->error; // REMOVE IN PRODUCTION
            }
        }
        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body { 
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(to right, #2980b9, #8e44ad);
            animation: gradientAnimation 15s ease infinite;
            overflow: hidden;
        }

        @keyframes gradientAnimation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .container {
            display: flex;
            width: 800px;
            background-color: rgba(255, 255, 255, 0.9);
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            overflow: hidden;
            transition: transform 0.3s ease;
        }
        .container:hover {
            transform: scale(1.02);
        }

        .left-panel {
            background-color: rgba(0, 120, 215, 0.8);
            color: white;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 20px;
        }

        .left-panel img {
            width: 100px;
            margin-bottom: 20px;
        }

        .left-panel h1 {
            font-size: 24px;
            margin: 10px 0;
        }

        .left-panel p {
            font-size: 14px;
            margin: 10px 0;
        }

        .right-panel {
            flex: 1.5;
            padding: 40px;
        }

        .right-panel h1 {
            color: #0078d7;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            color: #555;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            box-sizing: border-box;
        }

        .btn {
            background-color: #0078d7;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            width: 100%;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #005bb5;
        }

        .login-link {
            margin-top: 10px;
            text-align: center;
            font-size: 14px;
        }

        .login-link a {
            color: #0078d7;
            text-decoration: none;
            transition: color 0.3s;
        }

        .login-link a:hover {
            text-decoration: underline;
            color: #005bb5;
        }

        .success-message {
            color: green;
            font-size: 16px;
            text-align: center;
            margin-bottom: 20px;
        }

        .error-message {
            color: red;
            font-size: 16px;
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="left-panel">
            <img src="images/cabb028d-87b1-4f08-b856-1996add884ba.webp" alt="Inventory Logo">
            <h1>INVENTORY Management System</h1>
            <p>The Software You Need</p>
            <p>Copyright © Inventory Management System by nur. All rights reserved.</p>
        </div>
        <div class="right-panel">
            <h1>REGISTER</h1>

            <?php if ($registration_error): ?>
                <div class="error-message"><?php echo $registration_error; ?></div>
            <?php endif; ?>

            <?php if ($registration_successful): ?>
                <div class="success-message">Registration Successful! You can now <a href="login.php" class="login-link">login</a>.</div>
            <?php else : ?>
                <form action="register.php" method="POST">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn">Register</button>
                </form>
                <div class="login-link">
                    <p>Already registered? <a href="login.php">Login</a></p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
