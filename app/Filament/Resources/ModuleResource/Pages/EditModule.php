<?php

namespace App\Filament\Resources\ModuleResource\Pages;

use App\Filament\Resources\ModuleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;

class EditModule extends EditRecord
{
    protected static string $resource = ModuleResource::class;

     protected function getHeaderActions(): array
    {
        return [
            // Actions\DeleteAction::make(),

        ];
    }
     protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getSavedNotification(): ?Notification
    {
        return  Notification::make()
            ->title('Module Setting Updated')
            ->body('The Module Setting has been successfully Updated 💃💃.')
            ->success()
            ->send();
    }
}
