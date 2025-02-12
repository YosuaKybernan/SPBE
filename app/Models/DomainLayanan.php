<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DomainLayanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'aspect_name',
        'indicators',
    ];

    protected $casts = [
        'indicators' => 'array', // Casting JSON ke array
    ];
}
