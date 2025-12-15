@extends('layouts.app')

@section('title', 'Inloggen')

@section('content')
<div class="max-w-md mx-auto">
    <div class="bg-white rounded-lg shadow-md p-8">
        <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Inloggen</h1>

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

        <form method="POST" action="/login">
            @csrf
            
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

            <!-- Wachtwoord -->
            <div class="mb-6">
                <label for="password" class="block text-gray-700 font-semibold mb-2">Wachtwoord</label>
                <input type="password" 
                       id="password" 
                       name="password" 
                       class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-500"
                       required>
            </div>

            <!-- Onthoud mij -->
            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="mr-2">
                    <span class="text-gray-600">Onthoud mij</span>
                </label>
            </div>

            <!-- Submit -->
            <button type="submit" 
                    class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 font-semibold">
                Inloggen
            </button>
        </form>

        <p class="text-center text-gray-600 mt-4">
            Nog geen account? 
            <a href="/register" class="text-blue-600 hover:underline">Registreren</a>
        </p>
    </div>
</div>
@endsection
