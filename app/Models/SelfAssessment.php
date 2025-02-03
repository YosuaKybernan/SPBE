<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SelfAssessment extends Model
{
    use HasFactory;

    protected $fillable = [
        'year',
        'internal_policy',
        'strategic_planning',
        'information_technology',
        'organizer',
        'management_implementation',
        'it_audit',
        'administration_services',
        'public_services',
        'created_at',
        'updated_at'
    ];
}
