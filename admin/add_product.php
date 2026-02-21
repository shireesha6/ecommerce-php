<?php
session_start();
include("../includes/db.php");

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}

if(isset($_POST['add_product'])){

    $name = $_POST['name'];
    $price = $_POST['price'];

    $query = "INSERT INTO products (name, price) 
              VALUES ('$name', '$price')";

    if(mysqli_query($conn, $query)){
        echo "<script>alert('Product Added Successfully')</script>";
    } else {
        echo "Error!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #4e73df, #1cc88a);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background: #fff;
            padding: 40px;
            border-radius: 12px;
            width: 350px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            text-align: center;
        }

        h2 {
            margin-bottom: 25px;
            font-size: 28px;
            color: #333;
        }

        input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        button {
            width: 100%;
            padding: 12px;
            background: #4e73df;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 6px;
            cursor: pointer;
        }

        button:hover {
            background: #2e59d9;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Add Product</h2>

    <form method="POST">
        <input type="text" name="name" placeholder="Product Name" required>
        <input type="number" name="price" placeholder="Product Price" required>
        <button type="submit" name="add_product">Add Product</button>
    </form>
</div>

</body>
</html>