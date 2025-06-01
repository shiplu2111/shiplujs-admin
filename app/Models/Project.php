<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\SeoMetadata;
use Illuminate\Support\Facades\Storage;
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
        'status' => 'boolean'
    ];

     public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    public function seoMetadata()
    {
        return $this->hasOne(SeoMetadata::class);
    }
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($project) {
            // Delete single image fields
            foreach ([
                'image',
                'project_image_1',
                'project_image_2',
                'project_image_3'
            ] as $field) {
                if ($project->$field && Storage::disk('public')->exists($project->$field)) {
                    Storage::disk('public')->delete($project->$field);
                }
            }

            // Delete SEO images if relation exists
            if ($project->seoMetadata) {
                foreach (['og_image', 'twitter_image'] as $seoImage) {
                    if ($project->seoMetadata->$seoImage && Storage::disk('public')->exists($project->seoMetadata->$seoImage)) {
                        Storage::disk('public')->delete($project->seoMetadata->$seoImage);
                    }
                }

                // Optional: delete the SEO metadata row too
                $project->seoMetadata->delete();
            }
        });
    }
}
