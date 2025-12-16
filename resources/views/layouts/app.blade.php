<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Keuzedelen') | Techniek College Rotterdam</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'tcr-green': '#00843D',
                        'tcr-dark-green': '#006030',
                        'tcr-light-green': '#E8F5E9',
                        'tcr-gold': '#FFB81C',
                        'tcr-gray': '#4A5568',
                        'tcr-light-gray': '#F7FAFC',
                    },
                    fontFamily: {
                        'sans': ['Open Sans', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        .hero-pattern {
            background-image: linear-gradient(135deg, #00843D 0%, #006030 100%);
        }
        .gold-accent {
            background: linear-gradient(90deg, #FFB81C 0%, #FFA000 100%);
        }
    </style>
</head>
<body class="bg-white min-h-screen flex flex-col font-sans">
    <!-- Top Bar -->
    <div class="bg-tcr-dark-green text-white py-2">
        <div class="container mx-auto px-4 text-sm flex justify-between">
            <span>Techniek College Rotterdam - Keuzedelen Systeem</span>
            <span>Je toekomst is goud waard</span>
        </div>
    </div>

    <!-- Navigatie -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <!-- Logo/Title -->
                <a href="/" class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-tcr-green rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold text-xl">TCR</span>
                    </div>
                    <div>
                        <span class="text-tcr-green font-bold text-xl block leading-tight">Keuzedelen</span>
                        <span class="text-tcr-gray text-xs">Techniek College Rotterdam</span>
                    </div>
                </a>

                <!-- Menu Items -->
                <div class="flex items-center space-x-1">
                    <a href="/" class="px-4 py-2 text-tcr-gray hover:text-tcr-green hover:bg-tcr-light-green rounded-lg transition duration-200 font-semibold">
                        Home
                    </a>
                    <a href="/keuzedelen" class="px-4 py-2 text-tcr-gray hover:text-tcr-green hover:bg-tcr-light-green rounded-lg transition duration-200 font-semibold">
                        Keuzedelen
                    </a>
                    @auth
                        <a href="/mijn-inschrijvingen" class="px-4 py-2 text-tcr-gray hover:text-tcr-green hover:bg-tcr-light-green rounded-lg transition duration-200 font-semibold">
                            Mijn Inschrijvingen
                        </a>
                        @if(auth()->user()->isAdmin())
                            <a href="/admin" class="px-4 py-2 text-tcr-gray hover:text-tcr-green hover:bg-tcr-light-green rounded-lg transition duration-200 font-semibold">
                                Admin
                            </a>
                        @endif
                    @endauth

                    <!-- User Section -->
                    <div class="ml-6 pl-6 border-l-2 border-gray-200 flex items-center space-x-2">
                        @auth
                            <div class="flex items-center space-x-3">
                                <div class="text-right">
                                    <p class="text-sm font-semibold text-tcr-gray">{{ auth()->user()->name }}</p>
                                    <p class="text-xs text-gray-500">{{ auth()->user()->rol }}</p>
                                </div>
                                <form action="/logout" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-tcr-gold hover:bg-yellow-500 text-white px-4 py-2 rounded-lg font-semibold transition duration-200">
                                        Uitloggen
                                    </button>
                                </form>
                            </div>
                        @else
                            <a href="/login" class="bg-tcr-green hover:bg-tcr-dark-green text-white px-5 py-2 rounded-lg font-semibold transition duration-200">
                                Inloggen
                            </a>
                            <a href="/register" class="bg-tcr-gold hover:bg-yellow-500 text-white px-5 py-2 rounded-lg font-semibold transition duration-200">
                                Registreren
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hoofdinhoud -->
    <main class="flex-grow">
        <!-- Succes en error berichten -->
        <div class="container mx-auto px-4">
            @if(session('success'))
                <div class="bg-green-50 border-l-4 border-tcr-green text-green-800 p-4 my-4 rounded-r-lg shadow-sm">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span class="font-semibold">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-50 border-l-4 border-red-500 text-red-800 p-4 my-4 rounded-r-lg shadow-sm">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                        <span class="font-semibold">{{ session('error') }}</span>
                    </div>
                </div>
            @endif
        </div>

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-tcr-dark-green text-white mt-12">
        <div class="container mx-auto px-4 py-8">
            <div class="grid md:grid-cols-3 gap-8">
                <div>
                    <h3 class="font-bold text-tcr-gold mb-3">Techniek College Rotterdam</h3>
                    <p class="text-sm text-gray-300">
                        De grootste technische opleider in de regio Rotterdam-Rijnmond
                    </p>
                </div>
                <div>
                    <h3 class="font-bold text-tcr-gold mb-3">Contact</h3>
                    <p class="text-sm text-gray-300">
                        Jan Ligthartstraat 250<br>
                        3083 AM Rotterdam<br>
                        info@tcr.nl
                    </p>
                </div>
                <div>
                    <h3 class="font-bold text-tcr-gold mb-3">Volg ons</h3>
                    <p class="text-sm text-gray-300">
                        Blijf op de hoogte van het laatste nieuws
                    </p>
                </div>
            </div>
            <div class="border-t border-green-800 mt-6 pt-6 text-center text-sm text-gray-300">
                <p>&copy; {{ date('Y') }} Techniek College Rotterdam - Alle rechten voorbehouden</p>
            </div>
        </div>
    </footer>
</body>
</html>
