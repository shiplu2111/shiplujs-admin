<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'sub_title',
        'price',
        'currency_symbol',
        'duration',
        'description',
        'service_include',
        'service_not_include',
        'status',
    ];
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

    protected $casts = [
        'service_include' => 'array',
        'service_not_include' => 'array',
        'status' => 'boolean',
    ];
}

