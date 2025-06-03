<?php
require_once("koneksi.php");

if (!isset($_GET['id'])) {
    die("ID tidak ditemukan.");
}
$id = intval($_GET['id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $pesan = $_POST['pesan'];

    $query = "UPDATE pesan SET nama='$nama', email='$email', pesan='$pesan' WHERE id=$id";
    if (mysqli_query($conn, $query)) {
        header("Location: PesanDashboard.php");
        exit;
    } else {
        echo "Gagal mengedit pesan: " . mysqli_error($conn);
    }
}

$query = "SELECT * FROM pesan WHERE id = $id";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Pesan</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f5f5;
            padding: 40px;
        }

        .container {
            max-width: 500px;
            margin: auto;
            background: white;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 6px;
            color: #555;
            font-weight: 500;
        }

        input[type="text"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-bottom: 20px;
            font-size: 14px;
        }

        textarea {
            resize: vertical;
        }

        .btn-group {
            display: flex;
            justify-content: space-between;
        }

        button,
        .btn-cancel {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-size: 14px;
            cursor: pointer;
            transition: 0.3s;
        }

        button {
            background-color: #007BFF;
            color: white;
        }

        button:hover {
            background-color: #0056b3;
        }

        .btn-cancel {
            background-color: #6c757d;
            color: white;
        }

        .btn-cancel:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Edit Pesan</h2>
    <form method="POST">
        <label for="nama">Nama:</label>
        <input type="text" name="nama" value="<?= htmlspecialchars($data['nama']) ?>" required>

        <label for="email">Email:</label>
        <input type="email" name="email" value="<?= htmlspecialchars($data['email']) ?>" required>

        <label for="pesan">Pesan:</label>
        <textarea name="pesan" rows="5" required><?= htmlspecialchars($data['pesan']) ?></textarea>

        <div class="btn-group">
            <button  type="submit">Simpan</button>

            <a href="PesanDashboard.php" class="btn-cancel">Batal</a>
        </div>
    </form>
</div>

</body>
</html>
