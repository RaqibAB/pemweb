<?php namespace App\Modules\Auth\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;

    // Pastikan semua field ini ada
    protected $allowedFields = ['nama_lengkap', 'email', 'password', 'role'];

    protected $useTimestamps = true; // Jika tabel users punya created_at & updated_at
}