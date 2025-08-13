<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'tools_project';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$product_id = $_GET['id'];
$query = "SELECT * FROM products WHERE item_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $product_id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item_name = $_POST['item_name'];
    $quantity = $_POST['quantity'];
    $price_per_unit = $_POST['price_per_unit'];
    $mfd = $_POST['mfd'];
    $exp = $_POST['exp'];
    $batch_no = $_POST['batch_no'];

    $update_query = "UPDATE products SET item_name = ?, quantity = ?, price_per_unit = ?, mfd = ?, exp = ?, batch_no = ? WHERE item_id = ?";
    $update_stmt = $conn->prepare($update_query);
    $update_stmt->bind_param('sissssi', $item_name, $quantity, $price_per_unit, $mfd, $exp, $batch_no, $product_id);

    if ($update_stmt->execute()) {
        header("Location: inventory.php?status=success&highlight=$product_id");
    } else {
        $error_message = "Failed to update the product.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <style>
        /* Your consistent styling */
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
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        input, select {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
            font-size: 16px;
        }

        input[type="submit"] {
            background: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        input[type="submit"]:hover {
            background: #0056b3;
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
        <h1>Edit Product</h1>
        <?php if (isset($error_message)): ?>
            <p style="color: red;"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <form method="POST">
            <input type="text" name="item_name" value="<?php echo $product['item_name']; ?>" required>
            <input type="number" name="quantity" value="<?php echo $product['quantity']; ?>" required>
            <input type="number" name="price_per_unit" value="<?php echo $product['price_per_unit']; ?>" step="0.01" required>
            <input type="date" name="mfd" value="<?php echo $product['mfd']; ?>" required>
            <input type="date" name="exp" value="<?php echo $product['exp']; ?>" required>
            <input type="text" name="batch_no" value="<?php echo $product['batch_no']; ?>" required>
            <input type="submit" value="Update Product">
        </form>
        <a href="inventory.php" class="back-button">Back to Inventory</a>
    </div>
</body>
</html>
