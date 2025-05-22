<?php

namespace App\Filament\Resources\EmailSetupResource\Pages;

use App\Filament\Resources\EmailSetupResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;
class EditEmailSetup extends EditRecord
{
    protected static string $resource = EmailSetupResource::class;

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
            ->title('SMTP Updated 💃💃')
            ->body('The SMTP setup has been updated successfully!! .')
            ->success()
            ->send();
    }
}
