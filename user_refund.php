<?php
require_once 'koneksi.php';

// Ambil data JSON
$input = json_decode(file_get_contents('php://input'), true);

if (!isset($input['order_id'])) {
    echo json_encode(['success' => false, 'message' => 'Order ID tidak dikirim.']);
    exit;
}

$order_id = $input['order_id'];

// Hapus dari tabel data_pesanan
$stmt = $conn->prepare("DELETE FROM data_pesanan WHERE order_id = ?");
$stmt->bind_param("s", $order_id);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Pesanan berhasil direfund dan dihapus.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Gagal menghapus pesanan.']);
}

$stmt->close();
$conn->close();
?>
