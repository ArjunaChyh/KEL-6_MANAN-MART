<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die('Akses langsung tidak diperbolehkan.');
}

// Ambil data POST dengan trim agar bersih
$nama_pembeli = isset($_POST['nama_pembeli']) ? trim($_POST['nama_pembeli']) : '';
$email_pembeli = isset($_POST['email_pembeli']) ? trim($_POST['email_pembeli']) : '';
$id_pesanan = isset($_POST['id_pesanan']) ? trim($_POST['id_pesanan']) : '';
$alasan_pengembalian = isset($_POST['alasan_pengembalian']) ? trim($_POST['alasan_pengembalian']) : '';

// Cek wajib diisi
if (empty($alasan_pengembalian)) {
    die('Field alasan_pengembalian harus diisi.');
}

// Contoh jika tidak ada upload file, kosongkan
$upload_bukti = ''; 

// Jika nanti mau handle upload file, isi $upload_bukti dengan nama file yang diupload

// Siapkan statement insert
$stmt = $conn->prepare("INSERT INTO pengembalian (nama_pembeli, email_pembeli, id_pesanan, alasan_pengembalian, upload_bukti, tanggal_pengembalian) VALUES (?, ?, ?, ?, ?, NOW())");

if (!$stmt) {
    die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
}

// Simpan refund
$stmt = $conn->prepare("INSERT INTO pengembalian (nama_pembeli, email_pembeli, id_pesanan, alasan_pengembalian, upload_bukti, tanggal_pengembalian) VALUES (?, ?, ?, ?, ?, NOW())");
$stmt->bind_param("sssss", $nama_pembeli, $email_pembeli, $id_pesanan, $alasan_pengembalian, $upload_bukti);

if ($stmt->execute()) {
    // Hapus dari data_pesanan
    $hapus = $conn->prepare("DELETE FROM data_pesanan WHERE order_id = ?");
    $hapus->bind_param("s", $id_pesanan);
    $hapus->execute();
    $hapus->close();

    header("Location: riwayat.php");
    exit;
} else {
    echo "Gagal menyimpan data refund: " . $stmt->error;
}


$stmt->close();
$conn->close();
?>
