<?php

namespace App\Filament\Resources\Members\Pages;

use App\Filament\Resources\Members\MemberResource;
use App\Mail\MemberInvitationMail;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

class CreateMember extends CreateRecord
{
    protected static string $resource = MemberResource::class;

    protected function afterCreate(): void
    {
        $member = $this->record;

        // Only send if the member has an email address
        if (! $member->email) {
            return;
        }

        $token = $member->generatePasswordSetupToken();

        $setupUrl = route('member.setup-password.show', ['token' => $token]);

        Mail::to($member->email)->send(new MemberInvitationMail($member, $setupUrl));
    }
}
