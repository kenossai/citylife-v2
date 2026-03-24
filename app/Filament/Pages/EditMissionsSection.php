<?php

namespace App\Filament\Pages;

use App\Models\MissionsSection;
use Filament\Actions\Action;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class EditMissionsSection extends Page
{
    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedGlobeAlt;

    public static function getNavigationGroup(): ?string { return 'Home Page'; }
    public static function getNavigationLabel(): string  { return 'Missions Section'; }
    public static function getNavigationSort(): ?int     { return 4; }

    protected string $view = 'filament.pages.edit-missions-section';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill(MissionsSection::instance()->toArray());
    }

    public function defaultForm(Schema $schema): Schema
    {
        return $schema
            ->statePath('data');
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Missions Section')
                    ->columns(2)
                    ->schema([
                        TextInput::make('eyebrow')
                            ->label('Eyebrow Text')
                            ->maxLength(80),
                        TextInput::make('heading')
                            ->required()
                            ->maxLength(120),
                        Textarea::make('description')
                            ->rows(3)
                            ->columnSpanFull(),
                        TextInput::make('btn_text')
                            ->label('Button Text')
                            ->maxLength(60),
                        TextInput::make('btn_url')
                            ->label('Button URL')
                            ->maxLength(200),
                    ]),

                Section::make('Stats')
                    ->schema([
                        Repeater::make('stats')
                            ->label('Mission Stats')
                            ->schema([
                                TextInput::make('value')
                                    ->required()
                                    ->placeholder('15+')
                                    ->maxLength(20),
                                TextInput::make('label')
                                    ->required()
                                    ->placeholder('Mission Partners')
                                    ->maxLength(60),
                            ])
                            ->columns(2)
                            ->defaultItems(3)
                            ->maxItems(6),
                    ]),

                Section::make('Images')
                    ->schema([
                        Repeater::make('images')
                            ->label('Image Paths / URLs')
                            ->schema([
                                TextInput::make('url')
                                    ->label('Image URL')
                                    ->required()
                                    ->maxLength(300),
                            ])
                            ->defaultItems(3)
                            ->maxItems(4),
                    ]),
            ]);
    }

    public function save(): void
    {
        $data = $this->form->getState();
        MissionsSection::instance()->update($data);

        Notification::make()
            ->title('Missions section saved!')
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
