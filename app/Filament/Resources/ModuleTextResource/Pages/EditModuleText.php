<?php

namespace App\Filament\Resources\ModuleTextResource\Pages;

use App\Filament\Resources\ModuleTextResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;
class EditModuleText extends EditRecord
{
    protected static string $resource = ModuleTextResource::class;
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
            ->title('Module Text Updated')
            ->body('The Module Title and Sub-Title has been successfully Updated 💃💃.')
            ->success()
            ->send();
    }
}
