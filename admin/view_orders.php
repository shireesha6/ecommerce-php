<?php
include "../includes/db.php";

$result = mysqli_query($conn, "SELECT * FROM orders ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
<title>View Orders</title>

<style>
body { font-family: Arial; background:#f2f2f2; }

table {
    width: 80%;
    margin: 40px auto;
    background: white;
    border-collapse: collapse;
}

th, td {
    padding: 12px;
    border-bottom: 1px solid #ddd;
    text-align: center;
}

th {
    background: darkblue;
    color: white;
}

h2 {
    text-align:center;
    margin-top:30px;
}
</style>
</head>

<body>

<h2>📦 All Orders</h2>

<table>
<tr>
<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Total</th>
<th>Date</th>
</tr>

<?php
while($row = mysqli_fetch_assoc($result)){
?>
<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['customer_name']; ?></td>
    <td><?php echo $row['customer_email']; ?></td>
    <td>₹ <?php echo $row['total_amount']; ?></td>
    <td><?php echo $row['order_date']; ?></td>
</tr>
<?php
}
?>

</table>

</body>
</html>