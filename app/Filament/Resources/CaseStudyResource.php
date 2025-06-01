<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CaseStudyResource\Pages;
use App\Filament\Resources\CaseStudyResource\RelationManagers;
use App\Models\CaseStudy;
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
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Select;
use Illuminate\Support\Str;
use Filament\Tables\Columns\TagsColumn;
class CaseStudyResource extends Resource
{
    protected static ?string $model = CaseStudy::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?int $navigationSort = 6;

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
                                table: CaseStudy::class,
                                ignorable: fn ($record) => $record
                            )->required(),
                TextInput::make('client_name')
                ->label('Client Name')
                ->placeholder('E.g. Sara Innovations')
                ->required(),
                TextInput::make('industry')
                ->label('Industry')
                ->placeholder('E.g. Information Technology')
                ->required(),
                TextInput::make('location')
                ->label('Location')
                ->placeholder('E.g. Dhaka, Bangladesh')
                ->required(),
                TextInput::make('project_duration')
                ->label('Project Duration')
                ->placeholder('E.g. 6 months')
                ->required(),
                 TagsInput::make('technologies')
                            ->label('Technologies')->required(),
                RichEditor::make('overview')
                            ->columnSpan('full')->required(),
                RichEditor::make('problem')
                            ->columnSpan('full')->required(),
                RichEditor::make('solution')
                            ->columnSpan('full')->required(),
                RichEditor::make('results')
                            ->columnSpan('full')->required(),
                FileUpload::make('cover_image')
                            ->image()->directory('case_studies')->imageEditor(),
                TextInput::make('project_url')
                            ->url()->prefixIcon('heroicon-m-globe-alt'),
                ToggleButtons::make('is_featured')
                            ->label('Featured Status')
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


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->sortable()->searchable(),
                TextColumn::make('client_name')->sortable()->searchable(),
                TextColumn::make('industry')->sortable()->searchable(),
                TextColumn::make('location')->sortable()->searchable(),
                TextColumn::make('project_duration')->sortable()->searchable(),
                TagsColumn::make('technologies')->sortable()->searchable(),
                ToggleColumn::make('is_featured')->label('Featured')->toggleable()->afterStateUpdated(function ($record, $state) {
                Notification::make()
                    ->title('Featured Status Updated')
                    ->body("The status has been " . ($state ? 'enabled' : 'disabled') . " successfully.")
                    ->success()
                    ->send();
            }),
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
                    ->title('Case Study Deleted')
                    ->body('The Case Study has been successfully Deleted.')
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
            'index' => Pages\ListCaseStudies::route('/'),
            'create' => Pages\CreateCaseStudy::route('/create'),
            'edit' => Pages\EditCaseStudy::route('/{record}/edit'),
        ];
    }
}
