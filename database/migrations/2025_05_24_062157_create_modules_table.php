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
        Schema::create('modules', function (Blueprint $table) {
            $table->id();
            $table->boolean('service')->default(true);
            $table->boolean('skill')->default(true);
            $table->boolean('project')->default(true);
            $table->boolean('testimonial')->default(true);
            $table->boolean('priceing')->default(true);
            $table->boolean('blog')->default(true);
            $table->boolean('client')->default(true);
            $table->boolean('faq')->default(true);
            $table->boolean('education')->default(true);
            $table->boolean('experience')->default(true);
            $table->boolean('certificate')->default(true);
            $table->boolean('training')->default(true);
            $table->boolean('social')->default(true);
            $table->boolean('resume_download')->default(true);
            $table->boolean('case_study')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modules');
    }
};
