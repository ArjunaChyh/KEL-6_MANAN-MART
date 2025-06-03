<?php
require_once("koneksi.php");

// Ambil semua produk dari database
$query = "SELECT * FROM products";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Produk</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f2f5;
            padding: 30px;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .btn-back {
            position: fixed;
            top: 15px;
            left: 15px;
            background-color: #34495e;
            color: white;
            padding: 8px 14px;
            text-decoration: none;
            border-radius: 5px;
            z-index: 1000;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            font-weight: bold;
            transition: opacity 0.3s ease;
        }

        .btn-back:hover {
            opacity: 0.8;
        }



        .btn-add {
            background-color: #34495e;
            color: white;
            padding: 10px 16px;
            text-decoration: none;
            border-radius: 5px;
        }

        h2 {
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th,
        table td {
            border: 1px solid #ccc;
            padding: 12px;
            text-align: center;
        }

        table th {
            background-color: #f8f8f8;
        }

        .btn {
            padding: 6px 12px;
            border-radius: 5px;
            text-decoration: none;
            color: white;
            margin: 0 4px;
        }

        .btn-edit {
            background-color: #007bff;
        }

        .btn-delete {
            background-color: #dc3545;
        }

        .btn-edit:hover,
        .btn-delete:hover,
        .btn-add:hover,
        .btn-back:hover {
            opacity: 0.9;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header-section">
            <h2>Dashboard Produk</h2>
            <a href="tambah_produk.php" class="btn-add">Tambah Produk</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                    <tr>
                        <td><?= $row['produk_id'] ?></td>
                        <td><?= htmlspecialchars($row['name']) ?></td>
                        <td>Rp<?= number_format($row['price'], 0, ',', '.') ?></td>
                        <td>
                            <?php if (!empty($row['image_url'])) : ?>
                                <img src="-" alt="-" width="80">
                            <?php else : ?>
                                <span>-</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="Produk_edit.php?id=<?= $row['produk_id'] ?>" class="btn btn-edit">Edit</a>
                            <a href="hapus_produk.php?id=<?= $row['produk_id'] ?>" class="btn btn-delete" onclick="return confirm('Yakin ingin menghapus produk ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

     
        <a href="Admin-Dashboard.php" class="btn-back">Kembali</a>
    </div>
</body>

</html>