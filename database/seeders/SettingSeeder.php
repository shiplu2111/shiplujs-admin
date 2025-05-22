<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $data = [
            'site_name' => 'Shiplu JS',
            'logo' =>  '01JVVJF5C1754QNN5JJWC14294.png',
            'favicon' =>  '01JVVJF5C2ANTJPBAVSMNK8BKK.png',
            'preloader' =>  '01JVVJF5C4NB50A6NZQRZSCKE0.png',
            'email' => 'me@shiplujs.com',
            'website_url' => 'https://shiplujs.com/',
            'phone' => '01711002919',
            'address' => 'Babor road, Block B, Mohammadpur',
            'city' => 'Dhaka',
            'district' => 'Dhaka',
            'country' => 'Bangladesh',
            'postal_code' => '1205',
            'copyright' => '@ Shiplujs 2025 Shiplu. All rights reserved.',

        ];

        // Insert the data into the sites table
        Setting::create($data);
    }
}
