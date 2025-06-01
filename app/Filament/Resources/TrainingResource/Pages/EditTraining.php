<?php

namespace App\Filament\Resources\TrainingResource\Pages;

use App\Filament\Resources\TrainingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;
class EditTraining extends EditRecord
{
    protected static string $resource = TrainingResource::class;

     protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
            ->successNotification(
                     Notification::make()
                    ->title('Deleted 😒😒')
                    ->body('The Training has been successfully Deleted.')
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
            ->body('The Training  has been successfully Updated.')
            ->success()
            ->send();
    }
}
