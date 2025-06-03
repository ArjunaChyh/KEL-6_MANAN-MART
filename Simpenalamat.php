<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");

$host = "localhost";
$user = "root";
$pass = "";
$db   = "pjbl_6"; 

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}

$data = json_decode(file_get_contents("php://input"), true);

$telepon   = $conn->real_escape_string($data['telepon']);
$provinsi  = $conn->real_escape_string($data['provinsi']);
$kota      = $conn->real_escape_string($data['kota']);
$kecamatan = $conn->real_escape_string($data['kecamatan']);
$kodepos   = $conn->real_escape_string($data['kodepos']);
$alamat    = $conn->real_escape_string($data['alamat']);

$sql = "INSERT INTO alamat (telepon, provinsi, kota, kecamatan, kodepos, alamat)
        VALUES ('$telepon', '$provinsi', '$kota', '$kecamatan', '$kodepos', '$alamat')";

if ($conn->query($sql) === TRUE) {
  echo json_encode(["status" => "success", "message" => "Data berhasil disimpan"]);
} else {
  http_response_code(500);
  echo json_encode(["status" => "error", "message" => "Gagal menyimpan data"]);
}
  
$conn->close();
?>
