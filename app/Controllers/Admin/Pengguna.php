<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Pengguna extends BaseController
{
    public function index()
    {
        $model = new UserModel();
        $data = [
            'title' => 'Pengguna Sistem',
            'users' => $model->findAll()
        ];
        echo view('admin/partials/head', $data);
        echo view('admin/partials/side_nav');
        echo view('admin/pengguna/index', $data);
        echo view('admin/partials/footer');
    }

    public function new()
    {
        $data = ['title' => 'Tambah Pengguna Baru'];
        echo view('admin/partials/head', $data);
        echo view('admin/partials/side_nav');
        echo view('admin/pengguna/new', $data);
        echo view('admin/partials/footer');
    }

    public function create()
    {
        $rules = [
            'nama' => 'required',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[8]',
            'role' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors())->with('validation_error', 'Periksa kembali data input.');
        }

        $model = new UserModel();
        $model->save([
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role' => $this->request->getPost('role'),
        ]);

        return redirect()->to('/admin/pengguna')->with('success', 'Pengguna baru berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $model = new UserModel();
        $data = [
            'title' => 'Edit Pengguna',
            'user' => $model->find($id)
        ];
        echo view('admin/partials/head', $data);
        echo view('admin/partials/side_nav');
        echo view('admin/pengguna/edit', $data);
        echo view('admin/partials/footer');
    }

    public function update($id)
    {
        $rules = [
            'nama' => 'required',
            'email' => 'required|valid_email|is_unique[users.email,id,' . $id . ']',
            'role' => 'required'
        ];

        // Validasi password hanya jika diisi
        if ($this->request->getPost('password')) {
            $rules['password'] = 'min_length[8]';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors())->with('validation_error', 'Periksa kembali data input.');
        }

        $model = new UserModel();
        $data = [
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'role' => $this->request->getPost('role'),
        ];

        // Update password hanya jika diisi
        if ($this->request->getPost('password')) {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        $model->update($id, $data);
        return redirect()->to('/admin/pengguna')->with('success', 'Data pengguna berhasil diperbarui.');
    }

    public function delete($id)
    {
        // Mencegah pengguna menghapus akunnya sendiri
        if ($id == session()->get('user_id')) {
            return redirect()->to('/admin/pengguna')->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $model = new UserModel();
        $model->delete($id);
        return redirect()->to('/admin/pengguna')->with('success', 'Pengguna berhasil dihapus.');
    }
}