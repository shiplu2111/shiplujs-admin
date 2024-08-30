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

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static ?string $navigationIcon = 'heroicon-o-bolt';

    protected static ?int $navigationSort = 1;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->required()->required(),
                Forms\Components\TextInput::make('icon')->required()->required(),
                Forms\Components\RichEditor::make('short_description')->required()->columnSpan(2),
                Forms\Components\RichEditor::make('long_description')->required()->columnSpan(2),
                Forms\Components\RichEditor::make('key_requirements')->nullable()->columnSpan(2),
                Forms\Components\RichEditor::make('key_benefits')->nullable()->columnSpan(2),
                Forms\Components\RichEditor::make('key_features')->nullable()->columnSpan(2),
                Forms\Components\TextInput::make('slug')->required()->required(),
                Forms\Components\FileUpload::make('image')->required()->columnSpan(2),
                Forms\Components\Select::make('status')
                ->options([
                    'Draft' => 'Draft',
                    'Reviewing' => 'Reviewing',
                    'Published' => 'Published',
                ])
            ]);


    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('icon'),
                Tables\Columns\TextColumn::make('slug'),
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('status'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
