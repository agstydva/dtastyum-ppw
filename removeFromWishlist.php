<?php
include '_dbconnect.php';
session_start();

if (!isset($_SESSION['userId'])) {
    echo "Anda harus login untuk menghapus wishlist.";
    exit;
}

$userId = $_SESSION['userId'];
$pizzaId = $_POST['pizzaId'];

$sql = "DELETE FROM wishlist WHERE userId = '$userId' AND pizzaId = '$pizzaId'";
if (mysqli_query($conn, $sql)) {
    header("Location: ../wishlist.php");
    exit;
} else {
    echo "Gagal menghapus produk dari wishlist. Error: " . mysqli_error($conn);
}
?>
