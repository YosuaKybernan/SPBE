<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indicator extends Model
{
    use HasFactory;

    protected $fillable = ['aspect_id', 'url', 'label', 'description', 'assessment', 'support'];

    public function aspect()
    {
        return $this->belongsTo(Aspect::class);
    }

    public function levels()
    {
        return $this->hasMany(Level::class);
    }
}
