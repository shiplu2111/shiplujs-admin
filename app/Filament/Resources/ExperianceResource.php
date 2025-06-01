<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExperianceResource\Pages;
use App\Filament\Resources\ExperianceResource\RelationManagers;
use App\Models\Experiance;
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
class ExperianceResource extends Resource
{
    protected static ?string $model = Experiance::class;
protected static ?string $modelLabel = 'Experience ';
     protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    protected static ?int $navigationSort = 1;

    public static function getNavigationGroup(): ?string
        {
            return 'Resume'; // Match this to a group from navigationGroups()
        }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('company_name')
                ->label('Company Name')
                ->placeholder('E.g. Sara Innovations')
                ->required(),

                TextInput::make('address')
                ->label('Address')
                ->placeholder('E.g. Dhaka, Bangladesh')
                ->required(),

                TextInput::make('website_url')
                ->label('Website URL')
                ->placeholder('E.g. https://sara-inovations.com')
                ->required(),

                TextInput::make('position')
                ->label('Designation')
                ->placeholder('E.g. Senior Web Designer')
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
                RichEditor::make('description')
                ->columnSpan('full')
                ->required(),
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
                ->grouped()
            ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('company_name')->label('Company Name')->sortable()->searchable(),
                TextColumn::make('position')->label('Designation')->sortable()->searchable(),
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
                    ->title('Experience Deleted')
                    ->body('The Experience has been successfully Deleted.')
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
            'index' => Pages\ListExperiances::route('/'),
            'create' => Pages\CreateExperiance::route('/create'),
            'edit' => Pages\EditExperiance::route('/{record}/edit'),
        ];
    }
}
