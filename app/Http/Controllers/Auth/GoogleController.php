<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use GuzzleHttp\Client;

class GoogleController extends Controller
{
    // Redirect to Google
    public function redirect()
    {
        /** @var \Laravel\Socialite\Two\AbstractProvider $driver */
        $driver = Socialite::driver('google');

        // Fix for cURL error 60 on local Windows machines
        if (config('app.env') === 'local') {
            $driver->setHttpClient(new Client(['verify' => false]));
        }

        return $driver->redirect();
    }

    // Handle Google Callback
    public function callback(\Illuminate\Http\Request $request)
    {

        try {
            /** @var \Laravel\Socialite\Two\AbstractProvider $driver */
            $driver = Socialite::driver('google');

            // Fix for cURL error 60 on local Windows machines
            if (config('app.env') === 'local') {
                $driver->setHttpClient(new Client(['verify' => false]));
            }

            $googleUser = $driver->user();

            // Check if user already exists by email
            $existingUser = User::where('email', $googleUser->getEmail())->first();

            if ($existingUser) {
                // Ensure the user is marked as verified and linked
                $existingUser->update([
                    'provider_id'       => $googleUser->getId(),
                    'provider_name'     => 'google',
                    'provider_avatar'   => $googleUser->getAvatar(),
                    'email_verified_at' => $existingUser->email_verified_at ?? now(),
                ]);

                Auth::login($existingUser);
                $request->session()->save();
                return redirect('/admin/dashboard');
            }

            // If user doesn't exist, create new one
            $user = User::create([
                'name'              => $googleUser->getName(),
                'email'             => $googleUser->getEmail(),
                'provider_id'       => $googleUser->getId(),
                'provider_name'     => 'google',
                'provider_avatar'   => $googleUser->getAvatar(),
                'email_verified_at' => now(),
                'password'          => null,
            ]);

            // Assign default role to new users so they can access the dashboard
            $user->assignRole('Employee');

            Auth::login($user);
            $request->session()->save();

            return redirect('/admin/dashboard');
        } catch (\Exception $e) {
            // Log the error for debugging
            \Illuminate\Support\Facades\Log::error('Google Login Error: ' . $e->getMessage());

            return redirect('/login')->with('error', 'Google login failed: ' . $e->getMessage());
        }
    }
}
