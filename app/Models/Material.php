<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    // public $timestamps = false; // Menonaktifkan pengaturan otomatis timestamp

    protected $fillable = ['name', 'download_link'];

    protected $dates = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
