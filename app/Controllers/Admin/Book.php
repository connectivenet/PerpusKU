<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BookModel;

class Book extends BaseController
{
    /**
     * Menampilkan daftar buku dengan pencarian dan pagination.
     */
    public function index()
    {
        $model = new BookModel();
        $keyword = $this->request->getGet('keyword') ?? '';
        $perPage = $this->request->getGet('per_page') ?? 5;

        $query = $model->orderBy('judul', 'ASC');
        if ($keyword) {
            $query->like('judul', $keyword)->orLike('penulis', $keyword);
        }

        $data = [
            'title' => 'Manajemen Buku',
            'books' => $query->paginate($perPage, 'buku'), // Koma ditambahkan di sini
            'pager' => $model->pager,
            'keyword' => $keyword,
            'perPage' => $perPage
        ];

        echo view('admin/partials/head', $data);
        echo view('admin/partials/side_nav');
        echo view('admin/book/index', $data);
        echo view('admin/partials/footer');
    }

    /**
     * Menampilkan form tambah buku baru.
     */
    public function new()
    {
        $data = [
            'title' => 'Tambah Buku Baru',
        ];
        echo view('admin/partials/head', $data);
        echo view('admin/partials/side_nav');
        echo view('admin/book/new', $data);
        echo view('admin/partials/footer');
    }

