<?php

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'tools_project';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT * FROM products";
$result = $conn->query($query);

if (isset($_GET['edit_id'])) {
    $edit_id = $conn->real_escape_string($_GET['edit_id']);

    $edit_query = "SELECT * FROM products WHERE item_id = $edit_id";
    $edit_result = $conn->query($edit_query);

    if ($edit_result->num_rows == 1) {
        $product_to_edit = $edit_result->fetch_assoc();
    } else {
        echo "Product not found.";
        exit;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory | Inventory Management</title>
    <style>
        .edit-form {
            display: flex;
            flex-direction: column;
            gap: 10px;
            max-width: 400px; 
            margin: 20px auto; 
        }
        .edit-form label {
            font-weight: bold;
        }
        .edit-form input[type="text"],
        .edit-form input[type="number"],
        .edit-form input[type="date"] {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            width: 100%;
        }
        .edit-form input[type="submit"]{
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .edit-form a{
            text-decoration: none;
            color: #007bff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Inventory Management</h1>

        <?php if (isset($_GET['update_success']) && $_GET['update_success'] == 1) { ?>
            <p style="color: green;">Product updated successfully!</p>
        <?php } ?>

        <?php if (isset($product_to_edit)): ?>
            <h2>Edit Product</h2>
            <form action="update_product.php" method="POST" class="edit-form">
                <input type="hidden" name="item_id" value="<?php echo $product_to_edit['item_id']; ?>">

                <label for="item_name">Item Name:</label>
                <input type="text" name="item_name" id="item_name" value="<?php echo htmlspecialchars($product_to_edit['item_name']); ?>" required><br>

                <label for="quantity">Quantity:</label>
                <input type="number" name="quantity" id="quantity" value="<?php echo htmlspecialchars($product_to_edit['quantity']); ?>" required><br>

                <label for="price_per_unit">Price per Unit:</label>
                <input type="number" step="0.01" name="price_per_unit" id="price_per_unit" value="<?php echo htmlspecialchars($product_to_edit['price_per_unit']); ?>" required><br>

                <label for="mfd">Manufacture Date:</label>
                <input type="date" name="mfd" id="mfd" value="<?php echo htmlspecialchars($product_to_edit['mfd']); ?>" required><br>

                <label for="exp">Expiry Date:</label>
                <input type="date" name="exp" id="exp" value="<?php echo htmlspecialchars($product_to_edit['exp']); ?>" required><br>

                <label for="batch_no">Batch No:</label>
                <input type="text" name="batch_no" id="batch_no" value="<?php echo htmlspecialchars($product_to_edit['batch_no']); ?>" required><br>

                <input type="submit" value="Update Product">
                <a href="inventory.php">Cancel</a>
            </form>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Item ID</th>
                        <th>Item Name</th>
                        <th>Quantity</th>
                        <th>Price per Unit</th>
                        <th>Manufacture Date</th>
                        <th>Expiry Date</th>
                        <th>Batch No</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr class="<?php echo (strtotime($row['exp']) < time()) ? 'expired' : (intval($row['quantity']) < 10 ? 'low-stock' : ''); ?>">
                            <td><?php echo $row['item_id']; ?></td>
                            <td><?php echo htmlspecialchars($row['item_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['quantity']); ?></td>
                            <td><?php echo htmlspecialchars($row['price_per_unit']); ?></td>
                            <td><?php echo htmlspecialchars($row['mfd']); ?></td>
                            <td><?php echo htmlspecialchars($row['exp']); ?></td>
                            <td><?php echo htmlspecialchars($row['batch_no']); ?></td>
                            <td>
                                <div class="action-btn-container">
                                    <a href="inventory.php?edit_id=<?php echo $row['item_id']; ?>" class="action-btn">Edit</a>
                                    <a href="delete_product.php?id=<?php echo $row['item_id']; ?>" class="action-btn">Delete</a>
                                    <a href="update_stock.php?id=<?php echo $row['item_id']; ?>" class="action-btn">Update Stock</a>
                                </div>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php endif; ?>

        <a href="index.php" class="back-button">Back to Home</a>
    </div>
</body>
</html>
