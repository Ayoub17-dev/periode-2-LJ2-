@extends('layouts.app')

@section('title', 'Keuzedelen - Techniek College Rotterdam')

@section('content')
<!-- Professional Hero Section -->
<div class="hero-tcr">
    <div class="container mx-auto px-6">
        <div class="py-16">
            <h1 class="text-4xl font-bold text-white mb-4">Keuzedelen</h1>
            <p class="text-lg text-white/90 max-w-2xl">
                Kies uit 12 keuzedelen met unieke serienummers.
                Specialiseer je in wat bij jouw toekomst past.
            </p>
        </div>
    </div>
</div>

<div class="container mx-auto px-4 py-8">
    <!-- Filter Section zoals TCR opleidingen pagina -->
    <div class="mb-8">
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h2 class="text-2xl font-bold text-tcr-black mb-4">Filter op periode</h2>
            <div class="flex flex-wrap gap-2">
                <button class="filter-button active" data-periode="all">
                    Alle periodes ({{ $keuzedelen->count() }})
                </button>
                @for($i = 1; $i <= 4; $i++)
                    <button class="filter-button" data-periode="{{ $i }}">
                        Periode {{ $i }} ({{ $keuzedelen->where('periode', $i)->count() }})
                    </button>
                @endfor
            </div>
        </div>
    </div>
    <!-- Resultaten sectie -->
    <div class="mb-4">
        <h2 class="text-xl font-semibold text-tcr-gray">
            <span id="result-count">{{ $keuzedelen->count() }}</span> keuzedelen gevonden
        </h2>
    </div>

    <!-- Keuzedelen Grid zoals TCR -->
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6" id="keuzedelen-grid">
        @forelse ($keuzedelen as $keuzedeel)
            <div class="keuzedeel-card keuzedeel-item" data-periode="{{ $keuzedeel->periode }}">
                <!-- Keuzedeel Header met Serienummer -->
                <div class="keuzedeel-header">
                    <div class="absolute top-2 right-2">
                        <span class="badge-tcr periode-{{ $keuzedeel->periode }}">
                            Periode {{ $keuzedeel->periode }}
                        </span>
                    </div>
                    <div class="keuzedeel-code">
                        {{ $keuzedeel->keuzedeelcode }}
                    </div>
                    <div class="keuzedeel-title">
                        {{ $keuzedeel->naam }}
                    </div>
                </div>
                
                <!-- Card Body -->
                <div class="p-6">
                    <!-- Beschrijving -->
                    <p class="text-gray-600 mb-4 min-h-[60px]">
                        {{ Str::limit($keuzedeel->beschrijving ?: 'Verdiep je kennis met dit keuzedeel.', 120) }}
                    </p>
                    
                    <!-- Info Items -->
                    <div class="space-y-3 mb-4">
                        @if($keuzedeel->opleiding)
                        <div class="flex items-center text-sm">
                            <span class="font-semibold text-gray-700 w-24">Opleiding:</span>
                            <span class="text-gray-600">{{ $keuzedeel->opleiding }}</span>
                        </div>
                        @endif
                        <div class="flex items-center text-sm">
                            <span class="font-semibold text-gray-700 w-24">Plaatsen:</span>
                            <span class="{{ $keuzedeel->is_vol ? 'text-red-500 font-bold' : 'text-green-600' }}">
                                {{ $keuzedeel->aantal_inschrijvingen ?? 0 }} / {{ $keuzedeel->max_studenten }}
                            </span>
                        </div>
                        <div class="flex items-center text-sm">
                            <span class="font-semibold text-gray-700 w-24">Status:</span>
                            @if($keuzedeel->is_vol)
                                <span class="bg-red-500 text-white px-2 py-1 rounded text-xs font-bold">VOL</span>
                            @else
                                <span class="px-2 py-1 rounded text-xs font-bold text-white" style="background-color: #0F4F30;">OPEN</span>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Progress Bar -->
                    <div class="mb-4">
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="h-2 rounded-full transition-all"
                                 style="width: {{ min(100, ($keuzedeel->aantal_inschrijvingen / $keuzedeel->max_studenten) * 100) }}%; background: {{ $keuzedeel->is_vol ? '#DC143C' : '#FFC600' }};"></div>
                        </div>
                    </div>
                    
                    <!-- Action Button -->
                    @auth
                        @if(Auth::user()->rol == 'student')
                            @if($keuzedeel->is_vol)
                                <button class="btn-tcr btn-tcr-outline w-full" disabled>
                                    Keuzedeel is vol
                                </button>
                            @elseif(Auth::user()->heeftKeuzedeelGedaan($keuzedeel->id))
                                <button class="btn-tcr btn-tcr-outline w-full" disabled>
                                    Afgerond
                                </button>
                            @elseif(Auth::user()->inschrijvingen->where('keuzedeel_id', $keuzedeel->id)->first())
                                <button class="btn-tcr btn-tcr-secondary w-full" disabled>
                                    Ingeschreven
                                </button>
                            @else
                                <form action="{{ route('inschrijvingen.create', $keuzedeel->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn-tcr btn-tcr-primary w-full">
                                        Inschrijven
                                    </button>
                                </form>
                            @endif
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="btn-tcr btn-tcr-outline w-full text-center">
                            Login om in te schrijven
                        </a>
                    @endauth
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12">
                <div class="text-gray-400 mb-4">
                    <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">Geen keuzedelen gevonden</h3>
                <p class="text-gray-600">Er zijn geen keuzedelen beschikbaar voor de geselecteerde filters.</p>
            </div>
        @endforelse
    </div>
    
    <!-- No Results Message -->
    <div id="no-results" class="hidden text-center py-12 bg-white rounded-lg">
        <div class="text-gray-400 mb-4">
            <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </div>
        <h3 class="text-xl font-semibold text-gray-700 mb-2">Geen keuzedelen gevonden</h3>
        <p class="text-gray-600">Er zijn geen keuzedelen voor de geselecteerde periode.</p>
        <button onclick="filterKeuzedelen('all')" class="btn-tcr btn-tcr-primary mt-4">
            Toon alle keuzedelen
        </button>
    </div>
</div>

<script>
    function filterKeuzedelen(periode) {
        const items = document.querySelectorAll('.keuzedeel-item');
        const buttons = document.querySelectorAll('.filter-button');
        const noResults = document.getElementById('no-results');
        const grid = document.getElementById('keuzedelen-grid');
        const resultCount = document.getElementById('result-count');
        let count = 0;
        
        // Update button states
        buttons.forEach(btn => {
            if (btn.dataset.periode === periode) {
                btn.classList.add('active');
            } else {
                btn.classList.remove('active');
            }
        });
        
        // Filter items
        items.forEach(item => {
            if (periode === 'all' || item.dataset.periode == periode) {
                item.style.display = 'block';
                count++;
            } else {
                item.style.display = 'none';
            }
        });
        
        // Update result count
        if (resultCount) {
            resultCount.textContent = count;
        }
        
        // Show/hide no results
        if (count === 0) {
            grid.style.display = 'none';
            noResults.classList.remove('hidden');
        } else {
            grid.style.display = 'grid';
            noResults.classList.add('hidden');
        }
    }
    
    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.filter-button').forEach(button => {
            button.addEventListener('click', function() {
                filterKeuzedelen(this.dataset.periode);
            });
        });
    });
</script>
@endsection
