<?php
    session_start();
    if (!isset($_SESSION['username'])) {
      header("Location: login.php");
      exit();
    }

    if (isset($_GET['logout'])) {
      session_unset();
      session_destroy();
      header("Location: login.php");
      exit();
    }
  ?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <title>MANAN MART</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <style>
    /* --- STYLE AWAL TETAP --- */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #fff;
      color: #333;
      line-height: 1.6;
      min-height: 110vh;
      display: flex;
      flex-direction: column;
    }

    header {
      background-color: #FF9100;
      padding: 10px 30px;
      /* lebih kecil dan ramping */
      display: flex;
      justify-content: space-between;
      /* tetap di kiri dan kanan */
      align-items: center;
      /* ratakan secara vertikal */
      height: 60px;
    }

    .logo {
      font-weight: bold;
      color: rgb(0, 0, 0);
    }

    nav a {
      margin-left: 20px;
      text-decoration: none;
      color: rgb(0, 0, 0);
      font-weight: 500;
      font-size: 16px;
      line-height: 1;
    }

    nav a:hover {
      color: #FFF;
    }

    main {
      flex-grow: 1;
    }

    /* === HERO SECTION YANG DIGANTI === */
    .main-content {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      padding: 60px 5vw 80px;
      /* ubah dari 60px 80px 0 → jadi ada padding bawah 80px */
      background-color: #FFF8E1;
    }


    .text-area {
      max-width: 500px;
    }

    .text-area h1 {
      font-size: 80px;
      color: rgb(0, 0, 0);
    }

    .text-area p {
      margin-top: 20px;
      font-size: 16px;
      line-height: 1.6  ;
      color: #333;
      text-align: justify;
      /* Tambahkan baris ini */
    }

    .cta-button {
      margin-top: 110px;
      background-color: #FF9B17;
      color: white;
      padding: 25px 40px;
      border: none;
      border-radius: 20px;
      font-size: 18px;
      cursor: pointer;
    }

    .image-area {
      margin-top: 222px;
      min-width: 18px;
    }

    .image-area img {
      max-width: 940px;
      height: auto;
    }

    @media (max-width: 768px) {
      .main-content {
        flex-direction: column;
        text-align: center;
        align-items: center;
      }

      .image-area {
        margin-top: 1px;
      }

      .image-area img {
        width: 100%;
      }
    }

    /* === STYLING UNTUK BAGIAN BAWAH TIDAK DIUBAH === */
    section {
      padding: 60px 80px;
    }

    .section-white {
      background-color: #f2f2f2;
      padding: 60px 80px;
    }

    .section-white.maps-section {
      background-color: #fff;
    }

    h2 {
      margin-bottom: 20px;
      color: #000;
      font-weight: 700;
      font-size: 32px;
      text-align: center;
    }

    p {
      max-width: 700px;
      margin: 0 auto 20px;
      text-align: center;
      font-size: 18px;
    }

    .team {
      display: flex;
      gap: 30px;
      justify-content: center;
      /* Menengahkan secara horizontal */
      flex-wrap: wrap;
      /* Supaya rapi jika sempit */
      padding-bottom: 10px;
      scroll-behavior: smooth;
      -webkit-overflow-scrolling: touch;
    }


    .team::-webkit-scrollbar {
      height: 8px;
    }

    .team::-webkit-scrollbar-thumb {
      background-color: #FF9100;
      border-radius: 4px;
    }

    .member {
      flex: 0 0 180px;
      background: white;
      padding: 20px;
      text-align: center;
      border-radius: 12px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease;
    }

    .member:hover {
      transform: translateY(-6px);
      box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
    }

    .member img {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      object-fit: cover;
      margin-bottom: 12px;
      border: 3px solid #FF9100;
      transition: transform 0.3s ease;
    }

    .member h4 {
      margin-bottom: 8px;
      font-size: 20px;
      color: #FF9100;
    }

    .member p {
      font-size: 16px;
      color: #555;
    }

    iframe {
      width: 100%;
      height: 350px;
      border: none;
      border-radius: 16px;
      max-width: 900px;
      display: block;
      margin: 0 auto;
    }

    footer {
      background-color: #FF9100;
      color: #000;
      text-align: center;
      padding: 15px 0;
      font-weight: 500;
      font-size: 14px;
      flex-shrink: 0;
      margin-top: auto;
    }
  </style>
