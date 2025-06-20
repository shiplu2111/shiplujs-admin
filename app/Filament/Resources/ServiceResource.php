<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Filament\Resources\ServiceResource\RelationManagers;
use App\Models\Service;
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
class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static ?string $navigationIcon = 'heroicon-o-server';
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
                ->reactive()
                ->afterStateUpdated(function (callable $set, $state) {
                    $set('slug', Str::slug($state));
                })
                ->required(),

                TextInput::make('slug')
                            ->disabled()
                            ->dehydrated()
                            ->unique(
                                table: Service::class,
                                ignorable: fn ($record) => $record
                            )->required(),
                Textarea::make('sub_title')->required()->columnSpan(2),
                RichEditor::make('description')->required()->columnSpan(2),
                FileUpload::make('image')->image()->directory('services')->imageEditor()->columnSpan(2),
                Fieldset::make('Related Services')
                ->schema([
                Repeater::make('related_service')
                                ->schema([
                                    Hidden::make('id')
                                    ->default(fn () => (string) Str::uuid()),
                                    TextInput::make('service')
                                        ->label('Service Name')
                                        ->required(),
                                ])
                                ->columnSpan('full')
                                ->label('Related Services')
                                ->addActionLabel('Add Related Service')
                                ->default([
                                    [
                                        'id' => (string) Str::uuid(),
                                        'service' => '',
                                    ],
                                ]),
                ])->columnSpan(2),
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
                TextColumn::make('slug')->label('Slug')->sortable()->searchable(),
                ImageColumn::make('image')->label('Image'),
                ToggleColumn::make('status')->label('Status')->toggleable()->afterStateUpdated(function ($record, $state) {
                Notification::make()
                    ->title('Status Updated')
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
                    ->title('Service Deleted')
                    ->body('The Service has been successfully Deleted.')
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
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}
