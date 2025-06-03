<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$host = "localhost";
$user = "root";
$pass = "";
$db   = "pjbl_6";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
  die(json_encode(["status" => "error", "message" => "Koneksi gagal"]));
}

$user_id = 1;

$sql = "SELECT cart.*, produk.nama_produk, produk.gambar, produk.harga 
        FROM cart 
        JOIN produk ON cart.produk_id = produk.produk_id 
        WHERE cart.user_id = $user_id";

$result = $conn->query($sql);

if (!$result) {
  echo json_encode(["status" => "error", "message" => "SQL error: " . $conn->error]);
  exit;
}

$cart = [];

while ($row = $result->fetch_assoc()) {
  $cart[] = $row;
}

echo json_encode($cart);
?>
