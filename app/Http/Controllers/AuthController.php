<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Toon login pagina
    public function showLogin()
    {
        return view('auth.login');
    }

    // Verwerk login
    public function login(Request $request)
    {
        // Valideer de invoer
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Probeer in te loggen
        if (Auth::attempt($request->only('email', 'password'), $request->remember)) {
            $request->session()->regenerate();
            return redirect('/')->with('success', 'Je bent ingelogd!');
        }

        // Login mislukt
        return back()->withErrors([
            'email' => 'De opgegeven gegevens zijn onjuist.',
        ]);
    }

    // Toon registratie pagina
    public function showRegister()
    {
        return view('auth.register');
    }

    // Verwerk registratie
    public function register(Request $request)
    {
        // Valideer de invoer
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'studentnummer' => 'nullable|string|unique:users',
            'klas' => 'nullable|string|max:10',
        ]);

        // Maak nieuwe gebruiker aan
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'studentnummer' => $request->studentnummer,
            'klas' => $request->klas,
            'rol' => 'student', // Standaard is iedereen student
        ]);

        // Log de gebruiker direct in
        Auth::login($user);

        return redirect('/')->with('success', 'Account aangemaakt! Je bent nu ingelogd.');
    }

    // Uitloggen
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Je bent uitgelogd.');
    }
}
