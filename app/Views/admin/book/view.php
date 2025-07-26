<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= esc($title); ?></h1>
                </div>
                <div class="col-sm-6">
                    <a href="<?= site_url('admin/book'); ?>" class="btn btn-secondary float-sm-right">Kembali ke Daftar</a>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-4">
                        <h3 class="d-inline-block d-sm-none"><?= esc($book['judul']); ?></h3>
                        <div class="col-12">
                            <img src="<?= base_url('uploads/sampul/' . esc($book['sampul'])); ?>" class="product-image" alt="Sampul Buku">
                        </div>
                    </div>
                    <div class="col-12 col-sm-8">
                        <h3 class="my-3"><?= esc($book['judul']); ?></h3>
                        <p><strong>Penulis:</strong> <?= esc($book['penulis']); ?></p>
                        <p><strong>Penerbit:</strong> <?= esc($book['penerbit']); ?></p>
                        <p><strong>Tahun Terbit:</strong> <?= esc($book['tahun_terbit']); ?></p>
                        <hr>
                        <h4>Sinopsis</h4>
                        <p><?= nl2br(esc($book['sinopsis'])); ?></p>
                        <hr>
                        <?php if (!empty($book['file_buku'])): ?>
                            <div class="mt-4">
                                <a href="<?= site_url('admin/book/read/' . $book['id']); ?>" target="_blank" class="btn btn-primary btn-lg btn-flat">
                                    <i class="fas fa-book-reader fa-lg mr-2"></i>
                                    Baca Buku
                                </a>
                            </div>
                        <?php else: ?>
                            <div class="alert alert-warning">File buku digital tidak tersedia.</div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
