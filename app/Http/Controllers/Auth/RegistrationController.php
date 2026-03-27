<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegistrationController extends Controller
{
    public function create(): View
    {
        return view('pages.auth.signup');
    }

    public function store(Request $request): RedirectResponse
    {
        // 1. Validazione con i nomi delle colonne in italiano
        $request->validate([
            'nome'      => ['required', 'string', 'max:100'],
            'cognome'   => ['required', 'string', 'max:100'],
            'email'     => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password'  => ['required', 'confirmed', Rules\Password::defaults()],
            'tipo_utente' => ['required', 'in:Guest,Talent,Sponsor,Visitatore'], // Escludiamo Admin per sicurezza
        ]);

        // 2. Creazione dell'utente
        $user = User::create([
            'nome'          => $request->nome,
            'cognome'       => $request->cognome,
            'email'         => $request->email,
            'password_hash' => Hash::make($request->password), // Nome colonna del tuo SQL
            'tipo_utente'   => $request->tipo_utente,
            'lingua_preferita' => 'IT',
            'accetta_termini' => true, // Presumiamo che se è arrivato qui abbia cliccato la checkbox
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}