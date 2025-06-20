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
            'logo' =>  '01JXHNRX2JFGWBQAR17TAK12E3.png',
            'favicon' =>  '01JXHNRX37JNJ6YM9XY822Q21D.png',
            'preloader' =>  '01JXHNRX39JWCW3Q2X6GPP9SJ3.png',
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
