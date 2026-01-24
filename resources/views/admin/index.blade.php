@extends('layouts.app')

@section('title', 'Admin Dashboard - TCR Keuzedelen')

@section('content')
<!-- Professional Hero Section -->
<div class="hero-tcr">
    <div class="container mx-auto px-6">
        <div class="py-16">
            <h1 class="text-4xl font-bold text-white mb-4">Admin Dashboard</h1>
            <p class="text-lg text-white/90">Beheer keuzedelen, serienummers en inschrijvingen</p>
        </div>
    </div>
</div>

<div class="container mx-auto px-4 py-8">
    <!-- Main Stats Cards -->
    <div class="grid md:grid-cols-3 gap-6 mb-8 max-w-4xl mx-auto">
        <!-- Keuzedelen Card -->
        <div class="bg-white rounded-lg shadow-sm p-6 border-l-4" style="border-color: #0F4F30;">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium" style="color: #6B6B6B;">Totaal Keuzedelen</p>
                    <p class="text-3xl font-bold" style="color: #0F4F30;">{{ $totalKeuzedelen }}</p>
                    <p class="text-xs" style="color: #6B6B6B;">{{ $actieveKeuzedelen }} actief</p>
                </div>
                <div class="p-3 rounded-full" style="background-color: #F0F8E8;">
                    <svg class="w-8 h-8" style="color: #0F4F30;" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                        <path fill-rule="evenodd" d="M4 5a2 2 0 012-2v1a1 1 0 102 0V3a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 2a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
        </div>
        
        <!-- Studenten Card -->
        <div class="bg-white rounded-lg shadow-sm p-6 border-l-4" style="border-color: #0F4F30;">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium" style="color: #6B6B6B;">Totaal Studenten</p>
                    <p class="text-3xl font-bold" style="color: #0F4F30;">{{ $totalStudenten }}</p>
                </div>
                <div class="p-3 rounded-full" style="background-color: #F0F8E8;">
                    <svg class="w-8 h-8" style="color: #0F4F30;" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"/>
                    </svg>
                </div>
            </div>
        </div>
        
        <!-- Inschrijvingen Card -->
        <div class="bg-white rounded-lg shadow-sm p-6 border-l-4" style="border-color: #C7D400;">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium" style="color: #6B6B6B;">Totaal Inschrijvingen</p>
                    <p class="text-3xl font-bold" style="color: #0F4F30;">{{ $totalInschrijvingen }}</p>
                </div>
                <div class="p-3 rounded-full" style="background-color: #F0F8E8;">
                    <svg class="w-8 h-8" style="color: #0F4F30;" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Studenten Keuzedeel Keuzes -->
    <div class="bg-white rounded-lg shadow-sm p-6 mb-8 border border-gray-200">
        <h2 class="text-xl font-bold mb-4" style="color: #0F4F30;">
            Studenten Keuzedeel Keuzes
        </h2>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b-2" style="border-color: #C7D400;">
                        <th class="text-left py-2 px-4 font-bold" style="color: #1F1F1F;">Student</th>
                        <th class="text-left py-2 px-4 font-bold" style="color: #1F1F1F;">Studentnummer</th>
                        <th class="text-left py-2 px-4 font-bold" style="color: #1F1F1F;">Opleiding</th>
                        <th class="text-left py-2 px-4 font-bold" style="color: #1F1F1F;">Keuzedeel</th>
                        <th class="text-left py-2 px-4 font-bold" style="color: #1F1F1F;">Periode</th>
                        <th class="text-left py-2 px-4 font-bold" style="color: #1F1F1F;">Inschrijfdatum</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($studentenKeuzes as $inschrijving)
                        <tr class="border-b hover:bg-gray-50 transition">
                            <td class="py-3 px-4">
                                <div class="font-semibold">{{ $inschrijving->user->name }}</div>
                            </td>
                            <td class="py-3 px-4">
                                <div class="font-mono text-sm">{{ $inschrijving->user->studentnummer }}</div>
                            </td>
                            <td class="py-3 px-4">
                                <div class="text-sm">{{ $inschrijving->user->opleiding }}</div>
                            </td>
                            <td class="py-3 px-4">
                                <div class="font-mono font-bold" style="color: #C7D400;">{{ $inschrijving->keuzedeel->keuzedeelcode }}</div>
                                <div class="text-sm">{{ $inschrijving->keuzedeel->naam }}</div>
                            </td>
                            <td class="py-3 px-4">
                                <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded text-sm font-medium">
                                    Periode {{ $inschrijving->keuzedeel->periode }}
                                </span>
                            </td>
                            <td class="py-3 px-4 text-sm text-gray-600">
                                {{ $inschrijving->created_at->format('d-m-Y H:i') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Inschrijvingen per Periode -->
    <div class="bg-white rounded shadow-sm p-6 mb-8 border border-gray-200">
        <h2 class="text-xl font-bold mb-4" style="color: #0F4F30;">
            Inschrijvingen per Periode
        </h2>
        <div class="grid grid-cols-4 gap-4">
            @foreach($inschrijvingenPerPeriode as $periode)
                <div class="text-center p-4 rounded border-t-4" style="background-color: #F2F2F2; border-color: #C7D400;">
                    <div class="text-xl font-bold mb-2" style="color: #0F4F30;">Periode {{ $periode->periode }}</div>
                    <div class="text-3xl font-bold" style="color: #1F1F1F;">{{ $periode->inschrijvingen_count ?? 0 }}</div>
                    <div class="text-sm" style="color: #6B6B6B;">inschrijvingen</div>
                </div>
            @endforeach
        </div>
    </div>
    
    <!-- Recente Inschrijvingen -->
    <div class="bg-white rounded shadow-sm p-6 mb-8 border border-gray-200">
        <h2 class="text-xl font-bold mb-4" style="color: #0F4F30;">
            Recente Inschrijvingen
        </h2>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b-2" style="border-color: #C7D400;">
                        <th class="text-left py-2 px-4 font-bold" style="color: #1F1F1F;">Student</th>
                        <th class="text-left py-2 px-4 font-bold" style="color: #1F1F1F;">Serienummer</th>
                        <th class="text-left py-2 px-4 font-bold" style="color: #1F1F1F;">Keuzedeel</th>
                        <th class="text-left py-2 px-4 font-bold" style="color: #1F1F1F;">Periode</th>
                        <th class="text-left py-2 px-4 font-bold" style="color: #1F1F1F;">Datum</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recenteInschrijvingen as $inschrijving)
                        <tr class="border-b hover:bg-gray-50 transition">
                            <td class="py-3 px-4">
                                <div class="font-semibold">{{ $inschrijving->user->name }}</div>
                                <div class="text-sm" style="color: #6B6B6B;">{{ $inschrijving->user->studentnummer }}</div>
                            </td>
                            <td class="py-3 px-4">
                                <span class="font-mono font-bold" style="color: #C7D400;">{{ $inschrijving->keuzedeel->keuzedeelcode }}</span>
                            </td>
                            <td class="py-3 px-4 text-sm">{{ $inschrijving->keuzedeel->naam }}</td>
                            <td class="py-3 px-4">
                                <span class="badge-tcr periode-{{ $inschrijving->keuzedeel->periode }}">P{{ $inschrijving->keuzedeel->periode }}</span>
                            </td>
                            <td class="py-3 px-4 text-sm text-gray-600">{{ $inschrijving->created_at->format('d-m-Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Quick Actions -->
    <div class="grid md:grid-cols-4 gap-4">
        <a href="/admin/keuzedelen" class="group bg-white p-6 rounded shadow-sm border border-gray-200 hover:shadow-md transition-all" style="border-left: 4px solid #0F4F30;">
            <div>
                <h3 class="text-lg font-bold mb-2" style="color: #0F4F30;">KEUZEDELEN</h3>
                <p class="text-sm" style="color: #6B6B6B;">Beheer serienummers</p>
            </div>
        </a>

        <a href="/admin/inschrijvingen" class="group bg-white p-6 rounded shadow-sm border border-gray-200 hover:shadow-md transition-all" style="border-left: 4px solid #C7D400;">
            <div>
                <h3 class="text-lg font-bold mb-2" style="color: #0F4F30;">INSCHRIJVINGEN</h3>
                <p class="text-sm" style="color: #6B6B6B;">Bekijk status</p>
            </div>
        </a>

        <a href="/admin/csv-import" class="group bg-white p-6 rounded shadow-sm border border-gray-200 hover:shadow-md transition-all" style="border-left: 4px solid #0F4F30;">
            <div>
                <h3 class="text-lg font-bold mb-2" style="color: #0F4F30;">IMPORT EXCEL</h3>
                <p class="text-sm" style="color: #6B6B6B;">Upload data</p>
            </div>
        </a>
        
        <a href="#" class="group bg-white p-6 rounded shadow-sm border border-gray-200 hover:shadow-md transition-all" style="border-left: 4px solid #C7D400;">
            <div>
                <h3 class="text-lg font-bold mb-2" style="color: #0F4F30;">RAPPORTEN</h3>
                <p class="text-sm" style="color: #6B6B6B;">Download overzichten</p>
            </div>
        </a>
    </div>
</div>
@endsection
