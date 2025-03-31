<?php

namespace App\Http\Middleware;

use Closure;
use Filament\Navigation\MenuItem;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AddUserMenuItems
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return $next($request);
        }

        filament()->getCurrentPanel()->userMenuItems([
            'profile' => MenuItem::make()->label(auth()->user()->name)
        ]);

        return $next($request);
    }
}
