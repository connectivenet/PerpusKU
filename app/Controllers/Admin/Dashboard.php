<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BookModel;
use App\Models\AnggotaModel;
use App\Models\PeminjamanModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        
        // Query untuk buku paling populer (paling sering dipinjam)
        $topBorrowedQuery = $db->table('peminjaman p')
                               ->select('b.judul, COUNT(p.book_id) as total_pinjam')
                               ->join('books b', 'b.id = p.book_id')
                               ->groupBy('p.book_id')
                               ->orderBy('total_pinjam', 'DESC')
                               ->limit(5)
                               ->get();

        $data = [
            'title' => 'Dashboard',
            'total_books' => (new BookModel())->countAllResults(),
            'total_anggota' => (new AnggotaModel())->countAllResults(),
            'sirkulasi_aktif' => (new PeminjamanModel())->where('status', 'dipinjam')->countAllResults(),
            'laporan_sirkulasi' => (new PeminjamanModel())->where('tanggal_kembali', null)->where('DATEDIFF(NOW(), tanggal_harus_kembali) >', 0)->countAllResults(),
            'top_borrowed_books' => $topBorrowedQuery->getResultArray(),
            'newest_books' => (new BookModel())->orderBy('created_at', 'DESC')->limit(5)->find()
        ];

        echo view('admin/partials/head', $data);
        echo view('admin/partials/side_nav');
        echo view('admin/dashboard', $data);
        echo view('admin/partials/footer');
    }
}