@extends('layouts.app')

@section('title', 'Keuzedelen Overzicht')

@section('content')
<div class="max-w-6xl mx-auto">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Beschikbare Keuzedelen</h1>

    <!-- Filter op periode -->
    <div class="bg-white rounded-lg shadow-md p-4 mb-6">
        <form method="GET" action="/keuzedelen" class="flex items-center space-x-4">
            <label class="font-semibold">Filter op periode:</label>
            <select name="periode" class="border rounded px-3 py-2">
                <option value="">Alle periodes</option>
                <option value="1" {{ request('periode') == '1' ? 'selected' : '' }}>Periode 1</option>
                <option value="2" {{ request('periode') == '2' ? 'selected' : '' }}>Periode 2</option>
                <option value="3" {{ request('periode') == '3' ? 'selected' : '' }}>Periode 3</option>
                <option value="4" {{ request('periode') == '4' ? 'selected' : '' }}>Periode 4</option>
            </select>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Filteren
            </button>
        </form>
    </div>

    <!-- Keuzedelen grid -->
    @if($keuzedelen->count() > 0)
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($keuzedelen as $keuzedeel)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <!-- Header met kleur op basis van status -->
                    <div class="p-4 {{ $keuzedeel->is_vol ? 'bg-red-500' : 'bg-green-500' }} text-white">
                        <span class="text-sm font-mono">{{ $keuzedeel->code }}</span>
                        <h2 class="text-xl font-bold">{{ $keuzedeel->naam }}</h2>
                    </div>
                    
                    <div class="p-4">
                        <p class="text-gray-600 mb-4">
                            {{ Str::limit($keuzedeel->beschrijving, 100) }}
                        </p>
                        
                        <!-- Info -->
                        <div class="text-sm text-gray-500 space-y-1 mb-4">
                            <p><strong>Periode:</strong> {{ $keuzedeel->periode }}</p>
                            <p><strong>Plekken:</strong> {{ $keuzedeel->aantal_inschrijvingen }}/{{ $keuzedeel->max_studenten }}</p>
                            <p>
                                <strong>Status:</strong>
                                @if($keuzedeel->is_vol)
                                    <span class="text-red-600 font-semibold">Vol</span>
                                @else
                                    <span class="text-green-600 font-semibold">Beschikbaar</span>
                                @endif
                            </p>
                        </div>

                        <!-- Knoppen -->
                        <div class="flex space-x-2">
                            <a href="/keuzedelen/{{ $keuzedeel->id }}" 
                               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 text-sm">
                                Meer Info
                            </a>
                            
                            @auth
                                @if(!$keuzedeel->is_vol)
                                    <form action="/inschrijven/{{ $keuzedeel->id }}" method="POST">
                                        @csrf
                                        <button type="submit" 
                                                class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 text-sm">
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
        <div class="bg-white rounded-lg shadow-md p-8 text-center">
            <p class="text-gray-600">Er zijn nog geen keuzedelen beschikbaar.</p>
        </div>
    @endif
</div>
@endsection
