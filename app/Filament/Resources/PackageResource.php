<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PackageResource\Pages;
use App\Filament\Resources\PackageResource\RelationManagers;
use App\Models\Package;
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
use Illuminate\Support\Str;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Fieldset;
class PackageResource extends Resource
{
    protected static ?string $model = Package::class;

    protected static ?string $navigationIcon = 'heroicon-o-cpu-chip';
    protected static ?int $navigationSort = 2;

    public static function getNavigationGroup(): ?string
        {
            return 'Services'; // Match this to a group from navigationGroups()
        }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                ->label('Title')
                ->placeholder('E.g. Next JS')
                ->required(),
                TextInput::make('price')->required()->numeric()->minValue(0),
                Textarea::make('sub_title')->required()->columnSpan(2),
                RichEditor::make('description')->required()->columnSpan(2),
                TextInput::make('currency_symbol')->required(),
                TextInput::make('duration')->required(),


                Fieldset::make('Service Includes')
                ->schema([
                Repeater::make('service_include')
                                ->schema([
                                    Hidden::make('id')
                                    ->default(fn () => (string) Str::uuid()),
                                    TextInput::make('service')
                                        ->label('Service Name')
                                        ->required(),
                                ])
                                ->columnSpan('full')
                                ->label('Service Names')
                                ->addActionLabel('Service Name')
                                ->default([
                                    [
                                        'id' => (string) Str::uuid(),
                                        'service' => '',
                                    ],
                                ]),
                ])->columnSpan(1),
                Fieldset::make('Service Not Included')
                ->schema([
                Repeater::make('service_not_include')
                                ->schema([
                                    Hidden::make('id')
                                    ->default(fn () => (string) Str::uuid()),
                                    TextInput::make('service')
                                        ->label('Service Name'),
                                ])
                                ->columnSpan('full')
                                ->label('Service Names')
                                ->addActionLabel('Add  Service')
                                ->default([
                                    [
                                        'id' => (string) Str::uuid(),
                                        'service' => '',
                                    ],
                                ]),
                ])->columnSpan(1),
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
                 TextColumn::make('title')->label('Title')->sortable()->searchable(),
                 TextColumn::make('price')->label('Price')->sortable()->searchable(),
                 TextColumn::make('currency_symbol')->label('Currency Symbol')->sortable()->searchable(),
                 TextColumn::make('duration')->label('Duration')->sortable()->searchable(),
                 ToggleColumn::make('status')->label('Status')->toggleable()->afterStateUpdated(function ($record, $state) {
                 Notification::make()
                     ->title('Status Updated')
                     ->body("The status has been " . ($state ? 'enabled' : 'disabled') . " successfully.")
                     ->success()
                     ->send();
                 })
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
                    ->title('Package Deleted')
                    ->body('The Package has been successfully Deleted.')
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
            'index' => Pages\ListPackages::route('/'),
            'create' => Pages\CreatePackage::route('/create'),
            'edit' => Pages\EditPackage::route('/{record}/edit'),
        ];
    }
}
