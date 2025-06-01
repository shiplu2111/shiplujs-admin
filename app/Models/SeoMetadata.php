<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Project;
class SeoMetadata extends Model
{
    use HasFactory;
 protected $fillable = [
        'project_id',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'og_title',
        'og_description',
        'og_image',
        'twitter_title',
        'twitter_description',
        'twitter_image',
    ];
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
