<?php

$servername = "localhost"; 
$username = "root";        
$password = "";            
$dbname = "tools_project"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $order_id = htmlspecialchars(trim($_POST['order_id']));
    $product_name = htmlspecialchars(trim($_POST['product_name']));
    $reason = htmlspecialchars(trim($_POST['reason']));
    $return_method = htmlspecialchars(trim($_POST['return_method']));
    $customer_email = htmlspecialchars(trim($_POST['customer_email']));

    if (empty($order_id) || empty($product_name) || empty($reason) || empty($return_method) || empty($customer_email)) {
        $error_message = "All fields are required.";
    } elseif (!filter_var($customer_email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Invalid email address.";
    } else {
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "INSERT INTO returns (sale_id, item_id, quantity, return_date, product_name, return_reason, return_method, customer_email) 
                SELECT s.sale_id, p.item_id, s.quantity, NOW(), s.product_name, ?, ?, ?
                FROM sales s 
                JOIN products p ON p.item_name = ? 
                WHERE s.sale_id = ? AND s.product_name = ?";

        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            die('Error preparing statement: ' . $conn->error);
        }

        $stmt->bind_param("sssiis", $reason, $return_method, $customer_email, $product_name, $order_id, $product_name);

        if ($stmt->execute()) {
            $success_message = "Your return request has been successfully submitted.";
        } else {
            $error_message = "An error occurred: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Return Product - Processed</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            background: linear-gradient(to right, #1e3c72, #2a5298);
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
            text-align: center;
        }

        .message-container {
            max-width: 500px;
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.7);
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        .success {
            color: #28a745;
        }

        .error {
            color: #dc3545;
        }

        a {
            color: #0078d7;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="message-container">
        <?php if (isset($success_message)): ?>
            <h1 class="success">Success</h1>
            <p><?php echo $success_message; ?></p>
        <?php elseif (isset($error_message)): ?>
            <h1 class="error">Error</h1>
            <p><?php echo $error_message; ?></p>
        <?php endif; ?>
        <p><a href="index.php">Back to Home</a></p>
    </div>
</body>
</html>
