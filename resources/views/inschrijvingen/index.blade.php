@extends('layouts.app')

@section('title', 'Mijn Inschrijvingen')

@section('content')
<div class="max-w-4xl mx-auto">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Mijn Inschrijvingen</h1>

    @if($inschrijvingen->count() > 0)
        <div class="space-y-4">
            @foreach($inschrijvingen as $inschrijving)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-4 flex justify-between items-center 
                        {{ $inschrijving->status == 'accepted' ? 'bg-green-500' : ($inschrijving->status == 'pending' ? 'bg-yellow-500' : 'bg-red-500') }} text-white">
                        <div>
                            <span class="font-mono text-sm">{{ $inschrijving->keuzedeel->code }}</span>
                            <span class="font-bold ml-2">{{ $inschrijving->keuzedeel->naam }}</span>
                        </div>
                        <span class="bg-white/20 px-3 py-1 rounded text-sm">
                            @if($inschrijving->status == 'accepted')
                                Ingeschreven
                            @elseif($inschrijving->status == 'pending')
                                In behandeling
                            @else
                                Afgewezen
                            @endif
                        </span>
                    </div>
                    <div class="p-4">
                        <div class="grid md:grid-cols-3 gap-4 text-sm">
                            <div>
                                <span class="text-gray-600">Periode:</span>
                                <span class="font-semibold">{{ $inschrijving->periode }}</span>
                            </div>
                            <div>
                                <span class="text-gray-600">Ingeschreven op:</span>
                                <span class="font-semibold">{{ $inschrijving->created_at->format('d-m-Y H:i') }}</span>
                            </div>
                            <div>
                                <span class="text-gray-600">Studenten:</span>
                                <span class="font-semibold">{{ $inschrijving->keuzedeel->aantal_inschrijvingen }}/{{ $inschrijving->keuzedeel->max_studenten }}</span>
                            </div>
                        </div>

                        <!-- Waarschuwing als te weinig studenten -->
                        @if(!$inschrijving->keuzedeel->kan_starten)
                            <div class="mt-4 bg-yellow-100 border border-yellow-300 text-yellow-700 px-4 py-2 rounded text-sm">
                                Let op: Dit keuzedeel heeft nog niet genoeg inschrijvingen om te starten. 
                                Nog {{ $inschrijving->keuzedeel->min_studenten - $inschrijving->keuzedeel->aantal_inschrijvingen }} nodig.
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-white rounded-lg shadow-md p-8 text-center">
            <p class="text-gray-600 mb-4">Je hebt je nog niet ingeschreven voor een keuzedeel.</p>
            <a href="/keuzedelen" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                Bekijk Keuzedelen
            </a>
        </div>
    @endif
</div>
@endsection
