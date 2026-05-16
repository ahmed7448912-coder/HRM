<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SocialAuthController extends Controller
{
    /**
     * Redirect to Google for authentication.
     */
    public function redirect()
    {
        /** @var \Laravel\Socialite\Two\AbstractProvider $driver */
        $driver = Socialite::driver('google');

        // Fix for cURL error 60 on local Windows machines
        if (config('app.env') === 'local') {
            $driver->setHttpClient(new Client(['verify' => false]));
        }

        // Force account selection screen
        return $driver->with(['prompt' => 'select_account'])->redirect();
    }

    /**
     * Handle Google Callback.
     */
    public function callback(Request $request)
    {
        return $this->handleSocialLogin('google', $request);
    }

    /**
     * Redirect to Facebook for authentication.
     */
    public function redirectToFacebook()
    {
        /** @var \Laravel\Socialite\Two\AbstractProvider $driver */
        $driver = Socialite::driver('facebook');

        if (config('app.env') === 'local') {
            $driver->setHttpClient(new Client(['verify' => false]));
        }

        return $driver->redirect();
    }

    /**
     * Handle Facebook Callback.
     */
    function handleFacebookCallback(Request $request)
    {
        return $this->handleSocialLogin('facebook', $request);
    }

    /**
     * Common method to handle social login.
     */
    protected function handleSocialLogin($provider, Request $request)
    {
        try {
            /** @var \Laravel\Socialite\Two\AbstractProvider $driver */
            $driver = Socialite::driver($provider);

            // Fix for cURL error 60 on local Windows machines
            if (config('app.env') === 'local') {
                $driver->setHttpClient(new Client(['verify' => false]));
            }

            $socialUser = $driver->stateless()->user();
            Log::info(ucfirst($provider) . ' User retrieved successfully: ' . $socialUser->getEmail());

            // Check if user already exists by email
            $existingUser = User::where('email', $socialUser->getEmail())->first();

            if ($existingUser) {
                // Ensure the user is linked
                $updateData = [
                    'provider_id'       => $socialUser->getId(),
                    'provider_name'     => $provider,
                    'provider_avatar'   => $socialUser->getAvatar(),
                    'email_verified_at' => $existingUser->email_verified_at ?? now(),
                ];

                if ($provider === 'facebook') {
                    $updateData['facebook_id'] = $socialUser->getId();
                }

                $existingUser->update($updateData);

                Auth::login($existingUser);
                $request->session()->save();
                return redirect('/admin/dashboard');
            }

            // If user doesn't exist, create new one
            $userData = [
                'name'              => $socialUser->getName(),
                'email'             => $socialUser->getEmail(),
                'provider_id'       => $socialUser->getId(),
                'provider_name'     => $provider,
                'provider_avatar'   => $socialUser->getAvatar(),
                'email_verified_at' => now(),
                'password'          => null,
            ];

            if ($provider === 'facebook') {
                $userData['facebook_id'] = $socialUser->getId();
            }

            $user = User::create($userData);

            // Assign default role to new users
            $user->assignRole('Employee');

            Auth::login($user);
            $request->session()->save();

            return redirect('/admin/dashboard');
        } catch (\Exception $e) {
            Log::error(ucfirst($provider) . ' Login Error: ' . $e->getMessage(), [
                'exception' => $e,
                'trace' => $e->getTraceAsString()
            ]);

            return redirect('/login')->with('error', ucfirst($provider) . ' login failed: ' . $e->getMessage());
        }
    }
}
