<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EducationResource\Pages;
use App\Filament\Resources\EducationResource\RelationManagers;
use App\Models\Education;
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
class EducationResource extends Resource
{
    protected static ?string $model = Education::class;

     protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?int $navigationSort = 3;

    public static function getNavigationGroup(): ?string
        {
            return 'Resume'; // Match this to a group from navigationGroups()
        }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('institute')
                ->label('Institute')
                ->placeholder('E.g. Oxford University')
                ->required(),
                TextInput::make('subject')
                ->label('Major Subject')
                ->placeholder('E.g. Computer Science')
                ->required(),
                TextInput::make('address')
                ->label('Address')
                ->columnSpan(2)
                ->placeholder('E.g. 10 Downing Street, London, UK')
                ->required(),
                Select::make('start_date')
                ->label('Start Year')
                ->required()
                ->options(
                    collect(range(now()->year, now()->subYears(50)->year))
                        ->mapWithKeys(fn ($year) => [$year => $year])
                )
                ->reactive()
                ->searchable(),

                Select::make('end_date')
                ->label('End Year')
                ->required()
                ->options(function (callable $get) {
                    $startYear = $get('start_date');

                    $years = range(now()->year, now()->subYears(50)->year);

                    $filteredYears = collect($years)
                        ->filter(fn ($year) => $startYear ? $year >= $startYear : true)
                        ->mapWithKeys(fn ($year) => [(string)$year => (string)$year]);

                    return collect(['Present' => 'Present'])->union($filteredYears); // ✅ use union
                })
                ->disabled(fn (callable $get) => !$get('start_date'))
                ->searchable()
                ->reactive()
                ->suffixIcon('heroicon-o-calendar')
                ->live(),
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
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('institute')->label('Institute')->sortable()->searchable(),
                TextColumn::make('subject')->label('Major Subject')->sortable()->searchable(),
                TextColumn::make('start_date')->label('Start Year')->sortable()->searchable(),
                TextColumn::make('end_date')->label('End Year')->sortable()->searchable(),
                ToggleColumn::make('status')->label('Status')->toggleable()->afterStateUpdated(function ($record, $state) {
                Notification::make()
                    ->title('Publication Status Updated')
                    ->body("The status has been " . ($state ? 'enabled' : 'disabled') . " successfully.")
                    ->success()
                    ->send();
            }),
            ])->paginated(false)
            ->filters([
                //
            ])
            ->actions([
               Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                ->successNotification(
                     Notification::make()
                    ->title('Education Deleted')
                    ->body('The Education has been successfully Deleted.')
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
            'index' => Pages\ListEducation::route('/'),
            'create' => Pages\CreateEducation::route('/create'),
            'edit' => Pages\EditEducation::route('/{record}/edit'),
        ];
    }
}
