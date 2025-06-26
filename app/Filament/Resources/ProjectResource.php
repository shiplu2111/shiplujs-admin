<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Filament\Resources\ProjectResource\RelationManagers;
use App\Models\Project;
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
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use App\Models\Category;
class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;
   protected static ?string $navigationIcon = 'heroicon-o-folder-plus';
    protected static ?int $navigationSort = 2;

    public static function getNavigationGroup(): ?string
        {
            return 'Projects'; // Match this to a group from navigationGroups()
        }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                 Tabs::make('Tabs')
                    ->tabs([
                        Tabs\Tab::make('General')
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
                                table: Project::class,
                                ignorable: fn ($record) => $record
                            )->required(),
                            TextInput::make('client')->maxLength(255)->required(),
                            TextInput::make('location')->maxLength(255)->required(),
                            DatePicker::make('published_at')->label('Published Date')->required(),
                            TagsInput::make('tags')->label('Tags')->required(),
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

                            ToggleButtons::make('is_featured')
                            ->label('Featured ?')
                            ->boolean()
                            ->inline()
                            ->options([
                                '1' => 'Featured',
                                '0' => 'Not Featured',
                            ])
                            ->required()
                            ->colors([
                                '1' => 'info',
                                '0' => 'danger',
                            ])
                            ->default('0')
                            ->grouped()
                        ])->columns(2),
                        Tabs\Tab::make('Description')
                            ->schema([
                             RichEditor::make('short_description')
                            ->columnSpan('full')->required()
                            ->maxLength(255),
                            RichEditor::make('description')
                            ->columnSpan('full')->required(),
                            RichEditor::make('project_summery')
                            ->columnSpan('full')->required()
                        ])->columns(2),

                        Tabs\Tab::make('Images')
                            ->schema([
                                FileUpload::make('image')->label('Project Image')->image()->imageEditor()->required(),
                                FileUpload::make('project_image_1')->label('Description Image')->image()->imageEditor()->required(),
                                FileUpload::make('project_image_2')->label('Description Image')->image()->imageEditor(),
                                FileUpload::make('project_image_3')->label('Description Image')->image()->imageEditor(),
                        ])->columns(2),

                        Tabs\Tab::make('Service')
                            ->schema([
                                Select::make('category_id')
                                ->label('Category')
                                ->options(Category::pluck('title','id')->toArray())
                                ->searchable()
                                ->required(),
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
                        ]),
                        Tabs\Tab::make('SEO')->schema([
                        \Filament\Forms\Components\Group::make([
                            TextInput::make('meta_title')->maxLength(255)->required(),
                            TextInput::make('meta_description')->maxLength(255)->required(),
                            TextInput::make('meta_keywords')->maxLength(255)->required(),
                            TextInput::make('og_title')->maxLength(255)->required(),
                            Textarea::make('og_description')->maxLength(255)->required(),
                            FileUpload::make('og_image')->image()->directory('seo-images')->required(),
                            TextInput::make('twitter_title')->maxLength(255)->required(),
                            Textarea::make('twitter_description')->maxLength(255)->required(),
                            FileUpload::make('twitter_image')->image()->directory('seo-images')->required(),
                        ])
                        ->columns(2)
                        ->relationship('seoMetadata'),
                    ]),
                    ])->columnSpan(2),
                       ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->label('Title')->sortable()->searchable(),
                TextColumn::make('client')->label('Client')->sortable()->searchable(),
                TextColumn::make('location')->label('Location')->sortable()->searchable(),
                TextColumn::make('published_at')->label('Published Date')->sortable()->searchable(),
                ToggleColumn::make('status')->label('Status')->toggleable()->afterStateUpdated(function ($record, $state) {
                Notification::make()
                    ->title('Status Updated')
                    ->body("The status has been " . ($state ? 'enabled' : 'disabled') . " successfully.")
                    ->success()
                    ->send();
            }),
            ToggleColumn::make('is_featured')->label('Featured')->toggleable()->afterStateUpdated(function ($record, $state) {
                 Notification::make()
                     ->title('Featured Status Updated')
                     ->body("The Project has been updated to " . ($state ? 'featured' : 'not featured') . " successfully.")
                     ->success()
                     ->send();
                 })->sortable()->searchable(),

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
                    ->title('Project Deleted')
                    ->body('The Project has been successfully Deleted.')
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
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
