<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Exception;

class SocialiteController extends Controller
{
    // Redirect to Google for authentication
    public function googleLogin()
    {
        return Socialite::driver('google')->redirect();
    }

    // Handle the callback from Google after authentication
    public function googleAuthentication()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();  // Add stateless to avoid session issues
    
            // Check if the user exists in the database
            $user = User::where('google_id', $googleUser->id)->first();
    
            if ($user) {
                if (!$user->avatar) {
                    $user->update(['avatar' => $googleUser->avatar]);
                }
                Auth::login($user);
                return redirect()->route('home1');
            } else {
                $userData = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'password' => Hash::make('password'),  // Default password
                    'google_id' => $googleUser->id,
                    'avatar' => $googleUser->avatar,       // Ensure avatar is saved here
                    'level' => 'user'                      // Set default level
                ]);
                
    
                if ($userData) {
                    Auth::login($userData);
                    return redirect()->route('home1');
                }
            }
        } catch (Exception $e) {
            Log::error('Google Authentication Error', ['error' => $e->getMessage()]);
            return redirect()->route('home')->withErrors('Error occurred during authentication');
        }
    }
    
}
