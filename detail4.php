<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Manan Mart with Gulaku Popup</title>
    <style>
        /* --- Style Manan Mart dari kode asli --- */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }
        
        body {
            background-color: #fff8e1;
        }
        
        .header {
            position: relative;
            background-color: #ff9b17;
            height: 150px;
            width: 100%;
            display: flex;
            align-items: center;
            padding: 0 20px;
        }
        
        .logo {
            width: 120px;
            height: 120px;
            margin-right: 20px;
        }
        
        .search-container {
            position: relative;
            flex-grow: 1;
            max-width: 1097px;
            margin: 0 20px;
        }
        
        .search-bar {
            width: 100%;
            height: 48px;
            background-color: #eae7e7e5;
            border: none;
            border-radius: 5px;
            padding: 0 15px;
            font-size: 16px;
            font-weight: 200;
            color: #00000051;
        }
        
        .search-button {
            position: absolute;
            right: 0;
            top: 0;
            width: 44px;
            height: 48px;
            background-color: #c43535;
            border: none;
            border-radius: 0 5px 5px 0;
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .cart-icon {
            margin: 0 20px;
            cursor: pointer;
        }
        
        .chat-icon {
            cursor: pointer;
        }
        
        .main-content {
            padding: 20px;
        }
        
        .section-title {
            font-size: 20px;
            font-weight: 400;
            color: #442e2e;
            margin: 20px 0;
        }
        
        .products-container {
            background-color: #ff9b17;
            border-radius: 30px;
            padding: 20px;
            margin-bottom: 40px;
        }
        
        .section-label {
            font-size: 10px;
            font-weight: 300;
            color: #fff8e1;
            margin-bottom: 10px;
        }
        
        .divider {
            border-top: 1px solid #000000;
            margin: 10px 0;
        }
        
        .products-grid {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 20px;
        }
        
        .product-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }
        
        .product-image {
            width: 100%;
            height: 130px;
            object-fit: contain;
            margin-bottom: 10px;
        }
        
        .product-name {
            font-size: 13px;
            font-weight: 400;
            color: #000000;
            margin-bottom: 5px;
        }
        
        .product-price {
            font-size: 13px;
            font-weight: 400;
            color: #fff8e1;
        }
        
        .popular-title {
            font-size: 24px;
            font-weight: 400;
            color: #000000;
            margin: 30px 0;
        }
        
        .popular-grid {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 20px;
        }
        
        .popular-item {
            background-color: #ffcf56;
            border: 2px solid #000000;
            border-radius: 10px;
            height: 210px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            transition: transform 0.3s ease;
        }
        
        .popular-item:hover {
            transform: scale(1.05);
        }
        
        .popular-image {
            max-width: 80%;
            max-height: 80%;
            object-fit: contain;
        }
        
        .footer {
            background-color: #fff8e1;
            height: 124px;
            width: 100%;
            margin-top: 50px;
        }
        
        @media (max-width: 1200px) {
            .products-grid, .popular-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }
        
        @media (max-width: 768px) {
            .products-grid, .popular-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .header {
                flex-direction: column;
                height: auto;
                padding: 15px;
            }
            
            .search-container {
                width: 100%;
                margin: 15px 0;
            }
            
            .logo {
                margin-right: 0;
            }
        }
        
        @media (max-width: 480px) {
            .products-grid, .popular-grid {
                grid-template-columns: 1fr;
            }
        }

        .popup-container {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #F5EBCC;
            border-radius: 0.375rem; /* rounded-md */
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            width: 500px;
            padding: 1rem;
            display: flex;
            gap: 1rem;
            font-family: sans-serif;
            z-index: 9999;
            font-size: 14px;
        }
        .popup-left {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 420px;
            position: relative;
        }
        .popup-left img {
            width: 200px;
            height: 250px;
            object-fit: contain;
            border-radius: 0.25rem;
        }
        .popup-left .price {
            color: #b12704;
            font-weight: 600;
            margin-top: 0.5rem;
            text-align: center;
        }
        .popup-left .name {
            font-weight: 600;
            margin-top: 0.25rem;
            text-align: center;
        }
        .popup-left .weight {
            font-size: 12px;
            margin-top: 0.125rem;
            text-align: center;
        }
        .popup-right {
            flex: 1;
            padding-left: 0.5rem;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
        }
        .popup-description-btn {
            background-color:#ff9f1a;
            color: white;
            font-weight: 600;
            font-size: 20px;
            border-radius: 9999px;
            padding: 0.25rem 0.75rem;
            width: 200px;
            box-shadow: 0 2px 0 rgba(0,0,0,0.15);
            margin-bottom: 0.5rem;
            border: none;
            cursor: default;
        }
        .popup-description-text {
            font-size: 20px;
            color: #1a1a1a;
            margin-bottom: 1rem;
        }
        .popup-stock {
            text-align: right;
            font-size: 10px;
            font-weight: 600;
            color: #4a4a4a;
            margin-bottom: 0.25rem;
        }
        .popup-add-cart-btn {
            background-color: #ff9f1a;
            color: white;
            font-weight: 600;
            font-size: 12px;
            border-radius: 0.5rem;
            padding: 0.5rem 2rem;
            box-shadow: 0 2px 0 rgba(0,0,0,0.15);
            max-width: 260px;
            border: none;
            cursor: pointer;
            align-self: flex-end;
        }
        .popup-back-btn {
            position: absolute;
            top: 0.75rem;
            left: 0.75rem;
            background: #4a4a4a;
            border-radius: 30px;
            padding: 0.5rem;
            box-shadow: 0 2px 6px rgba(0,0,0,0.2);
            border: none;
            cursor: pointer;
            color:rgb(255, 255, 255);
            font-size: 16px;
            z-index: 10;
        }
         .book-icon {
            cursor: pointer;
            margin: 0 10px;
            display: flex;
            align-items: center;
        }
    </style>
