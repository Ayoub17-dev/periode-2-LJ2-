@extends('layouts.app')

@section('title', 'Student Login - TCR Keuzedelen')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 -mt-40">
    <div class="max-w-md w-full space-y-8">
        <!-- Login Card -->
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
            <!-- Card Header -->
            <div class="bg-gradient-to-r from-tcr-gold to-tcr-dark-gold p-6">
                <div class="text-center">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-white/20 backdrop-blur rounded-full mb-4">
                        <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-black text-tcr-black">Student Portal</h2>
                    <p class="text-tcr-black/70 mt-1">Toegang tot je keuzedelen</p>
                </div>
            </div>
            
            <!-- Form Section -->
            <div class="p-8">
                @if($errors->any())
                    <div class="alert-tcr-error mb-6">
                        <p class="font-bold mb-1">⚠️ Fout bij inloggen</p>
                        @foreach($errors->all() as $error)
                            <p class="text-sm">{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="/login" class="space-y-6">
                    @csrf
                    
                    <!-- Email Field -->
                    <div>
                        <label for="email" class="block text-sm font-bold text-tcr-black mb-2">
                            Email Adres
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <input type="email" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email') }}"
                                   class="pl-10 w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:border-tcr-gold focus:outline-none transition"
                                   placeholder="naam@student.tcr.nl"
                                   required>
                        </div>
                    </div>
                    
                    <!-- Password Field -->
                    <div>
                        <label for="password" class="block text-sm font-bold text-tcr-black mb-2">
                            Wachtwoord
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                            </div>
                            <input type="password" 
                                   id="password" 
                                   name="password"
                                   class="pl-10 w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:border-tcr-gold focus:outline-none transition"
                                   placeholder="••••••••"
                                   required>
                        </div>
                    </div>
                    
                    <!-- Remember Me -->
                    <div class="flex items-center justify-between">
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" name="remember" class="mr-2 w-4 h-4 text-tcr-gold border-gray-300 rounded focus:ring-tcr-gold">
                            <span class="text-sm text-tcr-gray">Blijf ingelogd</span>
                        </label>
                        <a href="#" class="text-sm text-tcr-gold hover:text-tcr-dark-gold font-semibold">
                            Wachtwoord vergeten?
                        </a>
                    </div>
                    
                    <!-- Submit Button -->
                    <button type="submit" class="w-full btn-tcr-primary py-3 text-lg">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                        </svg>
                        Inloggen
                    </button>
                </form>
                
                <!-- Divider -->
                <div class="relative my-6">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-4 bg-white text-gray-500">Of</span>
                    </div>
                </div>
                
                <!-- Register Link -->
                <div class="text-center">
                    <p class="text-gray-600 mb-2">Nog geen account?</p>
                    <a href="/register" class="inline-block w-full btn-tcr-secondary py-3">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                        </svg>
                        Maak een Account
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Help Cards -->
        <div class="grid md:grid-cols-2 gap-4">
            <!-- Tip Card -->
            <div class="bg-gradient-to-r from-tcr-gold to-tcr-dark-gold rounded-xl p-4 text-center">
                <div class="flex items-start space-x-3">
                    <span class="text-2xl">💡</span>
                    <div class="text-left">
                        <p class="font-bold text-tcr-black text-sm">Eerste keer?</p>
                        <p class="text-tcr-black/70 text-xs mt-1">
                            Gebruik je studentnummer als wachtwoord
                        </p>
                    </div>
                </div>
            </div>
            
            <!-- Test Accounts -->
            <div class="bg-white rounded-xl p-4 shadow-lg">
                <div class="flex items-start space-x-3">
                    <span class="text-2xl">🧪</span>
                    <div class="text-left">
                        <p class="font-bold text-tcr-black text-sm">Test Account</p>
                        <p class="text-gray-600 text-xs mt-1 font-mono">
                            admin@school.nl / admin123
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
