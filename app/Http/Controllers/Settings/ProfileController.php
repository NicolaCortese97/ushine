<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProfileController extends Controller
{

    public function edit(Request $request): View
    {
        return view('pages.auth.settings.profile', [
            'user' => $request->user(),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {

        $user = $request->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'cognome' => ['required', 'string', 'max:100'],
            'bio' => ['nullable', 'string', 'max:5000'], // Aumentato per via dei tag HTML di TinyMCE
            // 'email' => [
            //     'required',
            //     'string',
            //     'lowercase',
            //     'email',
            //     'max:255',
            //     Rule::unique(User::class)->ignore($user->id),
            // ],
        ]);

        $user->name = $validated['name'];
        $user->cognome = $validated['cognome'];
        $user->bio = $validated['bio'] ?? null;

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return to_route('settings.profile.edit')->with('status', 'Profile updated successfully');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return to_route('home');
    }

    public function updatePhoto(Request $request): RedirectResponse
    {
        $request->validate([
            'foto_profilo' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
        ]);

        $file = $request->file('foto_profilo');

        if (!$file || !$file->isValid()) {
            return back()->withErrors(['foto_profilo' => 'Impossibile caricare il file. Assicurati che non superi i limiti di dimensione del server (es. 2MB).']);
        }

        $user = $request->user();

        if ($user->foto_profilo && Storage::disk('public')->exists(str_replace('/storage/', '', $user->foto_profilo))) {
            Storage::disk('public')->delete(str_replace('/storage/', '', $user->foto_profilo));
        }

        try {
            $filename = uniqid('profile_') . '.' . $file->getClientOriginalExtension();
            $destinationPath = storage_path('app/public/profile-photos');
            
            // Assicurati che la cartella esista
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // Usa la funzione nativa move() che bypassa i problemi di stream fopen() su Windows
            $file->move($destinationPath, $filename);
            
            $user->foto_profilo = '/storage/profile-photos/' . $filename;
            $user->save();
        } catch (\Throwable $e) {
            return back()->withErrors(['foto_profilo' => 'Errore nel salvataggio del file: ' . $e->getMessage()]);
        }

        return back()->with('status', 'Profile photo updated successfully');
    }

    public function removePhoto(Request $request): RedirectResponse
    {
        $user = $request->user();

        if ($user->foto_profilo && Storage::disk('public')->exists(str_replace('/storage/', '', $user->foto_profilo))) {
            Storage::disk('public')->delete(str_replace('/storage/', '', $user->foto_profilo));
        }

        $user->foto_profilo = null;
        $user->save();

        return back()->with('status', 'Profile photo removed successfully');
    }
}
