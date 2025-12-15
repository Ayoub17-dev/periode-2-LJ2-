@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="max-w-6xl mx-auto">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Admin Dashboard</h1>

    <!-- Statistieken -->
    <div class="grid md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow-md p-6 text-center">
            <p class="text-3xl font-bold text-blue-600">{{ $stats['totaal_keuzedelen'] }}</p>
            <p class="text-gray-600">Totaal Keuzedelen</p>
        </div>
        <div class="bg-white rounded-lg shadow-md p-6 text-center">
            <p class="text-3xl font-bold text-green-600">{{ $stats['actieve_keuzedelen'] }}</p>
            <p class="text-gray-600">Actieve Keuzedelen</p>
        </div>
        <div class="bg-white rounded-lg shadow-md p-6 text-center">
            <p class="text-3xl font-bold text-purple-600">{{ $stats['totaal_inschrijvingen'] }}</p>
            <p class="text-gray-600">Inschrijvingen</p>
        </div>
        <div class="bg-white rounded-lg shadow-md p-6 text-center">
            <p class="text-3xl font-bold text-orange-600">{{ $stats['totaal_studenten'] }}</p>
            <p class="text-gray-600">Studenten</p>
        </div>
    </div>

    <!-- Snelle links -->
    <div class="grid md:grid-cols-2 gap-6">
        <a href="/admin/keuzedelen" class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
            <h2 class="text-xl font-bold text-gray-800 mb-2">📚 Keuzedelen Beheren</h2>
            <p class="text-gray-600">Voeg keuzedelen toe, bewerk ze, of zet ze aan/uit.</p>
        </a>
        <a href="/admin/inschrijvingen" class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
            <h2 class="text-xl font-bold text-gray-800 mb-2">📋 Inschrijvingen Bekijken</h2>
            <p class="text-gray-600">Bekijk wie zich heeft ingeschreven voor welk keuzedeel.</p>
        </a>
    </div>
</div>
@endsection
