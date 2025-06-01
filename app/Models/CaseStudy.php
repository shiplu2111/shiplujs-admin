<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class CaseStudy extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'client_name',
        'industry',
        'location',
        'project_duration',
        'technologies',
        'overview',
        'problem',
        'solution',
        'results',
        'cover_image',
        'project_url',
        'is_featured',
        'status',
    ];

    protected $casts = [
        'technologies' => 'array',
        'is_featured' => 'boolean',
        'status' => 'boolean',
    ];


    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($item) {
            // Delete single image fields
            foreach ([
                'cover_image',
            ] as $field) {
                if ($item->$field && Storage::disk('public')->exists($item->$field)) {
                    Storage::disk('public')->delete($item->$field);
                }
            }

        });
    }
}
