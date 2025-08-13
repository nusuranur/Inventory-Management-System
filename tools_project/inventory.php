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

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory | Inventory Management</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh; 
            background: linear-gradient(to right, #ff7a18, #af002d, #319197, #fc00ff, #00dbde);
            background-size: 400% 400%;
            animation: gradientBG 10s ease infinite;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .container {
            max-width: 1200px; 
            width: 95%; 
            background: rgba(0, 0, 0, 0.8);
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
            color: white;
            border: 2px solid #fff;
            overflow-x: auto; /* Added horizontal scroll for large tables */
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 2.5em;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            table-layout: fixed; 
        }

        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #fff;
            word-wrap: break-word; 
            overflow: hidden; 
        }

        th {
            background-color: #FF6F61;
            font-weight: bold; 
        }

        td {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .action-btn {
            padding: 6px 10px;
            font-size: 14px;
            background-color:rgb(255, 0, 21);
            border-radius: 4px;
            color: white;
            text-decoration: none;
            display: inline-block; 
            margin: 2px 0; 
            white-space: nowrap; 
            transition: background-color 0.3s ease;

        }

        .action-btn:hover {
            background-color: #0056b3;
        }

        .expired {
            background-color: #FF3B3F;
            color: white;
        }

        .low-stock {
            background-color: #FF9A8B;
            color: white;
        }

        .back-button {
            display: block; 
            margin: 20px auto; 
            padding: 12px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            text-align: center;
            font-size: 16px;
            transition: background-color 0.3s ease;
            width: fit-content; 

        }

        .back-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Inventory Management</h1>

        <?php if ($result->num_rows > 0): ?>
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
                        <th style="width: 200px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr class="<?php echo (strtotime($row['exp']) < time()) ? 'expired' : (intval($row['quantity']) < 10 ? 'low-stock' : ''); ?>">
                            <td><?php echo $row['item_id']; ?></td>
                            <td><?php echo $row['item_name']; ?></td>
                            <td><?php echo $row['quantity']; ?></td>
                            <td><?php echo $row['price_per_unit']; ?></td>
                            <td><?php echo $row['mfd']; ?></td>
                            <td><?php echo $row['exp']; ?></td>
                            <td><?php echo $row['batch_no']; ?></td>
                            <td>
                                <a href="edit_product.php?id=<?php echo $row['item_id']; ?>" class="action-btn">Edit</a>
                                <a href="delete_product.php?id=<?php echo $row['item_id']; ?>" class="action-btn">Delete</a>
                                <a href="update_stock.php?id=<?php echo $row['item_id']; ?>" class="action-btn">Update Stock</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No products found in the inventory.</p>
        <?php endif; ?>

        <a href="index.php" class="back-button">Back to Home</a>
    </div>
</body>
</html>
