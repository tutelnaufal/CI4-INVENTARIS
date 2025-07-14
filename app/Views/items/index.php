<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Inventaris Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <style>
        body {
            background-color: #121212;
            color: #f1f1f1;
        }
        .table {
            background-color: #1e1e1e;
            color: #fff;
        }
        .table thead {
            background-color: #333;
        }
        .btn {
            color: #fff;
        }
        .btn-success {
            background-color: #28a745;
        }
        .btn-primary {
            background-color: #007bff;
        }
        .btn-danger {
            background-color: #dc3545;
        }
        .form-control, .form-control:focus {
            background-color: #2c2c2c;
            color: #fff;
            border-color: #444;
        }
        .alert-success {
            background-color: #155724;
            border-color: #1e7e34;
            color: #d4edda;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Daftar Barang</h2>
    <a href="<?= base_url('items/create') ?>" class="btn btn-success mb-3">+ Tambah Barang</a>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <!-- Tabel Daftar Barang -->
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Jumlah</th>
                <th>Harga per Unit</th>
                <th>Jenis</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $item): ?>
                <tr>
                    <td><?= esc($item['name']) ?></td>
                    <td><?= esc($item['quantity']) ?></td>
                    <td>Rp<?= number_format($item['price_per_unit'], 0, ',', '.') ?></td>
                    <td><?= esc($item['type']) ?></td>
                    <td>
                        <a href="<?= base_url('items/edit/'.$item['id']) ?>" class="btn btn-primary btn-sm">Edit</a>
                        <form action="<?= base_url('items/delete/'.$item['id']) ?>" method="post" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                            <?= csrf_field() ?>
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

    <!-- Statistik Cards (pindah ke bawah tabel) -->
    <div class="row mt-5 mb-4">
        <div class="col-md-4">
            <div class="card bg-dark text-white">
                <div class="card-body">
                    <h5 class="card-title">Total Barang</h5>
                    <p class="card-text display-4"><?= $total_barang ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-secondary text-white">
                <div class="card-body">
                    <h5 class="card-title">Jenis Barang</h5>
                    <p class="card-text display-4"><?= $total_jenis ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h5 class="card-title">Stok Terbanyak</h5>
                    <?php if ($stok_terbanyak): ?>
                        <p class="mb-1"><strong><?= esc($stok_terbanyak['name']) ?></strong></p>
                        <p class="mb-0">Stok: <?= esc($stok_terbanyak['quantity']) ?></p>
                    <?php else: ?>
                        <p class="mb-0">Tidak ada data</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik Google Charts -->
    <div class="card bg-dark text-white mb-5">
        <div class="card-body">
            <h5 class="card-title">Grafik Jumlah Barang per Jenis</h5>
            <div id="chart_div" style="width: 100%; height: 400px;"></div>
        </div>
    </div>
</div>

<!-- Google Charts Script -->
<script>
    google.charts.load("current", { packages: ["corechart"] });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        const data = google.visualization.arrayToDataTable(<?= $grafik_data ?>);

        const options = {
            title: 'Jumlah Barang per Jenis',
            backgroundColor: '#121212',
            titleTextStyle: { color: '#fff' },
            legend: { textStyle: { color: '#fff' } },
            hAxis: { textStyle: { color: '#fff' } },
            vAxis: { textStyle: { color: '#fff' }, minValue: 0 },
        };

        const chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }
</script>
</body>
</html>
