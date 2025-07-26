<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1>Pengguna Sistem</h1></div>
                <div class="col-sm-6">
                    <a href="<?= site_url('admin/pengguna/new'); ?>" class="btn btn-primary float-sm-right"><i class="fas fa-plus"></i> Tambah Pengguna</a>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered">
                    <thead><tr><th>Nama</th><th>Email</th><th>Role</th><th>Aksi</th></tr></thead>
                    <tbody>
                        <?php if (!empty($users)): foreach($users as $user): ?>
                        <tr>
                            <td><?= esc($user['nama']); ?></td>
                            <td><?= esc($user['email']); ?></td>
                            <td><?= ucfirst(esc($user['role'])); ?></td>
                            <td>
                                <a href="<?= site_url('admin/pengguna/edit/' . $user['id']); ?>" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                <button onclick="confirmDelete('<?= site_url('admin/pengguna/delete/' . $user['id']); ?>')" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <?php endforeach; endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
