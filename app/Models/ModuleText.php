<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModuleText extends Model
{
    use HasFactory;
    protected $fillable = [
        'about_title',
        'about_sub_title',
        'about_keyword',
        'service_title',
        'service_sub_title',
        'service_keyword',
        'skill_title',
        'skill_sub_title',
        'skill_keyword',
        'portfolio_title',
        'portfolio_sub_title',
        'portfolio_keyword',
        'testimonial_title',
        'testimonial_sub_title',
        'testimonial_keyword',
        'price_title',
        'price_sub_title',
        'price_keyword',
        'blog_title',
        'blog_sub_title',
        'blog_keyword',
        'contact_title',
        'contact_sub_title',
        'contact_keyword',
        'client_title',
        'client_sub_title',
        'client_keyword',
        'faq_title',
        'faq_sub_title',
        'faq_keyword',
        'education_title',
        'education_sub_title',
        'education_keyword',
        'experience_title',
        'experience_sub_title',
        'experience_keyword',
        'certificate_title',
        'certificate_sub_title',
        'certificate_keyword',
        'training_title',
        'training_sub_title',
        'training_keyword',
        'social_title',
        'social_sub_title',
        'social_keyword',
        'casestudy_title',
        'casestudy_sub_title',
        'casestudy_keyword',
    ];

}

