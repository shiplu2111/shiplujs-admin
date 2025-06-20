<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Counter;

class CounterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
        {
            $counters = [
                ['value' => '13', 'value_type' => '', 'text' => 'Years Of Experience'],
                ['value' => '8', 'value_type' => 'k+', 'text' => 'Project Complete'],
                ['value' => '99', 'value_type' => '+', 'text' => 'Client Satisfactions'],
            ];

            foreach ($counters as $counter) {
                Counter::create([
                    'text' => $counter['text'],
                    'value' => $counter['value'],
                    'value_type' => $counter['value_type'],
                    'status' => true,
                ]);
            }
        }
}
