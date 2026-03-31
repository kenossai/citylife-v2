<?php

namespace App\Filament\Pages;

use App\Models\AboutSection;
use Filament\Actions\Action;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\EmbeddedSchema;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class EditAboutSection extends Page
{
    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedInformationCircle;

    public static function getNavigationGroup(): ?string { return 'Home Page'; }
    public static function getNavigationLabel(): string  { return 'About Section'; }
    public static function getNavigationSort(): ?int     { return 2; }

    protected string $view = 'filament.pages.edit-about-section';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill(AboutSection::instance()->toArray());
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
                Section::make('About Section')
                    ->columns(2)
                    ->schema([
                        TextInput::make('heading')
                            ->required()
                            ->maxLength(120)
                            ->columnSpanFull(),
                        TextInput::make('established_text')
                            ->label('Established Text')
                            ->placeholder('10th of February 2004')
                            ->maxLength(100),
                        TextInput::make('image_path')
                            ->label('Image Path / URL')
                            ->maxLength(300),
                        Textarea::make('body_1')
                            ->label('Body Paragraph 1')
                            ->rows(3)
                            ->columnSpanFull(),
                        Textarea::make('body_2')
                            ->label('Body Paragraph 2')
                            ->rows(3)
                            ->columnSpanFull(),
                        TextInput::make('btn_text')
                            ->label('Button Text')
                            ->maxLength(60),
                        TextInput::make('btn_url')
                            ->label('Button URL')
                            ->maxLength(200),
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
        AboutSection::instance()->update($data);

        Notification::make()
            ->title('About section saved!')
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