</head>
<body>
    <header class="header">
        <a href="homepage.php" class="logo">
            <img src="images/logo.png" alt="Manan Mart Logo" class="logo" />
        </a>
        <div class="search-container">
            <input type="text" class="search-bar" placeholder="Cari Di MANAN MART" />
            <button class="search-button">
                <img src="images/Search.svg" alt="Search" width="23" height="25" />
            </button>
        </div>

        <div class="cart-icon">
            <img src="images/keranjang.svg" alt="Shopping Cart" width="32" height="29" />
        </div>
 <div class="book-icon">
            <img src="images/riwayat.png"alt="Pesanan" width="50" height="50">
        </div>
    </header>

    <main class="main-content">
        <h2 class="section-title">Barang Yang Di Jual</h2>

        <div class="products-container">
            <p class="section-label">Dijual Sekarang</p>
            <div class="divider"></div>

            <div class="products-grid">
                <div class="product-card">
                    <img src="images/garam.png" alt="Garam Cap Udang" class="product-image" />
                    <h3 class="product-name">GARAM CAP UDANG</h3>
                    <p class="product-price">Rp.5.500,00</p>
                </div>

                <div class="product-card">
                    <img src="images/miedara.png" alt="Mi Burung Dara" class="product-image" />
                    <h3 class="product-name">MI BURUNG DARA</h3>
                    <p class="product-price">Rp.5.000,00</p>
                </div>

                <div class="product-card">
                    <img src="images/beras.png" alt="Beras Ramos" class="product-image" />
                    <h3 class="product-name">BERAS RAMOS</h3>
                    <p class="product-price">Rp.74.000,00</p>
                </div>

                <div class="product-card">
                    <img src="images/Minyak.png" alt="Minyak Kita" class="product-image" />
                    <h3 class="product-name">MINYAK KITA</h3>
                    <p class="product-price">Rp.15.000,00</p>
                </div>

                <div class="product-card">
                    <img src="images/tepung.png" alt="Tepung Segitiga Biru" class="product-image" />
                    <h3 class="product-name">TEPUNG SEGITIGA BIRU</h3>
                    <p class="product-price">Rp.12.000,00</p>
                </div>

                <div class="product-card">
                    <img src="images/gula.png" alt="Gulaku" class="product-image" />
                    <h3 class="product-name">GULAKU</h3>
                    <p class="product-price">Rp.17.000,00</p>
                </div>
            </div>
        </div>

        <h2 class="popular-title">Paling Sering Di beli</h2>

        <div class="popular-grid">
            <div class="popular-item">
                <img src="images/beras.png" alt="Beras Ramos" class="popular-image" />
            </div>

            <div class="popular-item">
                <img src="images/garam.png" alt="Garam Cap Udang" class="popular-image" />
            </div>

            <div class="popular-item">
                <img src="images/Minyak.png" alt="Garam Cap Udang" class="popular-image" />
            </div>

            <div class="popular-item">
                <img src="images/miedara.png" alt="Garam Cap Udang" class="popular-image" />
            </div>

            <div class="popular-item">
                <img src="images/tepung.png" alt="Tepung Segitiga Biru" class="popular-image" />
            </div>

            <div class="popular-item">
                <img src="images/gula.png" alt="Gulaku" class="popular-image" />
            </div>
        </div>
    </main>

    <footer class="footer"></footer>

    <!-- Popup Gulaku Premium Product -->
     <a href="keranjang.php">
    <div class="popup-container" role="dialog" aria-modal="true" aria-labelledby="popup-title">
        <button aria-label="Back" class="popup-back-btn">
            &#8592;
        </button>
        <div class="popup-left">
            </a>
            <img
                src="images/Miedara.png"
                alt="Gulaku premium sugar package with green and yellow label"
                width="120"
                height="120"
            />
            <div class="price">Rp.20.000,00</div>
            <div class="name">Mi Burung Dara</div>
            <div class="weight">1 pcs</div>
        </div>
        <div class="popup-right">
            <button type="button" class="popup-description-btn">Deskripsi</button>
            <p class="popup-description-text">
             Mie kering legendaris dengan tekstur kenyal dan keriting, cocok untuk berbagai macam masakan, terutama bakso kuah.
            </p>
            <div class="popup-stock"></div>
             <a href="pesanan.php">
                <button type="button" class="popup-add-cart-btn">Masukkan Keranjang</button>
            </a>
        </div>
    </div>
</body>
</html> 