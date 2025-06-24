<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectCategoryResource\Pages;
use App\Filament\Resources\ProjectCategoryResource\RelationManagers;
use App\Models\Category;
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
use App\Models\Project;
class ProjectCategoryResource extends Resource
{
    protected static ?string $model = Category::class;

        protected static ?string $navigationIcon = 'heroicon-o-bars-arrow-down';
    protected static ?int $navigationSort = 1;

    public static function getNavigationGroup(): ?string
        {
            return 'Projects'; // Match this to a group from navigationGroups()
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
                                table: Category::class,
                                ignorable: fn ($record) => $record
                            )->required(),
                FileUpload::make('image')->image()->imageEditor()->columnSpan(2),
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
                ImageColumn::make('image')->label('Image')->sortable()->searchable(),
                ToggleColumn::make('status')->label('Status')->toggleable()->afterStateUpdated(function ($record, $state) {
                Notification::make()
                    ->title('Status Updated')
                    ->body("The status has been " . ($state ? 'enabled' : 'disabled') . " successfully.")
                    ->success()
                    ->send();
            }),
            ])
            ->filters([

            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),

                Tables\Actions\DeleteAction::make()
                ->successNotification(null)
                ->before(function ($record, $action) {
                    $isProduct = Project::where('category_id', $record->id)->first();
                    if ($isProduct) {
                        Notification::make()
                            ->title('Deletion Blocked')
                            ->body('This Category cannot be deleted because it is linked to an existing project.')
                            ->icon('heroicon-s-x-circle')
                            ->danger()
                            ->send();

                        // Properly cancel the action
                        $action->cancel();
                    }
                })
                ->after(function ($record) {
                    Notification::make()
                        ->title('Category Deleted')
                        ->body('The category was successfully deleted.')
                        ->icon('heroicon-s-trash')
                        ->success()
                        ->send();
                }),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //      Tables\Actions\DeleteBulkAction::make()->successNotification(
                //      Notification::make()
                //     ->title('Deleted')
                //     ->body('The Selected Categories are successfully Deleted.')
                //     ->success()
                // ),
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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
