<?php

namespace App\Filament\Resources\PackageResource\Pages;

use App\Filament\Resources\PackageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Models\Package;

class ListPackages extends ListRecords
{
    protected static string $resource = PackageResource::class;

     protected function getHeaderActions(): array
    {
        if (Package::count() === 3) {
            return []; // hide the Create button
        }
        return [
            Actions\CreateAction::make(),
        ];
    }
}
