<?php
require_once("koneksi.php"); // koneksi ke database

$query = "SELECT user_id, username, email FROM users ORDER BY user_id DESC";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query gagal: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Dashboard Admin - Data User</title>
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
            width: 80%;
            margin: auto;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 0 10px #ccc;
        }

        th,
        td {
            padding: 12px 15px;
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

        .btn-add:hover {
            background-color: #218838;
        }

        .btn-delete {
            background-color: #34495e;
            color: white;
            border: none;
            padding: 7px 12px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        .btn-delete:hover {
            background-color: #b02a37;
        }

        .btn-kembali {
            position: fixed;
            top: 20px;
            left: 20px;
            background-color: #34495e;
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s ease;
            z-index: 1000;
        }

        .btn-kembali:hover {
            background-color: rgb(0, 128, 255);
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>

    <h2>Dashboard Admin - Data User</h2>

    <a href="Admin-Dashboard.php" class="btn-kembali">Kembali</a>

    <table>
        <thead>
            <tr>
                <th>User ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr id="row-<?= htmlspecialchars($row['user_id']) ?>">
                        <td><?= htmlspecialchars($row['user_id']) ?></td>
                        <td><?= htmlspecialchars($row['username']) ?></td>
                        <td><?= htmlspecialchars($row['email']) ?></td>
                        <td>
                            <button class="btn-delete" data-id="<?= htmlspecialchars($row['user_id']) ?>">Hapus</button>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" style="text-align:center;">Tidak ada data user</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <script>
        $(document).ready(function() {
            $('.btn-delete').click(function() {
                if (!confirm('Yakin ingin menghapus user ini?')) return;

                let userId = $(this).data('id');
                let row = $('#row-' + userId);

                $.ajax({
                    url: 'hapus_user_ajax.php',
                    method: 'POST',
                    data: {
                        user_id: userId
                    },
                    success: function(response) {
                        if (response.trim() === 'success') {
                            row.fadeOut(500, function() {
                                $(this).remove();
                            });
                        } else {
                            alert('Gagal menghapus user!');
                        }
                    },
                    error: function() {
                        alert('Error server, coba lagi nanti.');
                    }
                });
            });
        });
    </script>

</body>

</html>