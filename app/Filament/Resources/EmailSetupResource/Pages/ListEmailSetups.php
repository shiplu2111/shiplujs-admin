<?php

namespace App\Filament\Resources\EmailSetupResource\Pages;

use App\Filament\Resources\EmailSetupResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Notifications\Notification;
use App\Models\EmailSetup;
class ListEmailSetups extends ListRecords
{
    protected static string $resource = EmailSetupResource::class;

    protected function getHeaderActions(): array
    {
     if (EmailSetup::query()->exists()) {
            return []; // hide the Create button
        }
        return [
            Actions\CreateAction::make(),
        ];
    }
}
