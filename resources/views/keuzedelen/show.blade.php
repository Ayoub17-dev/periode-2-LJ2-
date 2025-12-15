@extends('layouts.app')

@section('title', $keuzedeel->naam)

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Terug knop -->
    <a href="/keuzedelen" class="text-blue-600 hover:underline mb-4 inline-block">
        ← Terug naar overzicht
    </a>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <!-- Header -->
        <div class="p-6 {{ $keuzedeel->is_vol ? 'bg-red-500' : 'bg-green-500' }} text-white">
            <span class="text-sm font-mono bg-white/20 px-2 py-1 rounded">{{ $keuzedeel->code }}</span>
            <h1 class="text-3xl font-bold mt-2">{{ $keuzedeel->naam }}</h1>
            <p class="mt-2">Periode {{ $keuzedeel->periode }}</p>
        </div>

        <div class="p-6">
            <!-- Beschrijving -->
            <div class="mb-6">
                <h2 class="text-xl font-bold text-gray-800 mb-2">Beschrijving</h2>
                <p class="text-gray-600 whitespace-pre-line">{{ $keuzedeel->beschrijving }}</p>
            </div>

            <!-- Statistieken -->
            <div class="grid md:grid-cols-3 gap-4 mb-6">
                <div class="bg-gray-50 rounded p-4 text-center">
                    <p class="text-2xl font-bold text-blue-600">{{ $keuzedeel->aantal_inschrijvingen }}</p>
                    <p class="text-gray-600">Inschrijvingen</p>
                </div>
                <div class="bg-gray-50 rounded p-4 text-center">
                    <p class="text-2xl font-bold text-blue-600">{{ $keuzedeel->max_studenten }}</p>
                    <p class="text-gray-600">Max plekken</p>
                </div>
                <div class="bg-gray-50 rounded p-4 text-center">
                    <p class="text-2xl font-bold text-blue-600">{{ $keuzedeel->min_studenten }}</p>
                    <p class="text-gray-600">Min om te starten</p>
                </div>
            </div>

            <!-- Status info -->
            <div class="mb-6">
                @if($keuzedeel->is_vol)
                    <div class="bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded">
                        <strong>Dit keuzedeel is vol!</strong> Er zijn geen plekken meer beschikbaar.
                    </div>
                @elseif(!$keuzedeel->kan_starten)
                    <div class="bg-yellow-100 border border-yellow-300 text-yellow-700 px-4 py-3 rounded">
                        <strong>Let op:</strong> Dit keuzedeel heeft nog niet genoeg inschrijvingen om te starten. 
                        Nog {{ $keuzedeel->min_studenten - $keuzedeel->aantal_inschrijvingen }} nodig.
                    </div>
                @else
                    <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded">
                        <strong>Dit keuzedeel gaat door!</strong> Er zijn genoeg inschrijvingen.
                    </div>
                @endif
            </div>

            <!-- Inschrijf knop -->
            @auth
                @if(!$keuzedeel->is_vol)
                    <form action="/inschrijven/{{ $keuzedeel->id }}" method="POST">
                        @csrf
                        <button type="submit" 
                                class="w-full bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 font-semibold">
                            Inschrijven voor dit keuzedeel
                        </button>
                    </form>
                @endif
            @else
                <div class="bg-blue-50 border border-blue-200 rounded p-4 text-center">
                    <p class="text-blue-800 mb-2">Je moet ingelogd zijn om je in te schrijven.</p>
                    <a href="/login" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Inloggen
                    </a>
                </div>
            @endauth
        </div>
    </div>
</div>
@endsection
