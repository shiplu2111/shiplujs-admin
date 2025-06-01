<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Project;
use Illuminate\Support\Facades\Storage;
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
 protected $casts = [
        'status' => 'boolean',
    ];
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($testimonial) {
            // Delete single image fields
            foreach ([
                'image',
            ] as $field) {
                if ($testimonial->$field && Storage::disk('public')->exists($testimonial->$field)) {
                    Storage::disk('public')->delete($testimonial->$field);
                }
            }


        });
    }
}
