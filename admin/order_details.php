<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "../includes/db.php";
include "../includes/db.php";

if(isset($_GET['id'])){

    $order_id = $_GET['id'];

    $result = mysqli_query($conn, "SELECT * FROM order_items WHERE order_id=$order_id");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Order Details</title>

<style>
body { font-family: Arial; background:#f2f2f2; }

table {
    width: 70%;
    margin: 50px auto;
    background: white;
    border-collapse: collapse;
}

th, td {
    padding: 12px;
    border-bottom: 1px solid #ddd;
    text-align: center;
}

th { background: orange; color: white; }

a {
    text-decoration: none;
    padding: 5px 10px;
    background: orange;
    color: white;
    border-radius: 5px;
}
</style>
</head>

<body>

<h2 style="text-align:center;">📦 Order Products</h2>

<table>
<tr>
<th>Product</th>
<th>Price</th>
<th>Quantity</th>
<th>Subtotal</th>
</tr>

<?php
$total = 0;

while($row = mysqli_fetch_assoc($result)){

    echo "<tr>
            <td>{$row['product_name']}</td>
            <td>₹ {$row['price']}</td>
            <td>{$row['quantity']}</td>
            <td>₹ {$row['subtotal']}</td>
          </tr>";

    $total += $row['subtotal'];
}

echo "<tr>
        <td colspan='3'><b>Total</b></td>
        <td><b>₹ $total</b></td>
      </tr>";
?>

</table>

<div style="text-align:center; margin-top:20px;">
<a href="view_orders.php">⬅ Back</a>
</div>

</body>
</html>