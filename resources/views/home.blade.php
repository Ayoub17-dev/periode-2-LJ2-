@extends('layouts.app')

@section('title', 'Techniek College Rotterdam - Keuzedelen')

@section('content')
<!-- Professional Hero Section -->
<div class="hero-tcr">
    <div class="container mx-auto px-6">
        <div class="relative z-10 py-24">
            <h1 class="text-5xl font-bold text-white mb-6">
                Keuzedelen <span style="color: #C7D400;">TCR</span>
            </h1>
            <p class="text-xl text-white/90 mb-8 max-w-2xl">
                Verbreed je vakkennis met onze keuzedelen. Maak een keuze die past bij jouw toekomst in de techniek.
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

<!-- Info Section -->
<div class="bg-gray-50 py-16">
    <div class="container mx-auto px-4">
        <div class="grid md:grid-cols-3 gap-8">
            <div class="text-center">
                <div class="text-5xl font-bold" style="color: #0F4F30;">12</div>
                <div class="text-gray-600">Keuzedelen</div>
            </div>
            <div class="text-center">
                <div class="text-5xl font-bold" style="color: #0F4F30;">4</div>
                <div class="text-gray-600">Periodes</div>
            </div>
            <div class="text-center">
                <div class="text-5xl font-bold" style="color: #0F4F30;">30</div>
                <div class="text-gray-600">Plaatsen per keuzedeel</div>
            </div>
        </div>
    </div>
</div>

<!-- Waarom kiezen voor TCR -->
<div class="container mx-auto px-4 py-16">
    <h2 class="text-3xl font-bold text-center mb-12 text-gray-800">Waarom kiezen voor TCR Keuzedelen?</h2>
    
    <div class="grid md:grid-cols-3 gap-8">
        <div class="bg-white p-6 rounded shadow-sm border-t-4" style="border-color: #0F4F30;">
            <h3 class="text-xl font-semibold mb-3 text-gray-800">Praktijkgericht</h3>
            <p class="text-gray-600 leading-relaxed">
                Alle keuzedelen zijn direct toepasbaar in de praktijk. Je werkt met de nieuwste technologieën en methodes uit het werkveld.
            </p>
        </div>
        
        <div class="bg-white p-6 rounded shadow-sm border-t-4" style="border-color: #C7D400;">
            <h3 class="text-xl font-semibold mb-3 text-gray-800">Persoonlijke ontwikkeling</h3>
            <p class="text-gray-600 leading-relaxed">
                Kies keuzedelen die passen bij jouw interesses en carrièredoelen. Verdiep je in specialisaties die jou onderscheiden op de arbeidsmarkt.
            </p>
        </div>
        
        <div class="bg-white p-6 rounded shadow-sm border-t-4" style="border-color: #0F4F30;">
            <h3 class="text-xl font-semibold mb-3 text-gray-800">Deskundige docenten</h3>
            <p class="text-gray-600 leading-relaxed">
                Leer van professionals uit het vakgebied met jarenlange ervaring. Zij delen hun kennis en netwerk met jou.
            </p>
        </div>
    </div>
</div>

<!-- Featured Keuzedelen -->
<div class="bg-gray-50 py-16">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-4 text-gray-800">Uitgelichte Keuzedelen</h2>
        <p class="text-center text-gray-600 mb-12 max-w-2xl mx-auto">
            Een selectie van onze meest populaire keuzedelen voor periode 1
        </p>
        
        <div class="grid md:grid-cols-3 gap-6">
            <!-- Card 1 -->
            <div class="bg-white rounded shadow-sm hover:shadow-md transition-shadow">
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
            <div class="bg-white rounded shadow-sm hover:shadow-md transition-shadow">
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
            <div class="bg-white rounded shadow-sm hover:shadow-md transition-shadow">
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
