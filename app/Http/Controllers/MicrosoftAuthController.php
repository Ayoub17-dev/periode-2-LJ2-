<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class MicrosoftAuthController extends Controller
{
    public function redirectToMicrosoft()
    {
        return Socialite::driver('microsoft')
            ->scopes(['openid', 'profile', 'email'])
            ->redirect();
    }

    public function handleMicrosoftCallback()
    {
        try {
            $microsoftUser = Socialite::driver('microsoft')->user();
            
            // Check if email is from TCR domain
            $email = $microsoftUser->getEmail();
            if (!str_ends_with($email, '@student.tcr.nl') && !str_ends_with($email, '@tcr.nl')) {
                return redirect('/login')->with('error', 'Alleen TCR accounts zijn toegestaan.');
            }
            
            // Find or create user
            $user = User::where('email', $email)->first();
            
            if (!$user) {
                // Create new user
                $user = User::create([
                    'name' => $microsoftUser->getName(),
                    'email' => $email,
                    'password' => Hash::make(uniqid()), // Random password since they use Microsoft login
                    'microsoft_id' => $microsoftUser->getId(),
                    'rol' => str_ends_with($email, '@student.tcr.nl') ? 'student' : 'admin',
                    'studentnummer' => str_ends_with($email, '@student.tcr.nl') ? 
                        $this->generateStudentNumber() : null,
                ]);
            } else {
                // Update Microsoft ID if not set
                if (!$user->microsoft_id) {
                    $user->update(['microsoft_id' => $microsoftUser->getId()]);
                }
            }
            
            Auth::login($user);
            
            return redirect()->intended('/');
            
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Er is een fout opgetreden bij het inloggen met Microsoft.');
        }
    }
    
    private function generateStudentNumber()
    {
        do {
            $number = '12' . str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);
        } while (User::where('studentnummer', $number)->exists());
        
        return $number;
    }
}
