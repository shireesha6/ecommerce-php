<?php
session_start();

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #4e73df, #1cc88a);
            text-align: center;
            padding-top: 80px;
        }

        h2 {
            color: white;
            font-size: 32px;
        }

        .btn {
            display: inline-block;
            margin: 15px;
            padding: 12px 25px;
            background: white;
            color: #4e73df;
            text-decoration: none;
            border-radius: 8px;
            font-size: 18px;
            font-weight: bold;
            transition: 0.3s;
        }

        .btn:hover {
            background: #f8f9fc;
            transform: scale(1.05);
        }

        .logout {
            background: #e74a3b;
            color: white;
        }

        .logout:hover {
            background: #c0392b;
        }
    </style>
</head>
<body>

<h2>Welcome Admin 🎉</h2>

<a href="add_product.php" class="btn">Add Product</a>
<a href="manage_products.php" class="btn">View Products</a>
<a href="view_users.php" class="btn">View Users</a>

<br><br>

<a href="logout.php" class="btn logout">Logout</a>
<a href="view_orders.php" class="btn">View Orders</a>
</body>
</html>