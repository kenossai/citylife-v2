<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use App\Mail\UserInvitationMail;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function afterCreate(): void
    {
        $user = $this->record;

        $user->update(['force_password_reset' => true]);

        $inviterName = Auth::user()->name;
        $roleName = $user->roles->first()?->name ?? 'User';

        $acceptUrl = URL::temporarySignedRoute(
            'invitation.accept',
            now()->addHours(48),
            ['user' => $user->id]
        );

        Mail::to($user->email)->send(
            new UserInvitationMail($user, $inviterName, $roleName, $acceptUrl)
        );
    }
}
