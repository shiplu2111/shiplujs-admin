<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Module;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
               $data = [
                'service'=> true,
                'skill'=> true,
                'project'=> true,
                'testimonial'=> true,
                'priceing'=> true,
                'blog'=> true,
                'client'=> true,
                'faq'=> true,
                'education'=> true,
                'experience'=> true,
                'certificate'=> true,
                'training'=> true,
                'social'=> true,
                'resume_download'=> false,
        ];

        // Insert the data into the sites table
        Module::create($data);
    }
}
