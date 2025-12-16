@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<!-- Hero Sectie -->
<div class="hero-pattern py-8">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-4xl font-bold text-white">Admin Dashboard</h1>
                <p class="text-gray-100 mt-2">Beheer keuzedelen en inschrijvingen</p>
            </div>
            <div class="text-right">
                <p class="text-tcr-gold font-bold text-2xl">{{ date('d-m-Y') }}</p>
                <p class="text-gray-100">Huidige periode: {{ ceil(date('n') / 3) }}</p>
            </div>
        </div>
    </div>
</div>

<div class="container mx-auto px-4 py-8">
    <!-- Statistieken Cards -->
    <div class="grid md:grid-cols-4 gap-6 -mt-6 mb-8">
        <!-- Totaal Keuzedelen -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden transform hover:scale-105 transition duration-200">
            <div class="h-2 bg-tcr-green"></div>
            <div class="p-6">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-12 h-12 bg-tcr-light-green rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-tcr-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <p class="text-3xl font-bold text-tcr-green">{{ $stats['totaal_keuzedelen'] }}</p>
                </div>
                <p class="text-gray-600 font-semibold">Totaal Keuzedelen</p>
                <p class="text-xs text-gray-500 mt-1">Alle keuzedelen in systeem</p>
            </div>
        </div>

        <!-- Actieve Keuzedelen -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden transform hover:scale-105 transition duration-200">
            <div class="h-2 bg-tcr-gold"></div>
            <div class="p-6">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-12 h-12 bg-yellow-50 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-tcr-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <p class="text-3xl font-bold text-tcr-gold">{{ $stats['actieve_keuzedelen'] }}</p>
                </div>
                <p class="text-gray-600 font-semibold">Actieve Keuzedelen</p>
                <p class="text-xs text-gray-500 mt-1">Zichtbaar voor studenten</p>
            </div>
        </div>

        <!-- Inschrijvingen -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden transform hover:scale-105 transition duration-200">
            <div class="h-2 bg-purple-600"></div>
            <div class="p-6">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-12 h-12 bg-purple-50 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                    <p class="text-3xl font-bold text-purple-600">{{ $stats['totaal_inschrijvingen'] }}</p>
                </div>
                <p class="text-gray-600 font-semibold">Inschrijvingen</p>
                <p class="text-xs text-gray-500 mt-1">Totaal aantal inschrijvingen</p>
            </div>
        </div>

        <!-- Studenten -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden transform hover:scale-105 transition duration-200">
            <div class="h-2 bg-red-500"></div>
            <div class="p-6">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-12 h-12 bg-red-50 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                    <p class="text-3xl font-bold text-red-500">{{ $stats['totaal_studenten'] }}</p>
                </div>
                <p class="text-gray-600 font-semibold">Studenten</p>
                <p class="text-xs text-gray-500 mt-1">Geregistreerde studenten</p>
            </div>
        </div>
    </div>

    <!-- Snelle Acties -->
    <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
        <h2 class="text-xl font-bold text-tcr-gray mb-4">Snelle Acties</h2>
        <div class="grid md:grid-cols-4 gap-4">
            <a href="/admin/keuzedelen/nieuw" class="flex items-center justify-center bg-tcr-green text-white p-4 rounded-lg hover:bg-tcr-dark-green transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                <span class="font-bold">Nieuw Keuzedeel</span>
            </a>
            <a href="/admin/keuzedelen" class="flex items-center justify-center bg-tcr-gold text-white p-4 rounded-lg hover:bg-yellow-500 transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                <span class="font-bold">Beheer Keuzedelen</span>
            </a>
            <a href="/admin/inschrijvingen" class="flex items-center justify-center bg-purple-600 text-white p-4 rounded-lg hover:bg-purple-700 transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v1a1 1 0 001 1h4a1 1 0 001-1v-1m3-2V8a2 2 0 00-2-2H8a2 2 0 00-2 2v6l2 2h8l2-2z"></path>
                </svg>
                <span class="font-bold">Inschrijvingen</span>
            </a>
            <button class="flex items-center justify-center bg-gray-600 text-white p-4 rounded-lg hover:bg-gray-700 transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                <span class="font-bold">Instellingen</span>
            </button>
        </div>
    </div>

    <!-- Management Cards -->
    <div class="grid md:grid-cols-2 gap-6">
        <!-- Keuzedelen Beheren -->
        <a href="/admin/keuzedelen" class="group bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition">
            <div class="h-2 bg-gradient-to-r from-tcr-green to-tcr-dark-green"></div>
            <div class="p-6">
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <h2 class="text-xl font-bold text-tcr-gray mb-2">Keuzedelen Beheren</h2>
                        <p class="text-gray-600">Beheer alle keuzedelen in het systeem. Voeg nieuwe toe, bewerk bestaande of schakel ze in/uit.</p>
                    </div>
                    <div class="w-16 h-16 bg-tcr-light-green rounded-full flex items-center justify-center group-hover:scale-110 transition">
                        <svg class="w-8 h-8 text-tcr-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                </div>
                <div class="flex items-center text-tcr-green font-bold">
                    Ga naar beheer
                    <svg class="w-5 h-5 ml-2 group-hover:translate-x-2 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </div>
            </div>
        </a>

        <!-- Inschrijvingen Bekijken -->
        <a href="/admin/inschrijvingen" class="group bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition">
            <div class="h-2 bg-gradient-to-r from-tcr-gold to-yellow-500"></div>
            <div class="p-6">
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <h2 class="text-xl font-bold text-tcr-gray mb-2">Inschrijvingen Bekijken</h2>
                        <p class="text-gray-600">Bekijk alle inschrijvingen per keuzedeel. Download overzichten en beheer de studentenlijsten.</p>
                    </div>
                    <div class="w-16 h-16 bg-yellow-50 rounded-full flex items-center justify-center group-hover:scale-110 transition">
                        <svg class="w-8 h-8 text-tcr-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                </div>
                <div class="flex items-center text-tcr-gold font-bold">
                    Bekijk overzicht
                    <svg class="w-5 h-5 ml-2 group-hover:translate-x-2 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </div>
            </div>
        </a>
    </div>
</div>
@endsection
