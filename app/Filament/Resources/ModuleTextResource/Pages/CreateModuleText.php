<?php

namespace App\Filament\Resources\ModuleTextResource\Pages;

use App\Filament\Resources\ModuleTextResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;
class CreateModuleText extends CreateRecord
{
    protected static string $resource = ModuleTextResource::class;
    protected static bool $canCreateAnother = false;
     protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    protected function afterCreate(): void
    {
        Notification::make()
            ->title('Module Text Created')
            ->body('The Title and Sub-Title has been successfully created.')
            ->success()
            ->send();
    }
    protected function getCreatedNotification(): ?Notification
    {
        return null; // disables the default "Created" notification
    }
}
