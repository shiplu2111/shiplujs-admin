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
        Schema::create('projects', function (Blueprint $table) {
              $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->longText('related_service')->nullable();
            $table->string('image')->nullable(); // main image

            $table->foreignId('category_id')
                ->nullable()
                ->constrained('categories')
                ->onDelete('cascade');

            $table->string('client')->nullable();
            $table->string('location')->nullable();
            $table->string('published_at')->nullable();
            $table->string('project_image_1')->nullable();
            $table->string('project_image_2')->nullable();
            $table->string('project_image_3')->nullable();
            $table->longText('project_summery')->nullable();
            $table->json('tags')->nullable();
            $table->boolean('status')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
