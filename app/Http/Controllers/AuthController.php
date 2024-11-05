<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Http\Controllers\PerformanceTestController;

class AuthController extends Controller
{
    /**
     * Redirect the user to the Google authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    /**
     * Handle the callback from Google after authentication.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function handleGoogleCallback()
    {
        try {
            // Retrieve user information from Google
            $googleUser = Socialite::driver('google')->stateless()->user();

            // Find or create the user in the database
            $user = User::firstOrCreate(
                ['google_id' => $googleUser->getId()],
                [
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    // No password field as we're not using password authentication
                ]
            );

            // Generate a token for API access
            $token = $user->createToken('authToken')->plainTextToken;

           // Store the token in the session or pass it to the frontend
           session(['authToken' => $token]);

           // Redirect to the performance test page
           return redirect('/performance-test'); //
        } catch (\Exception $e) {
            // Return a simple error message without detailed logs
            return response()->json(['error' => 'Authentication failed'], 500);
        }
    }
}
