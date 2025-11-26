<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Product Order - Indica</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

  <style>
    :root {
      --brown: #8B4513;
      --brown-light: #A0522D;
      --brown-dark: #5C4033;
      --bg-dark: #1a1a1a;
      --card-bg: #2d2d2d;
      --text-light: #f8f9fa;
    }

    body {
      background-color: #121212;
      color: var(--text-light);
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      overflow-x: hidden;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    .main-content {
      flex: 1;
      margin-left: 240px;
      padding: 30px;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .footer {
      text-align: center;
      color: #777;
      font-size: 0.9rem;
      background-color: #1a1a1a;
      padding: 15px 0;
      width: 100%;
    }

    .content-wrapper {
      width: 90%;
      max-width: 1000px;
      background-color: var(--card-bg);
      border-radius: 12px;
      padding: 25px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
      animation: fadeIn 0.5s ease-in;
    }

    h2 {
      color: #A0522D;
      font-weight: 600;
      margin-bottom: 20px;
      text-align: center;
    }

    h3.category-title {
      color: var(--brown-light);
      border-bottom: 2px solid var(--brown-light);
      padding-bottom: 5px;
      margin-top: 25px;
      margin-bottom: 15px;
      font-size: 1.3rem;
      text-align: left;
    }

    .menu-cards {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
      gap: 15px;
      margin-bottom: 25px;
    }

    .menu-card {
      background: #2e2e2e;
      border-radius: 10px;
      padding: 15px;
      text-align: center;
      transition: all 0.3s ease;
    }

    .menu-card:hover {
      background: #3b3b3b;
      transform: translateY(-2px);
    }

    .menu-card h5 {
      color: var(--brown-light);
      margin-bottom: 10px;
      font-weight: 600;
    }

    .menu-card p {
      margin: 0;
      color: #ccc;
      font-size: 0.9rem;
    }

    .btn-card {
      margin-top: 10px;
      background: var(--brown-light);
      color: white;
      border: none;
      border-radius: 8px;
      padding: 8px 14px;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .btn-card:hover {
      background: var(--brown);
    }

    input {
      padding: 10px;
      border-radius: 8px;
      border: 1px solid #555;
      background: #333;
      color: white;
      font-size: 14px;
    }

    input:focus {
      outline: none;
      border-color: var(--brown-light);
      box-shadow: 0 0 0 2px rgba(160, 82, 45, 0.3);
    }

    button {
      padding: 10px 16px;
      border-radius: 8px;
      border: none;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .btn-add {
      background-color: #28a745;
      color: white;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 15px;
      font-size: 14px;
    }

    th {
      background-color: var(--brown);
      color: white;
      padding: 12px;
      text-align: center;
    }

    td {
      padding: 12px;
      text-align: center;
      border-bottom: 1px solid #444;
    }

    tr.new-row {
      animation: fadeIn 0.5s ease;
    }

    tr:hover {
      background-color: #383838;
    }

    .empty-state {
      text-align: center;
      color: #888;
      font-style: italic;
      padding: 40px 20px;
    }
  </style>
</head>

<body>
  <main class="main-content">
    <div class="content-wrapper">
      <h2><i class="bi bi-cart-plus"></i> Product Order</h2>

      <!-- KATEGORI: MINUMAN -->
      <h3 class="category-title">Minuman</h3>
      <div class="menu-cards" id="menuMinuman"></div>

      <!-- KATEGORI: MAKANAN -->
      <h3 class="category-title">Makanan</h3>
      <div class="menu-cards" id="menuMakanan"></div>

      <div class="input-area mt-4 d-grid gap-3" style="grid-template-columns: 2fr 1fr 1fr auto;">
        <input type="text" id="namaProduk" placeholder="Nama Produk" />
        <input type="number" id="hargaProduk" placeholder="Harga (Rp)" min="0" />
        <input type="number" id="stokProduk" placeholder="Stok" min="0" />
        <button class="btn-add" onclick="tambahProduk()"><i class="bi bi-plus-circle"></i> Tambah</button>
      </div>

      <table id="tabelProduk">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>

      <div id="emptyState" class="empty-state">
        <p>Belum ada produk. Tambahkan produk pertama Anda!</p>
      </div>
    </div>

    <div class="footer">© 2025 | Indica by Kelompok 5</div>
  </main>

  <script>
    let daftarProduk = JSON.parse(localStorage.getItem("daftarProdukIndica")) || [];
    const tbody = document.querySelector("#tabelProduk tbody");
    const emptyState = document.getElementById("emptyState");

    // 🔹 Pisahkan kategori: minuman & makanan
    const menuMinuman = [
      // SIGNATURE
      { nama: "Arenicano", harga: 19000, stok: 20 },
      { nama: "KSM", harga: 20000, stok: 15 },
      { nama: "Brew Beer", harga: 22000, stok: 10 },
      { nama: "Kopi Susu Jamaika", harga: 24000, stok: 10 },
      { nama: "Lemonade Honey", harga: 15000, stok: 12 },
      { nama: "Susu Meruem", harga: 13000, stok: 15 },

      // ESPRESSO BASED
      { nama: "Spanish Latte", harga: 20000, stok: 15 },
      { nama: "Americano", harga: 12000, stok: 20 },
      { nama: "Cafe Latte", harga: 20000, stok: 15 },
      { nama: "Cappuccino", harga: 22000, stok: 15 },
      { nama: "Magic", harga: 24000, stok: 12 },
      { nama: "Moccacino", harga: 24000, stok: 10 },
      { nama: "Flavored Cafe Latte (Butterscotch)", harga: 25000, stok: 10 },
      { nama: "Flavored Cafe Latte (Caramel)", harga: 25000, stok: 10 },
      { nama: "Flavored Cafe Latte (Hazelnut)", harga: 25000, stok: 10 },

      // MANUAL BREW
      { nama: "Filter", harga: 22000, stok: 8 },
      { nama: "Cold Brew", harga: 18000, stok: 8 },

      // NON-KOPI
      { nama: "Matcha Latte", harga: 20000, stok: 10 },
      { nama: "Cocoa Latte", harga: 18000, stok: 10 },
      { nama: "Caramel Latte", harga: 18000, stok: 10 },
      { nama: "Salted Caramel Latte", harga: 18000, stok: 10 },
      { nama: "Hazelnut Latte", harga: 18000, stok: 10 },
      { nama: "Choco Rum", harga: 20000, stok: 10 }
    ];

    const menuMakanan = [
      { nama: "Donat Kampung", harga: 10000, stok: 15 },
      { nama: "Kentang Goreng", harga: 15000, stok: 15 },
      { nama: "Mie Nyemek", harga: 17000, stok: 10 }
    ];

    const formatRupiah = (angka) =>
      new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
        minimumFractionDigits: 0
      }).format(angka);

    const tampilkanProduk = () => {
      tbody.innerHTML = "";
      if (daftarProduk.length === 0) {
        emptyState.style.display = "block";
        return;
      }
      emptyState.style.display = "none";

      daftarProduk.forEach((produk, index) => {
        const tr = document.createElement("tr");
        tr.classList.add("new-row");
        tr.innerHTML = `
          <td>${index + 1}</td>
          <td>${produk.nama}</td>
          <td>${formatRupiah(produk.harga)}</td>
          <td>${produk.stok}</td>
          <td>
            <button class="btn-edit btn btn-warning btn-sm" onclick="editProduk(${index})"><i class="bi bi-pencil"></i></button>
            <button class="btn-delete btn btn-danger btn-sm" onclick="hapusProduk(${index})"><i class="bi bi-trash"></i></button>
          </td>`;
        tbody.appendChild(tr);
      });
    };

    const tambahProduk = () => {
      const nama = document.getElementById("namaProduk").value.trim();
      const harga = parseInt(document.getElementById("hargaProduk").value);
      const stok = parseInt(document.getElementById("stokProduk").value);

      if (!nama || isNaN(harga) || isNaN(stok) || harga < 0 || stok < 0) {
        alert("Lengkapi semua field dengan benar!");
        return;
      }

      daftarProduk.push({ nama, harga, stok });
      localStorage.setItem("daftarProdukIndica", JSON.stringify(daftarProduk));

      document.getElementById("namaProduk").value = "";
      document.getElementById("hargaProduk").value = "";
      document.getElementById("stokProduk").value = "";
      tampilkanProduk();
    };

    const tambahDariCard = (produk) => {
      daftarProduk.push(produk);
      localStorage.setItem("daftarProdukIndica", JSON.stringify(daftarProduk));
      tampilkanProduk();
    };

    const renderMenuCards = () => {
      const containerMinuman = document.getElementById("menuMinuman");
      const containerMakanan = document.getElementById("menuMakanan");

      menuMinuman.forEach(menu => {
        const div = document.createElement("div");
        div.className = "menu-card";
        div.innerHTML = `
          <h5>${menu.nama}</h5>
          <p>Harga: ${formatRupiah(menu.harga)}</p>
          <p>Stok: ${menu.stok}</p>
          <button class="btn-card" onclick='tambahDariCard(${JSON.stringify(menu)})'>
            <i class="bi bi-bag-plus"></i> Tambah ke Daftar
          </button>`;
        containerMinuman.appendChild(div);
      });

      menuMakanan.forEach(menu => {
        const div = document.createElement("div");
        div.className = "menu-card";
        div.innerHTML = `
          <h5>${menu.nama}</h5>
          <p>Harga: ${formatRupiah(menu.harga)}</p>
          <p>Stok: ${menu.stok}</p>
          <button class="btn-card" onclick='tambahDariCard(${JSON.stringify(menu)})'>
            <i class="bi bi-bag-plus"></i> Tambah ke Daftar
          </button>`;
        containerMakanan.appendChild(div);
      });
    };

    renderMenuCards();
    tampilkanProduk();
  </script>
</body>
</html>
