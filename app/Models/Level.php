<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;

    protected $fillable = ['indicator_id', 'level', 'description'];

    public function indicator()
    {
        return $this->belongsTo(Indicator::class);
    }
}
