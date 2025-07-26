<?php namespace App\Models;
use CodeIgniter\Model;
class PeminjamanModel extends Model {
    protected $table = 'peminjaman';
    protected $allowedFields = ['book_id', 'anggota_id', 'tanggal_pinjam', 'tanggal_harus_kembali', 'tanggal_kembali', 'status'];
}
