<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
class Client extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'image',
        'status',
    ]
    ;
     protected $casts = [
        'status' => 'boolean',
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
}
