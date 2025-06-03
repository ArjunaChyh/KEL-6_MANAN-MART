<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manan Mart</title>
    <style>
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

        .suggestion-list {
            position: absolute;
            background-color: #eae7e7e5;
            width: 100%;
            border-radius: 0 0 5px 5px;
            list-style: none;
            margin-top: -5px;
            max-height: 200px;
            overflow-y: auto;
            z-index: 10;
        }

        .suggestion-list li {
            padding: 10px;
            cursor: pointer;
            border-top: 1px solid #ccc;
            font-size: 14px;
            color: black;
        }

        .suggestion-list li:hover {
            background-color: #d3d3d3;
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
         .book-icon {
            cursor: pointer;
            margin: 0 10px;
            display: flex;
            align-items: center;
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
    </style>
</head>
<body>
    <header class="header">
        <a href="keranjang.php" class="logo">
            <img src="images/logo.png" alt="Manan Mart Logo" class="logo" />
        </a>

        <div class="search-container">
            <input type="text" class="search-bar" placeholder="Cari Di MANAN MART">
            <button class="search-button">
                <img src="images/Search.svg" alt="Search" width="23" height="25">
            </button>
            <ul class="suggestion-list" style="display: none;"></ul>
        </div>

        <div class="cart-icon">
            <img src="images/keranjang.svg" alt="Shopping Cart" width="32" height="29">
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
                    <img src="images/miedara.png" alt="Garam Cap Udang" class="product-image">
                    <h3 class="product-name">MI BURUNG DARA</h3>
                    <p class="product-price">Rp.5.000,00</p>
                </div>
                <div class="product-card">    
                </div>
                <div class="product-card">    
                </div>
                <div class="product-card">      
                </div>
                <div class="product-card">                    
                </div>
                <div class="product-card">
                </div>
            </div>
        </div>

        <h2 class="popular-title">Paling Sering Di beli</h2>

        <div class="popular-grid">
            <div class="popular-item"><img src="images/beras.png" alt="Beras Ramos" class="popular-image"></div>
            <div class="popular-item"><img src="images/garam.png" alt="Garam Cap Udang" class="popular-image"></div>
            <div class="popular-item"><img src="images/Minyak.png" alt="Minyak Kita" class="popular-image"></div>
            <div class="popular-item"><img src="images/miedara.png" alt="Mi Burung Dara" class="popular-image"></div>
            <div class="popular-item"><img src="images/tepung.png" alt="Tepung Segitiga Biru" class="popular-image"></div>
            <div class="popular-item"><img src="images/gula.png" alt="Gulaku" class="popular-image"></div>
        </div>
    </main>

    <footer class="footer"></footer>
</body>
</html>
