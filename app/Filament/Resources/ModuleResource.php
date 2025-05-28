<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ModuleResource\Pages;
use App\Filament\Resources\ModuleResource\RelationManagers;
use App\Models\Module;
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
use Filament\Tables\Columns\IconColumn;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Components\Placeholder;
use Illuminate\Support\HtmlString;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Section;
use Illuminate\Support\Facades\Schema;
class ModuleResource extends Resource
{
    protected static ?string $model = Module::class;
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';
    public static function getNavigationGroup(): ?string
        {
            return 'Module Manager'; // Match this to a group from navigationGroups()
        }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                ->schema([

                    Radio::make('service')->label('Service Publication Status')->inline()
                    ->options(['1' => 'Published','0' => 'Unpublished',])
                    ->descriptions(['1' => 'Is visible to Frontend ✔️.','0' => 'Is not visible to Frontend ❌.',])
                    ->default('1'),
                ]),

                Section::make()
                ->schema([

                    Radio::make('skill')->label('Skills Publication Status')->inline()
                    ->options(['1' => 'Published','0' => 'Unpublished',])
                    ->descriptions(['1' => 'Is visible to Frontend ✔️.','0' => 'Is not visible to Frontend ❌.',])
                    ->default('1'),
                ]),

                Section::make()
                ->schema([

                    Radio::make('project')->label('Project/Portfolio Publication Status')->inline()
                    ->options(['1' => 'Published','0' => 'Unpublished',])
                    ->descriptions(['1' => 'Is visible to Frontend ✔️.','0' => 'Is not visible to Frontend ❌.',])
                    ->default('1'),
                ]),


                Section::make()
                ->schema([

                    Radio::make('priceing')->label('Priceing Publication Status')->inline()
                    ->options(['1' => 'Published','0' => 'Unpublished',])
                    ->descriptions(['1' => 'Is visible to Frontend ✔️.','0' => 'Is not visible to Frontend ❌.',])
                    ->default('1'),
                ]),


                Section::make()
                ->schema([

                    Radio::make('blog')->label('Blog Publication Status')->inline()
                    ->options(['1' => 'Published','0' => 'Unpublished',])
                    ->descriptions(['1' => 'Is visible to Frontend ✔️.','0' => 'Is not visible to Frontend ❌.',])
                    ->default('0'),
                ]),


                Section::make()
                ->schema([

                    Radio::make('testimonial')->label('Testimonial Publication Status')->inline()
                    ->options(['1' => 'Published','0' => 'Unpublished',])
                    ->descriptions(['1' => 'Is visible to Frontend ✔️.','0' => 'Is not visible to Frontend ❌.',])
                    ->default('1'),
                ]),


                Section::make()
                ->schema([

                    Radio::make('client')->label('Clients Publication Status')->inline()
                    ->options(['1' => 'Published','0' => 'Unpublished',])
                    ->descriptions(['1' => 'Is visible to Frontend ✔️.','0' => 'Is not visible to Frontend ❌.',])
                    ->default('1'),
                ]),

                Section::make()
                ->schema([

                    Radio::make('faq')->label('FAQ Publication Status')->inline()
                    ->options(['1' => 'Published','0' => 'Unpublished',])
                    ->descriptions(['1' => 'Is visible to Frontend ✔️.','0' => 'Is not visible to Frontend ❌.',])
                    ->default('1'),
                ]),


                Section::make()
                ->schema([

                    Radio::make('education')->label('Education Publication Status')->inline()
                    ->options(['1' => 'Published','0' => 'Unpublished',])
                    ->descriptions(['1' => 'Is visible to Frontend ✔️.','0' => 'Is not visible to Frontend ❌.',])
                    ->default('1'),
                ]),


                Section::make()
                ->schema([

                    Radio::make('experience')->label('Experience Publication Status')->inline()
                    ->options(['1' => 'Published','0' => 'Unpublished',])
                    ->descriptions(['1' => 'Is visible to Frontend ✔️.','0' => 'Is not visible to Frontend ❌.',])
                    ->default('1'),
                ]),


