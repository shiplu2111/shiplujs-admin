<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EmailSetup;
class EmailSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'mail_driver' => 'smtp',
            'mail_host' => 'sandbox.smtp.mailtrap.io',
            'mail_port' => '587',
            'mail_username' => '627829fcf7518b',
            'mail_password' => 'a1fcab616ed189',
            'mail_encryption' => 'tls',
            'mail_from_address' => 'me@shiplujs.com',
            'mail_from_name' => 'Shiplu JS',

        ];

        // Insert the data into the sites table
        EmailSetup::create($data);
    }
}
