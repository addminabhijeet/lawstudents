<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\RedirectResponse as SymfonyRedirectResponse;

/**
 * Google sign-in for site visitors (web guard). It only unlocks the free
 * note downloads; admins and students have their own guards.
 */
class GoogleLoginController extends Controller
{
    public function redirect(): SymfonyRedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback(): RedirectResponse
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            Log::warning('Google login failed', ['error' => $e->getMessage()]);

            return redirect('/')->with('error', 'Google login failed.');
        }

        $email = $googleUser->getEmail();

        // Only trust addresses Google has verified; otherwise anyone could
        // claim an existing user's email.
        $verified = filter_var($googleUser->user['email_verified'] ?? false, FILTER_VALIDATE_BOOLEAN);

        if (! $email || ! $verified) {
            return redirect('/')->with('error', 'Your Google account needs a verified email address.');
        }

        // Never overwrite an existing row (the first users row also holds the
        // site's own details), just sign it in.
        $user = User::firstOrCreate(
            ['email' => $email],
            [
                'name' => $googleUser->getName() ?: Str::before($email, '@'),
                // No password login exists for this guard; the column is required.
                'password' => Str::random(40),
            ]
        );

        // Auth::login() also migrates the session ID (session fixation).
        Auth::login($user);

        return redirect()->intended('/');
    }
}
