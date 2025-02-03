<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    // public $timestamps = false; // Menonaktifkan pengaturan otomatis timestamp

    protected $fillable = [
        'name', 'download_link', 'created_at', 'modified_at'
    ];

    protected $dates = [
        'created_at', 'modified_at'
    ];
}
