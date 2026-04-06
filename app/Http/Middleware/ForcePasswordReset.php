<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ForcePasswordReset
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if (
            $user &&
            $user->force_password_reset &&
            !$request->routeIs('filament.admin.pages.force-password-reset')
        ) {
            return redirect()->route('filament.admin.pages.force-password-reset');
        }

        return $next($request);
    }
}
