        <!DOCTYPE html>
        <html lang="id">

        <head>
            <meta charset="UTF-8" />
            <title>Pembelian</title>
            <style>
                body {
                    margin: 0;
                    font-family: sans-serif;
                }

                .back-arrow {
                    position: absolute;
                    top: 20px;
                    left: 20px;
                    font-size: 28px;
                    text-decoration: none;
                    color: black;
                    z-index: 1000;
                }

                .container {
                    display: flex;
                    height: 100vh;
                }

                .left,
                .right {
                    flex: 1;
                    padding: 20px;
                    box-sizing: border-box;
                }

                .left {
                    background: #f9f9f9;
                    border-right: 1px solid #ccc;
                    overflow-y: auto;
                    padding-top: 60px;
                    /* Tambahkan padding atas */
                    padding-left: 60px;
                    /* Tambahkan padding kiri agar teks menjauh dari panah */
                }


                .right {
                    background: #fff;
                    display: flex;
                    flex-direction: column;
                    justify-content: space-between;
                }

                .header {
                    font-weight: bold;
                    font-size: 24px;
                    margin-bottom: 20px;
                }

                .search {
                    width: 100%;
                    padding: 8px;
                    margin-bottom: 10px;
                }

                .add-new {
                    color: green;
                    cursor: pointer;
                    margin-bottom: 10px;
                    display: inline-block;
                }

                .buttons {
                    margin-bottom: 10px;
                }

                .buttons button {
                    margin-right: 10px;
                }

                .product-card {
                    background: white;
                    border: 1px solid #ddd;
                    padding: 10px;
                    margin-bottom: 10px;
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                }

                .product-info {
                    display: flex;
                    align-items: center;
                }

                .product-info img {
                    width: 60px;
                    height: 60px;
                    margin-right: 10px;
                    object-fit: cover;
                }

                .controls {
                    display: flex;
                    align-items: center;
                    gap: 10px;
                }

                .payment-header {
                    background: orange;
                    color: white;
                    padding: 10px;
                    font-weight: bold;
                    font-size: 20px;
                }

                .payment-body {
                    flex-grow: 1;
                    padding: 20px;
                    font-style: italic;
                    color: gray;
                    text-align: center;
                    display: flex;
                    flex-direction: column;
                    align-items: flex-start;
                    justify-content: flex-start;
                }

                .payment-footer {
                    padding: 20px;
                }

                .pay-button {
                    width: 100%;
                    background: #fecd8e;
                    border: none;
                    padding: 15px;
                    font-size: 16px;
                    font-weight: bold;
                    color: white;
                    cursor: pointer;
                    opacity: 0.5;
                }

                .pay-button.active {
                    opacity: 1;
                    background: orange;
                }

                .cart-item {
                    background: #f9f9f9;
                    border: 1px solid #ddd;
                    padding: 10px;
                    display: flex;
                    align-items: center;
                    justify-content: flex-start;
                    font-style: normal;
                    color: black;
                    max-width: 100%;
                    margin-bottom: 10px;
                }

                .cart-item img {
                    width: 60px;
                    height: 60px;
                    margin-right: 10px;
                    object-fit: cover;
                }

                .cart-text {
                    text-align: left;
                }

                .payment-option {
                    display: flex;
                    align-items: center;
                    padding: 10px;
                    border: 10px solid #ccc;
                    margin: 10px 0;
                    cursor: pointer;
                    width: 100%;
                }

                .payment-option img {
                    width: 40px;
                    height: 40px;
                    margin-right: 10px;
                }

                .payment-option.selected {
                    border: 2px solid green;
                    background-color: #eaffea;
                }
            </style>
        </head>

        <body>
            <!-- Panah kiri atas -->
            <a href="javascript:history.back()" class="back-arrow">←</a>

            <div class="container">
                <!-- Pembelian -->
                <div class="left">
                    <div class="header">Pembelian</div>
                    <input type="text" class="search" placeholder="Cari nama barang" />
                    <div class="buttons">
                        <button>Semua</button>
                    </div>
                    <div id="product-list"></div>
                </div>

                <div class="right">
                    <div class="payment-header">Pembayaran</div>
                    <div class="payment-body" id="paymentNote">
                        Masukkan Belanjaanmu :
                    </div>


                    <form id="cartForm" method="POST" action="Alamatpembayaran.php">
                        <input type="hidden" name="cart_data" id="cartData">
                        <div class="payment-footer">
                            <button type="submit" class="pay-button" id="payBtn" disabled>Masukan keranjang</button>
                        </div>
                    </form>


                </div>
            </div>

            <script>
                const products = [{
                        id: 1,
                        name: "Garam Cap Udang",
                        price: 5500,
                        img: "images/garam.png"
                    },
                    {
                        id: 2,
                        name: "Mie Burung Dara",
                        price: 5000,
                        img: "images/miedara.png"
                    },
                    {
                        id: 3,
                        name: "Beras Ramos",
                        price: 78000,
                        img: "images/Beras.png"
                    },
                    {
                        id: 4,
                        name: "Minyak Kita",
                        price: 15000,
                        img: "images/Minyak.png"
                    },
                    {
                        id: 5,
                        name: "Tepung Segitiga Biru",
                        price: 12000,
                        img: "images/tepung.png"
                    },
                    {
                        id: 6,
                        name: "images/Gulaku Premium",
                        price: 15500,
                        img: "images/gula.png"
                    }
                ];

                const cart = {};
                let pembayaranAktif = false;

                function formatRupiah(number) {
                    return "Rp " + number.toLocaleString("id-ID");
                }

                function updateCartUI() {
                    const note = document.getElementById("paymentNote");
                    const payBtn = document.getElementById("payBtn");
                    note.innerHTML = "";
                    let total = 0;
                    const items = Object.values(cart);

                    if (items.length === 0) {
                        note.innerHTML = "Masukkan Belanjaanmu :)";
                        note.style.textAlign = "center";
                        payBtn.classList.remove("active");
                        payBtn.disabled = true;
                        return;
                    }

                    items.forEach(item => {
                        const subtotal = item.qty * item.price;
                        total += subtotal;
                        const div = document.createElement("div");
                        div.className = "cart-item";
                        div.innerHTML = `
                <img src="${item.img}" />
                <div class="cart-text">
                    <strong>${item.name}</strong><br>
                    Jumlah: ${item.qty}<br>
                    Total: ${formatRupiah(subtotal)}
                </div>
                `;
                        note.appendChild(div);
                    });

                    payBtn.classList.add("active");
                    payBtn.disabled = false;
                }

                function updateQty(id, change) {
                    const product = products.find(p => p.id === id);
                    if (!cart[id]) cart[id] = {
                        ...product,
                        qty: 0
                    };
                    cart[id].qty = Math.max(0, cart[id].qty + change);
                    if (cart[id].qty === 0) delete cart[id];
                    document.getElementById(`qty-${id}`).textContent = cart[id]?.qty || 0;
                    updateCartUI();
                }

                function renderProductList() {
                    const list = document.getElementById("product-list");
                    products.forEach(p => {
                        const card = document.createElement("div");
                        card.className = "product-card";
                        card.innerHTML = `
                <div class="product-info">
                    <img src="${p.img}" alt="${p.name}" />
                    <div>
                    <strong>${p.name}</strong><br>
                    ${formatRupiah(p.price)}
                    </div>
                </div>
                <div class="controls">
                    <button onclick="updateQty(${p.id}, -1)">-</button>
                    <span id="qty-${p.id}">0</span>
                    <button onclick="updateQty(${p.id}, 1)">+</button>
                </div>
                `;
                        list.appendChild(card);
                    });
                }


                function selectPayment(element, method) {
                    if (!pembayaranAktif) return;
                    document.querySelectorAll('.payment-option').forEach(el => el.classList.remove("selected"));
                    element.classList.add("selected");
                }

                renderProductList();

                document.getElementById('cartForm').addEventListener('submit', function(e) {
                    e.preventDefault(); // cegah form submit langsung supaya bisa simpan dulu
                    if (Object.keys(cart).length === 0) {
                        alert("Keranjang kosong, pilih barang dulu ya!");
                        return;
                    }
                    localStorage.setItem('cart', JSON.stringify(cart)); // simpan ke localStorage
                    window.location.href = 'Alamatpembayaran.php'; // pindah ke halaman pembayaran
                });
            </script>
        </body>

        </html>