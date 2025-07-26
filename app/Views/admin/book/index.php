<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manajemen Buku</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                        <a href="<?= site_url('admin/book/new'); ?>" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Buku</a>
                        <form action="<?= site_url('admin/book/delete-multiple'); ?>" method="post" id="bulk-delete-form" class="d-inline">
                            <?= csrf_field(); ?>
                            <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Hapus yang Dipilih</button>
                        </form>
                    </div>
                    <div class="card-tools">
                        <form action="" method="get" class="d-inline-block">
                            <div class="input-group">
                                <input type="text" name="keyword" class="form-control" placeholder="Cari judul atau penulis..." value="<?= esc($keyword); ?>">
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
                            <th><input type="checkbox" id="select-all"></th>
                            <th>Sampul</th>
                            <th>Judul</th>
                            <th>Penulis</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($books)): foreach($books as $book): ?>
                        <tr>
                            <td><input type="checkbox" name="book_ids[]" class="book-checkbox" form="bulk-delete-form" value="<?= $book['id']; ?>"></td>
                            <td><img src="<?= base_url('uploads/sampul/' . esc($book['sampul'])); ?>" width="50"></td>
                            <td><?= esc($book['judul']); ?></td>
                            <td><?= esc($book['penulis']); ?></td>
                            <td>
                                <a href="<?= site_url('admin/book/view/' . $book['id']); ?>" class="btn btn-sm btn-info" title="Lihat Detail"><i class="fas fa-eye"></i></a>
                                <a href="<?= site_url('admin/book/edit/' . $book['id']); ?>" class="btn btn-sm btn-warning" title="Edit"><i class="fas fa-edit"></i></a>
                                <button onclick="confirmDelete('<?= site_url('admin/book/delete/' . $book['id']); ?>')" class="btn btn-sm btn-danger" title="Hapus"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <?php endforeach; else: ?>
                        <tr><td colspan="5" class="text-center">Tidak ada buku yang ditemukan.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

			            <div class="card-footer p-3 d-flex justify-content-between">
                <?= $pager->links('buku', 'bootstrap_pagination'); ?>
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
    </section>
</div>