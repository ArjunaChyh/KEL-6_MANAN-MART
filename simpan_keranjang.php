<?php
session_start();
include 'koneksi.php';

$user_id = $_SESSION['user_id']; // pastikan user login

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cart_data'])) {
    $cart = json_decode($_POST['cart_data'], true);

    if (!empty($cart)) {
        foreach ($cart as $item) {
            $produk_id = $item['id'];
            $qty = $item['qty'];

            // Cek apakah sudah ada di cart
            $cek = mysqli_query($conn, "SELECT * FROM cart WHERE user_id = '$user_id' AND produk_id = '$produk_id'");
            if (mysqli_num_rows($cek) > 0) {
                mysqli_query($conn, "UPDATE cart SET quantity = quantity + $qty WHERE user_id = '$user_id' AND produk_id = '$produk_id'");
            } else {
                mysqli_query($conn, "INSERT INTO cart (user_id, produk_id, quantity) VALUES ('$user_id', '$produk_id', '$qty')");
            }
        }

        header("Location: Alamatpembayaran.php");
        exit;
    }
}
?>
