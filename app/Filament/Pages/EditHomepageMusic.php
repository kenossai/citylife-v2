<?php

namespace App\Filament\Pages;

use App\Models\HomepageMusic;
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\EmbeddedSchema;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class EditHomepageMusic extends Page
{
    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedMusicalNote;

    public static function getNavigationGroup(): ?string { return 'Home Page'; }
    public static function getNavigationLabel(): string  { return 'Homepage Music'; }
    public static function getNavigationSort(): ?int     { return 6; }

    protected string $view = 'filament.pages.edit-homepage-music';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill(HomepageMusic::instance()->toArray());
    }

    public function defaultForm(Schema $schema): Schema
    {
        return $schema->statePath('data');
    }

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Music Player')
                ->description('A floating music player shown at the bottom of the homepage. Browsers may block autoplay — the visitor will see a prompt to start playback if that happens.')
                ->columns(2)
                ->schema([
                    Toggle::make('is_active')
                        ->label('Enable Music Player')
                        ->helperText('Show the player on the homepage.')
                        ->columnSpanFull(),

                    Toggle::make('autoplay')
                        ->label('Autoplay (muted on load)')
                        ->helperText('Try to autoplay automatically. Visitor must click to unmute due to browser restrictions.')
                        ->columnSpanFull(),

                    TextInput::make('title')
                        ->label('Track Title')
                        ->required()
                        ->maxLength(150)
                        ->placeholder('e.g. Praise Medley'),

                    TextInput::make('artist')
                        ->label('Artist / Worship Team')
                        ->maxLength(150)
                        ->placeholder('e.g. City Life Worship'),

                    TextInput::make('url')
                        ->label('MP3 URL')
                        ->required()
                        ->url()
                        ->maxLength(500)
                        ->placeholder('https://example.com/track.mp3')
                        ->columnSpanFull()
                        ->helperText('Direct link to an MP3 file (must be publicly accessible).'),
                ]),
        ]);
    }

    public function content(Schema $schema): Schema
    {
        return $schema->components([
            Form::make([EmbeddedSchema::make('form')])
                ->livewireSubmitHandler('save'),
        ]);
    }

    public function save(): void
    {
        $data = $this->form->getState();
        HomepageMusic::instance()->update($data);

        Notification::make()
            ->title('Music settings saved!')
            ->success()
            ->send();
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('save')
                ->label('Save Changes')
                ->action('save'),
        ];
    }
}
