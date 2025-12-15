@extends('layouts.app')

@section('title', 'Home - Keuzedelen')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Welkom sectie -->
    <div class="bg-white rounded-lg shadow-md p-8 mb-8">
        <h1 class="text-3xl font-bold text-blue-600 mb-4">Welkom bij Keuzedelen TCR</h1>
        <p class="text-gray-600 mb-4">
            Op deze website kun je informatie vinden over alle beschikbare keuzedelen 
            en je inschrijven voor het keuzedeel van jouw keuze.
        </p>
        
        @guest
            <div class="bg-blue-50 border border-blue-200 rounded p-4">
                <p class="text-blue-800">
                    <strong>Let op:</strong> Om je in te schrijven voor een keuzedeel moet je eerst inloggen.
                </p>
                <div class="mt-4 space-x-4">
                    <a href="/login" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Inloggen
                    </a>
                    <a href="/register" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
                        Registreren
                    </a>
                </div>
            </div>
        @else
            <a href="/keuzedelen" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 inline-block">
                Bekijk Keuzedelen
            </a>
        @endguest
    </div>

    <!-- Uitleg sectie -->
    <div class="grid md:grid-cols-2 gap-6">
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-3">📚 Voor Studenten</h2>
            <ul class="text-gray-600 space-y-2">
                <li>• Bekijk alle beschikbare keuzedelen</li>
                <li>• Lees de beschrijvingen en informatie</li>
                <li>• Schrijf je in voor 1 keuzedeel per periode</li>
                <li>• Zie welke keuzedelen je al hebt gedaan</li>
            </ul>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-3">⚙️ Belangrijke Info</h2>
            <ul class="text-gray-600 space-y-2">
                <li>• Max 30 studenten per keuzedeel</li>
                <li>• Min 15 studenten om te starten</li>
                <li>• Vol = Vol (wie het eerst komt...)</li>
                <li>• 1 keuzedeel per periode</li>
            </ul>
        </div>
    </div>
</div>
@endsection
