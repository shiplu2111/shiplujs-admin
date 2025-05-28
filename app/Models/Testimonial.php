<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Project;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'company',
        'designation',
        'testimonial',
        'project_id',
        'status',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
