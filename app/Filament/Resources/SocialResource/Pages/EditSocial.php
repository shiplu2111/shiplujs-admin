<?php

namespace App\Filament\Resources\SocialResource\Pages;

use App\Filament\Resources\SocialResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;
class EditSocial extends EditRecord
{
    protected static string $resource = SocialResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
            ->successNotification(
                     Notification::make()
                    ->title('Deleted 😒😒')
                    ->body('The Social Link has been successfully Deleted.')
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
            ->body('The Social Link  has been successfully Updated.')
            ->success()
            ->send();
    }
}
