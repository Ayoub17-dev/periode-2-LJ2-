@extends('layouts.app')

@section('title', 'Keuzedelen')

@section('content')
<!-- Hero Sectie -->
<div class="hero-pattern py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-bold text-white">Ontdek je keuzedelen</h1>
        <p class="text-gray-100 mt-2 text-lg">Kies het keuzedeel dat jouw technische skills naar een hoger niveau tilt</p>
    </div>
</div>

<div class="container mx-auto px-4 py-8">
    <!-- Filter Sectie -->
    <div class="bg-white rounded-lg shadow-lg p-6 mb-8 border-l-4 border-tcr-gold">
        <form method="GET" action="/keuzedelen" class="flex flex-wrap items-center gap-4">
            <div class="flex-1 min-w-[200px]">
                <label class="block text-sm font-bold text-tcr-gray mb-2">Filter op periode:</label>
                <select name="periode" class="w-full border-2 border-gray-200 rounded-lg px-4 py-2 focus:border-tcr-green focus:outline-none transition">
                    <option value="">Alle periodes</option>
                    <option value="1" {{ request('periode') == '1' ? 'selected' : '' }}>Periode 1</option>
                    <option value="2" {{ request('periode') == '2' ? 'selected' : '' }}>Periode 2</option>
                    <option value="3" {{ request('periode') == '3' ? 'selected' : '' }}>Periode 3</option>
                    <option value="4" {{ request('periode') == '4' ? 'selected' : '' }}>Periode 4</option>
                </select>
            </div>
            <button type="submit" class="bg-tcr-green hover:bg-tcr-dark-green text-white px-6 py-2.5 rounded-lg font-bold transition duration-200 self-end">
                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                </svg>
                Filteren
            </button>
        </form>
    </div>

    <!-- Statistieken -->
    @if($keuzedelen->count() > 0)
        <div class="grid md:grid-cols-4 gap-4 mb-8">
            <div class="bg-white rounded-lg p-4 border-t-4 border-tcr-green text-center">
                <p class="text-3xl font-bold text-tcr-green">{{ $keuzedelen->count() }}</p>
                <p class="text-sm text-gray-600">Keuzedelen</p>
            </div>
            <div class="bg-white rounded-lg p-4 border-t-4 border-tcr-gold text-center">
                <p class="text-3xl font-bold text-tcr-gold">{{ $keuzedelen->where('is_vol', false)->count() }}</p>
                <p class="text-sm text-gray-600">Beschikbaar</p>
            </div>
            <div class="bg-white rounded-lg p-4 border-t-4 border-red-500 text-center">
                <p class="text-3xl font-bold text-red-500">{{ $keuzedelen->where('is_vol', true)->count() }}</p>
                <p class="text-sm text-gray-600">Vol</p>
            </div>
            <div class="bg-white rounded-lg p-4 border-t-4 border-tcr-green text-center">
                <p class="text-3xl font-bold text-tcr-green">4</p>
                <p class="text-sm text-gray-600">Periodes</p>
            </div>
        </div>
    @endif

    <!-- Keuzedelen Grid -->
    @if($keuzedelen->count() > 0)
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($keuzedelen as $keuzedeel)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <!-- Status Header -->
                    <div class="relative">
                        <div class="h-2 {{ $keuzedeel->is_vol ? 'bg-red-500' : 'bg-tcr-green' }}"></div>
                        @if($keuzedeel->is_vol)
                            <div class="absolute top-4 right-4 bg-red-500 text-white px-3 py-1 rounded-full text-xs font-bold">VOL</div>
                        @elseif($keuzedeel->aantal_inschrijvingen >= ($keuzedeel->max_studenten - 5))
                            <div class="absolute top-4 right-4 bg-tcr-gold text-white px-3 py-1 rounded-full text-xs font-bold">BIJNA VOL</div>
                        @endif
                    </div>
                    
                    <div class="p-6">
                        <!-- Header -->
                        <div class="mb-4">
                            <span class="inline-block bg-tcr-light-green text-tcr-green px-3 py-1 rounded-full text-xs font-bold mb-2">
                                {{ $keuzedeel->code }}
                            </span>
                            <h3 class="text-xl font-bold text-tcr-gray">{{ $keuzedeel->naam }}</h3>
                            <p class="text-sm text-gray-500 mt-1">Periode {{ $keuzedeel->periode }}</p>
                        </div>

                        <!-- Beschrijving -->
                        <p class="text-gray-600 mb-4 line-clamp-3">
                            {{ Str::limit($keuzedeel->beschrijving, 100) }}
                        </p>

                        <!-- Progress Bar -->
                        <div class="mb-4">
                            <div class="flex justify-between text-sm text-gray-600 mb-1">
                                <span>Bezetting</span>
                                <span class="font-bold">{{ $keuzedeel->aantal_inschrijvingen }}/{{ $keuzedeel->max_studenten }}</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="h-2 rounded-full {{ $keuzedeel->is_vol ? 'bg-red-500' : 'bg-tcr-green' }}" 
                                     style="width: {{ min(100, ($keuzedeel->aantal_inschrijvingen / $keuzedeel->max_studenten) * 100) }}%">
                                </div>
                            </div>
                        </div>

                        <!-- Waarschuwing -->
                        @if(!$keuzedeel->kan_starten)
                            <div class="bg-yellow-50 border-l-4 border-yellow-400 text-yellow-800 p-2 mb-4 text-xs">
                                Nog {{ $keuzedeel->min_studenten - $keuzedeel->aantal_inschrijvingen }} inschrijvingen nodig om te starten
                            </div>
                        @endif

                        <!-- Acties -->
                        <div class="flex gap-2">
                            <a href="/keuzedelen/{{ $keuzedeel->id }}" 
                               class="flex-1 text-center bg-white border-2 border-tcr-green text-tcr-green px-4 py-2 rounded-lg hover:bg-tcr-light-green font-bold transition duration-200">
                                Meer info
                            </a>
                            
                            @auth
                                @if(!$keuzedeel->is_vol)
                                    <form action="/inschrijven/{{ $keuzedeel->id }}" method="POST" class="flex-1">
                                        @csrf
                                        <button type="submit" 
                                                class="w-full bg-tcr-gold hover:bg-yellow-500 text-white px-4 py-2 rounded-lg font-bold transition duration-200">
                                            Inschrijven
                                        </button>
                                    </form>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-white rounded-lg shadow-lg p-12 text-center">
            <div class="w-20 h-20 bg-tcr-light-green rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-10 h-10 text-tcr-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-tcr-gray mb-2">Geen keuzedelen gevonden</h3>
            <p class="text-gray-600">Er zijn momenteel geen keuzedelen beschikbaar voor de geselecteerde periode.</p>
        </div>
    @endif
</div>
@endsection
