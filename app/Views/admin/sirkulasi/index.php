<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1>Sirkulasi Peminjaman</h1></div>
                <div class="col-sm-6">
                    <a href="<?= site_url('admin/sirkulasi/new'); ?>" class="btn btn-primary float-sm-right"><i class="fas fa-plus"></i> Tambah Peminjaman</a>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Riwayat Peminjaman Buku</h3></div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead><tr><th>Judul Buku</th><th>Peminjam</th><th>Jatuh Tempo</th><th>Status</th><th>Aksi</th></tr></thead>
                    <tbody>
                        <?php if (!empty($peminjaman)): foreach($peminjaman as $item): ?>
                        <tr>
                            <td><?= esc($item['judul']); ?></td>
                            <td><?= esc($item['nama']); ?></td>
                            <td><?= date('d M Y', strtotime($item['tanggal_harus_kembali'])); ?></td>
                            <td>
                                <?php if ($item['status'] == 'dikembalikan'): ?>
                                    <span class="badge badge-secondary">Sudah Kembali</span>
                                <?php elseif ($item['terlambat'] > 0): 
                                    $denda = $item['terlambat'] * 10000;
                                ?>
                                    <span class="badge badge-danger">Terlambat <?= $item['terlambat']; ?> hari</span>
                                    <span class="badge badge-warning">Denda: Rp <?= number_format($denda); ?></span>
                                <?php else: ?>
                                    <span class="badge badge-success">Dipinjam</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="<?= site_url('admin/sirkulasi/print/' . $item['id']); ?>" target="_blank" class="btn btn-sm btn-info" title="Cetak Bukti"><i class="fas fa-print"></i></a>
                                <?php if ($item['status'] == 'dipinjam'): ?>
                                    <button onclick="confirmReturn('<?= site_url('admin/sirkulasi/return/' . $item['id']); ?>')" class="btn btn-sm btn-success" title="Tandai Sudah Kembali"><i class="fas fa-check"></i></button>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; else: ?>
                        <tr><td colspan="5" class="text-center">Belum ada riwayat peminjaman.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>