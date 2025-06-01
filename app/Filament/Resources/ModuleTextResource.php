<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ModuleTextResource\Pages;
use App\Filament\Resources\ModuleTextResource\RelationManagers;
use App\Models\ModuleText;
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
use Filament\Forms\Components\Textarea;
class ModuleTextResource extends Resource
{
    protected static ?string $model = ModuleText::class;

    protected static ?string $navigationIcon = 'heroicon-o-pencil-square';
 protected static ?int $navigationSort = 4;
    public static function getNavigationGroup(): ?string
        {
            return 'Module Manager'; // Match this to a group from navigationGroups()
        }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
              //
                Section::make('About Section')
                    ->schema([
                        TextInput::make('about_title')->required()->label('Title')->maxLength(70)->required(),
                        TextInput::make('about_sub_title')->required()->label('Sub-Title')->maxLength(140)->required()->columnSpan(2),
                    ])->columns(3),
                Section::make('Service Section')
                    ->schema([
                        TextInput::make('service_title')->required()->maxLength(70)->label(' Title')->required(),
                        TextInput::make('service_sub_title')->required()->label(' Sub-Title')->maxLength(140)->required()->columnSpan(2),
                    ])->columns(3),
                Section::make('Skill Section')
                    ->schema([
                        TextInput::make('skill_title')->required()->maxLength(70)->label(' Title')->required(),
                        TextInput::make('skill_sub_title')->required()->label(' Sub-Title')->maxLength(140)->required()->columnSpan(2),
                    ])->columns(3),
                Section::make('Portfolio Section')
                    ->schema([
                        TextInput::make('portfolio_title')->required()->maxLength(70)->label(' Title')->required(),
                        TextInput::make('portfolio_sub_title')->required()->label(' Sub-Title')->maxLength(140)->required()->columnSpan(2),
                    ])->columns(3),
                Section::make('Testimonial Section')
                    ->schema([
                        TextInput::make('testimonial_title')->required()->maxLength(70)->label(' Title')->required(),
                        TextInput::make('testimonial_sub_title')->required()->label(' Sub-Title')->maxLength(140)->required()->columnSpan(2),
                    ])->columns(3),
                Section::make('Pricing Section')
                    ->schema([
                        TextInput::make('price_title')->required()->maxLength(70)->label(' Title')->required(),
                        TextInput::make('price_sub_title')->required()->label(' Sub-Title')->maxLength(140)->required()->columnSpan(2),
                    ])->columns(3),
                Section::make('Blog Section')
                    ->schema([
                        TextInput::make('blog_title')->required()->maxLength(70)->label(' Title')->required(),
                        TextInput::make('blog_sub_title')->required()->label(' Sub-Title')->maxLength(140)->required()->columnSpan(2),
                    ])->columns(3),
                Section::make('Contact Us Section')
                    ->schema([
                        TextInput::make('contact_title')->required()->maxLength(70)->label(' Title')->required(),
                        TextInput::make('contact_sub_title')->required()->label(' Sub-Title')->maxLength(140)->required()->columnSpan(2),
                    ])->columns(3),
                Section::make('Client Section')
                    ->schema([
                        TextInput::make('client_title')->required()->maxLength(70)->label(' Title')->required(),
                        TextInput::make('client_sub_title')->required()->label(' Sub-Title')->maxLength(140)->required()->columnSpan(2),
                    ])->columns(3),
                Section::make('FAQ Section')
                    ->schema([
                        TextInput::make('faq_title')->required()->maxLength(70)->label(' Title')->required(),
                        TextInput::make('faq_sub_title')->required()->label(' Sub-Title')->maxLength(140)->required()->columnSpan(2),
                    ])->columns(3),
                Section::make('Education Section')
                    ->schema([
                        TextInput::make('education_title')->required()->maxLength(70)->label(' Title')->required(),
                        TextInput::make('education_sub_title')->required()->label(' Sub-Title')->maxLength(140)->required()->columnSpan(2),
                    ])->columns(3),
                Section::make('Experience Section')
                    ->schema([
                        TextInput::make('experience_title')->required()->maxLength(70)->label(' Title')->required(),
                        TextInput::make('experience_sub_title')->required()->label(' Sub-Title')->maxLength(140)->required()->columnSpan(2),
                    ])->columns(3),
                Section::make('Certificate Section')
                    ->schema([
                        TextInput::make('certificate_title')->required()->maxLength(70)->label(' Title')->required(),
                        TextInput::make('certificate_sub_title')->required()->label(' Sub-Title')->maxLength(140)->required()->columnSpan(2),
                    ])->columns(3),
                Section::make('Training Section')
                    ->schema([
                        TextInput::make('training_title')->required()->maxLength(70)->label(' Title')->required(),
                        TextInput::make('training_sub_title')->required()->label(' Sub-Title')->maxLength(140)->required()->columnSpan(2),
                    ])->columns(3),
                Section::make('Social Section')
                    ->schema([
                        TextInput::make('social_title')->required()->maxLength(70)->label(' Title')->required(),
                        TextInput::make('social_sub_title')->required()->label(' Sub-Title')->maxLength(140)->required()->columnSpan(2),
                    ])->columns(3),
                Section::make('Case Study Section')
                    ->schema([
                        TextInput::make('casestudy_title')->required()->maxLength(70)->label(' Title')->required(),
                        TextInput::make('casestudy_sub_title')->required()->label(' Sub-Title')->maxLength(140)->required()->columnSpan(2),
                    ])->columns(3),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('about_title')->label('About Title'),
                TextColumn::make('service_title')->label('Service Title'),
                // TextColumn::make('skill_title')->label('Skill Title'),
            ])->paginated(false)
            ->filters([
                //
            ])
            ->actions([
                  Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                //
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
            'index' => Pages\ListModuleTexts::route('/'),
            // 'create' => Pages\CreateModuleText::route('/create'),
             ...(Schema::hasTable('module_texts') && ModuleText::query()->exists() ? [] : [
                'create' => Pages\CreateModuleText::route('/create'),
            ]),
            'edit' => Pages\EditModuleText::route('/{record}/edit'),
        ];
    }
}
