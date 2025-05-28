<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'description',
        'related_service',
        'image',
        'category_id',
        'client',
        'location',
        'published_at',
        'project_image_1',
        'project_image_2',
        'project_image_3',
        'project_summery',
        'tags',
        'status'
    ];

     protected $casts = [
        'tags' => 'array',
        'related_service' => 'array',
    ];

     public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
