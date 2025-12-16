@extends('layouts.app')

@section('title', 'Home')

@section('content')
<!-- Hero Sectie -->
<div class="hero-pattern text-white">
    <div class="container mx-auto px-4 py-20">
        <div class="max-w-4xl">
            <h1 class="text-5xl font-bold mb-4">
                Jouw toekomst is <span class="text-tcr-gold">goud waard</span>
            </h1>
            <p class="text-xl mb-8 text-gray-100">
                Kies het keuzedeel dat bij jou past en versterk je technische vaardigheden. 
                Bij Techniek College Rotterdam investeren we in jouw toekomst.
            </p>
            @guest
                <div class="flex space-x-4">
                    <a href="/login" class="bg-white text-tcr-green px-6 py-3 rounded-lg font-bold hover:bg-gray-100 transition duration-200">
                        Inloggen om te starten
                    </a>
                    <a href="/register" class="gold-accent text-white px-6 py-3 rounded-lg font-bold hover:opacity-90 transition duration-200">
                        Maak een account aan
                    </a>
                </div>
            @else
                <a href="/keuzedelen" class="gold-accent text-white px-8 py-4 rounded-lg font-bold text-lg hover:opacity-90 transition duration-200 inline-block">
                    Bekijk alle keuzedelen →
                </a>
            @endguest
        </div>
    </div>
</div>

<!-- Info Cards -->
<div class="container mx-auto px-4 py-12">
    <div class="grid md:grid-cols-3 gap-8 -mt-10">
        <!-- Card 1 -->
        <div class="bg-white rounded-lg shadow-xl p-6 border-t-4 border-tcr-gold">
            <div class="w-12 h-12 bg-tcr-light-green rounded-lg flex items-center justify-center mb-4">
                <svg class="w-6 h-6 text-tcr-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-tcr-gray mb-2">Verdiep je kennis</h3>
            <p class="text-gray-600">
                Kies uit meer dan 20 verschillende keuzedelen om je technische kennis te verbreden.
            </p>
        </div>

        <!-- Card 2 -->
        <div class="bg-white rounded-lg shadow-xl p-6 border-t-4 border-tcr-green">
            <div class="w-12 h-12 bg-tcr-light-green rounded-lg flex items-center justify-center mb-4">
                <svg class="w-6 h-6 text-tcr-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-tcr-gray mb-2">Simpele inschrijving</h3>
            <p class="text-gray-600">
                Schrijf je met één klik in voor je favoriete keuzedeel. Vol = vol, dus wees er snel bij!
            </p>
        </div>

        <!-- Card 3 -->
        <div class="bg-white rounded-lg shadow-xl p-6 border-t-4 border-tcr-gold">
            <div class="w-12 h-12 bg-tcr-light-green rounded-lg flex items-center justify-center mb-4">
                <svg class="w-6 h-6 text-tcr-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-tcr-gray mb-2">Groei in je vakgebied</h3>
            <p class="text-gray-600">
                Ontwikkel jezelf met keuzedelen die perfect aansluiten bij jouw ambities en interesses.
            </p>
        </div>
    </div>
</div>

<!-- Hoe het werkt -->
<div class="bg-tcr-light-gray py-12">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center text-tcr-green mb-12">Hoe werkt het?</h2>
        
        <div class="grid md:grid-cols-4 gap-6">
            <!-- Stap 1 -->
            <div class="text-center">
                <div class="w-20 h-20 bg-tcr-green text-white rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4">
                    1
                </div>
                <h3 class="font-bold text-tcr-gray mb-2">Registreer</h3>
                <p class="text-sm text-gray-600">Maak een account aan met je studentgegevens</p>
            </div>

            <!-- Stap 2 -->
            <div class="text-center">
                <div class="w-20 h-20 bg-tcr-green text-white rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4">
                    2
                </div>
                <h3 class="font-bold text-tcr-gray mb-2">Bekijk</h3>
                <p class="text-sm text-gray-600">Ontdek alle beschikbare keuzedelen per periode</p>
            </div>

            <!-- Stap 3 -->
            <div class="text-center">
                <div class="w-20 h-20 bg-tcr-green text-white rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4">
                    3
                </div>
                <h3 class="font-bold text-tcr-gray mb-2">Kies</h3>
                <p class="text-sm text-gray-600">Selecteer het keuzedeel dat bij jou past</p>
            </div>

            <!-- Stap 4 -->
            <div class="text-center">
                <div class="w-20 h-20 bg-tcr-gold text-white rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4">
                    4
                </div>
                <h3 class="font-bold text-tcr-gray mb-2">Schrijf in</h3>
                <p class="text-sm text-gray-600">Bevestig je keuze en start je leertraject</p>
            </div>
        </div>
    </div>
</div>

<!-- Belangrijke info -->
<div class="container mx-auto px-4 py-12">
    <div class="bg-white rounded-lg shadow-lg p-8">
        <h2 class="text-2xl font-bold text-tcr-green mb-6">Belangrijke informatie</h2>
        
        <div class="grid md:grid-cols-2 gap-8">
            <div>
                <h3 class="font-bold text-tcr-gray mb-3 flex items-center">
                    <span class="w-2 h-2 bg-tcr-gold rounded-full mr-2"></span>
                    Inschrijfregels
                </h3>
                <ul class="space-y-2 text-gray-600 ml-4">
                    <li>✓ Maximaal 30 studenten per keuzedeel</li>
                    <li>✓ Minimaal 15 studenten om te starten</li>
                    <li>✓ Vol = vol (first come, first served)</li>
                    <li>✓ 1 keuzedeel per periode</li>
                </ul>
            </div>

            <div>
                <h3 class="font-bold text-tcr-gray mb-3 flex items-center">
                    <span class="w-2 h-2 bg-tcr-gold rounded-full mr-2"></span>
                    Voor studenten
                </h3>
                <ul class="space-y-2 text-gray-600 ml-4">
                    <li>✓ Bekijk alle beschikbare keuzedelen</li>
                    <li>✓ Lees uitgebreide beschrijvingen</li>
                    <li>✓ Volg je inschrijfstatus</li>
                    <li>✓ Check je voortgang</li>
                </ul>
            </div>
        </div>

        @guest
            <div class="mt-8 p-4 bg-tcr-light-green rounded-lg border-l-4 border-tcr-green">
                <p class="text-tcr-green font-semibold">
                    Klaar om te beginnen? Log in met je studentaccount om je in te schrijven voor keuzedelen.
                </p>
            </div>
        @endguest
    </div>
</div>
@endsection
