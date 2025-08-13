<?php
session_start();

$login_error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = new mysqli('localhost', 'root', '', 'tools_project');
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM register WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            header("Location: index.php");
            exit();
        } else {
            $login_error = "Invalid email or password.";
        }
    } else {
        $login_error = "Invalid email or password.";
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            overflow: hidden; 
            background: linear-gradient(to right, #2980b9, #8e44ad); 
            animation: gradientAnimation 15s ease infinite; 
        }

        @keyframes gradientAnimation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-left, .login-right {
            width: 40%; 
            padding: 30px; 
            box-sizing: border-box;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); 
            transition: transform 0.3s ease; 
        }
        .login-left:hover, .login-right:hover{
            transform: scale(1.02);
        }

        .login-left {
            background-color: rgba(255, 255, 255, 0.8); 
            color: #333;
            text-align: center;
        }

        .login-left img {
            width: 150px;
            margin-bottom: 20px;
        }

        .login-left h1 {
            font-size: 28px;
            margin-bottom: 15px;
        }

        .login-left p {
            font-size: 16px;
            margin-bottom: 15px;
        }

        .login-right {
            background-color: rgba(255, 255, 255, 0.9); 
        }

        .login-right h2 {
            font-size: 36px; 
            color: #333;
            margin-bottom: 25px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-size: 16px;
            color: #555;
            margin-bottom: 8px;
            display: block;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
            transition: border-color 0.3s; 
        }

        .form-group input:focus {
            border-color:rgb(153, 0, 255); 
            outline: none;
        }

        .btn {
            width: 100%;
            padding: 12px;
            font-size: 18px;
            background-color:rgb(119, 0, 255);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color:rgb(116, 0, 204);
        }

        .register-link {
            text-align: center;
            margin-top: 25px;
        }

        .register-link a {
            color:rgb(255, 0, 68);
            text-decoration: none;
            font-weight: bold;
        }

        .error {
            color: red;
            text-align: center;
            margin-bottom: 20px;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-left">
            <img src="images/cabb028d-87b1-4f08-b856-1996add884ba.webp" alt="Logo">
            <h1>INVENTORY Management System</h1>
            <p>The Software You Need</p>
            <p>Copyright © Inventory Management System by nur. All rights reserved.</p>
        </div>
        <div class="login-right">
            <h2>LOGIN</h2>
            <?php if ($login_error): ?>
                <div class="error"><?php echo $login_error; ?></div>
            <?php endif; ?>
            <form action="login.php" method="POST">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="Enter your email" value="" required>
                </div>
                <div class="form-group">
                    <label for="password">PASSWORD</label>
                    <input type="password" name="password" id="password" placeholder="Enter your password" value="" required>
                </div>
                <button type="submit" class="btn">LOGIN</button>
            </form>
            <div class="register-link">
                <p>Not Registered? <a href="register.php">REGISTER USER</a></p>
            </div>
        </div>
    </div>
</body>
</html>



