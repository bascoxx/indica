<div class="col-lg-9 mt-2">
  <!-- Grafik Penjualan (7 Hari Terakhir) -->
  <div class="card mb-3">
    <div class="card-header fw-bold">Traffic Penjualan (7 Hari Terakhir)</div>
    <div class="card-body">
      <canvas id="chartPenjualan"></canvas>
    </div>
  </div>

  <!-- RINGKASAN PENJUALAN -->
  <div class="card mb-3">
    <div class="card-header fw-bold">Riwayat Penjualan</div>
    <div class="card-body">
      <div class="row text-center">
        <div class="col-md-3 border-end">
          <h6>Total Transaksi</h6>
          <h5 class="text-primary fw-bold"><span id="total-transaksi">0</span></h5>
        </div>
        <div class="col-md-3 border-end">
          <h6>Total Penjualan</h6>
          <h5 class="text-success fw-bold">Rp <span id="total-penjualan">0</span></h5>
        </div>
        <div class="col-md-3 border-end">
          <h6>Total Produk Terjual</h6>
          <h5 class="text-warning fw-bold"><span id="produk-terjual">0</span></h5>
        </div>
        <div class="col-md-3">
          <h6>Rata-rata Penjualan per Hari</h6>
          <h5 class="text-info fw-bold">Rp <span id="rata-rata">0</span></h5>
        </div>
      </div>
    </div>
  </div>

  <!-- TOTAL PENJUALAN PER MENU -->
  <div class="card mb-3">
    <div class="card-header fw-bold">Total Penjualan per Menu</div>
    <div class="card-body">
      <table class="table table-bordered text-center">
        <thead class="table-light">
          <tr>
            <th>Nama Menu</th>
            <th>Jumlah Terjual</th>
            <th>Total Penjualan (Rp)</th>
          </tr>
        </thead>
        <tbody id="tabel-menu">
          <!-- Data akan muncul otomatis -->
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Script Statistik Penjualan -->
<script>
  // Ambil data riwayat dari localStorage
  const riwayat = JSON.parse(localStorage.getItem("riwayatKasir")) || [];

  // Elemen tampilan
  const elTransaksi = document.getElementById("total-transaksi");
  const elPenjualan = document.getElementById("total-penjualan");
  const elProduk = document.getElementById("produk-terjual");
  const elRata = document.getElementById("rata-rata");
  const tabelMenu = document.getElementById("tabel-menu");

  if (riwayat.length === 0) {
    elTransaksi.textContent = 0;
    elPenjualan.textContent = 0;
    elProduk.textContent = 0;
    elRata.textContent = 0;
    tabelMenu.innerHTML = "<tr><td colspan='3'>Belum ada data penjualan</td></tr>";
  } else {
    // Total transaksi
    const totalTransaksi = riwayat.length;

    // Total penjualan (akumulasi semua total transaksi)
    const totalPenjualan = riwayat.reduce((sum, trx) => sum + trx.total, 0);

    // Total produk terjual
    const totalProduk = riwayat.reduce(
      (sum, trx) => sum + trx.daftar.reduce((a, p) => a + p.jumlah, 0),
      0
    );

    // Hitung jumlah hari unik dalam data
    const tanggalUnik = new Set(riwayat.map(trx => trx.tanggal.split(",")[0]));
    const rataRata = totalPenjualan / tanggalUnik.size;

    // Tampilkan ke dashboard
    elTransaksi.textContent = totalTransaksi;
    elPenjualan.textContent = totalPenjualan.toLocaleString("id-ID");
    elProduk.textContent = totalProduk;
    elRata.textContent = rataRata.toLocaleString("id-ID");

    // ====== DATA PENJUALAN PER MENU ======
    const dataMenu = {};

    riwayat.forEach(trx => {
      trx.daftar.forEach(item => {
        if (!dataMenu[item.nama]) {
          dataMenu[item.nama] = {
            jumlah: 0,
            total: 0
          };
        }
        dataMenu[item.nama].jumlah += item.jumlah;
        dataMenu[item.nama].total += item.subtotal;
      });
    });

    tabelMenu.innerHTML = Object.keys(dataMenu)
      .map(
        nama => `
        <tr>
          <td>${nama}</td>
          <td>${dataMenu[nama].jumlah}</td>
          <td>Rp ${dataMenu[nama].total.toLocaleString("id-ID")}</td>
        </tr>`
      )
      .join("");
  }
</script>