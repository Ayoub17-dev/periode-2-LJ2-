@extends('layouts.app')

@section('title', 'CSV Import - Techniek College Rotterdam')

@section('content')
<!-- Professional Hero Section -->
<div class="hero-tcr">
    <div class="container mx-auto px-6">
        <div class="py-16">
            <h1 class="text-4xl font-bold text-white mb-4">CSV Import</h1>
            <p class="text-lg text-white/90">Upload CSV bestanden om studenten en hun gedane keuzedelen in te lezen</p>
        </div>
    </div>
</div>

<div class="container mx-auto px-4 py-8">
    <!-- Succes/Error berichten -->
    @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 text-green-800 p-4 mb-6 rounded-r-lg">
            <div class="flex items-center">
                <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-50 border-l-4 border-red-500 text-red-800 p-4 mb-6 rounded-r-lg">
            @foreach($errors->all() as $error)
                <div class="flex items-center mb-1">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                    {{ $error }}
                </div>
            @endforeach
        </div>
    @endif

    <div class="grid md:grid-cols-2 gap-8">
        <!-- Upload Sectie -->
        <div class="bg-white rounded shadow-sm p-6 border border-gray-200">
            <h2 class="text-2xl font-bold mb-4" style="color: #0F4F30;">CSV Bestanden Uploaden</h2>
            
            <form action="/admin/csv-import/upload" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-6">
                    <label class="block text-sm font-bold text-tcr-gray mb-2">
                        Selecteer CSV bestand(en)
                    </label>
                    <input type="file" 
                           name="csv_files[]" 
                           multiple 
                           accept=".csv"
                           class="w-full border-2 border-gray-200 rounded p-3 focus:outline-none" style="border-color: #F2F2F2; focus:border-color: #0F4F30;"
                           required>
                    <p class="text-xs text-gray-500 mt-2">
                        Je kunt meerdere CSV bestanden tegelijk uploaden. Elk bestand is voor één klas.
                    </p>
                </div>

                <button type="submit" class="w-full btn-tcr btn-tcr-primary py-3">
                    BESTANDEN UPLOADEN
                </button>
            </form>
        </div>

        <!-- Info Sectie -->
        <div class="bg-white rounded shadow-sm p-6 border border-gray-200">
            <h2 class="text-2xl font-bold mb-4" style="color: #0F4F30;">Instructies</h2>
            
            <div class="space-y-4">
                <div>
                    <h3 class="font-bold mb-2" style="color: #1F1F1F;">Bestandsformaat</h3>
                    <ul class="text-sm space-y-1 ml-4" style="color: #6B6B6B;">
                        <li>• CSV bestand (Excel naar Opslaan als CSV)</li>
                        <li>• TCR Herkansingslijst format</li>
                        <li>• Rij 5 bevat keuzedeelcodes (25604K0059, etc.)</li>
                        <li>• Rij 8+ bevat studentgegevens</li>
                    </ul>
                </div>

                <div>
                    <h3 class="font-bold mb-2" style="color: #1F1F1F;">Kolommen (vanaf rij 8)</h3>
                    <ul class="text-sm space-y-1 ml-4" style="color: #6B6B6B;">
                        <li>• Kolom B: Roostergroep (klas)</li>
                        <li>• Kolom C: Studentnummer</li>
                        <li>• Kolom D: Naam student</li>
                        <li>• Kolom E: Opleidingscode</li>
                        <li>• Vanaf kolom H: Keuzedeel cijfers</li>
                    </ul>
                </div>

                <div>
                    <h3 class="font-bold mb-2" style="color: #1F1F1F;">Wat gebeurt er?</h3>
                    <ul class="text-sm space-y-1 ml-4" style="color: #6B6B6B;">
                        <li>• Studenten worden aangemaakt/bijgewerkt</li>
                        <li>• Cijfers worden opgeslagen als gedane keuzedelen</li>
                        <li>• Wachtwoord = studentnummer</li>
                        <li>• Email = naam@student.tcr.nl</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Gevaarzone -->
    <div class="mt-8 bg-white rounded shadow-sm p-6 border-l-4 border-red-500">
        <h2 class="text-xl font-bold text-red-600 mb-4">Gevaarzone</h2>
        
        <div class="flex items-center justify-between">
            <div>
                <h3 class="font-bold" style="color: #1F1F1F;">Verwijder alle oude inschrijfdata</h3>
                <p class="text-sm" style="color: #6B6B6B;">Dit verwijdert alle opgeslagen informatie over gedane keuzedelen</p>
            </div>
            
            <form action="/admin/csv-import/delete-old" method="POST" onsubmit="return confirm('Weet je zeker dat je alle oude data wilt verwijderen?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-6 py-2 rounded font-semibold transition text-sm uppercase tracking-wider">
                    Alles Verwijderen
                </button>
            </form>
        </div>
    </div>

    <!-- Terugknop -->
    <div class="mt-6">
        <a href="/admin" class="inline-flex items-center font-semibold" style="color: #0F4F30;" onmouseover="this.style.color='#0B3A24'" onmouseout="this.style.color='#0F4F30'">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Terug naar Dashboard
        </a>
    </div>
</div>
@endsection
