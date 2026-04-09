<?php

namespace App\Listeners;

use App\Models\ActivityLog;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;

class LogAuthActivity
{
    public function handleLogin(Login $event): void
    {
        activity('authentication')
            ->causedBy($event->user)
            ->withProperties([
                'user_type'  => get_class($event->user),
                'user_email' => $event->user->email ?? null,
            ])
            ->tap(function (ActivityLog $activity) {
                $activity->category     = 'Authentication';
                $activity->severity     = 'low';
                $activity->is_sensitive = false;
            })
            ->event('logged_in')
            ->log('User login');
    }

    public function handleLogout(Logout $event): void
    {
        if (! $event->user) {
            return;
        }

        activity('authentication')
            ->causedBy($event->user)
            ->withProperties([
                'user_type'  => get_class($event->user),
                'user_email' => $event->user->email ?? null,
            ])
            ->tap(function (ActivityLog $activity) {
                $activity->category     = 'Authentication';
                $activity->severity     = 'low';
                $activity->is_sensitive = false;
            })
            ->event('logged_out')
            ->log('User logout');
    }
}
