<?php
require_once("koneksi.php"); // pastikan file koneksi tersedia dan menghasilkan $conn

// Ambil data statistik
$jumlah_user = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users"));
$jumlah_produk = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM products"));
$jumlah_cart = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM cart"));
$jumlah_pesan = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM pesan"));
$jumlah_pengembalian = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM pengembalian"));
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f4f4;
        }

        .sidebar {
            width: 220px;
            background: #2c3e50;
            color: #fff;
            height: 100vh;
            position: fixed;
        }

        .sidebar h2 {
            text-align: center;
            padding: 20px 0;
            margin: 0;
            border-bottom: 1px solid #444;
        }

        .sidebar a {
            display: block;
            color: #fff;
            padding: 15px 20px;
            text-decoration: none;
        }

        .sidebar a:hover {
            background: #34495e;
        }

        .content {
            margin-left: 220px;
            padding: 20px;
        }

        .card {
            background: #fff;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .card h3 {
            margin: 0 0 10px;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <a href="Admin-dashboard.php">Dashboard</a>
        <a href="ProdukDashboard.php">Data Produk</a>
        <a href="LoginDashboard.php">Data Pengguna</a>
        <a href="TransaksiDashboard.php">Transaksi</a>
        <a href="PesanDashboard.php">Pesan</a>
        <a href="AlamatDashboard.php">Alamat</a>
        <a href="RefundDashboard.php">Pengembalian</a>
        <a href="RatingDashboard.php">Ratings</a>
    </div>

    <div class="content">
        <h1>Selamat Datang, Admin!</h1>

        <div class="card">
            <h3>Total Pengguna</h3>
            <p><?= $jumlah_user ?></p>
        </div>

        <div class="card">
            <h3>Total Produk</h3>
            <p><?= $jumlah_produk ?></p>
        </div>

        <div class="card">
            <h3>Total Keranjang</h3>
            <p><?= $jumlah_cart ?></p>
        </div>

        <div class="card">
            <h3>Total Pesan</h3>
            <p><?= $jumlah_pesan ?></p>
        </div>

        <div class="card">
            <h3>Total Pengembalian</h3>
            <p><?= $jumlah_pengembalian ?></p>
        </div>
    </div>
</body>

</html>
