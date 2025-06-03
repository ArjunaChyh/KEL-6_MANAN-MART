<?php
require_once 'koneksi.php';

// Ambil data transaksi
$query = "SELECT * FROM data_pesanan ORDER BY tanggal DESC";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Gagal mengambil data: " . mysqli_error($conn));
}

// Hitung total pemasukan
$total_pemasukan = 0;
$pesanan = [];
while ($row = mysqli_fetch_assoc($result)) {
    $pesanan[] = $row;
    $total_pemasukan += $row['total'];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dashboard Admin - Riwayat Transaksi</title>
  <style>
    :root {
      --primary: #34495e;
      --light-bg: #f4f4f4;
      --white: #ffffff;
      --text: #222;
    }

    body {
      font-family: Arial, sans-serif;
      margin: 0;
      background-color: var(--light-bg);
      color: var(--text);
    }

    header {
      background-color: var(--primary);
      color: white;
      padding: 20px;
      text-align: center;
      font-size: 24px;
      font-weight: bold;
    }

    .container {
      max-width: 1000px;
      margin: 30px auto;
      padding: 20px;
      background-color: var(--white);
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    h2 {
      text-align: center;
      color: var(--primary);
      margin-bottom: 20px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    table, th, td {
      border: 1px solid #ddd;
    }

    th {
      background-color: var(--primary);
      color: white;
      padding: 10px;
      text-align: center;
    }

    td {
      padding: 10px;
      text-align: center;
    }

    tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    .back-link {
      text-decoration: none;
      display: inline-block;
      margin-bottom: 15px;
      color: var(--primary);
      font-weight: bold;
    }

    .back-link:hover {
      text-decoration: underline;
    }

    .total-box {
      margin-top: 25px;
      padding: 15px;
      background-color: var(--primary);
      color: white;
      border-radius: 8px;
      text-align: center;
      font-size: 18px;
      font-weight: bold;
    }
  </style>
</head>
<body>

<header>
  Dashboard Admin
</header>

<div class="container">
  <a href="Admin-dashboard.php" class="back-link">← Kembali</a>
  <h2>Riwayat Transaksi</h2>

  <table>
    <thead>
      <tr>
        <th>Order ID</th>
        <th>Produk</th>
        <th>Jumlah</th>
        <th>Harga</th>
        <th>Total</th>
        <th>Tanggal</th>
      </tr>
    </thead>
    <tbody>
      <?php if (count($pesanan) > 0): ?>
        <?php foreach ($pesanan as $row): ?>
          <tr>
            <td><?= htmlspecialchars($row['order_id']) ?></td>
            <td><?= htmlspecialchars($row['nama_produk']) ?></td>
            <td><?= (int)$row['jumlah'] ?></td>
            <td>Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
            <td>Rp <?= number_format($row['total'], 0, ',', '.') ?></td>
            <td><?= htmlspecialchars($row['tanggal']) ?></td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr>
          <td colspan="6">Belum ada transaksi.</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>

  <div class="total-box">
    Total Pemasukan: Rp <?= number_format($total_pemasukan, 0, ',', '.') ?>
  </div>
</div>

</body>
</html>