    /**
     * Memproses penyimpanan buku baru.
     */
    public function create()
    {
        $rules = [
            'judul' => 'required',
            'penulis' => 'required',
            'sampul' => 'max_size[sampul,2048]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png,image/gif]',
            'file_buku' => 'uploaded[file_buku]|max_size[file_buku,10240]|ext_in[file_buku,pdf,doc,docx,xls,xlsx,ppt,pptx]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors())->with('validation_error', 'Periksa kembali, ada data yang tidak lengkap atau tidak valid.');
        }

        $model = new BookModel();
        $sampulFile = $this->request->getFile('sampul');
        $bukuFile = $this->request->getFile('file_buku');

        $namaSampul = 'default.jpg';
        if ($sampulFile->isValid() && !$sampulFile->hasMoved()) {
            $namaSampul = $sampulFile->getRandomName();
            $sampulFile->move('uploads/sampul', $namaSampul);
        }

        $namaBuku = null;
        if ($bukuFile->isValid() && !$bukuFile->hasMoved()) {
            $namaBuku = $bukuFile->getRandomName();
            $bukuFile->move('uploads/buku', $namaBuku);
        }

        $model->save([
            'judul' => $this->request->getPost('judul'),
            'penulis' => $this->request->getPost('penulis'),
            'penerbit' => $this->request->getPost('penerbit'),
            'tahun_terbit' => $this->request->getPost('tahun_terbit'),
            'sinopsis' => $this->request->getPost('sinopsis'),
            'sampul' => $namaSampul,
            'file_buku' => $namaBuku,
        ]);

        return redirect()->to('/admin/book')->with('success', 'Buku berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit buku.
     */
    public function edit($id)
    {
        $model = new BookModel();
        $data = [
            'title' => 'Edit Buku',
            'book' => $model->find($id)
        ];
        echo view('admin/partials/head', $data);
        echo view('admin/partials/side_nav');
        echo view('admin/book/edit', $data);
        echo view('admin/partials/footer');
    }

    /**
     * Memproses pembaruan data buku.
     */
    public function update($id)
    {
        $rules = [
            'judul' => 'required',
            'penulis' => 'required',
            'sampul' => 'max_size[sampul,2048]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png,image/gif]',
            'file_buku' => 'max_size[file_buku,10240]|ext_in[file_buku,pdf,doc,docx,xls,xlsx,ppt,pptx]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors())->with('validation_error', 'Periksa kembali, ada data yang tidak lengkap atau tidak valid.');
        }

        $model = new BookModel();
        $oldBook = $model->find($id);

        $sampulFile = $this->request->getFile('sampul');
        $bukuFile = $this->request->getFile('file_buku');

        $namaSampul = $oldBook['sampul'];
        if ($sampulFile->isValid() && !$sampulFile->hasMoved()) {
            if ($oldBook['sampul'] != 'default.jpg' && file_exists('uploads/sampul/' . $oldBook['sampul'])) {
                unlink('uploads/sampul/' . $oldBook['sampul']);
            }
            $namaSampul = $sampulFile->getRandomName();
            $sampulFile->move('uploads/sampul', $namaSampul);
        }

        $namaBuku = $oldBook['file_buku'];
        if ($bukuFile->isValid() && !$bukuFile->hasMoved()) {
            if ($oldBook['file_buku'] && file_exists('uploads/buku/' . $oldBook['file_buku'])) {
                unlink('uploads/buku/' . $oldBook['file_buku']);
            }
            $namaBuku = $bukuFile->getRandomName();
            $bukuFile->move('uploads/buku', $namaBuku);
        }

        $model->update($id, [
            'judul' => $this->request->getPost('judul'),
            'penulis' => $this->request->getPost('penulis'),
            'penerbit' => $this->request->getPost('penerbit'),
            'tahun_terbit' => $this->request->getPost('tahun_terbit'),
            'sinopsis' => $this->request->getPost('sinopsis'),
            'sampul' => $namaSampul,
            'file_buku' => $namaBuku,
        ]);

        return redirect()->to('/admin/book')->with('success', 'Buku berhasil diperbarui.');
    }

    /**
     * Menghapus satu buku.
     */
    public function delete($id)
    {
        $model = new BookModel();
        $book = $model->find($id);

        if ($book) {
            if ($book['sampul'] != 'default.jpg' && file_exists('uploads/sampul/' . $book['sampul'])) {
                unlink('uploads/sampul/' . $book['sampul']);
            }
            if ($book['file_buku'] && file_exists('uploads/buku/' . $book['file_buku'])) {
                unlink('uploads/buku/' . $book['file_buku']);
            }
            $model->delete($id);
            return redirect()->to('/admin/book')->with('success', 'Buku berhasil dihapus.');
        }
        return redirect()->to('/admin/book')->with('error', 'Buku tidak ditemukan.');
    }

    /**
     * Menghapus beberapa buku sekaligus.
     */
    public function deleteMultiple()
    {
        $model = new BookModel();
        $bookIds = $this->request->getPost('book_ids');

        if (!empty($bookIds)) {
            foreach ($bookIds as $id) {
                $book = $model->find($id);
                if ($book) {
                    if ($book['sampul'] != 'default.jpg' && file_exists('uploads/sampul/' . $book['sampul'])) {
                        unlink('uploads/sampul/' . $book['sampul']);
                    }
                    if ($book['file_buku'] && file_exists('uploads/buku/' . $book['file_buku'])) {
                        unlink('uploads/buku/' . $book['file_buku']);
                    }
                }
            }
            $model->delete($bookIds);
            return redirect()->to('/admin/book')->with('success', 'Buku yang dipilih berhasil dihapus.');
        }

        return redirect()->to('/admin/book')->with('error', 'Tidak ada buku yang dipilih untuk dihapus.');
    }

    /**
     * Menampilkan halaman detail buku.
     */
    public function view($id)
    {
        $model = new BookModel();
        $book = $model->find($id);

        if (empty($book)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Buku tidak ditemukan.');
        }

        $data = [
            'title' => 'Detail Buku: ' . $book['judul'],
            'book' => $book
        ];

        echo view('admin/partials/head', $data);
        echo view('admin/partials/side_nav');
        echo view('admin/book/view', $data);
        echo view('admin/partials/footer');
    }

    /**
     * Mengarahkan ke file buku untuk dibaca/diunduh.
     */
    public function read($id)
    {
        $model = new BookModel();
        $book = $model->find($id);

        if (empty($book) || empty($book['file_buku'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('File buku tidak ditemukan.');
        }

        return redirect()->to(base_url('uploads/buku/' . $book['file_buku']));
    }
}