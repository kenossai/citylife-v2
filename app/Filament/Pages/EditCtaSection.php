<?php

namespace App\Filament\Pages;

use App\Models\CtaSection;
use Filament\Actions\Action;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\EmbeddedSchema;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class EditCtaSection extends Page
{
    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedFlag;

    public static function getNavigationGroup(): ?string { return 'Home Page'; }
    public static function getNavigationLabel(): string  { return 'CTA / Volunteer Banner'; }
    public static function getNavigationSort(): ?int     { return 5; }

    protected string $view = 'filament.pages.edit-cta-section';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill(CtaSection::instance()->toArray());
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
                Section::make('CTA / Volunteer Banner')
                    ->columns(2)
                    ->schema([
                        TextInput::make('eyebrow')
                            ->label('Eyebrow Text')
                            ->maxLength(80),
                        TextInput::make('heading')
                            ->required()
                            ->maxLength(200)
                            ->columnSpanFull(),
                        Textarea::make('description')
                            ->rows(3)
                            ->columnSpanFull(),
                        TextInput::make('btn_text')
                            ->label('Button Text')
                            ->maxLength(60),
                        TextInput::make('btn_url')
                            ->label('Button URL')
                            ->maxLength(200),
                        TextInput::make('background_image')
                            ->label('Background Image Path / URL')
                            ->maxLength(300)
                            ->columnSpanFull(),
                    ]),

                Section::make('Side Images')
                    ->schema([
                        Repeater::make('side_images')
                            ->label('Side Images (shown on desktop)')
                            ->schema([
                                TextInput::make('url')
                                    ->label('Image URL')
                                    ->required()
                                    ->maxLength(300),
                            ])
                            ->defaultItems(2)
                            ->maxItems(2),
                    ]),
            ]);
    }

    public function content(Schema $schema): Schema
    {
        return $schema
            ->components([
                Form::make([EmbeddedSchema::make('form')])
                    ->livewireSubmitHandler('save'),
            ]);
    }

    public function save(): void
    {
        $data = $this->form->getState();
        CtaSection::instance()->update($data);

        Notification::make()
            ->title('CTA section saved!')
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
