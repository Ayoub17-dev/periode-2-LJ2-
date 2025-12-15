@extends('layouts.app')

@section('title', 'Inschrijvingen Overzicht')

@section('content')
<div class="max-w-6xl mx-auto">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Inschrijvingen Overzicht</h1>

    <!-- Per keuzedeel -->
    <div class="mb-8">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Per Keuzedeel</h2>
        
        @forelse($perKeuzedeel as $keuzedeel_id => $groep)
            @php $keuzedeel = $groep->first()->keuzedeel; @endphp
            <div class="bg-white rounded-lg shadow-md mb-4 overflow-hidden">
                <div class="bg-blue-600 text-white px-4 py-3 flex justify-between items-center">
                    <div>
                        <span class="font-mono text-sm">{{ $keuzedeel->code }}</span>
                        <span class="font-bold ml-2">{{ $keuzedeel->naam }}</span>
                        <span class="ml-2">(Periode {{ $keuzedeel->periode }})</span>
                    </div>
                    <span class="bg-white/20 px-3 py-1 rounded">
                        {{ $groep->count() }}/{{ $keuzedeel->max_studenten }} studenten
                    </span>
                </div>
                <div class="p-4">
                    <table class="w-full">
                        <thead>
                            <tr class="text-left text-gray-600">
                                <th class="pb-2">Studentnummer</th>
                                <th class="pb-2">Naam</th>
                                <th class="pb-2">Klas</th>
                                <th class="pb-2">Email</th>
                                <th class="pb-2">Ingeschreven op</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($groep as $inschrijving)
                                <tr class="border-t">
                                    <td class="py-2 font-mono">{{ $inschrijving->user->studentnummer ?? '-' }}</td>
                                    <td class="py-2">{{ $inschrijving->user->name }}</td>
                                    <td class="py-2">{{ $inschrijving->user->klas ?? '-' }}</td>
                                    <td class="py-2">{{ $inschrijving->user->email }}</td>
                                    <td class="py-2">{{ $inschrijving->created_at->format('d-m-Y H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Waarschuwing als te weinig studenten -->
                    @if($groep->count() < $keuzedeel->min_studenten)
                        <div class="mt-4 bg-yellow-100 border border-yellow-300 text-yellow-700 px-4 py-2 rounded">
                            Let op: Dit keuzedeel heeft nog {{ $keuzedeel->min_studenten - $groep->count() }} 
                            student(en) nodig om te kunnen starten!
                        </div>
                    @endif
                </div>
            </div>
        @empty
            <div class="bg-white rounded-lg shadow-md p-8 text-center text-gray-500">
                Er zijn nog geen inschrijvingen.
            </div>
        @endforelse
    </div>

    <!-- Alle inschrijvingen lijst -->
    <div>
        <h2 class="text-xl font-bold text-gray-800 mb-4">Alle Inschrijvingen (Chronologisch)</h2>
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-3 text-left">Datum</th>
                        <th class="px-4 py-3 text-left">Student</th>
                        <th class="px-4 py-3 text-left">Keuzedeel</th>
                        <th class="px-4 py-3 text-left">Periode</th>
                        <th class="px-4 py-3 text-left">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($inschrijvingen as $inschrijving)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-4 py-3">{{ $inschrijving->created_at->format('d-m-Y H:i') }}</td>
                            <td class="px-4 py-3">{{ $inschrijving->user->name }}</td>
                            <td class="px-4 py-3">{{ $inschrijving->keuzedeel->naam }}</td>
                            <td class="px-4 py-3">{{ $inschrijving->periode }}</td>
                            <td class="px-4 py-3">
                                @if($inschrijving->status == 'accepted')
                                    <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-sm">Geaccepteerd</span>
                                @elseif($inschrijving->status == 'pending')
                                    <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-sm">In behandeling</span>
                                @else
                                    <span class="bg-red-100 text-red-800 px-2 py-1 rounded text-sm">Afgewezen</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-8 text-center text-gray-500">
                                Er zijn nog geen inschrijvingen.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        <a href="/admin" class="text-blue-600 hover:underline">← Terug naar dashboard</a>
    </div>
</div>
@endsection
