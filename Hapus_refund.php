<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Ambil nama file bukti
    $stmt = $conn->prepare("SELECT bukti FROM pengembalian WHERE id_refund = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    $stmt->close();

    if ($data && $data['bukti']) {
        $file_path = 'uploads/' . $data['bukti'];
        if (file_exists($file_path)) {
            unlink($file_path);
        }
    }

    // Hapus data
    $stmt = $conn->prepare("DELETE FROM pengembalian WHERE id_refund = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

$conn->close();

// Redirect ke dashboard setelah hapus
header("Location: RefundDashboard.php");
exit;
?>
