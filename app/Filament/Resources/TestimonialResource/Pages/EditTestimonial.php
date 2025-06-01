<?php

namespace App\Filament\Resources\TestimonialResource\Pages;

use App\Filament\Resources\TestimonialResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;
class EditTestimonial extends EditRecord
{
    protected static string $resource = TestimonialResource::class;

   protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
            ->successNotification(
                     Notification::make()
                    ->title('Deleted 😒😒')
                    ->body('The Testimonial has been successfully Deleted ✔️.')
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
            ->body('The Testimonial  has been successfully Updated ✔️.')
            ->success()
            ->send();
    }
}
