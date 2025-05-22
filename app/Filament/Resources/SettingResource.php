<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SettingResource\Pages;
use App\Filament\Resources\SettingResource\RelationManagers;
use App\Models\Setting;
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
class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Tabs')
                    ->tabs([
                        Tabs\Tab::make('General')
                            ->schema([
                            TextInput::make('site_name')->required()->live(),
                            TextInput::make('email')->email()->required()->live(),
                            TextInput::make('website_url')->url()->prefixIcon('heroicon-m-globe-alt'),
                            TextInput::make('copyright'),
                            ])->columns(2),
                        Tabs\Tab::make('Contact')
                            ->schema([
                             TextInput::make('phone'),
                             TextInput::make('address'),
                             TextInput::make('city'),
                             TextInput::make('district'),
                             TextInput::make('country'),
                             TextInput::make('postal_code'),
                             TextInput::make('map')->suffixIcon('heroicon-m-map')->prefix('https://maps.google.com/')->url()->columnSpan(2),
                            ])->columns(2),
                        Tabs\Tab::make('Images')
                            ->schema([
                                FileUpload::make('logo')->image()->imageEditor(),
                                FileUpload::make('favicon')->image()->imageEditor(),
                                FileUpload::make('preloader')->image()->imageEditor(),
                            ])->columns(3),
                    ])->columnSpan(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //  TextColumn::make('status')->getStateUsing(fn (Setting $record): string => $record->status == 1 ? 'Active' : 'Inactive')->toggleable()->label('Site Name')->sortable(),
                    TextColumn::make('site_name')->label('Site Name'),
                    TextColumn::make('email')->label('Email'),
                    TextColumn::make('website_url')->label('Website URL'),
                ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                // Tables\Actions\DeleteAction::make()
                // ->successNotification(
                //      Notification::make()
                //     ->title('Setting Deleted')
                //     ->body('The Setting has been successfully Deleted.')
                //     ->success()
                // ),

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
            'index' => Pages\ListSettings::route('/'),
            'create' => Pages\CreateSetting::route('/create'),
            'edit' => Pages\EditSetting::route('/{record}/edit'),
        ];
    }

}
