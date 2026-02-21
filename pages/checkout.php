<?php
session_start();
include "../includes/db.php";

if(isset($_POST['place_order'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $total = $_SESSION['total_amount'];

    $sql = "INSERT INTO orders (customer_name, customer_email, total_amount)
            VALUES ('$name', '$email', '$total')";

    if(mysqli_query($conn, $sql)){

        // Get last inserted order ID
        $order_id = mysqli_insert_id($conn);

        // Insert each product into order_items table
        foreach($_SESSION['cart'] as $item){

            $pname = $item['name'];
            $price = $item['price'];
            $qty = $item['qty'];
            $subtotal = $price * $qty;

            $item_sql = "INSERT INTO order_items 
                        (order_id, product_name, price, quantity, subtotal)
                        VALUES 
                        ('$order_id', '$pname', '$price', '$qty', '$subtotal')";

            mysqli_query($conn, $item_sql);
        }

        // Clear cart
        unset($_SESSION['cart']);
        unset($_SESSION['total_amount']);

        echo "<script>
                alert('Order Placed Successfully!');
                window.location='../index.php';
              </script>";
        exit();

    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Checkout</title>

<style>
body { font-family: Arial; background: #f2f2f2; }

.checkout-container {
    width: 400px;
    margin: 60px auto;
    background: white;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
}

h2 { text-align: center; margin-bottom: 20px; }

input {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
}

button {
    width: 100%;
    padding: 12px;
    background: green;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
}

button:hover { background: darkgreen; }

.total-box {
    text-align: center;
    font-size: 18px;
    margin-bottom: 15px;
    background: #f8f8f8;
    padding: 10px;
    border-radius: 5px;
}
</style>
</head>

<body>

<div class="checkout-container">

<h2>🧾 Checkout</h2>

<div class="total-box">
Total Amount: ₹ <?php echo $_SESSION['total_amount'] ?? 0; ?>
</div>

<form method="POST">
<input type="text" name="name" placeholder="Enter Your Name" required>
<input type="email" name="email" placeholder="Enter Your Email" required>
<button type="submit" name="place_order">Place Order</button>
</form>

</div>

</body>
</html>