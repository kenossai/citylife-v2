<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Auth;

class Dashboard extends BaseDashboard
{
    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedHome;

    public function getHeading(): string
    {
        $hour = now()->hour;
        $name = Auth::user()?->name ?? 'there';

        $greeting = match (true) {
            $hour < 12 => 'Good morning',
            $hour < 17 => 'Good afternoon',
            default    => 'Good evening',
        };

        return $greeting . ', ' . $name;
    }

    public function getSubheading(): ?string
    {
        return now()->format('l, j F Y');
    }
}
