<?php

namespace App\Modules\User\Controllers;

use CodeIgniter\Controller;
use App\Modules\Auth\Models\UserModel; // Kita panggil UserModel dari modul Auth

class UserController extends Controller
{
    protected $userModel;

    public function __construct()
    {
        // Gunakan model yang sudah ada
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Manajemen User',
            'users' => $this->userModel->findAll()
        ];
        return view('App\Modules\User\Views\index', $data);
    }

    public function new()
    {
        $data = [
            'title' => 'Tambah User Baru',
            'validation' => \Config\Services::validation()
        ];
        return view('App\Modules\User\Views\new', $data);
    }

    public function create()
    {
        if (
            !$this->validate([
                'nama_lengkap' => 'required',
                'email' => 'required|valid_email|is_unique[users.email]',
                'password' => 'required|min_length[6]',
                'role' => 'required'
            ])
        ) {
            return redirect()->to(site_url('user/new'))->withInput();
        }

        $this->userModel->save([
            'nama_lengkap' => $this->request->getVar('nama_lengkap'),
            'email' => $this->request->getVar('email'),
            'password' => $this->request->getVar('password'), 
            'role' => $this->request->getVar('role'),
        ]);

        session()->setFlashdata('pesan', 'User baru berhasil ditambahkan.');
        return redirect()->to(site_url('user'));
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Data User',
            'user' => $this->userModel->find($id),
            'validation' => \Config\Services::validation()
        ];
        return view('App\Modules\User\Views\edit', $data);
    }

    public function update($id)
    {
        // Aturan validasi email: harus unik, tapi abaikan email milik user yg sedang diedit
        $emailRule = 'required|valid_email|is_unique[users.email,id,' . $id . ']';

        if (
            !$this->validate([
                'nama_lengkap' => 'required',
                'email' => $emailRule,
                'role' => 'required'
            ])
        ) {
            return redirect()->to(site_url('user/edit/' . $id))->withInput();
        }

        $dataToUpdate = [
            'id' => $id,
            'nama_lengkap' => $this->request->getVar('nama_lengkap'),
            'email' => $this->request->getVar('email'),
            'role' => $this->request->getVar('role'),
        ];

        // Cek apakah admin mengisi password baru
        $password = $this->request->getVar('password');
        if ($password) {
            // Jika ada password baru, hash dan tambahkan ke data update
            $dataToUpdate['password'] = password_hash($password, PASSWORD_DEFAULT);
        }
        // Jika password kosong, field password tidak akan diupdate

        $this->userModel->save($dataToUpdate);

        session()->setFlashdata('pesan', 'Data user berhasil diubah.');
        return redirect()->to(site_url('user'));
    }

    public function delete($id)
    {
        // Mencegah admin menghapus akunnya sendiri
        if ($id == session()->get('user_id')) {
            session()->setFlashdata('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
            return redirect()->to(site_url('user'));
        }

        $this->userModel->delete($id);
        session()->setFlashdata('pesan', 'Data user berhasil dihapus.');
        return redirect()->to(site_url('user'));
    }
}