<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PeminjamanModel;
use App\Models\AnggotaModel;
use App\Models\BookModel;

class Sirkulasi extends BaseController
{
public function index()
{
    $db = \Config\Database::connect();
    $builder = $db->table('peminjaman p');
    $builder->select('p.id, b.judul, a.nama, p.tanggal_pinjam, p.tanggal_harus_kembali, p.status, DATEDIFF(NOW(), p.tanggal_harus_kembali) as terlambat');
    $builder->join('books b', 'b.id = p.book_id');
    $builder->join('anggota a', 'a.id = p.anggota_id');
    $builder->orderBy('p.status', 'ASC')->orderBy('p.tanggal_pinjam', 'DESC'); // Urutkan berdasarkan status
    $query = $builder->get();

    $data = [
        'title' => 'Sirkulasi Peminjaman',
        'peminjaman' => $query->getResultArray()
    ];

    echo view('admin/partials/head', $data);
    echo view('admin/partials/side_nav');
    echo view('admin/sirkulasi/index', $data);
    echo view('admin/partials/footer');
}

    public function new()
    {
        $data = [
            'title' => 'Tambah Transaksi Peminjaman',
            'anggota' => (new AnggotaModel())->findAll(),
            'books' => (new BookModel())->findAll() // Diambil semua buku untuk contoh ini
        ];
        echo view('admin/partials/head', $data);
        echo view('admin/partials/side_nav');
        echo view('admin/sirkulasi/new', $data);
        echo view('admin/partials/footer');
    }

    public function create()
    {
        $rules = [
            'anggota_id' => 'required',
            'book_id' => 'required',
            'tanggal_pinjam' => 'required|valid_date',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation_error', 'Semua kolom wajib diisi.');
        }

        $model = new PeminjamanModel();
        $tgl_pinjam = $this->request->getPost('tanggal_pinjam');
        // Jatuh tempo adalah 7 hari dari tanggal pinjam
        $tgl_harus_kembali = date('Y-m-d', strtotime($tgl_pinjam . ' +7 days'));

        $model->save([
            'anggota_id' => $this->request->getPost('anggota_id'),
            'book_id' => $this->request->getPost('book_id'),
            'tanggal_pinjam' => $tgl_pinjam,
            'tanggal_harus_kembali' => $tgl_harus_kembali,
            'status' => 'dipinjam'
        ]);

        return redirect()->to('/admin/sirkulasi')->with('success', 'Transaksi peminjaman berhasil ditambahkan.');
    }

    public function markAsReturned($id)
    {
        $model = new PeminjamanModel();
        $model->update($id, [
            'status' => 'dikembalikan',
            'tanggal_kembali' => date('Y-m-d')
        ]);
        return redirect()->to('/admin/sirkulasi')->with('success', 'Buku telah ditandai sebagai dikembalikan.');
    }

    public function printReceipt($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('peminjaman p');
        $builder->select('b.judul, a.nama, a.nim, p.tanggal_pinjam, p.tanggal_harus_kembali');
        $builder->join('books b', 'b.id = p.book_id');
        $builder->join('anggota a', 'a.id = p.anggota_id');
        $builder->where('p.id', $id);
        $query = $builder->get();

        $data = [
            'title' => 'Bukti Peminjaman',
            'peminjaman' => $query->getRowArray()
        ];
        return view('admin/sirkulasi/receipt', $data);
    }
}
