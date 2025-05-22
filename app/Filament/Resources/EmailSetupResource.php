<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmailSetupResource\Pages;
use App\Filament\Resources\EmailSetupResource\RelationManagers;
use App\Models\EmailSetup;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Tabs;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\EditAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Forms\Components\ToggleButtons;
class EmailSetupResource extends Resource
{
    protected static ?string $model = EmailSetup::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';
    protected static ?string $navigationLabel = 'SMTP';
    protected static ?int $navigationSort = 3;
    public static function getNavigationGroup(): ?string
        {
            return 'Settings'; // Match this to a group from navigationGroups()
        }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('SMTP Settings')
                ->description('SMTP Settings allow you to configure the email delivery system for your application. By providing your SMTP credentials—such as the mail host, port, username, and encryption method—you enable the system to send important emails like account verification, password resets, and notifications. These settings are typically provided by your email service provider (e.g., Gmail, Outlook, Zoho, or custom domain email). For enhanced security, especially when using services like Gmail or Outlook, its recommended to use an app-specific password if two-factor authentication is enabled. Make sure to test your configuration after saving to ensure that emails are sent successfully.')
                ->aside()
                ->schema([
                    TextInput::make('mail_driver')->required()->default('smtp'),
                    TextInput::make('mail_host')->required()->placeholder('smtp.gmail.com'),
                    TextInput::make('mail_port')->required()->numeric()->default(587),
                    TextInput::make('mail_username')->required(),
                    TextInput::make('mail_password')->required()->password()->revealable(),
                    TextInput::make('mail_encryption')->required()->default('tls'),
                    TextInput::make('mail_from_address')->required(),
                    TextInput::make('mail_from_name')->required(),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('mail_driver')->label('Driver'),
                TextColumn::make('mail_host')->label('Host'),
                TextColumn::make('mail_port')->label('Port'),
                TextColumn::make('mail_username')->label('Username'),
                TextColumn::make('mail_encryption')->label('Encryption'),
                TextColumn::make('mail_from_address')->label('Sender Email'),
                TextColumn::make('mail_from_name')->label('Sender Name'),
            ])->paginated(false)
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
            'index' => Pages\ListEmailSetups::route('/'),
            'create' => Pages\CreateEmailSetup::route('/create'),
            'edit' => Pages\EditEmailSetup::route('/{record}/edit'),
        ];
    }
}
