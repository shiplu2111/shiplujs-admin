<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Testimonial;
use App\Models\Project;
use Illuminate\Support\Str;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projectId = Project::latest()->value('id');

        Testimonial::create([
            'name' => 'John Doe',
            'image' => null, // Add image path if available
            'company' => 'Acme Corp',
            'designation' => 'CEO',
            'testimonial' => 'This project exceeded our expectations and delivered outstanding results.',
            'project_id' => $projectId,
            'status' => true,
        ]);

        Testimonial::create([
            'name' => 'Jane Smith',
            'image' => null,
            'company' => 'Tech Solutions',
            'designation' => 'CTO',
            'testimonial' => 'Professional, timely, and high-quality work. Highly recommended!',
            'project_id' => $projectId,
            'status' => true,
        ]);
    }
}
