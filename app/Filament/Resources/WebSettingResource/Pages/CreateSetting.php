<?php

namespace App\Filament\Resources\WebSettingResource\Pages;

use App\Filament\Resources\WebSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;
class CreateSetting extends CreateRecord
{
    protected static string $resource = WebSettingResource::class;
    protected static bool $canCreateAnother = false;
     protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    protected function afterCreate(): void
    {
        Notification::make()
            ->title('Setting Created')
            ->body('The Setting has been successfully created.')
            ->success()
            ->send();
    }
    protected function getCreatedNotification(): ?Notification
    {
        return null; // disables the default "Created" notification
    }
}
