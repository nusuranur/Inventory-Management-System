<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    die("<p>You must be logged in to update information.</p>");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $field = $_POST['field'];
    $value = htmlspecialchars($_POST['value']);
    $userId = $_SESSION['user_id'];

    if (!in_array($field, ['email', 'password', 'name'])) {
        die("<p>Invalid field selected.</p>");
    }

    if ($field === 'password') {
        $value = password_hash($value, PASSWORD_DEFAULT);
    }

    $conn = new mysqli('localhost', 'root', '', 'tools_project');

    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    $sql = "UPDATE register SET $field = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("SQL Error: " . $conn->error);
    }

    $stmt->bind_param('si', $value, $userId);

    if ($stmt->execute()) {
        $successMessage = "$field updated successfully!";
    } else {
        $errorMessage = "Error updating $field: " . $stmt->error;
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
    <title>Update Login Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(to right, #ff7a18, #af002d, #319197, #fc00ff, #00dbde);
            background-size: 600% 600%;
            animation: gradientBG 15s ease infinite;
        }

        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 400px;
            opacity: 0;
            animation: fadeIn 1s forwards;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        h2 {
            margin-bottom: 20px;
            font-size: 24px;
            text-align: center;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }

        .form-group input, .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            transition: transform 0.3s ease;
        }

        .form-group input:focus, .form-group select:focus {
            transform: scale(1.05);
            border-color: #4CAF50;
        }

        .form-group button {
            width: 100%;
            padding: 10px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .form-group button:hover {
            background: #0056b3;
            transform: scale(1.05);
        }

        .form-group button:active {
            background: #004085;
        }

        .form-group button:disabled {
            background: #d6d6d6;
            cursor: not-allowed;
        }

        .form-group p {
            text-align: center;
            color: green;
            font-size: 16px;
        }

        .back-to-home {
            text-align: center;
            margin-top: 20px;
        }

        .back-to-home a {
            text-decoration: none;
            font-size: 18px;
            color: #007bff;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        .back-to-home a:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Update Login Information</h2>
        <form action="" method="post">
            <div class="form-group">
                <label for="field">Choose Field to Update</label>
                <select id="field" name="field" required>
                    <option value="email">Email</option>
                    <option value="password">Password</option>
                    <option value="name">Name</option>
                </select>
            </div>

            <div class="form-group">
                <label for="value">New Value</label>
                <input type="text" id="value" name="value" placeholder="Enter the new value" required>
            </div>

            <div class="form-group">
                <button type="submit">Update</button>
            </div>
        </form>

        <?php
        if (isset($successMessage)) {
            echo "<p>$successMessage</p>";
        }

        if (isset($errorMessage)) {
            echo "<p>$errorMessage</p>";
        }
        ?>

        <div class="back-to-home">
            <a href="index.php">Back to Home</a>
        </div>
    </div>
</body>
</html>



