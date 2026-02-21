<?php
include "../includes/db.php";

if(isset($_GET['id']) && isset($_GET['status'])){

    $id = $_GET['id'];
    $status = $_GET['status'];

    mysqli_query($conn, "UPDATE orders SET status='$status' WHERE id=$id");

    header("Location: view_orders.php");
}
?>