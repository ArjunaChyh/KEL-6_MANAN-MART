<?php
require_once("koneksi.php");

$query = "SELECT * FROM alamat ORDER BY id DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Data Alamat</title>
    <style>
        body {
            font-family: Arial;
            padding: 20px;
            background: #f9f9f9;
        }

        table {
            width: 95%;
            margin: auto;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 0 10px #ccc;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
            
        }

        th {
            background: #34495e;
            color: white;
        }

        tr:nth-child(even) {
            background: #f2f2f2;
        }

        .btn {
            padding: 6px 10px;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
        }

        .btn-edit {
            background: #ffc107;
            color: black;
        }

        .btn-delete {
            background: #dc3545;
            color: white;
        }

        .btn-back {
            position: absolute;
            top: 20px;
            left: 20px;
            padding: 10px;
            background: #34495e;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>

<body>

    <a href="Admin-Dashboard.php" class="btn-back"> Kembali</a>

    <h2 style="text-align:center;">Data Alamat Pengguna</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>No HP</th>
                <th>Provinsi</th>
                <th>Kota</th>
                <th>Kecamatan</th>
                <th>Kode Pos</th>
                <th>alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['id']) ?></td>
                        <td><?= htmlspecialchars($row['telepon']) ?></td>
                        <td><?= htmlspecialchars($row['provinsi']) ?></td>
                        <td><?= htmlspecialchars($row['kota']) ?></td>
                        <td><?= htmlspecialchars($row['kecamatan']) ?></td>
                        <td><?= htmlspecialchars($row['kodepos']) ?></td>
                        <td><?= htmlspecialchars($row['alamat']) ?></td>
                        <td>
                            <a href="edit_alamat.php?id=<?= $row['id'] ?>" class="btn btn-edit">Edit</a>
                            <a href="hapus_alamat.php?id=<?= $row['id'] ?>" class="btn btn-delete" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8">Tidak ada data alamat</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</body>

</html>
