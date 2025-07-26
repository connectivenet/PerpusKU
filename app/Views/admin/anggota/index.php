<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Kelola Anggota</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
					<div class="btn-group">
                        <a href="<?= site_url('admin/anggota/new'); ?>" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Anggota</a>
                    </div>
                        <div class="card-tools">
                            <form action="" method="get">
                                <div class="input-group">
                                    <input type="text" name="keyword" class="form-control" placeholder="Cari nama atau NIM..." value="<?= esc($keyword); ?>">
                                    <input type="hidden" name="per_page" value="<?= esc($perPage); ?>">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>NIM</th>
                                <th>Nama</th>
                                <th>Jurusan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($anggota)): foreach($anggota as $item): ?>
                            <tr>
                                <td><?= esc($item['nim']); ?></td>
                                <td><?= esc($item['nama']); ?></td>
                                <td><?= esc($item['jurusan']); ?></td>
                                <td>
                                    <a href="<?= site_url('admin/anggota/edit/' . $item['id']); ?>" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                    <button onclick="confirmDelete('<?= site_url('admin/anggota/delete/' . $item['id']); ?>')" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            <?php endforeach; else: ?>
                            <tr><td colspan="4" class="text-center">Belum ada data anggota.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            <div class="card-footer p-3 d-flex justify-content-between">
                <?= $pager->links('anggota', 'bootstrap_pagination'); ?>
                <form action="" method="get" id="per-page-form" class="tile-subtitle-p tile-subtitle-footer mb-0 ml-auto">
                    <select name="per_page" id="per_page" class="form-control form-control-sm" onchange="this.form.submit()">
                        <option value="5" <?= ($perPage == 5) ? 'selected' : '' ?>>5 per halaman</option>
                        <option value="10" <?= ($perPage == 10) ? 'selected' : '' ?>>10 per halaman</option>
                        <option value="20" <?= ($perPage == 20) ? 'selected' : '' ?>>20 per halaman</option>
                        <option value="50" <?= ($perPage == 50) ? 'selected' : '' ?>>50 per halaman</option>
                        <option value="100" <?= ($perPage == 100) ? 'selected' : '' ?>>100 per halaman</option>
                    </select>
                    <input type="hidden" name="keyword" value="<?= esc($keyword); ?>">
                </form>
            </div>
            </div>
        </div>
    </section>
</div>