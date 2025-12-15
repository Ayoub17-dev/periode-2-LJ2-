<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Keuzedelen')</title>
    <!-- Tailwind CSS via CDN (makkelijk voor beginners) -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <!-- Navigatie -->
    <nav class="bg-blue-600 text-white p-4 shadow-lg">
        <div class="container mx-auto flex justify-between items-center">
            <a href="/" class="text-xl font-bold">Keuzedelen TCR</a>
            <div class="space-x-4">
                <a href="/" class="hover:underline">Home</a>
                <a href="/keuzedelen" class="hover:underline">Keuzedelen</a>
                @auth
                    <a href="/mijn-inschrijvingen" class="hover:underline">Mijn Inschrijvingen</a>
                    @if(auth()->user()->isAdmin())
                        <a href="/admin" class="hover:underline">Admin</a>
                    @endif
                    <span class="mx-2">|</span>
                    <span>{{ auth()->user()->name }}</span>
                    <form action="/logout" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="hover:underline">Uitloggen</button>
                    </form>
                @else
                    <a href="/login" class="hover:underline">Inloggen</a>
                    <a href="/register" class="hover:underline">Registreren</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Hoofdinhoud -->
    <main class="container mx-auto py-8 px-4">
        <!-- Succes en error berichten -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white p-4 mt-auto">
        <div class="container mx-auto text-center">
            <p>&copy; {{ date('Y') }} Keuzedelen TCR</p>
        </div>
    </footer>
</body>
</html>
