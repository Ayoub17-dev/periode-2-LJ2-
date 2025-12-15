@extends('layouts.app')

@section('title', 'Keuzedelen Beheren')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Keuzedelen Beheren</h1>
        <a href="/admin/keuzedelen/nieuw" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            + Nieuw Keuzedeel
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-3 text-left">Code</th>
                    <th class="px-4 py-3 text-left">Naam</th>
                    <th class="px-4 py-3 text-left">Periode</th>
                    <th class="px-4 py-3 text-left">Inschrijvingen</th>
                    <th class="px-4 py-3 text-left">Status</th>
                    <th class="px-4 py-3 text-left">Acties</th>
                </tr>
            </thead>
            <tbody>
                @forelse($keuzedelen as $keuzedeel)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="px-4 py-3 font-mono">{{ $keuzedeel->code }}</td>
                        <td class="px-4 py-3">{{ $keuzedeel->naam }}</td>
                        <td class="px-4 py-3">{{ $keuzedeel->periode }}</td>
                        <td class="px-4 py-3">
                            {{ $keuzedeel->aantal_inschrijvingen }}/{{ $keuzedeel->max_studenten }}
                            @if($keuzedeel->is_vol)
                                <span class="text-red-600 text-sm">(Vol)</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            @if($keuzedeel->is_actief)
                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-sm">Actief</span>
                            @else
                                <span class="bg-red-100 text-red-800 px-2 py-1 rounded text-sm">Inactief</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex space-x-2">
                                <a href="/admin/keuzedelen/{{ $keuzedeel->id }}/bewerk" 
                                   class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700">
                                    Bewerk
                                </a>
                                <form action="/admin/keuzedelen/{{ $keuzedeel->id }}" method="POST" 
                                      onsubmit="return confirm('Weet je zeker dat je dit keuzedeel wilt verwijderen?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="bg-red-600 text-white px-3 py-1 rounded text-sm hover:bg-red-700">
                                        Verwijder
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-8 text-center text-gray-500">
                            Nog geen keuzedelen. Klik op "Nieuw Keuzedeel" om er een toe te voegen.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        <a href="/admin" class="text-blue-600 hover:underline">← Terug naar dashboard</a>
    </div>
</div>
@endsection
