<?php

namespace App\Filament\Resources\ModuleResource\Pages;

use App\Filament\Resources\ModuleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Models\Module;
class ListModules extends ListRecords
{
    protected static string $resource = ModuleResource::class;

   protected function getHeaderActions(): array
    {
     if (Module::query()->exists()) {
            return []; // hide the Create button
        }
        return [
            Actions\CreateAction::make(),
        ];
    }
}
