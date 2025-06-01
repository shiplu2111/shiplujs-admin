<?php

namespace App\Filament\Resources\ClientResource\Pages;

use App\Filament\Resources\ClientResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;
class EditClient extends EditRecord
{
    protected static string $resource = ClientResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
            ->successNotification(
                     Notification::make()
                    ->title('Deleted 😒😒')
                    ->body('The Client has been successfully Deleted.')
                    ->success()
                ),
        ];
    }
         protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getSavedNotification(): ?Notification
    {
        return  Notification::make()
            ->title(' Updated 💃💃')
            ->body('The Client  has been successfully Updated.')
            ->success()
            ->send();
    }
}
