<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
class Certificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'institute_name',
        'certificate_image',
        'institute_address',
        'passing_year',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

      protected static function boot()
    {
        parent::boot();

        static::deleting(function ($item) {
            // Delete single image fields
            foreach ([
                'certificate_image',
            ] as $field) {
                if ($item->$field && Storage::disk('public')->exists($item->$field)) {
                    Storage::disk('public')->delete($item->$field);
                }
            }

        });
    }
}
