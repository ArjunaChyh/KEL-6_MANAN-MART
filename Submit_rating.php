<?php
header('Content-Type: application/json');

// Dapatkan input JSON
$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['rating'])) {
    echo json_encode(['success' => false, 'message' => 'Rating tidak ditemukan']);
    exit;
}

$rating = (int)$data['rating'];

// Validasi rating 1-5
if ($rating < 1 || $rating > 5) {
    echo json_encode(['success' => false, 'message' => 'Rating tidak valid']);
    exit;
}

// Contoh koneksi ke database (sesuaikan dengan settingmu)
$host = "localhost";
$user = "root";
$password = "";
$dbname = "pjbl_6";

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Koneksi database gagal']);
    exit;
}

// Simpan rating ke tabel, misal tabel 'ratings' dengan kolom id (auto_increment), rating (int)
$sql = "INSERT INTO ratings (rating) VALUES (?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $rating);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Gagal menyimpan data']);
}

$stmt->close();
$conn->close();
?>
