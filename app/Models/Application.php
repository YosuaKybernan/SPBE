<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $table = 'applications';

    protected $fillable = [
        'nama_aplikasi',
        'skpd_pemilik',
        'jenis_layanan',
        'spesifikasi_layanan',
        'alamat_website',
        'nama_pic',
        'kontak_wa',
    ];
}
