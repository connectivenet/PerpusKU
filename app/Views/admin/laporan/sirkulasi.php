<!DOCTYPE html><html><head><title><?= esc($title); ?></title>
<link rel="stylesheet" href="<?= base_url('adminlte/dist/css/adminlte.min.css'); ?>">
<style> @media print { .no-print { display: none; } } </style>
</head><body><div class="container mt-4">
<h2 class="text-center">Laporan Keterlambatan Pengembalian Buku</h2>
<p class="text-center">Per Tanggal: <?= date('d F Y'); ?></p>
<hr><button onclick="window.print()" class="btn btn-primary no-print mb-3">Cetak Laporan</button>
<table class="table table-bordered">
    <thead><tr><th>Judul Buku</th><th>Peminjam</th><th>Tgl Pinjam</th><th>Terlambat</th><th>Denda</th></tr></thead>
    <tbody>
        <?php foreach($terlambat as $item): $denda = ($item['lama_pinjam'] - 7) * 10000; ?>
        <tr>
            <td><?= esc($item['judul']); ?></td>
            <td><?= esc($item['nama']); ?></td>
            <td><?= date('d M Y', strtotime($item['tanggal_pinjam'])); ?></td>
            <td><?= ($item['lama_pinjam'] - 7); ?> hari</td>
            <td>Rp <?= number_format($denda, 0, ',', '.'); ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div></body></html>