<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit();
}

require_once 'db.php'; // Include your database connection file

// Fetch users and their product purchases and quantities
$query = "
    SELECT users.email, orders.product_name, SUM(orders.quantity) as total_quantity
    FROM users
    JOIN orders ON users.user_id = orders.user_id
    GROUP BY users.email, orders.product_name
    ORDER BY users.user_id
";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - User Management</title>
    <style>
        /* General Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f6;
            color: #333;
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background-color: #2c3e50;
            color: #fff;
            padding: 20px;
            height: 100%;
        }

        .sidebar h2 {
            margin-bottom: 30px;
            text-align: center;
            font-size: 24px;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }

        .sidebar ul li {
            margin: 20px 0;
        }

        .sidebar ul li a {
            text-decoration: none;
            color: #ecf0f1;
            display: block;
            padding: 10px;
            font-size: 18px;
        }

        .sidebar ul li a:hover {
            background-color: #34495e;
            border-radius: 5px;
        }

        .main-content {
            flex-grow: 1;
            background-color: #ecf0f1;
            padding: 20px;
            overflow-y: auto;
        }

        h1 {
            font-size: 32px;
            margin-bottom: 20px;
        }

        .dashboard-section {
            margin-bottom: 40px;
        }

        .dashboard-section h2 {
            font-size: 24px;
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #34495e;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        a {
            text-decoration: none;
            color: #2980b9;
        }

        a:hover {
            text-decoration: underline;
        }

        .btn {
            background-color: #2980b9;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }

        .btn:hover {
            background-color: #3498db;
        }

        /* Responsive Design */
        @media screen and (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                height: auto;
            }

            .main-content {
                padding: 10px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="sidebar">
            <h2>Admin Panel</h2>
            <ul>
                <li><a href="admin.php">Dashboard</a></li>
                <li><a href="manage_inventory.php">Manage Inventory</a></li>
                <li><a href="manage_orders.php">Manage Orders</a></li>
                <li><a href="manage_users.php">Manage Users</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>

        <div class="main-content">
            <h1>Users & Their Product Purchases</h1>

            <section class="dashboard-section">
                <h2>Users</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Email</th>
                            <th>Product Name</th>
                            <th>Total Quantity Purchased</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (mysqli_num_rows($result) > 0) : ?>
                            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                                <tr>
                                    <td><?php echo $row['email']; ?></td>
                                    <td><?php echo $row['product_name']; ?></td>
                                    <td><?php echo $row['total_quantity']; ?></td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="3">No data available</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </section>

        </div>
    </div>

</body>
</html>

<?php
mysqli_close($conn);
?>
