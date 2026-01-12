<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Techniek College Rotterdam')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/tcr-style.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; }
    </style>
</head>
<body class="min-h-screen flex flex-col bg-white text-gray-900">
    <!-- Professional Navigation -->
    <nav class="bg-white border-b border-gray-200 sticky top-0 z-50">
        <div class="container mx-auto px-6">
            <div class="flex items-center justify-between h-20">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center space-x-3">
                    <div class="font-black text-2xl">
                        <span style="color: #0F4F30;">TCR</span>
                        <span style="color: #C7D400;">.</span>
                    </div>
                    <div class="text-sm font-medium" style="color: #6B6B6B;">Keuzedelen</div>
                </a>
                
                <!-- Desktop Navigation -->
                <div class="hidden lg:flex items-center space-x-1">
                    <a href="{{ route('home') }}" class="px-5 py-6 font-medium transition-colors" style="color: #1F1F1F;" onmouseover="this.style.color='#0F4F30'" onmouseout="this.style.color='#1F1F1F'">Home</a>
                    <a href="{{ route('keuzedelen.index') }}" class="px-5 py-6 font-medium transition-colors" style="color: #1F1F1F;" onmouseover="this.style.color='#0F4F30'" onmouseout="this.style.color='#1F1F1F'">Keuzedelen</a>
                    
                    @auth
                        @if(Auth::user()->rol == 'admin')
                            <a href="{{ route('admin.index') }}" class="px-5 py-6 font-medium transition-colors" style="color: #1F1F1F;" onmouseover="this.style.color='#0F4F30'" onmouseout="this.style.color='#1F1F1F'">Dashboard</a>
                        @endif
                        
                        @if(Auth::user()->rol == 'student')
                            <a href="{{ route('inschrijvingen.index') }}" class="px-5 py-6 font-medium transition-colors" style="color: #1F1F1F;" onmouseover="this.style.color='#0F4F30'" onmouseout="this.style.color='#1F1F1F'">Mijn Inschrijvingen</a>
                        @endif
                        
                        <div class="flex items-center gap-3 ml-6 pl-6 border-l border-gray-200">
                            <span class="text-gray-600 text-sm">{{ Auth::user()->name }}</span>
                            <form action="{{ route('logout') }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="px-4 py-2 text-sm border border-gray-300 rounded hover:bg-gray-50 transition-colors">Uitloggen</button>
                            </form>
                        </div>
                    @else
                        <div class="flex items-center gap-3 ml-6 pl-6 border-l border-gray-200">
                            <a href="{{ route('login') }}" class="px-5 py-6 font-medium transition-colors" style="color: #1F1F1F;" onmouseover="this.style.color='#0F4F30'" onmouseout="this.style.color='#1F1F1F'">Inloggen</a>
                            <a href="{{ route('register') }}" class="px-6 py-2.5 font-semibold rounded transition-colors" style="background-color: #C7D400; color: #1F1F1F;" onmouseover="this.style.backgroundColor='#B8C500'" onmouseout="this.style.backgroundColor='#C7D400'">Aanmelden</a>
                        </div>
                    @endauth
                </div>
                
                <!-- Mobile menu button -->
                <div class="lg:hidden">
                    <button type="button" class="text-tcr-black hover:text-tcr-yellow" onclick="toggleMobileMenu()">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Mobile Navigation -->
        <div id="mobile-menu" class="hidden lg:hidden border-t border-gray-200">
            <div class="px-4 py-3 space-y-2 bg-white">
                <a href="{{ route('home') }}" class="block nav-link-tcr py-2">Home</a>
                <a href="{{ route('keuzedelen.index') }}" class="block nav-link-tcr py-2">Keuzedelen</a>
                @auth
                    @if(Auth::user()->rol == 'admin')
                        <a href="{{ route('admin.index') }}" class="block nav-link-tcr py-2">Admin</a>
                    @endif
                    
                    @if(Auth::user()->rol == 'student')
                        <a href="{{ route('inschrijvingen.index') }}" class="block nav-link-tcr py-2">Mijn Inschrijvingen</a>
                    @endif
                    
                    <div class="pt-2 mt-2 border-t border-gray-200">
                        <span class="block text-gray-600 mb-2">{{ Auth::user()->name }}</span>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-tcr btn-tcr-outline w-full mt-2">Uitloggen</button>
                        </form>
                    </div>
                @else
                    <div class="pt-2 mt-2 border-t border-gray-200">
                        <a href="{{ route('login') }}" class="block nav-link-tcr py-2">Inloggen</a>
                        <a href="{{ route('register') }}" class="bg-yellow-500 text-gray-900 hover:bg-yellow-400 px-4 py-2 rounded-full font-semibold block text-center mt-2">Aanmelden</a>
                    </div>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow">
        @if(session('success'))
            <div class="container mx-auto px-6 mt-4">
                <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded relative">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="container mx-auto px-6 mt-4">
                <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded relative">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Professional Footer -->
    <footer class="text-white mt-auto" style="background-color: #0F4F30;">
        <div class="container mx-auto px-6 py-12">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">TCR Keuzedelen</h3>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        Techniek College Rotterdam<br>
                        Jan Ligthartstraat 250<br>
                        3083 AM Rotterdam
                    </p>
                </div>
                
                <div>
                    <h4 class="font-semibold mb-4">Keuzedelen</h4>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li>12 Specialisaties</li>
                        <li>4 Periodes</li>
                        <li>Praktijkgericht onderwijs</li>
                        <li>Erkende certificering</li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="font-semibold mb-4">Contact</h4>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li>088 945 45 00</li>
                        <li><a href="mailto:info@tcrmbo.nl" class="hover:text-white transition-colors">info@tcrmbo.nl</a></li>
                        <li>Ma-Vr: 08:30 - 17:00</li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li><a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a></li>
                        <li><a href="{{ route('keuzedelen.index') }}" class="hover:text-white transition-colors">Alle Keuzedelen</a></li>
                        <li><a href="{{ route('login') }}" class="hover:text-white transition-colors">Student Portal</a></li>
                        <li><a href="{{ route('register') }}" class="hover:text-white transition-colors">Aanmelden</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400 text-sm">
                <p>&copy; {{ date('Y') }} Techniek College Rotterdam. Alle rechten voorbehouden.</p>
            </div>
        </div>
    </footer>
    
    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        }
    </script>
</body>
</html>
