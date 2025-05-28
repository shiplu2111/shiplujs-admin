<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Model;
use App\Models\EmailSetup;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
         Model::unguard();
        if (Schema::hasTable('email_setups')) { // make sure table exists (avoids error during migration)
            $emailSetup = EmailSetup::first(); // You can adjust this if you have multiple setups

            if ($emailSetup) {
                Config::set('mail.mailers.smtp.transport', $emailSetup->mail_driver);
                Config::set('mail.mailers.smtp.host', $emailSetup->mail_host);
                Config::set('mail.mailers.smtp.port', $emailSetup->mail_port);
                Config::set('mail.mailers.smtp.username', $emailSetup->mail_username);
                Config::set('mail.mailers.smtp.password', $emailSetup->mail_password);
                Config::set('mail.mailers.smtp.encryption', $emailSetup->mail_encryption);
                Config::set('mail.from.address', $emailSetup->mail_from_address);
                Config::set('mail.from.name', $emailSetup->mail_from_name);
            }
        }
    }
}
