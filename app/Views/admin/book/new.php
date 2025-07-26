<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>Tambah Buku Baru</h1>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <form action="<?= site_url('admin/book/create'); ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="judul">Judul Buku*</label>
                            <input type="text" name="judul" id="judul" class="form-control <?= (session('errors.judul')) ? 'is-invalid' : '' ?>" value="<?= old('judul'); ?>">
                        </div>
                        <div class="form-group">
                            <label for="penulis">Penulis*</label>
                            <input type="text" name="penulis" id="penulis" class="form-control <?= (session('errors.penulis')) ? 'is-invalid' : '' ?>" value="<?= old('penulis'); ?>">
                        </div>
                        <div class="form-group">
                            <label for="penerbit">Penerbit</label>
                            <input type="text" name="penerbit" id="penerbit" class="form-control" value="<?= old('penerbit'); ?>">
                        </div>
                        <div class="form-group">
                            <label for="tahun_terbit">Tahun Terbit</label>
                            <input type="number" name="tahun_terbit" id="tahun_terbit" class="form-control" min="1900" max="<?= date('Y'); ?>" value="<?= old('tahun_terbit'); ?>">
                        </div>
                        <div class="form-group">
                            <label for="sinopsis">Sinopsis</label>
                            <textarea name="sinopsis" id="sinopsis" class="form-control" rows="4"><?= old('sinopsis'); ?></textarea>
                        </div>
<div class="form-group">
    <label for="sampul">File Sampul (Gambar)</label>
    <input type="file" name="sampul" id="sampul" class="form-control-file <?= (session('errors.sampul')) ? 'is-invalid' : '' ?>" accept="image/png, image/jpeg, image/gif">
</div>
<div class="form-group">
    <label for="file_buku">File Buku (Dokumen)*</label>
    <input type="file" name="file_buku" id="file_buku" class="form-control-file <?= (session('errors.file_buku')) ? 'is-invalid' : '' ?>" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx">
    <small class="form-text text-muted">*Wajib ditambahkan </small>
</div>
                    </div>
                    <div class="card-footer">
						<button type="submit" class="btn btn-primary">Simpan Buku</button>
						<a href="<?= site_url('admin/book'); ?>" class="btn btn-secondary">Batal</a>
					</div>
                </form>
            </div>
        </div>
    </section>
</div>
