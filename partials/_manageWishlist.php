<?php
include '_dbconnect.php';
session_start(); // Memulai session

if (isset($_POST['addToWishlist']) && isset($_SESSION['userId'])) {
    $userId = $_SESSION['userId']; // Ambil userId dari session
    $pizzaId = $_POST['itemId']; // Ambil pizzaId yang dipilih

    // Cek jika produk sudah ada di wishlist
    $checkSql = "SELECT * FROM `wishlist` WHERE `userId` = '$userId' AND `pizzaId` = '$pizzaId'";
    $checkResult = mysqli_query($conn, $checkSql);
    
    if (mysqli_num_rows($checkResult) > 0) {
        // Produk sudah ada di wishlist, jadi kita hapus
        $deleteSql = "DELETE FROM `wishlist` WHERE `userId` = '$userId' AND `pizzaId` = '$pizzaId'";
        mysqli_query($conn, $deleteSql);
        header('Location: ../wishlist.php'); // Redirect ke halaman wishlist setelah dihapus
    } else {
        // Produk belum ada di wishlist, jadi kita tambahkan
        $insertSql = "INSERT INTO `wishlist` (`userId`, `pizzaId`, `time`) VALUES ('$userId', '$pizzaId', NOW())";
        mysqli_query($conn, $insertSql);
        header('Location: ../wishlist.php'); // Redirect ke halaman wishlist setelah ditambahkan
    }
}
?>
