<?php namespace App\Models;
use CodeIgniter\Model;

class BookModel extends Model
{
    protected $table = 'books';
    protected $allowedFields = ['judul', 'penulis', 'penerbit', 'tahun_terbit', 'sinopsis', 'sampul', 'file_buku'];
    protected $useTimestamps = true;
}
