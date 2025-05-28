<?php

namespace App\Filament\Resources\ModuleTextResource\Pages;

use App\Filament\Resources\ModuleTextResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Notifications\Notification;
use App\Models\ModuleText;
class ListModuleTexts extends ListRecords
{
    protected static string $resource = ModuleTextResource::class;

    protected function getHeaderActions(): array
    {
     if (ModuleText::query()->exists()) {
            return []; // hide the Create button
        }
        return [
            Actions\CreateAction::make(),
        ];
    }
}
