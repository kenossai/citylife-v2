<?php

namespace App\Listeners;

use App\Models\ActivityLog;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;

class LogAuthActivity
{
    /** @var array<string, bool> Prevents double-logging within a single request lifecycle. */
    private static array $loginLogged  = [];
    private static array $logoutLogged = [];

    public function handleLogin(Login $event): void
    {
        $key = $event->guard . '::' . get_class($event->user) . ':' . $event->user->getKey();

        if (isset(self::$loginLogged[$key])) {
            return;
        }
        self::$loginLogged[$key] = true;

        activity('authentication')
            ->causedBy($event->user)
            ->withProperties([
                'guard'      => $event->guard,
                'user_type'  => get_class($event->user),
                'user_email' => $event->user->email ?? null,
            ])
            ->tap(function (ActivityLog $activity) use ($event) {
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

        $key = $event->guard . '::' . get_class($event->user) . ':' . $event->user->getKey();

        if (isset(self::$logoutLogged[$key])) {
            return;
        }
        self::$logoutLogged[$key] = true;

        activity('authentication')
            ->causedBy($event->user)
            ->withProperties([
                'guard'      => $event->guard,
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
