<?php
require_once("koneksi.php");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $query = "DELETE FROM pesan WHERE id = $id";
    if (mysqli_query($conn, $query)) {
        header("Location: PesanDashboard.php");
        exit;
    } else {
        echo "Gagal menghapus pesan: " . mysqli_error($conn);
    }
} else {
    echo "ID tidak ditemukan.";
}
?>
