<div class="content-wrapper">
    <section class="content-header"><h1><?= esc($title); ?></h1></section>
    <section class="content">
        <div class="card card-primary">
            <form action="<?= site_url('admin/pengguna/create'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="card-body">
                    <div class="form-group"><label>Nama Lengkap*</label><input type="text" name="nama" class="form-control" required></div>
                    <div class="form-group"><label>Email*</label><input type="email" name="email" class="form-control" required></div>
                    <div class="form-group"><label>Password*</label><input type="password" name="password" class="form-control" required></div>
                    <div class="form-group"><label>Role*</label>
                        <select name="role" class="form-control" required>
                            <option value="petugas">Petugas</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="<?= site_url('admin/pengguna'); ?>" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </section>
</div>
