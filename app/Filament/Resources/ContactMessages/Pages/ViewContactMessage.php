<?php

namespace App\Filament\Resources\ContactMessages\Pages;

use App\Filament\Resources\ContactMessages\ContactMessageResource;
use Filament\Actions\Action;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class ViewContactMessage extends ViewRecord
{
    protected static string $resource = ContactMessageResource::class;

    public function mount(int|string $record): void
    {
        parent::mount($record);

        // Auto-mark as read when opened
        if (! $this->record->is_read) {
            $this->record->markAsRead();
        }
    }

    public function infolist(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Contact Details')
                ->columns(2)
                ->schema([
                    TextEntry::make('name')->label('Full Name'),
                    TextEntry::make('email')->label('Email Address')->copyable()->color('primary'),
                    TextEntry::make('phone')->label('Phone')->placeholder('Not provided'),
                    TextEntry::make('enquiry_type')
                        ->label('Enquiry Type')
                        ->badge()
                        ->formatStateUsing(fn (string $state) => match ($state) {
                            'general'      => 'General',
                            'prayer'       => 'Prayer Request',
                            'volunteering' => 'Volunteering',
                            'events'       => 'Events',
                            'bible-school' => 'Bible School',
                            'other'        => 'Other',
                            default        => $state,
                        })
                        ->color(fn (string $state) => match ($state) {
                            'prayer'       => 'success',
                            'volunteering' => 'info',
                            'events'       => 'warning',
                            'bible-school' => 'primary',
                            default        => 'gray',
                        }),
                    TextEntry::make('created_at')->label('Received At')->dateTime(),
                    TextEntry::make('replied_at')->label('Replied At')->dateTime()->placeholder('Not yet replied'),
                ]),

            Section::make('Message')
                ->schema([
                    TextEntry::make('subject')->label('Subject'),
                    TextEntry::make('message')->label('Message')->prose()->columnSpanFull(),
                ]),
        ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('mark_replied')
                ->label('Mark as Replied')
                ->icon(Heroicon::OutlinedCheckCircle)
                ->color('success')
                ->visible(fn () => $this->record->replied_at === null)
                ->requiresConfirmation()
                ->action(function () {
                    $this->record->update(['replied_at' => now()]);
                    $this->redirect(request()->header('Referer') ?: static::getResource()::getUrl('view', ['record' => $this->record]));
                }),

            Action::make('reply_email')
                ->label('Reply via Email')
                ->icon(Heroicon::OutlinedEnvelope)
                ->url(fn () => 'mailto:' . $this->record->email . '?subject=Re: ' . rawurlencode($this->record->subject))
                ->openUrlInNewTab(),
        ];
    }
}
