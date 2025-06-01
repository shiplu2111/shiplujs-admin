<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'image',
        'status',
    ];
    protected $casts = [
        'status' => 'boolean',
    ];
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($project) {
            // Delete single image fields
            foreach ([
                'image',
            ] as $field) {
                if ($project->$field && Storage::disk('public')->exists($project->$field)) {
                    Storage::disk('public')->delete($project->$field);
                }
            }

        });
    }
}
