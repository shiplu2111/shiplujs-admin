<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Hero;

class HeroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         Hero::create([
            'title' => 'Hello, I’m',
            'name' => 'E.H Shiplu',
            'designation' => 'Web Developer',
            'description' => 'We denounce with righteous indignation dislike demoralized by the charms of pleasure',
            'button_text' => 'Hire Me',
            'image' => null, // Add image path if you have one
        ]);
    }
}
