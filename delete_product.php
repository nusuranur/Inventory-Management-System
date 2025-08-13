<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'tools_project';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Deleting
$product_id = $_GET['id'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $delete_query = "DELETE FROM products WHERE item_id = ?";
    $stmt = $conn->prepare($delete_query);
    $stmt->bind_param('i', $product_id);

    if ($stmt->execute()) {
        header("Location: inventory.php?status=deleted&highlight=$product_id");
    } else {
        $error_message = "Failed to delete the product.";
    }
}

$query = "SELECT item_name FROM products WHERE item_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $product_id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Product</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(to right, #ff7a18, #af002d, #319197, #fc00ff, #00dbde);
            background-size: 400% 400%;
            animation: gradientBG 10s ease infinite;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .container {
            background: rgba(0, 0, 0, 0.8);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
            color: white;
            max-width: 500px;
            width: 90%;
            border: 1px solid white;
            text-align: center;
        }

        h1 {
            margin-bottom: 20px;
        }

        p {
            margin-bottom: 20px;
            font-size: 18px;
        }

        form {
            display: inline-block;
        }

        input[type="submit"] {
            background: #dc3545;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        input[type="submit"]:hover {
            background: #c82333;
        }

        .back-button {
            display: inline-block;
            margin-top: 10px;
            background-color: #6c757d;
            color: white;
            padding: 10px 15px;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
        }

        .back-button:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Delete Product</h1>
        <?php if (isset($error_message)): ?>
            <p style="color: red;"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <p>Are you sure you want to delete <strong><?php echo htmlspecialchars($product['item_name']); ?></strong>?</p>
        <form method="POST">
            <input type="submit" value="Yes, Delete">
        </form>
        <a href="inventory.php" class="back-button">Cancel</a>
    </div>
</body>
</html>

