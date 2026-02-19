<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;

class GoogleController extends Controller
{
    /**
     * Redirige l'utilisateur vers Google pour consentement OAuth.
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Callback Google : récupère le profil, crée/associe l'utilisateur, connecte, puis redirige.
     */
    public function handleGoogleCallback(Request $request)
    {
        try {
            // Récupération du profil Google
            $googleUser = Socialite::driver('google')->user();

            // Google doit renvoyer un email (sinon on ne peut pas créer le compte proprement)
            $email = $googleUser->getEmail();
            if (!$email) {
                return redirect('/login')->with('error', 'Google n’a pas retourné d’adresse email. Merci d’en sélectionner une ou d’autoriser le partage de l’email.');
            }

            // Nom d’affichage : fallback sur la partie locale de l’email si Google n’en fournit pas
            $name = $googleUser->getName() ?: explode('@', $email)[0];

            // Recherche d’un utilisateur existant par email
            $user = User::where('email', $email)->first();

            // Création si nécessaire — Google a confirmé l'email → marqué vérifié immédiatement
            if (!$user) {
                $user = User::create([
                    'name'     => $name,
                    'email'    => $email,
                    'password' => bcrypt(Str::random(24)),
                ]);
                // email_verified_at peut être hors $fillable — utiliser forceFill
                $user->forceFill(['email_verified_at' => now()])->save();
            } elseif (!$user->email_verified_at) {
                // Utilisateur existant sans vérification — Google vient de le confirmer
                $user->forceFill(['email_verified_at' => now()])->save();
            }

            // Connexion + régénération de session
            Auth::login($user, $request->filled('remember'));
            $request->session()->regenerate();

            // Mise à jour last_login_at si la colonne existe (safe)
            if (Schema::hasColumn('users', 'last_login_at')) {
                $user->update(['last_login_at' => now()]);
            }

            // Redirection vers la page prévue (ou dashboard par défaut)
            return redirect()->intended('/dashboard');

        } catch (\Throwable $e) {
            // Journaliser si besoin : \Log::error($e);
            return redirect('/login')->with('error', 'Unable to login with Google.');
        }
    }
}
