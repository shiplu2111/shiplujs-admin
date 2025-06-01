<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TrainingResource\Pages;
use App\Filament\Resources\TrainingResource\RelationManagers;
use App\Models\Training;
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
use Filament\Tables\Actions\EditAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Components\Placeholder;
use Illuminate\Support\HtmlString;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
class TrainingResource extends Resource
{
    protected static ?string $model = Training::class;

     protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?int $navigationSort = 2;

    public static function getNavigationGroup(): ?string
        {
            return 'Resume'; // Match this to a group from navigationGroups()
        }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                ->label('Title')
                ->placeholder('E.g. Web Development')
                ->required(),
                TextInput::make('institute')
                ->label('Institute')
                ->placeholder('E.g. Sara Innovations')
                ->required(),

                Select::make('start_date')
                ->label('Start Year')
                ->options(
                    collect(range(now()->year, now()->subYears(50)->year))->mapWithKeys(fn ($year) => [$year => $year])
                )
                ->searchable(),

               Select::make('end_date')
                ->label('End Year')
                ->options(
                    collect(['Present' => 'Present'] + range(now()->year, now()->subYears(50)->year))
                        ->mapWithKeys(fn ($year) => [$year => $year])
                )
                ->searchable(),
                TextInput::make('website_url')
                ->label('Website URL')
                ->placeholder('E.g. Sara Innovations')
                ->prefixIcon('heroicon-m-globe-alt')
                ->url(),
                ToggleButtons::make('status')
                ->label('Publication Status')
                ->boolean()
                ->inline()
                ->options([
                    '1' => 'Active',
                    '0' => 'Inactive',
                ])
                ->required()
                 ->colors([
                    '1' => 'info',
                    '0' => 'danger',
                ])
                ->default('1')
                ->grouped(),
                RichEditor::make('description')
                ->columnSpan('full')
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->label('Title')->sortable()->searchable(),
                TextColumn::make('institute')->label('Institute')->sortable()->searchable(),
                TextColumn::make('start_date')->label('Start Year')->sortable()->searchable(),
                TextColumn::make('end_date')->label('End Year')->sortable()->searchable(),
                ToggleColumn::make('status')->label('Status')->toggleable()->afterStateUpdated(function ($record, $state) {
                Notification::make()
                    ->title('Publication Status Updated')
                    ->body("The status has been " . ($state ? 'enabled' : 'disabled') . " successfully.")
                    ->success()
                    ->send();
            }),
            ])
            ->filters([
                //
            ])
            ->actions([
                 Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                ->successNotification(
                     Notification::make()
                    ->title('Training Deleted')
                    ->body('The Training has been successfully Deleted.')
                    ->success()
                ),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListTrainings::route('/'),
            'create' => Pages\CreateTraining::route('/create'),
            'edit' => Pages\EditTraining::route('/{record}/edit'),
        ];
    }
}
