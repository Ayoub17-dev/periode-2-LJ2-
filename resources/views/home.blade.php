@extends('layouts.app')

@section('title', 'Techniek College Rotterdam')

@section('content')
<!-- Professional Hero Section -->
<div class="hero-tcr relative overflow-hidden">
    <!-- Background Image -->
    <div class="absolute inset-0 bg-gradient-to-r from-black/70 to-black/50">
        <img src="https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80" 
             alt="Technische werkplaats" 
             class="w-full h-full object-cover">
    </div>
    
    <div class="container mx-auto px-6 relative z-10">
        <div class="py-24">
            <h1 class="text-5xl font-bold text-white mb-6">
                Welkom bij <span style="color: #C7D400;">TCR</span>
            </h1>
            <p class="text-xl text-white/90 mb-8 max-w-2xl">
                Techniek College Rotterdam - Jouw partner in technisch onderwijs. Ontdek onze keuzedelen en verbreed je vakkennis.
            </p>
            <div class="flex gap-4">
                <a href="/keuzedelen" class="btn-tcr btn-tcr-secondary">
                    BEKIJK KEUZEDELEN
                </a>
                @guest
                    <a href="/register" class="btn-tcr btn-tcr-outline border-white text-white hover:bg-white" style="hover:color: #0F4F30;">
                        REGISTREREN
                    </a>
                @endguest
            </div>
        </div>
    </div>
</div>

