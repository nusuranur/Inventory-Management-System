<?php
session_start();
session_unset();
session_destroy();

if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 3600, '/');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout - Inventory Management System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: linear-gradient(to right, #2980b9, #8e44ad);
            animation: gradientAnimation 15s ease infinite;
            color: white;
            overflow: hidden;
        }

        @keyframes gradientAnimation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .logout-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            text-align: center;
        }

        .logout-container h1 {
            margin-bottom: 20px;
        }

        .login-link {
            display: inline-block;
            padding: 10px 20px;
            background-color: #00aaff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .login-link:hover {
            background-color: #0088cc;
        }
    </style>
</head>
<body>
    <div class="logout-container">
        <h1>You have been logged out successfully.</h1>
        <p>Click <a href="login.php" class="login-link">here</a> to log in again.</p>
    </div>
</body>
</html>