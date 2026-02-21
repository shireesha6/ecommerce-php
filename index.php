<?php
// Database connection include
include "includes/db.php";

// Fetch products
$result = mysqli_query($conn, "SELECT * FROM products");
?>

<!DOCTYPE html>
<html>
<head>
<title>Product List</title>

<style>
body {
    font-family: Arial;
    background: #f2f2f2;
}

h2 {
    text-align: center;
}

.products {
    display: flex;
    justify-content: center;
    gap: 20px;
    flex-wrap: wrap;
}

.card {
    background: white;
    width: 220px;
    padding: 15px;
    border-radius: 10px;
    box-shadow: 0px 0px 10px #ccc;
    text-align: center;
}

.card img {
    width: 180px;
    height: 150px;
    object-fit: cover;
    border-radius: 10px;
}

.card h3 {
    margin: 10px 0;
}

.card p {
    color: green;
    font-weight: bold;
}

.card a {
    display: inline-block;
    margin-top: 10px;
    padding: 8px 15px;
    background: orange;
    color: white;
    text-decoration: none;
    border-radius: 5px;
}

.card a:hover {
    background: darkorange;
}
</style>
</head>

<body>

<h2>🛒 Product List</h2>

<div class="products">

<?php while($row = mysqli_fetch_assoc($result)) { ?>

    <div class="card">
        <!-- Correct Image Path -->
        <img src="images/<?php echo $row['image']; ?>">

        <h3><?php echo $row['name']; ?></h3>

        <p>₹ <?php echo $row['price']; ?></p>

        <!-- Correct Cart Path -->
        <a href="pages/cart.php?id=<?php echo $row['id']; ?>">
            Add to Cart
        </a>
    </div>

<?php } ?>

</div>

</body>
</html>