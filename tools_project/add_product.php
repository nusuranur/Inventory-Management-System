<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'tools_project';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $item_id = $_POST['item_id'];
    $item_name = $_POST['item_name'];
    $quantity = $_POST['quantity'];
    $price_per_unit = $_POST['price_per_unit'];
    $mfd = $_POST['mfd'];
    $exp = $_POST['exp'];
    $batch_no = $_POST['batch_no'];

    // Insert p in database
    $insertQuery = "INSERT INTO products (item_id, item_name, quantity, price_per_unit, mfd, exp, batch_no) 
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insertQuery);
    $stmt->bind_param('isidsss', $item_id, $item_name, $quantity, $price_per_unit, $mfd, $exp, $batch_no);
    
    if ($stmt->execute()) {
        echo "<p class='success'>Product added successfully!</p>";
    } else {
        echo "<p class='error'>Error adding product: " . $conn->error . "</p>";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product | Inventory Management</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            background: linear-gradient(to right, #ff7a18, #af002d, #319197, #fc00ff, #00dbde);
            background-size: 400% 400%;
            animation: gradientBG 10s ease infinite;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
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
            max-width: 600px;
            width: 100%;
            background: rgba(0, 0, 0, 0.8); /* Darker background for better contrast */
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
            color: white;
            transform: scale(0.95);
            animation: fadeInUp 1s forwards;
            border: 2px solid #fff; /* Added a white border to make boundaries clear */
            position: relative; /* Ensuring no movement */
        }

        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(30px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #fff;
            font-size: 2.2em;
            text-transform: uppercase;
            letter-spacing: 2px;
            animation: textGlow 3s infinite alternate;
        }

        @keyframes textGlow {
            0% {
                text-shadow: 0 0 10px #FF6F61, 0 0 20px #FF6F61, 0 0 30px #FF6F61;
            }
            100% {
                text-shadow: 0 0 20px #FF6F61, 0 0 30px #FF6F61, 0 0 40px #FF6F61;
            }
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-size: 16px;
            color: #fff;
            display: block;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border-radius: 8px;
            border: 1px solid #fff;
            background: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .form-group input:focus {
            outline: none;
            background: rgba(255, 255, 255, 0.2);
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 14px 24px;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        button:hover {
            background-color: #45a049;
            transform: scale(1.05);
        }

        button:active {
            transform: scale(1);
        }

        .back-button {
            display: inline-block;
            padding: 14px 24px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            text-align: center;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .back-button:hover {
            background-color: #0056b3;
        }

        .success {
            color: #28a745;
            font-size: 16px;
            margin-top: 20px;
            text-align: center;
        }

        .error {
            color: #dc3545;
            font-size: 16px;
            margin-top: 20px;
            text-align: center;
        }

        .button-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

    </style>
</head>
<body>
    <div class="container">
        <h1>Add Product</h1>
        <form action="add_product.php" method="POST">
            <div class="form-group">
                <label for="item_id">Item ID</label>
                <input type="number" id="item_id" name="item_id" required>
            </div>
            <div class="form-group">
                <label for="item_name">Item Name</label>
                <input type="text" id="item_name" name="item_name" required>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" id="quantity" name="quantity" required>
            </div>
            <div class="form-group">
                <label for="price_per_unit">Price per Unit</label>
                <input type="number" id="price_per_unit" name="price_per_unit" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="mfd">MFD (Manufacture Date)</label>
                <input type="date" id="mfd" name="mfd" required>
            </div>
            <div class="form-group">
                <label for="exp">EXP (Expiry Date)</label>
                <input type="date" id="exp" name="exp" required>
            </div>
            <div class="form-group">
                <label for="batch_no">Batch No</label>
                <input type="text" id="batch_no" name="batch_no" required>
            </div>

            <div class="button-container">
                <button type="submit">Add Product</button>
                <button type="reset">Clear</button>
                <a href="index.php" class="back-button">Back to Home</a>
            </div>
        </form>
    </div>
</body>
</html>
