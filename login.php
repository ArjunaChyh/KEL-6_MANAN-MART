<?php
include 'koneksi.php';
session_start();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name']; 
    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");

    if (mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);
        if (password_verify($password, $user['password'])) {
            // login berhasil
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            if ($user['role'] === 'admin') {
                header("Location: admin-dashboard.php");
            } else {
                header("Location: homepage.php");
            }
            exit;
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Email tidak ditemukan!";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manan Mart - Login</title>
  <style>
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
    .error-msg {
      text-align: center;
      color: red;
      margin-bottom: 10px;
      font-weight: bold;
    }
  </style>
</head>
<body>

  <div class="brand" onclick="window.location.href='tampilanawal.php'">MANAN MART</div>
    
  <form class="container" method="POST" action="">
    <div class="title">Login</div>
    <br>
    <p class="subtitle">Enter the information you entered while registering</p>
    <br>

    <?php if ($error): ?>
      <div class="error-msg"><?= $error ?></div>
    <?php endif; ?>

    <label>Name</label>
    <input type="text" name="name" placeholder="Enter your name" required value="<?= isset($name) ? htmlspecialchars($name) : '' ?>">

    <label>Email</label>
    <input type="email" name="email" placeholder="Enter your email" required value="<?= isset($email) ? htmlspecialchars($email) : '' ?>">

    <label>Password</label>
    <input type="password" name="password" placeholder="Enter your password" required>

    <div class="forgot"><a href="registrasi.php">Registrasi</a></div>

    <button type="submit" class="login-btn">Login</button>

    <div class="or-line">OR</div>

    <button type="button" class="google-btn">
      <img src="https://www.google.com/favicon.ico" alt="Google" width="16"> Sign in with Google
    </button>
  </form>

</body>
</html>
