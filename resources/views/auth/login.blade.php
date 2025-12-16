@extends('layouts.app')

@section('title', 'Inloggen')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-tcr-light-green to-white">
    <div class="max-w-md w-full">
        <!-- Logo/Header -->
        <div class="text-center mb-8">
            <div class="w-20 h-20 bg-tcr-green rounded-2xl flex items-center justify-center mx-auto mb-4">
                <span class="text-white font-bold text-3xl">TCR</span>
            </div>
            <h2 class="text-3xl font-bold text-tcr-gray">Welkom terug</h2>
            <p class="mt-2 text-gray-600">Log in om verder te gaan met je keuzedelen</p>
        </div>

        <!-- Login Card -->
        <div class="bg-white rounded-2xl shadow-xl p-8">
            <!-- Fouten tonen -->
            @if($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 text-red-800 p-4 mb-6 rounded-r-lg">
                    <ul class="space-y-1">
                        @foreach($errors->all() as $error)
                            <li class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                                {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="/login" class="space-y-6">
                @csrf
                
                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-bold text-tcr-gray mb-2">
                        E-mailadres
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                            </svg>
                        </div>
                        <input type="email" 
                               id="email" 
                               name="email" 
                               value="{{ old('email') }}"
                               class="w-full pl-10 pr-3 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-tcr-green transition"
                               placeholder="student@tcr.nl"
                               required>
                    </div>
                </div>

                <!-- Wachtwoord -->
                <div>
                    <label for="password" class="block text-sm font-bold text-tcr-gray mb-2">
                        Wachtwoord
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                        <input type="password" 
                               id="password" 
                               name="password" 
                               class="w-full pl-10 pr-3 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-tcr-green transition"
                               placeholder="••••••••"
                               required>
                    </div>
                </div>

                <!-- Remember me -->
                <div class="flex items-center justify-between">
                    <label class="flex items-center cursor-pointer">
                        <input type="checkbox" name="remember" class="rounded border-gray-300 text-tcr-green focus:ring-tcr-green mr-2">
                        <span class="text-sm text-gray-600">Onthoud mij</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                        class="w-full bg-tcr-green hover:bg-tcr-dark-green text-white py-3 rounded-lg font-bold text-lg transition duration-200 transform hover:scale-105">
                    Inloggen
                </button>
            </form>

            <!-- Divider -->
            <div class="mt-6 relative">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-2 bg-white text-gray-500">Of</span>
                </div>
            </div>

            <!-- Register link -->
            <div class="mt-6 text-center">
                <p class="text-gray-600">
                    Nog geen account?
                    <a href="/register" class="font-bold text-tcr-green hover:text-tcr-dark-green transition">
                        Registreer nu
                    </a>
                </p>
            </div>

            <!-- Test Account Info -->
            <div class="mt-6 p-4 bg-tcr-light-green rounded-lg">
                <p class="text-xs font-bold text-tcr-green mb-2">Test accounts:</p>
                <div class="text-xs text-gray-600 space-y-1">
                    <p><span class="font-semibold">Admin:</span> admin@school.nl / admin123</p>
                    <p><span class="font-semibold">Student:</span> student@school.nl / student123</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
