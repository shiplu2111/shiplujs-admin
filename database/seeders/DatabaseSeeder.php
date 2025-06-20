<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Closure;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\Console\Helper\ProgressBar;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // admin seeder start here
        $this->command->warn(PHP_EOL . 'Creating admin user...');
        $this->withProgressBar(1, function () {
            return collect([
                User::factory()->create([
                    'name' => 'Shiplujs',
                    'email' => 'me@shiplujs.com',
                    'password' => Hash::make('password'),
                ])
            ]);
        });
        $this->command->info('Admin user created.');
        //admin seeder end here

        // Setting seeder start here
        $this->command->warn(PHP_EOL . 'Creating Setting...');
        $this->withProgressBar(1, function () {
            $this->call([
                SettingSeeder::class,
            ]);
            return collect(); // return empty collection to satisfy merge()
        });
        $this->command->info('Setting created.');
        // Setting seeder end here

        // Email Setup seeder start here
        $this->command->warn(PHP_EOL . 'Creating Email Setting...');
        $this->withProgressBar(1, function () {
            $this->call([
                EmailSettingSeeder::class,
            ]);
            return collect(); // return empty collection to satisfy merge()
        });
        $this->command->info('Email Setting created.');
        // Email Setup seeder end here

         // ModuleSeeder Setup seeder start here
        $this->command->warn(PHP_EOL . 'Creating Module Setting...');
        $this->withProgressBar(1, function () {
            $this->call([
                ModuleSeeder::class,
            ]);
            return collect(); // return empty collection to satisfy merge()
        });
        $this->command->info('Module Setting created.');
        // ModuleSeeder Setup seeder end here

        // ModuleTextSeeder Setup seeder start here
        $this->command->warn(PHP_EOL . 'Creating Module Text Seeder...');
        $this->withProgressBar(1, function () {
            $this->call([
                ModuleTextSeeder::class,
            ]);
            return collect(); // return empty collection to satisfy merge()
        });
        $this->command->info('Module Text Seeder created.');
        // ModuleTextSeeder Setup seeder end here

        // SkillSeeder Setup seeder start here
        $this->command->warn(PHP_EOL . 'Creating Skill Seeder...');
        $this->withProgressBar(1, function () {
            $this->call([
                SkillSeeder::class,
            ]);
            return collect(); // return empty collection to satisfy merge()
        });
        $this->command->info('Skill Seeder created.');
        // SkillSeeder seeder end here

        // CounterSeeder  seeder start here
        $this->command->warn(PHP_EOL . 'Creating Counter Seeder...');
        $this->withProgressBar(1, function () {
            $this->call([
                CounterSeeder::class,
            ]);
            return collect(); // return empty collection to satisfy merge()
        });
        $this->command->info('Counter Seeder created.');
        // CounterSeeder seeder end here
        // HeroSeeder  seeder start here
        $this->command->warn(PHP_EOL . 'Creating Hero Seeder...');
        $this->withProgressBar(1, function () {
            $this->call([
                HeroSeeder::class,
            ]);
            return collect(); // return empty collection to satisfy merge()
        });
        $this->command->info('Hero Seeder created.');
        // HeroSeeder seeder end here

        // CategorySeeder  seeder start here
        $this->command->warn(PHP_EOL . 'Creating Category Seeder...');
        $this->withProgressBar(1, function () {
            $this->call([
                CategorySeeder::class,
            ]);
            return collect(); // return empty collection to satisfy merge()
        });
        $this->command->info('Category Seeder created.');
        // CategorySeeder seeder end here

        // ProjectSeeder  seeder start here
        $this->command->warn(PHP_EOL . 'Creating Project Seeder...');
        $this->withProgressBar(1, function () {
            $this->call([
                ProjectSeeder::class,
            ]);
            return collect(); // return empty collection to satisfy merge()
        });
        $this->command->info('Project Seeder created.');
        // ProjectSeeder seeder end here
        // TestimonialSeeder  seeder start here
        $this->command->warn(PHP_EOL . 'Creating Testimonial Seeder...');
        $this->withProgressBar(1, function () {
            $this->call([
                TestimonialSeeder::class,
            ]);
            return collect(); // return empty collection to satisfy merge()
        });
        $this->command->info('Testimonial Seeder created.');
        // TestimonialSeeder seeder end here




        $this->command->question('Login URL: https://example.com/admin/login');
        $this->command->alert('Email: me@shiplujs.com  &  Password: password');
        $this->command->line('❤️❤️Thank you for using Shiplujs!❤️❤️');


    }







    /**
     * Custom progress bar wrapper for repeatable tasks.
     */
    protected function withProgressBar(int $amount, Closure $task): Collection
    {
        $progressBar = new ProgressBar($this->command->getOutput(), $amount);
        // $progressBar->start();

        $items = new Collection;

        foreach (range(1, $amount) as $i) {
            $items = $items->merge($task());
            $progressBar->advance();
        }

        // $progressBar->finish();
        $this->command->getOutput()->writeln('');

        return $items;
    }
}
