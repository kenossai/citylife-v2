<?php

namespace App\Filament\Pages;

use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\EmbeddedSchema;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class ForcePasswordReset extends Page
{
    protected static bool $shouldRegisterNavigation = false;

    protected static string $layout = 'filament-panels::components.layout.simple';

    protected string $view = 'filament-panels::pages.simple';

    public function hasLogo(): bool
    {
        return true;
    }

    public static function getNavigationLabel(): string
    {
        return 'Set Password';
    }

    public function getTitle(): string
    {
        return 'Set Your Password';
    }

    public function getSubheading(): ?string
    {
        return 'Choose a password to activate your account.';
    }

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function defaultForm(Schema $schema): Schema
    {
        return $schema->statePath('data');
    }

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('password')
                ->password()
                ->revealable()
                ->required()
                ->rule(Password::default())
                ->same('password_confirmation')
                ->label('New Password'),
            TextInput::make('password_confirmation')
                ->password()
                ->revealable()
                ->required()
                ->label('Confirm Password'),
        ]);
    }

    public function content(Schema $schema): Schema
    {
        return $schema->components([
            Form::make([
                EmbeddedSchema::make('form'),
                Actions::make([$this->getSaveFormAction()])->fullWidth(),
            ])->livewireSubmitHandler('save'),
        ]);
    }

    protected function getSaveFormAction(): Action
    {
        return Action::make('save')
            ->label('Set Password')
            ->submit('save');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        Auth::user()->update([
            'password'             => $data['password'],
            'force_password_reset' => false,
        ]);

        Notification::make()
            ->title('Password set successfully. Welcome!')
            ->success()
            ->send();

        $this->redirect(filament()->getHomeUrl());
    }
}
