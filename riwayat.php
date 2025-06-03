<?php
session_start();
require_once 'koneksi.php';

$user_id = $_SESSION['user_id'] ?? null;

if (!$user_id) {
    die("Anda belum login.");
}

$query = "SELECT * FROM data_pesanan WHERE user_id = '$user_id' ORDER BY tanggal DESC";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query gagal: " . mysqli_error($conn));
}

$pesanan = [];

while ($row = mysqli_fetch_assoc($result)) {
    $pesanan[] = $row;
}
?>



<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <title>Riwayat Pesanan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <style>
        :root {
            --primary: #FF9100;
            --bg: #f9f9f9;
            --card-bg: #ffffff;
            --text: #333;
            --shadow: rgba(0, 0, 0, 0.1);
        }

        .back-arrow {
            position: absolute;
            top: 12px;
            left: 20px;
            font-size: 38px;
            text-decoration: none;
            color: black;
            z-index: 1000;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background-color: var(--bg);
            color: var(--text);
        }

        header {
            background-color: var(--primary);
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 1.8rem;
            box-shadow: 0 2px 6px var(--shadow);
        }

        .container {
            max-width: 960px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .card {
            background-color: var(--card-bg);
            border-radius: 10px;
            box-shadow: 0 4px 12px var(--shadow);
            padding: 20px;
            margin-bottom: 25px;
            transition: transform 0.2s ease;
        }

        .card:hover {
            transform: scale(1.01);
        }

        .card h3 {
            margin-top: 0;
            color: var(--primary);
        }

        .card p {
            margin: 6px 0;
        }

        .refund-button {
            display: inline-block;
            text-align: center;
            text-decoration: none;
            padding: 10px 18px;
            background-color: var(--primary);
            border-radius: 6px;
            color: white;
            font-size: 1rem;
            cursor: pointer;
            border: none;
            transition: background-color 0.3s ease;
            margin-top: 15px;
        }

        .refund-button:hover {
            background-color: #e65100;
        }

        @media (max-width: 600px) {
            .card {
                padding: 15px;
            }

            header {
                font-size: 1.5rem;
                padding: 15px;
            }

            .refund-button {
                width: 100%;
            }
        }
    </style>
</head>

<body>

    <a href="keranjang.php" class="back-arrow">←</a>

    <header>Riwayat Pesanan</header>

    <div class="container">
        <?php if (count($pesanan) === 0): ?>
            <p style="text-align:center;">Belum ada pesanan.</p>
        <?php else: ?>
            <?php foreach ($pesanan as $row): ?>
                <div class="card">
                    <h3>Order ID: <?= htmlspecialchars($row['order_id']) ?></h3>
                    <p><strong>Produk:</strong> <?= htmlspecialchars($row['nama_produk']) ?></p>
                    <p><strong>Jumlah:</strong> <?= (int)$row['jumlah'] ?></p>
                    <p><strong>Harga per produk:</strong> Rp <?= number_format($row['harga'], 0, ',', '.') ?></p>
                    <p><strong>Total Harga:</strong> Rp <?= number_format($row['total'], 0, ',', '.') ?></p>
                    <p><strong>Waktu Pesan:</strong> <?= $row['tanggal'] ?></p>
                    <a href="refund.php?order_id=<?= urlencode($row['order_id']) ?>" class="refund-button">Ajukan Refund</a>


                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <script>
        function refund(orderId) {
            if (confirm("Yakin ingin refund untuk Order ID " + orderId + "?")) {
                fetch("user_refund.php", {
                        method: "POST",
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            order_id: orderId
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        alert(data.message || "Refund diproses.");
                        if (data.success) {
                            localStorage.removeItem("keranjang");
                            window.location.href = "riwayat.php";
                        }
                    })
                    .catch(() => alert("Gagal memproses refund."));
            }
        }





        // Bersihkan keranjang jika sebelumnya redirect dengan ?submitted=true
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get("submitted") === "true") {
            localStorage.removeItem("keranjang");
        }
    </script>

</body>

</html>