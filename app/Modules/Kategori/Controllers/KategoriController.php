<?php namespace App\Modules\Kategori\Controllers;

use CodeIgniter\Controller;
use App\Modules\Kategori\Models\KategoriModel;
use CodeIgniter\Database\Exceptions\DatabaseException;

class KategoriController extends Controller
{
    protected $kategoriModel;

    public function __construct()
    {
        $this->kategoriModel = new KategoriModel();
    }

    // Menampilkan daftar semua kategori
    public function index()
{
    $keyword = $this->request->getVar('keyword');

    if ($keyword) {
        $kategoriQuery = $this->kategoriModel->like('nama_kategori', $keyword);
    } else {
        $kategoriQuery = $this->kategoriModel;
    }

    // Terapkan paginasi dengan 8 data per halaman
    $kategori = $kategoriQuery->paginate(8, 'kategori');

    $data = [
        'title'    => 'Data Kategori Buku',
        'kategori' => $kategori,
        'pager'    => $this->kategoriModel->pager,
        'keyword'  => $keyword,
        // Menghitung nomor urut agar berlanjut di halaman berikutnya
        'nomor'    => ($this->request->getVar('page_kategori') ? $this->request->getVar('page_kategori') : 1 - 1) * 8 + 1
    ];

    return view('App\Modules\Kategori\Views\index', $data);
}

    // Menampilkan form tambah kategori
    public function new()
    {
        $data = [
            'title' => 'Tambah Kategori Baru',
            'validation' => \Config\Services::validation()
        ];
        return view('App\Modules\Kategori\Views\new', $data);
    }

    // Menyimpan data kategori baru
    public function create()
    {
        // Validasi input
        if (!$this->validate([
            'nama_kategori' => 'required|is_unique[kategori.nama_kategori]'
        ])) {
            return redirect()->to('/kategori/new')->withInput();
        }

        $this->kategoriModel->save([
            'nama_kategori' => $this->request->getVar('nama_kategori'),
        ]);

        session()->setFlashdata('pesan', 'Kategori baru berhasil ditambahkan.');
        return redirect()->to('/kategori');
    }

    // Menampilkan form edit kategori
    public function edit($id)
    {
        $data = [
            'title' => 'Edit Data Kategori',
            'kategori' => $this->kategoriModel->find($id),
            'validation' => \Config\Services::validation()
        ];
        return view('App\Modules\Kategori\Views\edit', $data);
    }

    // Mengupdate data kategori
    public function update($id)
    {
        $this->kategoriModel->save([
            'id_kategori' => $id,
            'nama_kategori' => $this->request->getVar('nama_kategori'),
        ]);

        session()->setFlashdata('pesan', 'Data kategori berhasil diubah.');
        return redirect()->to('/kategori');
    }

    // Menghapus data kategori
    public function delete($id)
    {
        try {
            $this->kategoriModel->delete($id);
            session()->setFlashdata('pesan', 'Data kategori berhasil dihapus.');
        } catch (DatabaseException $e) {
            // Tangani error jika kategori masih digunakan oleh buku
            session()->setFlashdata('error', 'Gagal menghapus! Kategori ini masih digunakan oleh data buku.');
        }
        
        return redirect()->to('/kategori');
    }
}   