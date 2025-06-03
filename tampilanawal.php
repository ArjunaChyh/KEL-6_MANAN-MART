<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1" name="viewport" />
  <title>Manan Mart</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap" rel="stylesheet" />
  <style>
    html, body {
      margin: 0;
      padding: 0;
      height: 100%;
      background-color: #DED9C7;
      font-family: "Montserrat", sans-serif;
      overflow: hidden; 
    }
    #app {
      height: 100vh;
      width: 100vw;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      position: relative;
    }

    #content {
      padding: 3rem 4rem 0 4rem;
      max-width: 42rem;
      z-index: 10;
    }

    #content h1 {
      font-size: 5rem;
      font-weight: 800;
      line-height: 1;
      color: #1A2434;
    }

    #content p {
      font-size: 16px;
      line-height: 1.6;
      color: black;
      margin-top: 1.5rem;
      text-align: justify;
    }

    #background-img {
      position: absolute;
      bottom: 1px;  /* naikkan sedikit dari bawah */
      left: 336px;    /* geser ke kanan */
      width: 100%;
      max-height: 55vh;
      object-fit: contain;
      z-index: 0;
      pointer-events: none;
      user-select: none;
    }

    #login-button {
      position: absolute;
      bottom: 5rem;
      left: 4rem;
      z-index: 20;
      background-color: #FF9100;
      color: white;
      font-size: 18px;
      font-weight: 500;
      border-radius: 15px;
      padding: 1rem 2.5rem;
      width: 180px;
      cursor: pointer;
      transition: filter 0.3s ease;
    }

    #login-button:hover {
      filter: brightness(1.1);
    }
  </style>
</head>
<body>
  <div id="app">
    <div id="content">
      <h1>
        MANAN<br />MART
      </h1>
      <p>
        Toko ini sangat penting bagi masyarakat karena toko ini mencakup berbagai sembako seperti gula, beras, minyak, mie, tepung, telur, dan lain-lain. Toko ini memiliki harga terjangkau dan dijamin lengkap. Toko ini juga memiliki peran penting dalam mendukung perekonomian rumah tangga.
      </p>
    </div>

    <img id="background-img" src="images/gambarsembako.png" alt="Ilustrasi Sembako" />
  <button id="login-button" onclick="window.location.href='login.php'" style="color: white;">
  LOGIN
  </button>
  </div>
</body>
</html>
