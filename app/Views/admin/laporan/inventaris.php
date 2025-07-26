<!DOCTYPE html><html><head><title><?= esc($title); ?></title>
<link rel="stylesheet" href="<?= base_url('adminlte/dist/css/adminlte.min.css'); ?>">
<style> @media print { .no-print { display: none; } } </style>
</head><body><div class="container mt-4">
<h2 class="text-center">Laporan Inventaris Buku</h2>
<p class="text-center">Total: <?= count($books); ?> Judul</p>
<hr><button onclick="window.print()" class="btn btn-primary no-print mb-3">Cetak Laporan</button>
<table class="table table-bordered">
    <thead><tr><th>No</th><th>Judul</th><th>Penulis</th><th>Penerbit</th><th>Tahun</th></tr></thead>
    <tbody>
        <?php $no=1; foreach($books as $book): ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= esc($book['judul']); ?></td>
            <td><?= esc($book['penulis']); ?></td>
            <td><?= esc($book['penerbit']); ?></td>
            <td><?= esc($book['tahun_terbit']); ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div></body></html>