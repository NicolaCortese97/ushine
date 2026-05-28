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
        // Validazione con i campi standard Laravel
        $request->validate([
            'name'      => ['required', 'string', 'max:255'],      // Cambiato da 'nome'
            'cognome'   => ['required', 'string', 'max:100'],
            'email'     => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'telefono'  => ['required', 'string', 'max:20'],
            'prefisso_internazionale' => ['required', 'string', 'max:5'],
            'password'  => ['required', 'confirmed', Rules\Password::defaults()],
            'tipo_utente' => ['required', 'in:Guest,Talent,Sponsor,Visitatore'],
            'accetta_termini' => ['required', 'accepted'],         // Aggiunto
            'categories' => ['nullable', 'array'],
            'categories.*' => ['exists:categories,id'],
        ]);

        // Creazione dell'utente con campi standard Laravel
        $user = User::create([
            'name'          => $request->name,                    // Cambiato da 'nome'
            'cognome'       => $request->cognome,
            'email'         => $request->email,
            'telefono'      => $request->telefono,
            'prefisso_internazionale' => $request->prefisso_internazionale,
            'password'      => Hash::make($request->password),    // Cambiato da 'password_hash'
            'tipo_utente'   => $request->tipo_utente,
            'lingua_preferita' => 'IT',
            'accetta_termini' => true,
            'email_verified_at' => now(),                         // Aggiunto per verifica automatica
            'premium' => false,
            'verificato_identita' => false,
            'bannato' => false,
            'xp_points' => 0,
            'level' => 1,
            'rank' => '#1',
        ]);

        if ($request->has('categories')) {
            $user->categories()->sync($request->categories);
        }

        event(new Registered($user));
        Auth::login($user);

        return redirect(route('homepage', absolute: false));
    }
}