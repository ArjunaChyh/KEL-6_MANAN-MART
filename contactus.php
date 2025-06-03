<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nama   = $_POST['name'];
  $email  = $_POST['email'];
  $pesan  = $_POST['message'];

  // Koneksi ke database
  $host = "localhost";
  $user = "root";
  $pass = ""; 
  $db   = "pjbl_6";

  $koneksi = new mysqli($host, $user, $pass, $db);

  if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
  }

  // Simpan ke database
  $sql = "INSERT INTO pesan (nama, email, pesan) VALUES (?, ?, ?)";
  $stmt = $koneksi->prepare($sql);
  $stmt->bind_param("sss", $nama, $email, $pesan);

  if ($stmt->execute()) {
    echo "<script>alert('Pesan berhasil dikirim!');</script>";
  } else {
    echo "<script>alert('Gagal mengirim pesan!');</script>";
  }

  $stmt->close();
  $koneksi->close();
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Masukan Pesan - Manan Mart</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #fff8e0;
      margin: 0;
      padding: 0;
    }

    .judul {
      text-align: center;
      font-size: 22px;
    }

    header {
      padding: 20px 40px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .logo {
      font-size: 20px;
      font-weight: bold;
      color: #1f2f57;
    }

    nav a {
      margin-left: 20px;
      text-decoration: none;
      color: #1f2f57;
      font-weight: 500;
    }

    .container {
      max-width: 1200px;
      margin: 15px auto;
      padding: 25px;
    }

    .heading {
      text-align: center;
      font-size: 20px;
      margin-bottom: 35px;
      font-weight: bold;
      color: #111;
    }

    .content {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      gap: 20px;
    }

    .contact-info {
      flex: 1;
      max-width: 60%;
    }

    .info-item {
      display: flex;
      align-items: center;
      margin-bottom: 70px;
    }

    .icon {
      font-size: 24px;
      background-color: white;
      padding: 10px;
      border-radius: 50%;
      margin-right: 15px;
    }

    .form-box {
      flex: 1;
      max-width: 55%;
      background-color: white;
      padding: 30px;
      border-radius: 0px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .form-box h2 {
      margin-top: 0;
      font-size: 24px;
      font-weight: bold;
    }

    .form-box label {
      display: block;
      margin-top: 15px;
      font-weight: 00;
    }

    .form-box input,
    .form-box textarea {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border: none;
      border-bottom: 2px solid #ccc;
      font-size: 16px;
      background: transparent;
    }

    .form-box input:focus,
    .form-box textarea:focus {
      outline: none;
      border-bottom-color: #0099cc;
    }

    .form-box button {
      margin-top: 20px;
      background-color: #FF9B17;
      color: white;
      padding: 10px 25px;
      border: none;
      cursor: pointer;
      border-radius: 4px;
      font-weight: bold;
    }

    .form-box button:hover {
      background-color: #2bb3df;
    }

    .home-icon img {
      width: 35px;
      height: auto;
    }

    .home-icon {
      text-align: right;
    }
  </style>
</head>

<body>
  <header>
    <div class="logo">MANAN MART</div>
    <a href="homepage.php">
      <div class="home-icon">
        <img src="images/home.png" alt="Sembako Ilustrasi">
      </div>
    </a>
  </header>

  <div class="judul">
    <h1>CONTACT US</h1>
  </div>
  <div class="container">
    <h1 class="heading">Tuliskan kritik dan saran anda mengenai toko dan produk kami...</h1>
    <div class="content">
      <div class="contact-info">
        <div class="info-item">
          <div class="icon">📍</div>
          <div><strong>Lokasi</strong><br>Jl. Borobudur Raya 3</div>
        </div>
        <div class="info-item">
          <div class="icon">📞</div>
          <div><strong>Phone</strong><br>08893394085</div>
        </div>
        <div class="info-item">
          <div class="icon">✉</div>
          <div><strong>Email</strong><br><a href="emailto:titaniumpasa@gmail.com">titaniumpasa@gmail.com</a></div>
        </div>
      </div>
      <div class="form-box">
        <h2>MASUKAN PESAN</h2>
        <form method="POST" action="">
          <label for="name">Tuliskan Nama</label>
          <input type="text" id="name" name="name" required>
          <label for="email">Email</label>
          <input type="email" id="email" name="email" required>
          <label for="message">Pesan</label>
          <textarea id="message" name="message" rows="4" required></textarea>
          <button type="submit">Kirim</button>
        </form>
      </div>
    </div>
  </div>
</body>

</html>