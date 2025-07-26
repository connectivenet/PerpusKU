<?php namespace App\Models;
use CodeIgniter\Model;
class AnggotaModel extends Model {
    protected $table = 'anggota';
    protected $allowedFields = ['nama', 'nim', 'jurusan', 'no_telepon'];
}
