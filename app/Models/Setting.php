<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $fillable = [
    'site_name',
    'logo',
    'resume',
    'favicon',
    'preloader',
    'email',
    'website_url',
    'phone',
    'address',
    'city',
    'district',
    'country',
    'postal_code',
    'copyright',
    'map',
];
}
