<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestimonialResource\Pages;
use App\Filament\Resources\TestimonialResource\RelationManagers;
use App\Models\Testimonial;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Columns\IconColumn;
use Filament\Infolists\Components\TextEntry;
class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->required(),
                Forms\Components\TextInput::make('company')->required(),
                Forms\Components\RichEditor::make('testimonial')->required()->columnSpan(2),
                Forms\Components\FileUpload::make('image')->required()->columnSpan(2),
                Forms\Components\TextInput::make('link')->required()->columnSpan(2),

                Forms\Components\Select::make('rating')
                ->options([
                    1 => '⭐',
                    2 => '⭐⭐',
                    3 => '⭐⭐⭐',
                    4 => '⭐⭐⭐⭐',
                    5 => '⭐⭐⭐⭐⭐',
                ]),
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
                Tables\Columns\TextColumn::make('company'),
                Tables\Columns\ImageColumn::make('image'),

                Tables\Columns\TextColumn::make('link'),
                Tables\Columns\IconColumn::make('rating')
                ->icon(fn (string $state): string => match ($state) {
                    '1' => 'heroicon-o-hand-thumb-down',
                    '2' => 'heroicon-o-arrow-trending-down',
                    '3' => 'heroicon-o-star',
                    '4' => 'heroicon-o-hand-thumb-up',
                    '5' => 'heroicon-o-heart',
                }),
                Tables\Columns\IconColumn::make('status')
                ->size(IconColumn\IconColumnSize::Medium)
                ->color(fn (string $state): string => match ($state) {
                    'Draft' => 'info',
                    'Reviewing' => 'warning',
                    'Published' => 'success',
                })
                ->icon(fn (string $state): string => match ($state) {
                    'Draft' => 'heroicon-o-pencil-square',
                    'Reviewing' => 'heroicon-o-clock',
                    'Published' => 'heroicon-o-check-circle',
                }),

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
            'index' => Pages\ListTestimonials::route('/'),
            'create' => Pages\CreateTestimonial::route('/create'),
            'edit' => Pages\EditTestimonial::route('/{record}/edit'),
        ];
    }
}
