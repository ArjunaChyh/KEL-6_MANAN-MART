<?php
require_once("koneksi.php");

// Cek koneksi database
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$query = "  
  SELECT ratings.id, ratings.rating, users.email
  FROM ratings
  JOIN users ON ratings.user_id = users.user_id
  ORDER BY ratings.id DESC LIMIT 25;
";

$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query gagal: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin - Data Rating</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: white;
        }
        table {
            width: 80%;
            margin: auto;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: center;
        }
        th {
           background: #34495e;
           color :white;
        }
        .btn-kembali {
            display: inline-block;
            margin: 0 0 20px 0;
            padding: 10px 20px;
            background-color: #34495e;
            color: white;
            text-align: center;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
        .btn-kembali:hover {
            background-color:rgb(0, 128, 255);
        }
        .no-data {
            text-align: center;
            font-style: italic;
            color: #ccc;
            padding: 15px;
        }
    </style>
</head>
<body>

    <a href="Admin-dashboard.php" class="btn-kembali"> Kembali</a>

    <h2 style="text-align:center;">Data Rating Pengguna</h2>

    <table>
        <thead>
            <tr>
                <th>ID Rating</th>
                <th>Email Pengguna</th>
                <th>Rating</th>
            </tr>
        </thead>
        <tbody>
            <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['id']) ?></td>
                        <td><?= htmlspecialchars($row['email']) ?></td>
                        <td><?= htmlspecialchars($row['rating']) ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3" class="no-data">Tidak ada data rating</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</body>
</html>
