<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('module_texts', function (Blueprint $table) {
            $table->id();
            $table->string('about_title');
            $table->string('about_sub_title')->nullable();
            $table->string('service_title');
            $table->string('service_sub_title')->nullable();
            $table->string('skill_title');
            $table->string('skill_sub_title')->nullable();
            $table->string('portfolio_title');
            $table->string('portfolio_sub_title')->nullable();
            $table->string('testimonial_title');
            $table->string('testimonial_sub_title')->nullable();
            $table->string('price_title');
            $table->string('price_sub_title')->nullable();
            $table->string('blog_title');
            $table->string('blog_sub_title')->nullable();
            $table->string('contact_title');
            $table->string('contact_sub_title')->nullable();
            $table->string('client_title');
            $table->string('client_sub_title')->nullable();
            $table->string('faq_title');
            $table->string('faq_sub_title')->nullable();
            $table->string('education_title');
            $table->string('education_sub_title')->nullable();
            $table->string('experience_title');
            $table->string('experience_sub_title')->nullable();
            $table->string('certificate_title');
            $table->string('certificate_sub_title')->nullable();
            $table->string('training_title');
            $table->string('training_sub_title')->nullable();
            $table->string('social_title');
            $table->string('social_sub_title')->nullable();
            $table->string('casestudy_title');
            $table->string('casestudy_sub_title')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('module_texts');
    }
};
