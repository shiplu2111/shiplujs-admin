<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'icon',
        'short_description',
        'long_description',
        'key_requirements',
        'key_benefits',
        'key_features',
        'slug',
        'image',
        'status',
    ];
}
