<?php
$order_id = isset($_GET['order_id']) ? htmlspecialchars($_GET['order_id']) : '';
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Ajukan Pengembalian</title>
    <style>
        body {
            font-family: sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            background-color: white;
            padding: 30px;
            margin: auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            margin-top: 20px;
            background-color: orange;
            color: white;
            border: none;
            padding: 15px;
            width: 100%;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: darkorange;
        }

        .success-message {
            margin-top: 20px;
            color: green;
            font-weight: bold;
            text-align: center;
        }

        .back-arrow {
            position: absolute;
            top: 12px;
            left: 20px;
            font-size: 28px;
            text-decoration: none;
            color: black;
            z-index: 1000;
        }
    </style>
</head>

<body>
    <a href="keranjang.php" class="back-arrow">←</a>

    <div class="container">
        <h1>Formulir Pengembalian Barang</h1>

        <form id="refundForm" action="submit_pengembalian.php" method="POST" enctype="multipart/form-data">
            <label for="nama">Nama Pembeli</label>
            <input type="text" id="nama" name="nama_pembeli" required>

            <label for="email">Email Pembeli</label>
            <input type="email" id="email" name="email_pembeli" required>

            <label for="orderId">ID Pesanan</label>
            <input type="text" id="orderId" name="id_pesanan" value="<?= $order_id ?>" readonly required>


            <label for="alasan">Alasan Pengembalian</label>
            <textarea name="alasan_pengembalian" rows="4" required></textarea>

            <label for="bukti">Upload Bukti (Opsional)</label>
            <input type="file" id="bukti" name="bukti" accept="image/*">

            <button type="submit">Ajukan Pengembalian</button>
        </form>
    </div>

</body>

</html>