<?php

namespace App\Filament\Resources\ContactMessageResource\Widgets;

use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\HtmlString;
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
}
