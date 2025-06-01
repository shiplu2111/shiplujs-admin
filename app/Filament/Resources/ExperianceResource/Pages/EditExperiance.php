<?php

namespace App\Filament\Resources\ExperianceResource\Pages;

use App\Filament\Resources\ExperianceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;
class EditExperiance extends EditRecord
{
    protected static string $resource = ExperianceResource::class;

   protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
            ->successNotification(
                     Notification::make()
                    ->title('Deleted 😒😒')
                    ->body('The Experience has been successfully Deleted.')
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
            ->body('The Experience  has been successfully Updated.')
            ->success()
            ->send();
    }
}
