<?php namespace App\Modules\Buku\Controllers;

use CodeIgniter\Controller;
use App\Modules\Buku\Models\BukuModel;
use App\Modules\Kategori\Models\KategoriModel; // Kita akan butuh ini

class BukuController extends Controller
{
    protected $bukuModel;
    protected $kategoriModel;

    public function __construct()
    {
        $this->bukuModel = new BukuModel();
        $this->kategoriModel = new KategoriModel(); // Inisialisasi
    }

    public function index()
    {
        $keyword = $this->request->getVar('keyword');
        $buku = $this->bukuModel->getBuku($keyword)->paginate(8, 'buku');

        $data = [
            'title' => 'Data Buku',
            'buku' => $buku,
            'pager' => $this->bukuModel->pager,
            'keyword' => $keyword
        ];
        return view('App\Modules\Buku\Views\index', $data);
    }

    public function new()
    {
        $data = [
            'title' => 'Tambah Buku Baru',
            'kategori' => $this->kategoriModel->findAll(), // Ambil data kategori
            'validation' => \Config\Services::validation()
        ];
        return view('App\Modules\Buku\Views\new', $data);
    }

    public function show($id)
{
    // Gunakan method getBuku() dari model untuk join dengan tabel kategori
    $buku = $this->bukuModel->getBuku()->where('id_buku', $id)->first();

    $data = [
        'title' => 'Detail Buku',
        'buku'  => $buku
    ];

    // Jika buku tidak ditemukan
    if (empty($data['buku'])) {
        throw new \CodeIgniter\Exceptions\PageNotFoundException('Buku dengan ID ' . $id . ' tidak ditemukan.');
    }

    return view('App\Modules\Buku\Views\show', $data);
}

    public function create()
    {
        // Validasi input
        if (!$this->validate([
            'judul_buku' => 'required',
            'id_kategori' => 'required',
            'pengarang' => 'required',
            'jumlah_stok' => 'required|numeric'
        ])) {
            return redirect()->to('/buku/new')->withInput();
        }

        $this->bukuModel->save([
            'judul_buku' => $this->request->getVar('judul_buku'),
            'id_kategori' => $this->request->getVar('id_kategori'),
            'pengarang' => $this->request->getVar('pengarang'),
            'penerbit' => $this->request->getVar('penerbit'),
            'tahun_terbit' => $this->request->getVar('tahun_terbit'),
            'jumlah_stok' => $this->request->getVar('jumlah_stok'),
        ]);

        session()->setFlashdata('pesan', 'Data buku berhasil ditambahkan.');
        return redirect()->to('/buku');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Data Buku',
            'buku' => $this->bukuModel->find($id),
            'kategori' => $this->kategoriModel->findAll(),
            'validation' => \Config\Services::validation()
        ];
        return view('App\Modules\Buku\Views\edit', $data);
    }

    public function update($id)
    {
        $this->bukuModel->save([
            'id_buku' => $id,
            'judul_buku' => $this->request->getVar('judul_buku'),
            'id_kategori' => $this->request->getVar('id_kategori'),
            'pengarang' => $this->request->getVar('pengarang'),
            'penerbit' => $this->request->getVar('penerbit'),
            'tahun_terbit' => $this->request->getVar('tahun_terbit'),
            'jumlah_stok' => $this->request->getVar('jumlah_stok'),
        ]);

        session()->setFlashdata('pesan', 'Data buku berhasil diubah.');
        return redirect()->to('/buku');
    }

    public function delete($id)
    {
        $this->bukuModel->delete($id);
        session()->setFlashdata('pesan', 'Data buku berhasil dihapus.');
        return redirect()->to('/buku');
    }
}