Bol<?php
session_start();
include("../includes/db.php");

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}

if(isset($_GET['id'])){

    $id = $_GET['id'];

    $query = "DELETE FROM products WHERE id='$id'";

    if(mysqli_query($conn, $query)){
        header("Location: manage_products.php");
        exit();
    } else {
        echo "Error deleting product";
    }
}
?>
<a href="delete_product.php?id=<?php echo $row['id']; ?>" 
   onclick="return confirm('Are you sure you want to delete this product?')">
   Delete
</a>