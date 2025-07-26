<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BookModel;

class Laporan extends BaseController
{
    public function index()
    {
        $data = ['title' => 'Generate Laporan'];
        echo view('admin/partials/head', $data);
        echo view('admin/partials/side_nav');
        echo view('admin/laporan/index', $data);
        echo view('admin/partials/footer');
    }

    public function sirkulasi()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('peminjaman p');
        $builder->select('b.judul, a.nama, p.tanggal_pinjam, DATEDIFF(NOW(), p.tanggal_pinjam) as lama_pinjam');
        $builder->join('books b', 'b.id = p.book_id');
        $builder->join('anggota a', 'a.id = p.anggota_id');
        $builder->where('p.status', 'dipinjam')->where('DATEDIFF(NOW(), p.tanggal_pinjam) >', 7);
        $query = $builder->get();

        $data = ['title' => 'Laporan Sirkulasi Keterlambatan', 'terlambat' => $query->getResultArray()];
        return view('admin/laporan/sirkulasi', $data);
    }

    public function inventaris()
    {
        $model = new BookModel();
        $data = [
            'title' => 'Laporan Inventaris Buku',
            'books' => $model->findAll()
        ];
        return view('admin/laporan/inventaris', $data);
    }
}