<?php

namespace App\Filament\Resources\ContactMessageResource\Widgets;

use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\HtmlString;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
class ContactReplies extends BaseWidget
{
    public $record; // To receive record

    protected static ?string $heading = 'Reply History'; // Optional: Adds a nice heading
    protected int|string|array $columnSpan = 'full'; // Full width

    protected function getTableQuery(): Builder
    {
        return $this->record->replies()->getQuery()->latest(); // ✅ fix here
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('reply')
            ->label('Reply Message')
            ->wrap()
            ->formatStateUsing(fn (string $state): HtmlString => new HtmlString($state)),
            Tables\Columns\TextColumn::make('created_at')
                ->label('Sent At')
                ->dateTime()
                ->sortable()
                ->searchable(),
        ];
    }

     protected function getTableActions(): array
    {
        return [
            ViewAction::make()
                ->infolist([
                    TextEntry::make('reply')->label('Full Reply')->markdown(),
                    TextEntry::make('created_at')->label('Sent At')->dateTime(),
                ])
                ->modalHeading('View Reply'),
        ];
    }
}
