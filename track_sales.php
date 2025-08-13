<?php

$servername = "localhost"; 
$username = "root";        
$password = "";            
$dbname = "tools_project"; 


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM products ORDER BY mfd DESC"; 
$result = $conn->query($sql);

if (!$result) {
    die("Query failed: " . $conn->error); 
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track Products</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            background: linear-gradient(to right, #ff7a18, #af002d, #319197, #fc00ff, #00dbde);
            background-size: 600% 600%;
            animation: gradientBG 15s ease infinite;
        }

        @keyframes gradientBG {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

        .container {
            max-width: 1000px;
            margin: 50px auto;
            background-color: #ffffff;
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            opacity: 0;
            animation: fadeIn 1s forwards;
        }

        h2 {
            text-align: center;
            color: #333;
            font-size: 28px;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: center;
            font-size: 16px;
        }

        th {
            background-color: #f4f4f4;
            color: #333;
        }

        td {
            background-color: #fafafa;
        }

        tr:nth-child(even) td {
            background-color: #f1f1f1;
        }

        .back-to-home {
            text-align: center;
            margin-top: 30px;
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
    </style>
</head>
<body>

<div class="container">
    <h2>Track Products</h2>
    
    <?php if ($result->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Item ID</th>
                    <th>Item Name</th>
                    <th>Quantity</th>
                    <th>Price per Unit</th>
                    <th>Manufacture Date</th>
                    <th>Expiration Date</th>
                    <th>Batch No</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['item_id']; ?></td>
                        <td><?php echo $row['item_name']; ?></td>
                        <td><?php echo $row['quantity']; ?></td>
                        <td><?php echo $row['price_per_unit']; ?></td>
                        <td><?php echo $row['mfd']; ?></td>
                        <td><?php echo $row['exp']; ?></td>
                        <td><?php echo $row['batch_no']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No product records found.</p>
    <?php endif; ?>

    <div class="back-to-home">
        <a href="index.php">Back to Home</a>
    </div>
</div>

</body>
</html>

