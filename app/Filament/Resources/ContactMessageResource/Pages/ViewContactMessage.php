<?php

namespace App\Filament\Resources\ContactMessageResource\Pages;

use App\Filament\Resources\ContactMessageResource;
use Filament\Actions\Action;
use Filament\Resources\Pages\ViewRecord;
use Filament\Forms;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactReplyMail;
use Filament\Notifications\Notification;
use Filament\Widgets\Widget;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Actions\Action as TableAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Forms\Components\RichEditor;
class ViewContactMessage extends ViewRecord
{
    protected static string $resource = ContactMessageResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $record_data = ContactMessage::find($data['id']);
        $record_data['is_read'] = true;
        $record_data->save();
        return $data;
    }
    protected function getHeaderActions(): array
    {
    return [
        Action::make('Reply')
            ->label('Reply to Message')
            ->action(fn (array $data) => $this->replyToMessage($data)) // ← fixed here
            ->requiresConfirmation()
            ->color('primary')
            ->modalIcon('heroicon-o-paper-airplane')
            ->modalHeading('Reply to Contact')
            ->modalSubheading('Send a reply to this contact email.')
            ->modalButton('Send Reply')
            ->form([
                    RichEditor::make('reply')
                    ->label('Your Reply')
                    ->columnSpan('full')->required(),
            ]),
    ];
}

    public function replyToMessage(array $data)
    {
        // Reply insert in the ContactMessageReply table
        $this->record->replies()->create([
            'reply' => $data['reply']
        ]);

        // Send reply email
        Mail::to($this->record->email)->send(new ContactReplyMail($data['reply']));

            Notification::make()
            ->title('Reply Sent Successfully!')
            ->success()
            ->send();
    }

    protected function getFooterWidgets(): array
{
    return [
        \App\Filament\Resources\ContactMessageResource\Widgets\ContactReplies::make([
            'record' => $this->record,
        ]),
    ];
}
}
