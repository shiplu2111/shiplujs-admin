<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HeroResource\Pages;
use App\Filament\Resources\HeroResource\RelationManagers;
use App\Models\Hero;
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
class HeroResource extends Resource
{
    protected static ?string $model = Hero::class;

      protected static ?string $navigationIcon = 'heroicon-o-sparkles';
    protected static ?int $navigationSort = 4;

    public static function getNavigationGroup(): ?string
        {
            return 'About Me'; // Match this to a group from navigationGroups()
        }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                ->label('Title')
                ->placeholder('E.g. Hello, i’m')
                ->required(),
                TextInput::make('name')
                ->label('Name')
                ->placeholder('E.g. Shiplu ')
                ->required(),
                TextInput::make('designation')
                ->label('Designation')
                ->placeholder('E.g. Software Engineer')
                ->required(),
                TextInput::make('button_text')
                ->label('Button Text')
                ->placeholder('E.g. Hire Me')
                ->required(),
                Textarea::make('description')->maxLength(150)->required()->columnSpan(2),
                FileUpload::make('image')->image()->imageEditor()->required()->columnSpan(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->label('Title'),
                TextColumn::make('name')->label('Name'),
                TextColumn::make('designation')->label('Designation'),
                TextColumn::make('button_text')->label('Button Text'),
                ImageColumn::make('image')->label('Image'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListHeroes::route('/'),
             ...(Schema::hasTable('email_setups') && Hero::query()->exists() ? [] : [
                'create' => Pages\CreateHero::route('/create'),
            ]),
            'edit' => Pages\EditHero::route('/{record}/edit'),
        ];
    }
}