</head>

<body>

  <header>
    <div class="logo">MANAN MART</div>
    <nav>
      <a href="tentangkami.php">Tentang Kami</a>
      <a href="contactus.php">Kontak</a>
      <a href="tampilanawal.php">Log out</a>
    </nav>
  </header>

  <main>
    <!-- HERO SECTION milikmu -->
    <section class="main-content">
      <div class="text-area">
        <h1>MANAN<br>MART</h1>
        <p>Toko ini sangat penting bagi masyarakat karena toko ini mencakup berbagai sembako seperti gula, beras,
          minyak,
          mie, tepung, telur dll.
          Toko ini memiliki harga terjangkau dan dijamin lengkap. Toko ini juga memiliki peran penting dalam mendukung
          perekonomian rumah tangga.</p>
        <a href="keranjang.php">
          <button class="cta-button">Belanja Sekarang</button>
        </a>
      </div>
      <div class="image-area">
        <img src="images/gambarsembako.png" alt="Sembako Ilustrasi">
      </div>
    </section>

    <!-- BAGIAN LAIN TETAP SAMA -->
    <section class="section-white">
      <h2>Tentang Website</h2>
      <p>Website ini dirancang sebagai solusi modern bagi masyarakat dalam memenuhi kebutuhan sembako secara online,
        dengan menghadirkan pengalaman belanja yang cepat, praktis, dan aman. Didukung oleh produk-produk lokal
        berkualitas dan sistem pengiriman yang efisien, kami berkomitmen untuk membantu Anda memenuhi kebutuhan harian
        tanpa harus meninggalkan kenyamanan rumah. Dengan layanan yang andal dan antarmuka yang ramah pengguna, MANAN
        MART hadir sebagai mitra belanja digital terpercaya di era serba cepat.</p>
    </section>

    <section class="section-light">
      <h2>Tim Pembuat</h2>
      <div class="team" id="team-container"></div>
      <script>
        const tim = [
          { nama: "Alfianisa Nurin Yuniar", posisi: "Frontend Developer", foto: "images/fia.jpg" },
          { nama: "Arjuna Cahya Handyka", posisi: "Backend Developer", foto: "images/juna.jpg" },
          { nama: "Denis Pratama", posisi: "UI/UX Designer", foto: "images/denis.jpg" },
          { nama: "Naswa Maura Yasmine", posisi: "QA Tester", foto: "images/naswa.jpg" },
          { nama: "Titanium Akbar Pasa", posisi: "Database Admin", foto: "images/titan.jpg" },
          { nama: "Zhafar Desfiyanto", posisi: "Project Manager", foto: "images/zhafar.jpg" },
        ];

        const container = document.getElementById('team-container');

        tim.forEach(member => {
          const div = document.createElement('div');
          div.className = 'member';
          div.innerHTML = `
              <img src="${member.foto}" alt="${member.nama}" />
              <h4>${member.nama}</h4>
              <p>${member.posisi}</p>
            `;
          container.appendChild(div);
        });
      </script>
    </section>

    <section class="section-white maps-section">
      <h2>Lokasi Kami</h2>
      <p>Kunjungi toko fisik kami di lokasi berikut:</p>
      <iframe
        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d300.6718435169919!2d110.3742881358923!3d-7.000581504412326!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e708ae11f3e5ed9%3A0x190ef28fdc82ce13!2sJl.%20Borobudur%20Raya%203%20No.41%2C%20Kembangarum%2C%20Kec.%20Semarang%20Barat%2C%20Kota%20Semarang%2C%20Jawa%20Tengah%2050183!5e0!3m2!1sid!2sid!4v1748857655315!5m2!1sid!2sid"
        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"></iframe>
    </section>
  </main>

  <footer>
    ©2025 MANAN MART, Inc. All rights reserved.
  </footer>

</body>

</html>