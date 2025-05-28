<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $fillable = [
       'service',
       'skill',
       'project',
       'testimonial',
       'priceing',
       'blog',
       'client',
       'faq',
       'education',
       'experience',
       'certificate',
       'training',
       'social',
       'resume_download',
    ];
}
