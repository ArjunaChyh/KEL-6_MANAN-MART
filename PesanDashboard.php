<?php
require_once("koneksi.php");

$query = "SELECT id, nama, email, pesan, created_at FROM pesan ORDER BY id DESC";
$result = mysqli_query($conn, $query);
if (!$result) {
    die("Query gagal: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin - Data Pesan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background: #f9f9f9;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        table {
            width: 95%;
            margin: auto;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 0 10px #ccc;
        }

        th, td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: #34495e;
            color: white;
        }

        tr:nth-child(even) {
            background: #f2f2f2;
        }

        .btn-kembali {
            display: inline-block;
            margin-bottom: 20px;
            background-color: #34495e;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            position: absolute;
            top: 20px;
            left: 20px;
        }

        .btn-kembali:hover {
            background-color: #34495e;
        }

        .btn-edit, .btn-hapus {
            padding: 5px 10px;
            color: white;
            border: none;
            border-radius: 4px;
            text-decoration: none;
        }

        .btn-edit {
            background-color: #ffc107;
        }

        .btn-edit:hover {
            background-color: #e0a800;
        }

        .btn-hapus {
            background-color: #dc3545;
        }

        .btn-hapus:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>

<a href="Admin-Dashboard.php" class="btn-kembali"> Kembali</a>

<h2>Dashboard Admin - Data Pesan</h2>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Pesan</th>
            <th>Tanggal</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?= htmlspecialchars($row['id']) ?></td>
                    <td><?= htmlspecialchars($row['nama']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td><?= nl2br(htmlspecialchars($row['pesan'])) ?></td>
                    <td><?= htmlspecialchars($row['created_at']) ?></td>
                    <td>
                        <a class="btn-edit" href="Edit_pesan.php?id=<?= $row['id'] ?>">Edit</a>
                        <a class="btn-hapus" href="Hapus_pesan.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin ingin menghapus pesan ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="6" style="text-align:center;">Tidak ada pesan.</td></tr>
        <?php endif; ?>
    </tbody>
</table>

</body>
</html>
