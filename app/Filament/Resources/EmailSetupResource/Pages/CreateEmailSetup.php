<?php

namespace App\Filament\Resources\EmailSetupResource\Pages;

use App\Filament\Resources\EmailSetupResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;
class CreateEmailSetup extends CreateRecord
{
    protected static string $resource = EmailSetupResource::class;
    protected static bool $canCreateAnother = false;
     protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    protected function afterCreate(): void
    {
        Notification::make()
            ->title('SMTP Created 💃💃')
            ->body('The SMTP has been created successfully .')
            ->success()
            ->send();
    }
    protected function getCreatedNotification(): ?Notification
    {
        return null; // disables the default "Created" notification
    }
}
