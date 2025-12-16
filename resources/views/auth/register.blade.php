@extends('layouts.app')

@section('title', 'Registreren')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-white to-tcr-light-green">
    <div class="max-w-md w-full">
        <!-- Logo/Header -->
        <div class="text-center mb-8">
            <div class="w-20 h-20 bg-tcr-gold rounded-2xl flex items-center justify-center mx-auto mb-4">
                <span class="text-white font-bold text-3xl">TCR</span>
            </div>
            <h2 class="text-3xl font-bold text-tcr-gray">Word lid van TCR</h2>
            <p class="mt-2 text-gray-600">Maak een account aan om je keuzedelen te kiezen</p>
        </div>

        <!-- Register Card -->
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

            <form method="POST" action="/register" class="space-y-5">
                @csrf
                
                <!-- Persoonlijke gegevens sectie -->
                <div class="border-b border-gray-200 pb-4 mb-4">
                    <h3 class="text-lg font-bold text-tcr-green">Persoonlijke gegevens</h3>
                </div>

                <!-- Naam -->
                <div>
                    <label for="name" class="block text-sm font-bold text-tcr-gray mb-2">
                        Volledige naam *
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <input type="text" 
                               id="name" 
                               name="name" 
                               value="{{ old('name') }}"
                               class="w-full pl-10 pr-3 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-tcr-green transition"
                               placeholder="Jan Jansen"
                               required>
                    </div>
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-bold text-tcr-gray mb-2">
                        E-mailadres *
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
                               placeholder="j.jansen@student.tcr.nl"
                               required>
                    </div>
                </div>

                <!-- School gegevens sectie -->
                <div class="border-b border-gray-200 pb-4 mb-4 pt-2">
                    <h3 class="text-lg font-bold text-tcr-green">School gegevens</h3>
                </div>

                <!-- Grid voor studentnummer en klas -->
                <div class="grid grid-cols-2 gap-4">
                    <!-- Studentnummer -->
                    <div>
                        <label for="studentnummer" class="block text-sm font-bold text-tcr-gray mb-2">
                            Studentnummer
                        </label>
                        <input type="text" 
                               id="studentnummer" 
                               name="studentnummer" 
                               value="{{ old('studentnummer') }}"
                               class="w-full px-3 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-tcr-green transition"
                               placeholder="123456">
                    </div>

                    <!-- Klas -->
                    <div>
                        <label for="klas" class="block text-sm font-bold text-tcr-gray mb-2">
                            Klas
                        </label>
                        <input type="text" 
                               id="klas" 
                               name="klas" 
                               value="{{ old('klas') }}"
                               class="w-full px-3 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-tcr-green transition"
                               placeholder="SD2A">
                    </div>
                </div>

                <!-- Beveiliging sectie -->
                <div class="border-b border-gray-200 pb-4 mb-4 pt-2">
                    <h3 class="text-lg font-bold text-tcr-green">Beveiliging</h3>
                </div>

                <!-- Wachtwoord -->
                <div>
                    <label for="password" class="block text-sm font-bold text-tcr-gray mb-2">
                        Wachtwoord *
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
                               placeholder="Minimaal 6 tekens"
                               required>
                    </div>
                </div>

                <!-- Wachtwoord bevestigen -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-bold text-tcr-gray mb-2">
                        Wachtwoord bevestigen *
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                        <input type="password" 
                               id="password_confirmation" 
                               name="password_confirmation" 
                               class="w-full pl-10 pr-3 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-tcr-green transition"
                               placeholder="Herhaal wachtwoord"
                               required>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                        class="w-full bg-tcr-gold hover:bg-yellow-500 text-white py-3 rounded-lg font-bold text-lg transition duration-200 transform hover:scale-105">
                    Account aanmaken
                </button>
            </form>

            <!-- Login link -->
            <div class="mt-6 text-center">
                <p class="text-gray-600">
                    Heb je al een account?
                    <a href="/login" class="font-bold text-tcr-green hover:text-tcr-dark-green transition">
                        Log hier in
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
