<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Return Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            background: linear-gradient(to right, #2980b9, #8e44ad);
            background-size: 400% 400%;
            animation: gradientAnimation 15s ease infinite;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        @keyframes gradientAnimation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            color: #333;
            flex-grow: 1;
            transition: transform 0.3s ease;
        }

        .container:hover {
            transform: scale(1.02);
        }

        h1 {
            text-align: center;
            color: #0078d7;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        textarea,
        select {
            width: calc(100% - 12px);
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            background-color: white;
            color: #333;
        }

        input[type="submit"],
        .back-to-home {
            background-color: #0078d7;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            margin-top: 10px;
        }

        input[type="submit"]:hover,
        .back-to-home:hover {
            background-color: #005bb5;
        }

        .error-message, .success-message {
            text-align: center;
            margin-bottom: 10px;
        }

        .error-message {
            color: red;
        }

        .success-message {
            color: green;
        }

        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px 0;
            margin-top: auto;
            width: 100%;
        }
    </style>
</head>
<body>
    <?php
   
    $host = 'localhost'; 
    $db = 'tools_project'; 
    $user = 'root'; 
    $pass = ''; 

    $error_message = '';
    $success_message = '';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $conn = new mysqli($host, $user, $pass, $db);

        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $order_id = $conn->real_escape_string($_POST['order_id']);
        $product_name = $conn->real_escape_string($_POST['product_name']);
        $reason = $conn->real_escape_string($_POST['reason']);
        $return_method = $conn->real_escape_string($_POST['return_method']);
        $customer_email = $conn->real_escape_string($_POST['customer_email']);

        
        $sql = "INSERT INTO returnss (order_id, product_name, reason, return_method, customer_email) 
                VALUES ('$order_id', '$product_name', '$reason', '$return_method', '$customer_email')";

        if ($conn->query($sql) === TRUE) {
            $success_message = "Your return request has been submitted successfully.";
        } else {
            $error_message = "Error: " . $conn->error;
        }

        
        $conn->close();
    }
    ?>

    <div class="container">
        <h1>Return Product</h1>

        <?php if (!empty($error_message)): ?>
            <div class="error-message"><?php echo $error_message; ?></div>
        <?php endif; ?>
        <?php if (!empty($success_message)): ?>
            <div class="success-message"><?php echo $success_message; ?></div>
        <?php endif; ?>

        <form action="" method="post">
            <label for="order_id">Order ID:</label>
            <input type="text" id="order_id" name="order_id" required>

            <label for="product_name">Product Name:</label>
            <input type="text" id="product_name" name="product_name" required>

            <label for="reason">Reason for Return:</label>
            <textarea id="reason" name="reason" rows="4" required></textarea>

            <label for="return_method">Preferred Return Method:</label>
            <select name="return_method" id="return_method">
                <option value="refund">Refund</option>
                <option value="exchange">Exchange</option>
            </select>

            <label for="customer_email">Customer Email:</label>
            <input type="email" id="customer_email" name="customer_email" required>

            <input type="submit" value="Submit Return Request">
        </form>

        <a href="index.php" class="back-button">Back to Home</a>
    </div>
    <footer>
        <p>&copy; 2023 Your Company. All rights reserved.</p>
    </footer>
</body>
</html>
