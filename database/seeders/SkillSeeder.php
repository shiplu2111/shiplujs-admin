<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Skill;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
        {
            $skills = [

                ['name' => 'React', 'percentage' => '75'],
                ['name' => 'Vue', 'percentage' => '70'],
                ['name' => 'Laravel', 'percentage' => '80'],
                ['name' => 'Tailwind CSS', 'percentage' => '90'],
                ['name' => 'Bootstrap', 'percentage' => '88'],
                ['name' => 'JavaScript', 'percentage' => '85'],
                ['name' => 'HTML & CSS', 'percentage' => '95'],
                ['name' => 'Node.js', 'percentage' => '78'],
                ['name' => 'PHP', 'percentage' => '70'],
                ['name' => 'MySQL', 'percentage' => '80'],
                ['name' => 'MongoDB', 'percentage' => '75'],
                ['name' => 'Git & GitHub', 'percentage' => '90'],
            ];

            foreach ($skills as $skill) {
                Skill::create([
                    'name' => $skill['name'],
                    'percentage' => $skill['percentage'],
                    'status' => true,
                ]);
            }
        }
}
