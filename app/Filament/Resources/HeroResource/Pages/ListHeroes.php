<?php

namespace App\Filament\Resources\HeroResource\Pages;

use App\Filament\Resources\HeroResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Models\Hero;
class ListHeroes extends ListRecords
{
    protected static string $resource = HeroResource::class;

     protected function getHeaderActions(): array
    {
     if (Hero::query()->exists()) {
            return []; // hide the Create button
        }
        return [
            Actions\CreateAction::make(),
        ];
    }
}