<!-- Over TCR Sectie -->
<div class="py-16 bg-white">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold mb-4" style="color: #0F4F30;">Techniek College Rotterdam</h2>
            <p class="text-lg" style="color: #6B6B6B;">Jouw toekomst in de techniek begint hier</p>
        </div>
        
        <div class="grid md:grid-cols-3 gap-8 mb-16">
            <div class="text-center">
                <div class="w-16 h-16 mx-auto mb-4 rounded-full flex items-center justify-center" style="background-color: #F2F2F2;">
                    <svg class="w-8 h-8" style="color: #0F4F30;" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"/>
                        <path d="M3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762z"/>
                        <path d="M9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-3" style="color: #1F1F1F;">Kwaliteitsonderwijs</h3>
                <p style="color: #6B6B6B;">Erkende opleidingen in de technische sector met moderne faciliteiten en ervaren docenten.</p>
            </div>
            
            <div class="text-center">
                <div class="w-16 h-16 mx-auto mb-4 rounded-full flex items-center justify-center" style="background-color: #F2F2F2;">
                    <svg class="w-8 h-8" style="color: #0F4F30;" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-3" style="color: #1F1F1F;">Praktijkgericht</h3>
                <p style="color: #6B6B6B;">Leren door te doen met echte projecten en moderne apparatuur uit het werkveld.</p>
            </div>
            
            <div class="text-center">
                <div class="w-16 h-16 mx-auto mb-4 rounded-full flex items-center justify-center" style="background-color: #F2F2F2;">
                    <svg class="w-8 h-8" style="color: #0F4F30;" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-3" style="color: #1F1F1F;">Keuzedelen</h3>
                <p style="color: #6B6B6B;">Specialiseer je met keuzedelen die aansluiten bij jouw interesses en carrièredoelen.</p>
            </div>
        </div>
        
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold mb-4" style="color: #0F4F30;">Waarom Keuzedelen bij TCR?</h2>
            <p class="text-lg" style="color: #6B6B6B;">Ontdek wat onze keuzedelen zo bijzonder maakt</p>
        </div>
        
        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-white p-6 rounded shadow-sm border-t-4" style="border-color: #0F4F30;">
                <h3 class="text-xl font-semibold mb-3 text-gray-800">Praktijkgericht</h3>
                <p class="text-gray-600 leading-relaxed">
                    Alle keuzedelen zijn direct toepasbaar in de praktijk. Je werkt met de nieuwste technologieën en methodes uit het werkveld.
                </p>
            </div>
            
            <div class="bg-white p-6 rounded shadow-sm border-t-4" style="border-color: #C7D400;">
                <h3 class="text-xl font-semibold mb-3 text-gray-800">Flexibel</h3>
                <p class="text-gray-600 leading-relaxed">
                    Kies keuzedelen die passen bij jouw interesses en carrièredoelen. Elke periode kun je een nieuwe richting kiezen.
                </p>
            </div>
            
            <div class="bg-white p-6 rounded shadow-sm border-t-4" style="border-color: #0F4F30;">
                <h3 class="text-xl font-semibold mb-3 text-gray-800">Erkend</h3>
                <p class="text-gray-600 leading-relaxed">
                    Alle keuzedelen zijn officieel erkend en tellen mee voor je diploma. Vergroot je kansen op de arbeidsmarkt.
                </p>
            </div>
        </div>
        
        <div class="text-center mt-12">
            <h2 class="text-3xl font-bold mb-4" style="color: #0F4F30;">Populaire Keuzedelen</h2>
            <p class="text-center text-gray-600 mb-12 max-w-2xl mx-auto">
                Een selectie van onze meest populaire keuzedelen voor periode 1
            </p>
        </div>
        
        <div class="grid md:grid-cols-3 gap-6">
            <!-- Card 1 -->
            <div class="bg-white rounded shadow-sm hover:shadow-md transition-shadow overflow-hidden">
                <img src="https://images.unsplash.com/photo-1555066931-4365d14bab8c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" 
                     alt="Software Development" 
                     class="w-full h-48 object-cover">
                <div class="p-4" style="background: linear-gradient(135deg, #0F4F30, #0B3A24);">
                    <div class="text-2xl font-bold mb-1" style="color: #C7D400;">25604K0059</div>
                    <h3 class="text-lg font-semibold text-white">Verdieping Software</h3>
                </div>
                <div class="p-6">
                    <p class="text-gray-600 mb-4">Verdiep je kennis in geavanceerde programmeertechnieken en software architectuur.</p>
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-sm text-gray-500">Periode 1</span>
                        <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-sm">Beschikbaar</span>
                    </div>
                    <a href="/keuzedelen" class="text-blue-900 font-semibold hover:underline">
                        Meer informatie
                    </a>
                </div>
            </div>
            
            <!-- Card 2 -->
            <div class="bg-white rounded shadow-sm hover:shadow-md transition-shadow overflow-hidden">
                <img src="https://images.unsplash.com/photo-1550751827-4bd374c3f58b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" 
                     alt="Cybersecurity" 
                     class="w-full h-48 object-cover">
                <div class="p-4" style="background: linear-gradient(135deg, #0F4F30, #0B3A24);">
                    <div class="text-2xl font-bold mb-1" style="color: #C7D400;">25604K0497</div>
                    <h3 class="text-lg font-semibold text-white">Cybersecurity Fundamentals</h3>
                </div>
                <div class="p-6">
                    <p class="text-gray-600 mb-4">Leer de basis van informatiebeveiliging en ethisch hacken.</p>
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-sm text-gray-500">Periode 1</span>
                        <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-sm">Beschikbaar</span>
                    </div>
                    <a href="/keuzedelen" class="font-semibold hover:underline" style="color: #0F4F30;">
                        Meer informatie
                    </a>
                </div>
            </div>
            
            <!-- Card 3 -->
            <div class="bg-white rounded shadow-sm hover:shadow-md transition-shadow overflow-hidden">
                <img src="https://images.unsplash.com/photo-1451187580459-43490279c0fa?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" 
                     alt="Cloud Computing" 
                     class="w-full h-48 object-cover">
                <div class="p-4" style="background: linear-gradient(135deg, #0F4F30, #0B3A24);">
                    <div class="text-2xl font-bold mb-1" style="color: #C7D400;">25604K0505</div>
                    <h3 class="text-lg font-semibold text-white">Cloud Computing</h3>
                </div>
                <div class="p-6">
                    <p class="text-gray-600 mb-4">Werk met moderne cloud platforms en leer over cloud architectuur.</p>
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-sm text-gray-500">Periode 2</span>
                        <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-sm">Beschikbaar</span>
                    </div>
                    <a href="/keuzedelen" class="font-semibold hover:underline" style="color: #0F4F30;">
                        Meer informatie
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CTA Section -->
<div class="py-16" style="background: linear-gradient(135deg, #0F4F30, #0B3A24);">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold text-white mb-4">Start jouw toekomst bij TCR</h2>
        <p class="text-xl text-white/90 mb-8 max-w-2xl mx-auto">
            Schrijf je vandaag nog in voor een keuzedeel en ontwikkel de vaardigheden van morgen
        </p>
        
        <div class="flex justify-center gap-4">
            @guest
                <a href="/register" class="btn-tcr btn-tcr-secondary">
                    REGISTREREN
                </a>
                <a href="/login" class="btn-tcr btn-tcr-outline border-white text-white hover:bg-white" style="hover:color: #0F4F30;">
                    INLOGGEN
                </a>
            @else
                <a href="/keuzedelen" class="btn-tcr btn-tcr-secondary">
                    BEKIJK ALLE KEUZEDELEN
                </a>
            @endguest
        </div>
    </div>
</div>
@endsection
