<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FaqResource\Pages;
use App\Filament\Resources\FaqResource\RelationManagers;
use App\Models\Faq;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Tabs;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Actions\EditAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Forms\Components\ToggleButtons;
use Illuminate\Support\Facades\Schema;
use Filament\Tables\Actions\ActionGroup;

class FaqResource extends Resource
{
    protected static ?string $model = Faq::class;

    protected static ?string $navigationIcon = 'heroicon-o-question-mark-circle';
    protected static ?int $navigationSort = 4;
    public static function getNavigationGroup(): ?string
    {
        return 'Services'; // Match this to a group from navigationGroups()
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Textarea::make('question')->maxLength(150)->required()->columnSpan(2),

                Textarea::make('answer')
                    ->label('Answer')
                    ->placeholder('E.g. My name is Shiplu.')
                    ->columnSpan(2)
                    ->rows(8)
                    ->required(),
                ToggleButtons::make('status')
                    ->label('Status')
                    ->options([
                        '1' => 'Active',
                        '0' => 'Inactive',
                    ])
                    ->default('1')
                    ->required()
                    ->inline()
                    ->helperText('Toggle to change the status of the FAQ.')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('question')->label('Question')->sortable()->searchable(),
                TextColumn::make('answer')->label('Answer')->sortable()->searchable(),
                ToggleColumn::make('status')->label('Status')->toggleable()->afterStateUpdated(function ($record, $state) {
                    // Update the status of the record
                    Notification::make()
                    ->title('Publication Status Updated')
                    ->body("The status has been " . ($state ? 'enabled' : 'disabled') . " successfully.")
                    ->success()
                    ->send();
                })
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                   Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                ->successNotification(
                     Notification::make()
                    ->title('Faq Deleted')
                    ->body('The Faq has been successfully Deleted.')
                    ->success()
                ),
                ]),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                // Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFaqs::route('/'),
            'create' => Pages\CreateFaq::route('/create'),
            'edit' => Pages\EditFaq::route('/{record}/edit'),
        ];
    }
}
