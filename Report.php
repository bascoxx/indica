<div class="col-lg-9 mt-2">
    <div class="card">
        <div class="card-header">
            📊 Report - Traffic Penjualan 7 Hari Terakhir
        </div>
        <div class="card-body text-center">
            <!-- Grafik Penjualan (ukuran sedang & responsif) -->
            <div style="max-width: 700px; height: 350px; margin: auto;">
                <canvas id="salesChart"></canvas>
            </div>

            <hr>
            <!-- Total Income -->
            <h5 class="mt-3">Total Income 7 Hari Terakhir:</h5>
            <h3 class="text-success">Rp <span id="total-income">0</span></h3>
        </div>
    </div>

    <!-- Card Riwayat Pemesanan -->
    <div class="card mt-3">
        <div class="card-header">
            🧾 Histori Pemesanan
        </div>
        <div class="card-body">
            <table class="table table-striped text-center">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Produk</th>
                        <th>Jumlah</th>
                        <th>Total (Rp)</th>
                    </tr>
                </thead>
                <tbody id="order-history"></tbody>
            </table>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Data penjualan 7 hari terakhir
    const salesData = [
        { date: '2025-11-01', total: 150000 },
        { date: '2025-11-02', total: 220000 },
        { date: '2025-11-03', total: 180000 },
        { date: '2025-11-04', total: 250000 },
        { date: '2025-11-05', total: 200000 },
        { date: '2025-11-06', total: 300000 },
        { date: '2025-11-07', total: 270000 }
    ];

    // Data histori pemesanan
    const orderHistory = [
        { date: '2025-11-01', product: 'Kopi Hitam', qty: 5, total: 50000 },
        { date: '2025-11-02', product: 'Es Kopi Susu', qty: 8, total: 88000 },
        { date: '2025-11-03', product: 'Latte', qty: 4, total: 76000 },
        { date: '2025-11-04', product: 'Cappuccino', qty: 6, total: 90000 },
        { date: '2025-11-05', product: 'Americano', qty: 7, total: 91000 },
        { date: '2025-11-06', product: 'Kopi Tubruk', qty: 10, total: 120000 },
        { date: '2025-11-07', product: 'Espresso', qty: 9, total: 99000 }
    ];

    // Render tabel histori pemesanan
    const tableBody = document.getElementById('order-history');
    tableBody.innerHTML = orderHistory.map(order => `
        <tr>
            <td>${order.date}</td>
            <td>${order.product}</td>
            <td>${order.qty}</td>
            <td>${order.total.toLocaleString('id-ID')}</td>
        </tr>
    `).join('');

    // Hitung total income
    const totalIncome = salesData.reduce((sum, item) => sum + item.total, 0);
    document.getElementById('total-income').textContent = totalIncome.toLocaleString('id-ID');

    // Siapkan data chart
    const ctx = document.getElementById('salesChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: salesData.map(item => item.date),
            datasets: [{
                label: 'Penjualan (Rp)',
                data: salesData.map(item => item.total),
                backgroundColor: 'rgba(13, 110, 253, 0.5)',
                borderColor: '#0d6efd',
                borderWidth: 1.5,
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: ctx => 'Rp ' + ctx.parsed.y.toLocaleString('id-ID')
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: v => 'Rp ' + v.toLocaleString('id-ID')
                    }
                }
            }
        }
    });
</script>