                Section::make()
                ->schema([

                    Radio::make('certificate')->label('Certificate Publication Status')->inline()
                    ->options(['1' => 'Published','0' => 'Unpublished',])
                    ->descriptions(['1' => 'Is visible to Frontend ✔️.','0' => 'Is not visible to Frontend ❌.',])
                    ->default('1'),
                ]),

                Section::make()
                ->schema([

                    Radio::make('training')->label('Training Publication Status')->inline()
                    ->options(['1' => 'Published','0' => 'Unpublished',])
                    ->descriptions(['1' => 'Is visible to Frontend ✔️.','0' => 'Is not visible to Frontend ❌.',])
                    ->default('1'),
                ]),

                Section::make()
                ->schema([

                    Radio::make('social')->label('Social Media Publication Status')->inline()
                    ->options(['1' => 'Published','0' => 'Unpublished',])
                    ->descriptions(['1' => 'Is visible to Frontend ✔️.','0' => 'Is not visible to Frontend ❌.',])
                    ->default('1'),
                ]),

                Section::make()
                ->schema([

                    Radio::make('resume_download')->label('Resume Download Button Publication Status')->inline()
                    ->options(['1' => 'Published','0' => 'Unpublished',])
                    ->descriptions(['1' => 'Is visible to Frontend ✔️.','0' => 'Is not visible to Frontend ❌.',])
                    ->default('1'),
                ]),


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ToggleColumn::make('service')->label('Service')->onIcon('heroicon-o-check-circle')->offIcon('heroicon-o-x-circle')->onColor('success')->offColor('danger'),
                ToggleColumn::make('skill')->label('Skill')->onIcon('heroicon-o-check-circle')->offIcon('heroicon-o-x-circle')->onColor('success')->offColor('danger'),
                ToggleColumn::make('project')->onIcon('heroicon-o-check-circle')->offIcon('heroicon-o-x-circle')->onColor('success')->offColor('danger'),
                ToggleColumn::make('testimonial')->onIcon('heroicon-o-check-circle')->offIcon('heroicon-o-x-circle')->onColor('success')->offColor('danger'),
                ToggleColumn::make('priceing')->onIcon('heroicon-o-check-circle')->offIcon('heroicon-o-x-circle')->onColor('success')->offColor('danger'),
                ToggleColumn::make('blog')->onIcon('heroicon-o-check-circle')->offIcon('heroicon-o-x-circle')->onColor('success')->offColor('danger'),
                ToggleColumn::make('client')->onIcon('heroicon-o-check-circle')->offIcon('heroicon-o-x-circle')->onColor('success')->offColor('danger'),
                ToggleColumn::make('faq')->onIcon('heroicon-o-check-circle')->offIcon('heroicon-o-x-circle')->onColor('success')->offColor('danger'),
                ToggleColumn::make('education')->onIcon('heroicon-o-check-circle')->offIcon('heroicon-o-x-circle')->onColor('success')->offColor('danger'),
                ToggleColumn::make('experience')->onIcon('heroicon-o-check-circle')->offIcon('heroicon-o-x-circle')->onColor('success')->offColor('danger'),
                ToggleColumn::make('certificate')->onIcon('heroicon-o-check-circle')->offIcon('heroicon-o-x-circle')->onColor('success')->offColor('danger'),
                ToggleColumn::make('training')->onIcon('heroicon-o-check-circle')->offIcon('heroicon-o-x-circle')->onColor('success')->offColor('danger'),
                ToggleColumn::make('social')->onIcon('heroicon-o-check-circle')->offIcon('heroicon-o-x-circle')->onColor('success')->offColor('danger'),
                ToggleColumn::make('resume_download')->onIcon('heroicon-o-check-circle')->offIcon('heroicon-o-x-circle')->onColor('success')->offColor('danger'),
            ])->paginated(false)
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListModules::route('/'),
            // 'create' => Pages\CreateModule::route('/create'),
             ...(Schema::hasTable('modules') && Module::query()->exists() ? [] : [
                'create' => Pages\CreateModule::route('/create'),
            ]),
            'edit' => Pages\EditModule::route('/{record}/edit'),
        ];
    }
}
