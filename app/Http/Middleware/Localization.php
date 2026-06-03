<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (session()->has('locale')) {
            App::setLocale(session()->get('locale'));
        } elseif (auth()->check() && auth()->user()->lingua) {
            $userLocale = auth()->user()->lingua;
            $localeMap = [
                'Italiano' => 'it',
                'English' => 'en',
                'it' => 'it',
                'en' => 'en',
            ];
            $mappedLocale = $localeMap[$userLocale] ?? null;
            if ($mappedLocale) {
                App::setLocale($mappedLocale);
                session()->put('locale', $mappedLocale);
            }
        }

        return $next($request);
    }
}
