<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DashboardAssessment extends Model
{
    use HasFactory;

    protected $table = 'dashboard_assessments';

    protected $fillable = [
        'form_id',
        'form_name',
        'year',
        'description',
        'created_at',
        'updated_at'
    ];
}
