<?php
session_start();
include("../includes/db.php");

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}

$result = mysqli_query($conn, "SELECT * FROM products");
?>

<!DOCTYPE html>
<html>
<head>
<title>Manage Products</title>

<style>
body {
    font-family: Arial;
    background: #f4f6f9;
    text-align: center;
    padding-top: 50px;
}

table {
    margin: auto;
    background: white;
    border-collapse: collapse;
    width: 70%;
}

th, td {
    padding: 12px;
    border: 1px solid #ddd;
}

th {
    background: #4e73df;
    color: white;
}

a {
    text-decoration: none;
}
</style>
</head>
<body>

<h2>Manage Products</h2>

<table>
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Price</th>
    <th>Action</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)) { ?>
<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['price']; ?></td>
    <td>
        <a href="delete_product.php?id=<?php echo $row['id']; ?>">
            Delete
        </a>
    </td>
</tr>
<?php } ?>

</table>

<br><br>
<a href="dashboard.php">Back to Dashboard</a>

</body>
</html>