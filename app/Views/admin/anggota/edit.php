<div class="content-wrapper">
    <section class="content-header"><h1><?= esc($title); ?></h1></section>
    <section class="content">
        <div class="card card-primary">
            <form action="<?= site_url('admin/anggota/update/' . $anggota['id']); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="card-body">
                    <div class="form-group"><label>Nama Lengkap*</label><input type="text" name="nama" class="form-control <?= (session('errors.nama')) ? 'is-invalid' : '' ?>" value="<?= old('nama', $anggota['nama']); ?>"></div>
                    <div class="form-group"><label>NIM*</label><input type="text" name="nim" class="form-control <?= (session('errors.nim')) ? 'is-invalid' : '' ?>" value="<?= old('nim', $anggota['nim']); ?>"></div>
                    <div class="form-group"><label>Jurusan</label><input type="text" name="jurusan" class="form-control" value="<?= old('jurusan', $anggota['jurusan']); ?>"></div>
                    <div class="form-group"><label>No. Telepon</label><input type="text" name="no_telepon" class="form-control" value="<?= old('no_telepon', $anggota['no_telepon']); ?>"></div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="<?= site_url('admin/anggota'); ?>" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </section>
</div>
