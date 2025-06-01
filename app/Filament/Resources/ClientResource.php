<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClientResource\Pages;
use App\Filament\Resources\ClientResource\RelationManagers;
use App\Models\Client;
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
class ClientResource extends Resource
{
    protected static ?string $model = Client::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?int $navigationSort = 3;

    public static function getNavigationGroup(): ?string
        {
            return 'Services'; // Match this to a group from navigationGroups()
        }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required()->maxLength(70)->columnSpan(2),
                FileUpload::make('image')->image()->directory('clients')->imageEditor()->columnSpan(2),
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
                TextColumn::make('name')->label('Name')->sortable()->searchable(),
                ImageColumn::make('image')->label('Image'),
                ToggleColumn::make('status')->label('Status')->toggleable()
                ->afterStateUpdated(function ($record, $state) {
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
                    ->title('Client Deleted')
                    ->body('The Client has been successfully Deleted.')
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
            'index' => Pages\ListClients::route('/'),
            'create' => Pages\CreateClient::route('/create'),
            'edit' => Pages\EditClient::route('/{record}/edit'),
        ];
    }
}
