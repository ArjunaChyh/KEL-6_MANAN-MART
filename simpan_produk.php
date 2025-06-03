<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "pjbl_6";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) die("Koneksi gagal: " . $conn->connect_error);

// Data produk yang ingin dimasukkan
$products = [
    ["Garam Cap Udang", 5500, "garam.png"],
    ["Mie Burung Dara", 5000, "miedara.png"],
    ["Beras Ramos", 78000, "Beras.png"],
    ["Minyak Kita", 15000, "Minyak.png"],
    ["Tepung Segitiga Biru", 12000, "tepung.png"],
    ["Gulaku Premium", 15500, "gula.png"]
];

// Simpan ke database
foreach ($products as $p) {
    $nama  = $conn->real_escape_string($p[0]);
    $harga = (int)$p[1];
    $gambar = $conn->real_escape_string($p[2]);

    $sql = "INSERT INTO produk (nama_produk, harga, gambar) 
            VALUES ('$nama', $harga, '$gambar')";

    if ($conn->query($sql) !== TRUE) {
        echo "Gagal menyimpan produk: $nama - " . $conn->error . "<br>";
    }
}

echo "Semua produk berhasil disimpan!";
$conn->close();
