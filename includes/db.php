<?php
$conn = mysqli_connect("localhost", "root", "", "ecommerce1", 3307);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>