<?php
include 'koneksi.php';

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    // Ambil nama file bukti dari database
    $result = $conn->query("SELECT bukti FROM pengembalian WHERE id_pengembalian = $id");
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Cek file berdasarkan kolom 'bukti' (bukan 'upload_bukti')
        if (!empty($row['bukti']) && file_exists("uploads/" . $row['bukti'])) {
            unlink("uploads/" . $row['bukti']);
        }
    }

    $conn->query("DELETE FROM pengembalian WHERE id_pengembalian = $id");
    header("Location: RefundDashboard.php");
    exit;
}

// Ambil data pengembalian
$sql = "SELECT * FROM pengembalian ORDER BY tanggal_pengembalian DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <title>Dashboard Pengembalian</title>
    <style>

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f4f7fa;
            margin: 20px;
            color: rgb(0, 0, 0);
        }

        h2 {
            margin-bottom: 20px;
            color: #34495e;
            text-align: center;
            letter-spacing: 1px;
        }

        .btn-back {
            position: fixed;
            top: 20px;
            left: 20px;
            background-color: #34495e;
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 600;
            z-index: 1000;
            transition: background-color 0.3s ease;
        }

        .btn-back:hover {
            background-color: #2c3e50;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgb(52 73 94 / 0.15);
        }

        th,
        td {
            padding: 12px 15px;
            text-align: left;
        }

        thead {
            background-color: #34495e;
            color: white;
            font-weight: 600;
            letter-spacing: 0.05em;
        }

        tbody tr:nth-child(even) {
            background-color: #f7f9fb;
        }

        tbody tr:hover {
            background-color: #d6e4f0;
            cursor: pointer;
        }

        img.bukti {
            max-width: 120px;
            max-height: 80px;
            border-radius: 4px;
            box-shadow: 0 1px 4px rgb(52 73 94 / 0.3);
        }

        a.delete-btn {
            background-color: #e74c3c;
            color: white;
            padding: 6px 12px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: 600;
            transition: background-color 0.3s ease;
            display: inline-block;
        }

        a.delete-btn:hover {
            background-color: #c0392b;
        }

        @media (max-width: 768px) {

            table,
            thead,
            tbody,
            th,
            td,
            tr {
                display: block;
            }

            thead tr {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }

            tr {
                margin-bottom: 15px;
                border: 1px solid #ddd;
                border-radius: 8px;
                padding: 10px;
            }

            td {
                border: none;
                position: relative;
                padding-left: 50%;
                white-space: normal;
                text-align: left;
            }

            td:before {
                position: absolute;
                top: 12px;
                left: 15px;
                width: 45%;
                padding-right: 10px;
                white-space: nowrap;
                font-weight: 600;
                color: #34495e;
            }

            td:nth-of-type(1):before {
                content: "ID";
            }

            td:nth-of-type(2):before {
                content: "Nama Pembeli";
            }

            td:nth-of-type(3):before {
                content: "Email Pembeli";
            }

            td:nth-of-type(4):before {
                content: "ID Pesanan";
            }

            td:nth-of-type(5):before {
                content: "Alasan";
            }

            td:nth-of-type(6):before {
                content: "Bukti";
            }

            td:nth-of-type(7):before {
                content: "Tanggal Pengajuan";
            }

            td:nth-of-type(8):before {
                content: "Aksi";
            }

            img.bukti {
                max-width: 80px;
                max-height: 60px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <a href="Admin-dashboard.php" class="btn-back">Kembali</a>
        <h2>Dashboard Pengembalian</h2>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Pembeli</th>
                    <th>Email Pembeli</th>
                    <th>ID Pesanan</th>
                    <th>Alasan</th>
                    <th>Bukti</th>
                    <th>Tanggal Pengajuan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result && $result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['id_pengembalian']) ?></td>
                            <td><?= htmlspecialchars($row['nama_pembeli']) ?></td>
                            <td><?= htmlspecialchars($row['email_pembeli']) ?></td>
                            <td><?= htmlspecialchars($row['id_pesanan']) ?></td>
                            <td><?= nl2br(htmlspecialchars($row['alasan_pengembalian'])) ?></td>
                            <td>
                                <?php if (!empty($row['bukti'])): ?>
                                    <a href="uploads/<?= htmlspecialchars($row['bukti']) ?>" target="_blank" rel="noopener">
                                        <img class="bukti" src="uploads/<?= htmlspecialchars($row['bukti']) ?>" alt="Bukti Pengembalian" />
                                    </a>
                                <?php else: ?>
                                    Tidak ada
                                <?php endif; ?>
                            </td>
                            <td><?= htmlspecialchars($row['tanggal_pengembalian']) ?></td>
                            <td>
                                <a class="delete-btn" href="?delete=<?= $row['id_pengembalian'] ?>" onclick="return confirm('Yakin ingin hapus data ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" style="text-align:center; padding: 20px;">Belum ada data pengembalian.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>

</html>

<?php
$conn->close();
?>
