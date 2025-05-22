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
            'logo' =>  '01JVVKMGG70WXA0F7XPAKY2K19.png',
            'favicon' =>  '01JVVKMGG9AHTBSF70QNZGMJD0.png',
            'preloader' =>  '01JVVKMGGBRY27C0DT086Q0E2H.png',
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
