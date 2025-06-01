<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experiance extends Model
{
    use HasFactory;

        protected $fillable = [
        'company_name',
        'position',
        'start_date',
        'end_date',
        'website_url',
        'description',
        'address',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];
}
