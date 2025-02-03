<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Home extends Model
{
    use HasFactory;
    // Tentukan kolom yang dapat diisi
    protected $fillable = [
        'title', 
        'description', 
        'image_path',
    ];
}
