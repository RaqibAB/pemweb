<?php namespace App\Modules\Buku\Models;

use CodeIgniter\Model;

class BukuModel extends Model
{
    protected $table = 'buku';
    protected $primaryKey = 'id_buku';
    // Sesuaikan allowedFields
    protected $allowedFields = ['judul_buku', 'id_kategori', 'pengarang', 'penerbit', 'tahun_terbit', 'jumlah_stok', 'cover_buku'];

    public function getBuku($keyword = null)
    {
        $builder = $this->table('buku');
        $builder->join('kategori', 'kategori.id_kategori = buku.id_kategori');
        if ($keyword) {
            $builder->like('judul_buku', $keyword);
            $builder->orLike('pengarang', $keyword);
            $builder->orLike('penerbit', $keyword);
        }
        return $builder;
    }
}