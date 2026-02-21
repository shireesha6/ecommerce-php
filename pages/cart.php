<?php
session_start();
include "../includes/db.php";

// Create cart session if not exists
if(!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// ADD PRODUCT TO CART
if(isset($_GET['id'])) {

    $id = $_GET['id'];

    $result = mysqli_query($conn, "SELECT * FROM products WHERE id=$id");
    $product = mysqli_fetch_assoc($result);

    $found = false;

    foreach($_SESSION['cart'] as &$item) {
        if($item['id'] == $id) {
            $item['qty'] += 1;
            $found = true;
            break;
        }
    }

    if(!$found) {
        $product['qty'] = 1;
        $_SESSION['cart'][] = $product;
    }
}

// INCREASE QTY
if(isset($_GET['increase'])) {
    $_SESSION['cart'][$_GET['increase']]['qty']++;
}

// DECREASE QTY
if(isset($_GET['decrease'])) {

    $_SESSION['cart'][$_GET['decrease']]['qty']--;

    if($_SESSION['cart'][$_GET['decrease']]['qty'] <= 0) {
        unset($_SESSION['cart'][$_GET['decrease']]);
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }
}

// REMOVE ITEM
if(isset($_GET['remove'])) {
    unset($_SESSION['cart'][$_GET['remove']]);
    $_SESSION['cart'] = array_values($_SESSION['cart']);
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Your Cart</title>

<style>
body { font-family: Arial; background:#f2f2f2; }

table {
    width: 70%;
    margin: auto;
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

a:hover { background: darkorange; }

.checkout-btn {
    background: green;
}

.checkout-btn:hover {
    background: darkgreen;
}

.total {
    text-align:center;
    font-size:22px;
    margin-top:20px;
}
</style>
</head>

<body>

<h2 style="text-align:center;">🛒 Your Cart</h2>

<table>
<tr>
<th>Product</th>
<th>Price</th>
<th>Quantity</th>
<th>Subtotal</th>
<th>Action</th>
</tr>

<?php
$total = 0;

if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {

    foreach($_SESSION['cart'] as $index => $item) {

        $subtotal = $item['price'] * $item['qty'];
        $total += $subtotal;

        echo "<tr>
                <td>{$item['name']}</td>
                <td>₹ {$item['price']}</td>

                <td>
                    <a href='cart.php?decrease=$index'>➖</a>
                    {$item['qty']}
                    <a href='cart.php?increase=$index'>➕</a>
                </td>

                <td>₹ $subtotal</td>

                <td>
                    <a href='cart.php?remove=$index'>Remove</a>
                </td>
              </tr>";
    }

    // STORE TOTAL IN SESSION
    $_SESSION['total_amount'] = $total;

}
else {
    echo "<tr><td colspan='5'>Cart is Empty</td></tr>";
}
?>

</table>

<div class="total">
<b>Total: ₹ <?php echo $total; ?></b>
</div>

<div style="text-align:center; margin-top:20px;">

<a href="/ecommerce/index.php">⬅ Continue Shopping</a>

<?php if($total > 0) { ?>
<a href="checkout.php" class="checkout-btn">Proceed to Checkout ➡</a>
<?php } ?>

</div>

</body>
</html>