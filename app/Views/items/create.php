<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Tambah Barang</h2>
    <form action="<?= base_url('items/store') ?>" method="post">
        <?= csrf_field() ?>

        <div class="form-group">
            <label>Nama Barang</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Jumlah</label>
            <input type="number" name="quantity" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Harga per Unit</label>
            <input type="number" name="price_per_unit" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Jenis Barang</label>
            <select name="type" id="type" class="form-control" required onchange="toggleFields(this.value)">
                <option value="Electronic">Elektronik</option>
                <option value="Furniture">Furniture</option>
                <option value="Food">Makanan</option>
            </select>
        </div>

        <!-- Field Elektronik -->
        <div id="electronicFields">
            <div class="form-group">
                <label>Daya Listrik (Watt)</label>
                <input type="number" name="wattage" class="form-control">
            </div>
            <div class="form-group">
                <label>Garansi (Tahun)</label>
                <input type="number" name="warranty" class="form-control">
            </div>
        </div>

        <!-- Field Furniture -->
        <div id="furnitureFields" style="display:none;">
            <div class="form-group">
                <label>Bahan</label>
                <input type="text" name="material" class="form-control">
            </div>
            <div class="form-group">
                <label>Dimensi</label>
                <input type="text" name="dimensions" class="form-control">
            </div>
        </div>

        <!-- Field Makanan -->
        <div id="foodFields" style="display:none;">
            <div class="form-group">
                <label>Tanggal Kedaluwarsa</label>
                <input type="date" name="expiry_date" class="form-control">
            </div>
            <div class="form-group">
                <label>Kondisi Penyimpanan</label>
                <input type="text" name="storage_condition" class="form-control">
            </div>
        </div>

        <button type="submit" class="btn btn-success mt-3">Simpan</button>
        <a href="<?= base_url('items') ?>" class="btn btn-secondary mt-3">Kembali</a>
        <?php if (session()->getFlashdata('errors')) : ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                <li><?= esc($error) ?></li>
            <?php endforeach ?>
        </ul>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

    </form>
</div>

<script>
    function toggleFields(type) {
        document.getElementById('electronicFields').style.display = (type === 'Electronic') ? 'block' : 'none';
        document.getElementById('furnitureFields').style.display = (type === 'Furniture') ? 'block' : 'none';
        document.getElementById('foodFields').style.display = (type === 'Food') ? 'block' : 'none';
    }
    // Auto show fields on load if needed
    window.onload = function () {
        toggleFields(document.getElementById('type').value);
    };
</script>
</body>
</html>
