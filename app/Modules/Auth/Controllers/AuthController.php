<?php namespace App\Modules\Auth\Controllers;

use CodeIgniter\Controller;
use App\Modules\Auth\Models\UserModel;

class AuthController extends Controller
{
    public function login()
    {
        // Jika sudah login, redirect ke dashboard
        if (session()->get('isLoggedIn')) {
            return redirect()->to('dashboard');
        }

        // Menampilkan halaman login tanpa template utama
        return view('App\Modules\Auth\Views\login');
    }

    public function attemptLogin()
    {
        $session = session();
        $model = new UserModel();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $data = $model->where('email', $email)->first();

        if ($data) {
            $pass = $data['password'];
            // Ganti ini dengan password_verify jika Anda menggunakan hash
            if ($password === $pass) { // Sederhana, tanpa hash untuk contoh
                $ses_data = [
                    'user_id'       => $data['id'],
                    'nama_lengkap'  => $data['nama_lengkap'],
                    'email'         => $data['email'],
                    'role'          => $data['role'],
                    'isLoggedIn'    => TRUE
                ];
                $session->set($ses_data);
                return redirect()->to('dashboard');
            } else {
                $session->setFlashdata('msg', 'Password Salah');
                return redirect()->to('login');
            }
        } else {
            $session->setFlashdata('msg', 'Email Tidak Ditemukan');
            return redirect()->to('login');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('login');
    }
}