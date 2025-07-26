<!DOCTYPE html><html><head><title><?= esc($title); ?></title>
<link rel="stylesheet" href="<?= base_url('adminlte/dist/css/adminlte.min.css'); ?>">
<style> @media print { .no-print { display: none; } } body { font-size: 12pt; } </style>
</head><body><div class="container mt-5">
<h3 class="text-center">Bukti Peminjaman Buku</h3><hr>
<p><strong>Nama Peminjam:</strong> <?= esc($peminjaman['nama']); ?></p>
<p><strong>NIM:</strong> <?= esc($peminjaman['nim']); ?></p>
<p><strong>Judul Buku:</strong> <?= esc($peminjaman['judul']); ?></p>
<p><strong>Tanggal Pinjam:</strong> <?= date('d F Y', strtotime($peminjaman['tanggal_pinjam'])); ?></p>
<p><strong>Tanggal Harus Kembali:</strong> <?= date('d F Y', strtotime($peminjaman['tanggal_harus_kembali'])); ?></p>
<br><p>Terima kasih telah meminjam buku di Perpustakaan Digital.</p>
<script>window.print();</script>
</div></body></html>
