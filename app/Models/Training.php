<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;
        protected $fillable = [
        'title',
        'institute',
        'start_date',
        'end_date',
        'description',
        'website_url',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];
}
