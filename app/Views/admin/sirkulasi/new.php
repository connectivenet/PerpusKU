<div class="content-wrapper">
    <section class="content-header"><h1><?= esc($title); ?></h1></section>
    <section class="content">
        <div class="card card-primary">
            <form action="<?= site_url('admin/sirkulasi/create'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="card-body">
                    <div class="form-group">
                        <label>Pilih Anggota*</label>
                        <select name="anggota_id" class="form-control" required>
                            <option value="">-- Pilih Anggota --</option>
                            <?php foreach($anggota as $a): ?>
                            <option value="<?= $a['id']; ?>"><?= esc($a['nim'] . ' - ' . $a['nama']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Pilih Buku*</label>
                        <select name="book_id" class="form-control" required>
                            <option value="">-- Pilih Judul Buku --</option>
                            <?php foreach($books as $b): ?>
                            <option value="<?= $b['id']; ?>"><?= esc($b['judul']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Pinjam*</label>
                        <input type="date" name="tanggal_pinjam" class="form-control" value="<?= date('Y-m-d'); ?>" required>
                    </div>
                    <p><strong>Catatan:</strong> Batas waktu peminjaman adalah 7 hari dari tanggal pinjam.</p>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
                    <a href="<?= site_url('admin/sirkulasi'); ?>" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </section>
</div>
