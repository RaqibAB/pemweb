<?php namespace App\Modules\Dashboard\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\Database\Config;

class DashboardController extends Controller
{
    public function index()
    {
        $db = Config::connect(); // Menggunakan query builder

        $data = [
            'title' => 'Dashboard',
            'total_buku' => $db->table('buku')->countAllResults(),
            'total_kategori' => $db->table('kategori')->countAllResults(),
            'total_anggota' => $db->table('anggota')->countAllResults(),
            'total_pinjam' => $db->table('transaksi')->where('status', 'Dipinjam')->countAllResults()
        ];
        return view('App\Modules\Dashboard\Views\index', $data);
    }
}