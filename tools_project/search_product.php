<?php

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'tools_project';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = '';
if (isset($_GET['query'])) {
    $query = $conn->real_escape_string($_GET['query']);

    $sql = "SELECT * FROM products 
            WHERE item_name LIKE '%$query%' 
            OR batch_no LIKE '%$query%'";

    $result = $conn->query($sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Product</title>
    <style>
        body {
            background: linear-gradient(to right, #ff7a18, #af002d, #319197, #fc00ff, #00dbde);
            background-size: 400% 400%;
            animation: gradientAnimation 15s ease infinite;
            font-family: 'Arial', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        @keyframes gradientAnimation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            max-width: 90%;
            margin: 20px auto;
            text-align: center;
            overflow-x: auto;
        }

        .logo {
            width: 100px;
            margin-bottom: 20px;
        }

        h1 {
            color: #333;
            font-size: 24px;
        }

        input[type="text"] {
            padding: 10px;
            width: 80%;
            border: 2px solid #ddd;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        button {
            padding: 10px 20px;
            background-color: #6C63FF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #4e46d6;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            table-layout: fixed; 
        }

        table th, table td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
            word-wrap: break-word;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        table th {
            background-color: #6C63FF;
            color: white;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .back-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #555;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
            transition: background-color 0.3s;
        }

        .back-button:hover {
            background-color: #333;
        }
    </style>
</head>
<body>

    <div class="container">
        <img src="images/cabb028d-87b1-4f08-b856-1996add884ba.webp" alt="Logo" class="logo">
        <h1>Search for a Product</h1>
        <form action="search_product.php" method="GET">
            <input type="text" name="query" value="<?php echo $query; ?>" placeholder="Enter product name or batch number" required>
            <button type="submit">Search</button>
        </form>

        <?php
        if (isset($result)) {
            if ($result->num_rows > 0) {
                echo "<h2>Search Results</h2>";
                echo "<table>
                        <tr>
                            <th>Item ID</th>
                            <th>Item Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Mfg. Date</th>
                            <th>Exp. Date</th>
                            <th>Batch #</th>
                        </tr>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['item_id']}</td>
                            <td>{$row['item_name']}</td>
                            <td>{$row['quantity']}</td>
                            <td>{$row['price_per_unit']}</td>
                            <td>{$row['mfd']}</td>
                            <td>{$row['exp']}</td>
                            <td>{$row['batch_no']}</td>
                          </tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No products found matching '$query'.</p>";
            }
        }
        ?>
        <a href="index.php" class="back-button">Back to Dashboard</a>
    </div>

</body>
</html>

<?php
$conn->close();
?>