<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
        {
        $titles = [
            'Design',
            'Branding',
            'Marketing',
            'Development',
            'Mobile Apps',
            'Graphics',
        ];

        foreach ($titles as $title) {
            Category::create([
                'title' => $title,
                'slug' => Str::slug($title),
                'status' => true,
                'image' => null, // Set image path if needed
            ]);
        }
    }
}
