<?php
$servername = "localhost"; 
$username = "root";        
$password = "";            
$dbname = "tools_project"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$item_id = $user_id = $sale_id = $return_id = $transaction_type = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item_id = $_POST['item_id'];
    $user_id = $_POST['user_id'];
    $sale_id = $_POST['sale_id'];
    $return_id = $_POST['return_id'];
    $transaction_type = $_POST['transaction_type'];

    $sql = "INSERT INTO transactions (item_id, user_id, sale_id, return_id, transaction_type, transaction_date) 
            VALUES ('$item_id', '$user_id', '$sale_id', '$return_id', '$transaction_type', NOW())";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='success fade-in'>Transaction record added successfully!</div>";
    } else {
        echo "<div class='error fade-in'>Error: " . $sql . "<br>" . $conn->error . "</div>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Form</title>
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

        input[type="text"], input[type="number"], select, input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            transition: transform 0.3s ease;
        }

        input[type="text"]:focus, input[type="number"]:focus, select:focus {
            transform: scale(1.05);
            border-color: #4CAF50;
        }

        input[type="submit"] {
            background-color: rgb(175, 76, 76);
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: rgb(160, 69, 69);
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
    <h2>Transaction Form</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label class="form-label" for="item_id">Item ID:</label>
        <input type="number" id="item_id" name="item_id" required><br>

        <label class="form-label" for="user_id">User ID:</label>
        <input type="number" id="user_id" name="user_id" required><br>

        <label class="form-label" for="sale_id">Sale ID:</label>
        <input type="number" id="sale_id" name="sale_id"><br>

        <label class="form-label" for="return_id">Return ID:</label>
        <input type="number" id="return_id" name="return_id"><br>

        <label class="form-label" for="transaction_type">Transaction Type:</label>
        <select id="transaction_type" name="transaction_type" required>
            <option value="sale">Sale</option>
            <option value="return">Return</option>
        </select><br>

        <input type="submit" value="Submit">
    </form>

    <div class="back-to-home">
        <a href="index.php">Back to Home</a>
    </div>
</div>

</body>
</html>
