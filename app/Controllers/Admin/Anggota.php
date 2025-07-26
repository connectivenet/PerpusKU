<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AnggotaModel;

class Anggota extends BaseController
{
    public function index()
    {
        $model = new AnggotaModel();
        $keyword = $this->request->getGet('keyword') ?? '';
        // Ambil nilai per_page dari URL, defaultnya 5
        $perPage = $this->request->getGet('per_page') ?? 5;

        $query = $model->orderBy('nama', 'ASC');
        if ($keyword) {
            $query->like('nama', $keyword)->orLike('nim', $keyword);
        }

        $data = [
            'title' => 'Kelola Anggota',
            'anggota' => $query->paginate($perPage, 'anggota'),
            'pager' => $model->pager,
            'keyword' => $keyword,
            'perPage' => $perPage // Kirim nilai per_page ke view
        ];
        echo view('admin/partials/head', $data);
        echo view('admin/partials/side_nav');
        echo view('admin/anggota/index', $data);
        echo view('admin/partials/footer');
    }

    public function new()
    {
        $data = ['title' => 'Tambah Anggota Baru'];
        echo view('admin/partials/head', $data);
        echo view('admin/partials/side_nav');
        echo view('admin/anggota/new', $data);
        echo view('admin/partials/footer');
    }

    public function create()
    {
        $rules = [
            'nama' => 'required',
            'nim' => 'required|is_unique[anggota.nim]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors())->with('validation_error', 'Periksa kembali, ada data yang tidak lengkap atau duplikat.');
        }

        $model = new AnggotaModel();
        $model->save([
            'nama' => $this->request->getPost('nama'),
            'nim' => $this->request->getPost('nim'),
            'jurusan' => $this->request->getPost('jurusan'),
            'no_telepon' => $this->request->getPost('no_telepon'),
        ]);

        return redirect()->to('/admin/anggota')->with('success', 'Anggota baru berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $model = new AnggotaModel();
        $data = [
            'title' => 'Edit Anggota',
            'anggota' => $model->find($id)
        ];
        echo view('admin/partials/head', $data);
        echo view('admin/partials/side_nav');
        echo view('admin/anggota/edit', $data);
        echo view('admin/partials/footer');
    }

    public function update($id)
    {
        $rules = [
            'nama' => 'required',
            'nim' => 'required|is_unique[anggota.nim,id,' . $id . ']'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors())->with('validation_error', 'Periksa kembali, ada data yang tidak lengkap atau duplikat.');
        }

        $model = new AnggotaModel();
        $model->update($id, [
            'nama' => $this->request->getPost('nama'),
            'nim' => $this->request->getPost('nim'),
            'jurusan' => $this->request->getPost('jurusan'),
            'no_telepon' => $this->request->getPost('no_telepon'),
        ]);

        return redirect()->to('/admin/anggota')->with('success', 'Data anggota berhasil diperbarui.');
    }

    public function delete($id)
    {
        $model = new AnggotaModel();
        $model->delete($id);
        return redirect()->to('/admin/anggota')->with('success', 'Anggota berhasil dihapus.');
    }
}
