<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Edit Barang</h2>
    <form action="<?= base_url('items/update/'.$item['id']) ?>" method="post">
        <?= csrf_field() ?>

        <div class="form-group">
            <label>Nama Barang</label>
            <input type="text" name="name" class="form-control" value="<?= esc($item['name']) ?>" required>
        </div>

        <div class="form-group">
            <label>Jumlah</label>
            <input type="number" name="quantity" class="form-control" value="<?= esc($item['quantity']) ?>" required>
        </div>

        <div class="form-group">
            <label>Harga per Unit</label>
            <input type="number" name="price_per_unit" class="form-control" value="<?= esc($item['price_per_unit']) ?>" required>
        </div>

        <div class="form-group">
            <label>Jenis Barang</label>
            <input type="text" class="form-control" value="<?= esc($item['type']) ?>" disabled>
        </div>

        <!-- Field sesuai jenis -->
        <?php if ($item['type'] === 'Electronic'): ?>
            <div class="form-group">
                <label>Daya Listrik (Watt)</label>
                <input type="number" name="wattage" class="form-control" value="<?= esc($item['wattage']) ?>">
            </div>
            <div class="form-group">
                <label>Garansi (Tahun)</label>
                <input type="number" name="warranty" class="form-control" value="<?= esc($item['warranty']) ?>">
            </div>
        <?php elseif ($item['type'] === 'Furniture'): ?>
            <div class="form-group">
                <label>Bahan</label>
                <input type="text" name="material" class="form-control" value="<?= esc($item['material']) ?>">
            </div>
            <div class="form-group">
                <label>Dimensi</label>
                <input type="text" name="dimensions" class="form-control" value="<?= esc($item['dimensions']) ?>">
            </div>
        <?php elseif ($item['type'] === 'Food'): ?>
            <div class="form-group">
                <label>Tanggal Kedaluwarsa</label>
                <input type="date" name="expiry_date" class="form-control" value="<?= esc($item['expiry_date']) ?>">
            </div>
            <div class="form-group">
                <label>Kondisi Penyimpanan</label>
                <input type="text" name="storage_condition" class="form-control" value="<?= esc($item['storage_condition']) ?>">
            </div>
        <?php endif; ?>

        <button type="submit" class="btn btn-primary mt-3">Update</button>
        <a href="<?= base_url('items') ?>" class="btn btn-secondary mt-3">Kembali</a>
    </form>
</div>
</body>
</html>
