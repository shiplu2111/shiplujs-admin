<?php

namespace App\Filament\Resources\EmailSetupResource\Pages;

use App\Filament\Resources\EmailSetupResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEmailSetup extends EditRecord
{
    protected static string $resource = EmailSetupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
