@extends('layouts.app')

@section('title', 'Nieuw Keuzedeel')

@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Nieuw Keuzedeel Toevoegen</h1>

    <div class="bg-white rounded-lg shadow-md p-6">
        <!-- Fouten tonen -->
        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="/admin/keuzedelen">
            @csrf

            <!-- Code -->
            <div class="mb-4">
                <label for="code" class="block text-gray-700 font-semibold mb-2">Keuzedeel Code *</label>
                <input type="text" id="code" name="code" value="{{ old('code') }}"
                       class="w-full border rounded px-3 py-2" placeholder="Bijv: K0001" required>
            </div>

            <!-- Naam -->
            <div class="mb-4">
                <label for="naam" class="block text-gray-700 font-semibold mb-2">Naam *</label>
                <input type="text" id="naam" name="naam" value="{{ old('naam') }}"
                       class="w-full border rounded px-3 py-2" placeholder="Bijv: Verdieping Software" required>
            </div>

            <!-- Beschrijving -->
            <div class="mb-4">
                <label for="beschrijving" class="block text-gray-700 font-semibold mb-2">Beschrijving</label>
                <textarea id="beschrijving" name="beschrijving" rows="4"
                          class="w-full border rounded px-3 py-2" 
                          placeholder="Beschrijf wat studenten leren in dit keuzedeel...">{{ old('beschrijving') }}</textarea>
            </div>

            <!-- Periode -->
            <div class="mb-4">
                <label for="periode" class="block text-gray-700 font-semibold mb-2">Periode *</label>
                <select id="periode" name="periode" class="w-full border rounded px-3 py-2" required>
                    <option value="1" {{ old('periode') == '1' ? 'selected' : '' }}>Periode 1</option>
                    <option value="2" {{ old('periode') == '2' ? 'selected' : '' }}>Periode 2</option>
                    <option value="3" {{ old('periode') == '3' ? 'selected' : '' }}>Periode 3</option>
                    <option value="4" {{ old('periode') == '4' ? 'selected' : '' }}>Periode 4</option>
                </select>
            </div>

            <!-- Max en Min studenten -->
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="max_studenten" class="block text-gray-700 font-semibold mb-2">Max Studenten *</label>
                    <input type="number" id="max_studenten" name="max_studenten" 
                           value="{{ old('max_studenten', 30) }}"
                           class="w-full border rounded px-3 py-2" min="1" required>
                </div>
                <div>
                    <label for="min_studenten" class="block text-gray-700 font-semibold mb-2">Min Studenten *</label>
                    <input type="number" id="min_studenten" name="min_studenten" 
                           value="{{ old('min_studenten', 15) }}"
                           class="w-full border rounded px-3 py-2" min="1" required>
                </div>
            </div>

            <!-- Checkboxes -->
            <div class="mb-6 space-y-2">
                <label class="flex items-center">
                    <input type="checkbox" name="is_actief" class="mr-2" checked>
                    <span>Actief (zichtbaar voor studenten)</span>
                </label>
                <label class="flex items-center">
                    <input type="checkbox" name="herhaalbaar" class="mr-2">
                    <span>Herhaalbaar (studenten mogen dit meerdere keren doen)</span>
                </label>
            </div>

            <!-- Knoppen -->
            <div class="flex space-x-4">
                <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
                    Opslaan
                </button>
                <a href="/admin/keuzedelen" class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600">
                    Annuleren
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
