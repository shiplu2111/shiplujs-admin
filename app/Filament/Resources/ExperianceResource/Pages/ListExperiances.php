<?php

namespace App\Filament\Resources\ExperianceResource\Pages;

use App\Filament\Resources\ExperianceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Notifications\Notification;
class ListExperiances extends ListRecords
{
    protected static string $resource = ExperianceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
