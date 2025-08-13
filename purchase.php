<?php
$servername = "localhost"; 
$username = "root";        
$password = "";            
$dbname = "tools_project"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$product_name = $item_id = $quantity = $customer_email = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_name = $_POST['product_name'];
    $item_id = $_POST['item_id'];
    $quantity = $_POST['quantity'];
    $customer_email = $_POST['customer_email'];

    $sql = "INSERT INTO sales (product_name, item_id, quantity, sale_date, customer_email) 
            VALUES (?, ?, ?, NOW(), ?)";

    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("sids", $product_name, $item_id, $quantity, $customer_email);

    if ($stmt->execute()) {
        echo "<div class='success fade-in'>Sale record added successfully!</div>";
    } else {
        echo "<div class='error fade-in'>Error: " . $stmt->error . "</div>";
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
    <title>Sale Form</title>
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
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .container {
            max-width: 600px;
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
            font-size: 24px;
            margin-bottom: 20px;
        }

        .form-label {
            font-size: 16px;
            color: #555;
            margin-bottom: 5px;
        }

        input[type="text"], input[type="number"], input[type="email"], input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            transition: transform 0.3s ease;
        }

        input[type="text"]:focus, input[type="number"]:focus, input[type="email"]:focus {
            transform: scale(1.05);
            border-color: #4CAF50;
        }

        input[type="submit"] {
            background-color:rgb(175, 76, 76);
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color:rgb(160, 69, 69);
            transform: scale(1.05);
        }

        .success {
            padding: 10px;
            margin: 20px 0;
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            border-radius: 4px;
            text-align: center;
            opacity: 0;
            animation: fadeIn 1s forwards;
        }

        .error {
            padding: 10px;
            margin: 20px 0;
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            border-radius: 4px;
            text-align: center;
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
    <h2>Purchase Form</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label class="form-label" for="product_name">Product Name:</label>
        <input type="text" id="product_name" name="product_name" required><br>

        <label class="form-label" for="item_id">Item ID:</label>
        <input type="number" id="item_id" name="item_id" required><br>
        
        <label class="form-label" for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" required><br>

        <label class="form-label" for="customer_email">Customer Email:</label>
        <input type="email" id="customer_email" name="customer_email" required><br>

        <input type="submit" value="Submit">
    </form>

    <div class="back-to-home">
        <a href="index.php">Back to Home</a>
    </div>
</div>

</body>
</html>

