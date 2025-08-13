<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Dashboard</title>

    <!-- Include Bootstrap Setup -->
    <?php include('bootstrap_setup.php'); ?>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
       
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            background: linear-gradient(to right, #ff7a18, #af002d, #319197, #fc00ff, #00dbde);
            background-size: 300% 300%;
            animation: gradientAnimation 15s ease infinite;
            color: #333;
            overflow-x: hidden;
            min-height: 100vh;
            display: flex;
        }

        @keyframes gradientAnimation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .dashboard-container {
            display: flex;
            flex: 1;
        }

        .sidebar {
            background: rgba(0, 0, 0, 0.7);
            color: #eee;
            width: 250px;
            padding: 20px;
            position: fixed;
            height: 100%;
            overflow-y: auto;
            transition: transform 0.3s ease-in-out;
            z-index: 100;
            box-shadow: 2px 0 5px rgba(0,0,0,0.2);
        }

        .sidebar h2 {
            margin-bottom: 20px;
            text-align: center;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar li a {
            display: block;
            padding: 10px;
            text-decoration: none;
            color: #eee;
            transition: background 0.3s;
            border-radius: 5px;
            margin-bottom: 5px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
        }

        .sidebar li a:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .content {
            flex: 1;
            padding: 20px;
            margin-left: 250px;
            transition: margin-left 0.3s ease-in-out;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            margin: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .home-icon {
            margin-bottom: 20px;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); opacity: 0.8; }
            50% { transform: scale(1.05); opacity: 1; }
            100% { transform: scale(1); opacity: 0.8; }
        }

        .home-icon img {
            max-width: 300px;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .home-icon img:hover {
            transform: scale(1.1);
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
        }

        h1, h2, p {
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
        }

        .menu-toggle {
            display: none;
            position: fixed;
            top: 20px;
            left: 20px;
            background: rgba(0, 0, 0, 0.5);
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            z-index: 101;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-250px);
            }

            .content {
                margin-left: 0;
            }

            .sidebar.collapsed {
                transform: translateX(0);
            }

            .content.collapsed {
                margin-left: 0;
            }

            .menu-toggle {
                display: block;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <aside class="sidebar" id="sidebar">
            <h2>Dashboard</h2>
            <ul>
                <li><a href="index.php"><i class="fas fa-home"></i> HOME</a></li>
                <li><a href="add_product.php"><i class="fas fa-plus"></i> ADD PRODUCT</a></li>
                <li><a href="search_product.php"><i class="fas fa-search"></i> SEARCH PRODUCT</a></li>
                <li><a href="inventory.php"><i class="fas fa-boxes"></i> INVENTORY</a></li>
                <li><a href="return_product.php"><i class="fas fa-undo"></i> RETURN PRODUCT</a></li>
                <li><a href="purchase.php"><i class="fas fa-shopping-cart"></i> PURCHASE</a></li>
                <li><a href="track_sales.php"><i class="fas fa-chart-line"></i> TRACK SALES</a></li>
                <li><a href="update_login.php"><i class="fas fa-user-cog"></i> UPDATE LOGIN</a></li>
                <li><a href="transactions.php"><i class="fas fa-exchange-alt"></i> TRANSACTIONS</a></li> <!-- Added Transactions link -->
                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> LOGOUT</a></li>
            </ul>
        </aside>

        <main class="content" id="content">
            <button class="menu-toggle" id="menuToggle">
                <i class="fas fa-bars"></i>
            </button>
            <h1>HOME</h1>
            <div class="home-icon">
                <img src="images/cabb028d-87b1-4f08-b856-1996add884ba.webp" alt="Inventory Logo">
            </div>
            <h2>INVENTORY Management System</h2>
            <p>The Software You Need</p>
            <p>Copyright © Inventory Management System by nur. All rights reserved.</p>
        </main>
    </div>
    
    <script src="js/script.js"></script>
</body>
</html>
