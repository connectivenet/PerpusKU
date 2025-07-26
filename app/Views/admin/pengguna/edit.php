<div class="content-wrapper">
    <section class="content-header"><h1><?= esc($title); ?></h1></section>
    <section class="content">
        <div class="card card-primary">
            <form action="<?= site_url('admin/pengguna/update/' . $user['id']); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="card-body">
                    <div class="form-group"><label>Nama Lengkap*</label><input type="text" name="nama" class="form-control" value="<?= esc($user['nama']); ?>" required></div>
                    <div class="form-group"><label>Email*</label><input type="email" name="email" class="form-control" value="<?= esc($user['email']); ?>" required></div>
                    <div class="form-group"><label>Password</label><input type="password" name="password" class="form-control"><small class="form-text text-muted">Biarkan kosong jika tidak ingin mengubah password.</small></div>
                    <div class="form-group"><label>Role*</label>
                        <select name="role" class="form-control" required>
                            <option value="petugas" <?= ($user['role'] == 'petugas') ? 'selected' : '' ?>>Petugas</option>
                            <option value="admin" <?= ($user['role'] == 'admin') ? 'selected' : '' ?>>Admin</option>
                        </select>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="<?= site_url('admin/pengguna'); ?>" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </section>
</div>