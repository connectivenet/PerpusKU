<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard Administrator</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Info Boxes -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3><?= $total_books; ?></h3>
                            <p>Buku</p>
                        </div>
                        <div class="icon"><i class="fas fa-book"></i></div>
                        <a href="<?= site_url('admin/book'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?= $total_anggota; ?></h3>
                            <p>Anggota</p>
                        </div>
                        <div class="icon"><i class="fas fa-user-plus"></i></div>
                        <a href="<?= site_url('admin/anggota'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?= $sirkulasi_aktif; ?></h3>
                            <p>Sirkulasi yang sedang berjalan</p>
                        </div>
                        <div class="icon"><i class="fas fa-exchange-alt"></i></div>
                        <a href="<?= site_url('admin/sirkulasi'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3><?= $laporan_sirkulasi; ?></h3>
                            <p>Laporan Sirkulasi</p>
                        </div>
                        <div class="icon"><i class="fas fa-chart-pie"></i></div>
                        <a href="<?= site_url('admin/laporan'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- /.row -->

            <!-- Main row -->
            <div class="row">
                <section class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Buku Paling Populer (Sering Dipinjam)</h3>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <?php if (!empty($top_borrowed_books)) : foreach ($top_borrowed_books as $book) : ?>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <?= esc($book['judul']); ?>
                                            <span class="badge bg-primary rounded-pill"><?= $book['total_pinjam']; ?> kali</span>
                                        </li>
                                    <?php endforeach;
                                else : ?>
                                    <li class="list-group-item">Belum ada data peminjaman.</li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </section>
                <section class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">5 Buku Terbaru Ditambahkan</h3>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <?php if (!empty($newest_books)) : foreach ($newest_books as $book) : ?>
                                        <li class="list-group-item">
                                            <?= esc($book['judul']); ?>
                                            <small class="text-muted d-block">oleh <?= esc($book['penulis']); ?></small>
                                        </li>
                                    <?php endforeach;
                                else : ?>
                                    <li class="list-group-item">Belum ada buku.</li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </section>
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->