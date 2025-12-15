@extends('layouts.app')

@section('title', 'Registreren')

@section('content')
<div class="max-w-md mx-auto">
    <div class="bg-white rounded-lg shadow-md p-8">
        <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Registreren</h1>

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

        <form method="POST" action="/register">
            @csrf
            
            <!-- Naam -->
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-semibold mb-2">Naam</label>
                <input type="text" 
                       id="name" 
                       name="name" 
                       value="{{ old('name') }}"
                       class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-500"
                       required>
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-semibold mb-2">E-mailadres</label>
                <input type="email" 
                       id="email" 
                       name="email" 
                       value="{{ old('email') }}"
                       class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-500"
                       required>
            </div>

            <!-- Studentnummer -->
            <div class="mb-4">
                <label for="studentnummer" class="block text-gray-700 font-semibold mb-2">Studentnummer</label>
                <input type="text" 
                       id="studentnummer" 
                       name="studentnummer" 
                       value="{{ old('studentnummer') }}"
                       class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-500"
                       placeholder="Bijv: 123456">
            </div>

            <!-- Klas -->
            <div class="mb-4">
                <label for="klas" class="block text-gray-700 font-semibold mb-2">Klas</label>
                <input type="text" 
                       id="klas" 
                       name="klas" 
                       value="{{ old('klas') }}"
                       class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-500"
                       placeholder="Bijv: SD2A">
            </div>

            <!-- Wachtwoord -->
            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-semibold mb-2">Wachtwoord</label>
                <input type="password" 
                       id="password" 
                       name="password" 
                       class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-500"
                       required>
            </div>

            <!-- Wachtwoord bevestigen -->
            <div class="mb-6">
                <label for="password_confirmation" class="block text-gray-700 font-semibold mb-2">Wachtwoord bevestigen</label>
                <input type="password" 
                       id="password_confirmation" 
                       name="password_confirmation" 
                       class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-500"
                       required>
            </div>

            <!-- Submit -->
            <button type="submit" 
                    class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 font-semibold">
                Registreren
            </button>
        </form>

        <p class="text-center text-gray-600 mt-4">
            Al een account? 
            <a href="/login" class="text-blue-600 hover:underline">Inloggen</a>
        </p>
    </div>
</div>
@endsection
