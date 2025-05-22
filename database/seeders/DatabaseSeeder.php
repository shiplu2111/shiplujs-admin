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
        $this->command->warn(PHP_EOL . 'Creating admin user...');

        $this->withProgressBar(1, function () {
            return collect([
                User::factory()->create([
                    'name' => 'Demo User',
                    'email' => 'me@shiplujs.com',
                    'password' => Hash::make('password'),
                ])
            ]);
        });

        $this->command->info('Admin user created.');

        $this->command->warn(PHP_EOL . 'Creating Setting...');

        $this->withProgressBar(1, function () {
            $this->call([
                SettingSeeder::class,
            ]);

            return collect(); // return empty collection to satisfy merge()
        });

        $this->command->info('Setting created.');
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
