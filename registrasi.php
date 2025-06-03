<?php
include 'koneksi.php';
session_start();

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if ($name == '' || $email == '' || $password == '') {
        $error = "Semua field harus diisi!";
    } else {
        // Cek apakah email sudah terdaftar
        $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
        if (mysqli_num_rows($check) > 0) {
            $error = "Email sudah terdaftar!";
        } else {
            // Hash password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert ke database
            $insert = mysqli_query($conn, "INSERT INTO users (username, email, password) VALUES ('$name', '$email', '$hashed_password')");
            if ($insert) {
                $success = "Registrasi berhasil! Silakan <a href='login.php'>login</a>.";
                // Kosongkan form setelah berhasil
                $name = $email = '';
            } else {
                $error = "Registrasi gagal, coba lagi.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manan Mart - Registrasi</title>
  <style>
    /* CSS kamu sama persis */
    body {
      font-family: Arial, sans-serif;
      background-color: #fff8e1;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    .container {
      background: #f2f2f2;
      padding: 32px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      width: 350px;
    }
    .title {
      text-align: center;
      font-weight: 600;
      color: #333;
      font-size: 24px;
    }
    p.subtitle {
      text-align: center;
      color: gray;
      font-size: 12px;
      margin-top: -10px;
      margin-bottom: 20px;
    }
    input[type="text"], input[type="email"], input[type="password"] {
      width: 100%;
      padding: 10px;
      margin: 8px 0 16px 0;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    .login-btn {
      width: 100%;
      background-color: #ff9b17;
      color: white;
      padding: 10px;
      border: none;
      border-radius: 4px;
      font-weight: bold;
      cursor: pointer;
    }
    .login-btn:hover {
      background-color: #444;
    }
    .google-btn {
      margin-top: 15px;
      width: 100%;
      padding: 10px;
      background-color: white;
      border: 1px solid #ddd;
      border-radius: 4px;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
    }
    .google-btn:hover {
      background-color: #f0f0f0;
    }
    .or-line {
      text-align: center;
      margin: 10px 0;
      color: #aaa;
    }
    .forgot {
      text-align: right;
      font-size: 12px;
      margin-top: -12px;
      margin-bottom: 16px;
    }
    .brand {
      position: absolute;
      top: 20px;
      left: 20px;
      font-weight: bold;
      color: #000000;
    }
  </style>
</head>
<body>

  <div class="brand">MANAN MART</div>

  <form class="container" method="POST" action="">
    <div class="title">Registrasi</div>
    <br>
    <p class="subtitle">Enter the information you entered while registering</p>
    <br>

    <?php if ($error): ?>
      <div style="color:red; text-align:center; margin-bottom:10px;"><?= $error ?></div>
    <?php endif; ?>

    <?php if ($success): ?>
      <div style="color:green; text-align:center; margin-bottom:10px;"><?= $success ?></div>
    <?php endif; ?>

    <label>Nama</label>
    <input type="text" name="name" placeholder="Enter your name" required value="<?= isset($name) ? htmlspecialchars($name) : '' ?>">

    <label>Email</label>
    <input type="email" name="email" placeholder="Enter your email" required value="<?= isset($email) ? htmlspecialchars($email) : '' ?>">

    <label>Password</label>
    <input type="password" name="password" placeholder="Enter your password" required>

    <div class="forgot">
        <a>Sudah Memiliki Akun?</a>
        <a href="login.php">Masuk</a>
    </div>

    <button type="submit" class="login-btn">Masuk</button>

  </form>

</body>
</html>
