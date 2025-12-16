<?php

namespace App\Http\Controllers;

use App\Models\Keuzedeel;
use App\Models\Inschrijving;
use App\Models\User;
use App\Models\GedaanKeuzedeel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // Check of gebruiker admin is
    private function checkAdmin()
    {
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Je hebt geen toegang tot deze pagina.');
        }
    }

    // Admin dashboard
    public function index()
    {
        $this->checkAdmin();

        $stats = [
            'totaal_keuzedelen' => Keuzedeel::count(),
            'actieve_keuzedelen' => Keuzedeel::where('is_actief', true)->count(),
            'totaal_inschrijvingen' => Inschrijving::where('status', 'accepted')->count(),
            'totaal_studenten' => User::where('rol', 'student')->count(),
        ];
        
        // Statistieken per opleiding
        $opleidingStats = Keuzedeel::selectRaw('opleiding, COUNT(*) as aantal')
            ->whereNotNull('opleiding')
            ->groupBy('opleiding')
            ->get();
        
        // Populairste keuzedelen (op basis van inschrijvingen)
        $populaireKeuzedelen = Keuzedeel::withCount(['inschrijvingen' => function($query) {
                $query->where('status', 'accepted');
            }])
            ->orderByDesc('inschrijvingen_count')
            ->take(5)
            ->get();
        
        // Inschrijvingen per periode
        $inschrijvingenPerPeriode = Keuzedeel::selectRaw('keuzedelen.periode, COUNT(inschrijvingen.id) as aantal')
            ->leftJoin('inschrijvingen', function($join) {
                $join->on('keuzedelen.id', '=', 'inschrijvingen.keuzedeel_id')
                     ->where('inschrijvingen.status', '=', 'accepted');
            })
            ->groupBy('keuzedelen.periode')
            ->orderBy('keuzedelen.periode')
            ->get();
        
        // Recent ingeschreven studenten
        $recenteInschrijvingen = Inschrijving::with(['user', 'keuzedeel'])
            ->where('status', 'accepted')
            ->latest()
            ->take(10)
            ->get();

        return view('admin.index', compact('stats', 'opleidingStats', 'populaireKeuzedelen', 'inschrijvingenPerPeriode', 'recenteInschrijvingen'));
    }

    // Keuzedelen beheren
    public function keuzedelenIndex()
    {
        $this->checkAdmin();

        $keuzedelen = Keuzedeel::all();

        return view('admin.keuzedelen.index', compact('keuzedelen'));
    }

    // Nieuw keuzedeel formulier
    public function keuzedelenCreate()
    {
        $this->checkAdmin();

        return view('admin.keuzedelen.create');
    }

    // Keuzedeel opslaan
    public function keuzedelenStore(Request $request)
    {
        $this->checkAdmin();

        $validated = $request->validate([
            'code' => 'required|unique:keuzedelen',
            'keuzedeelcode' => 'required|unique:keuzedelen|regex:/^\d{5}K\d{4}$/',
            'naam' => 'required|string|max:255',
            'beschrijving' => 'nullable|string',
            'periode' => 'required|integer|between:1,4',
            'max_studenten' => 'required|integer|min:1',
            'min_studenten' => 'required|integer|min:1',
        ]);

        $validated['is_actief'] = $request->has('is_actief');
        $validated['herhaalbaar'] = $request->has('herhaalbaar');

        Keuzedeel::create($validated);

        return redirect('/admin/keuzedelen')->with('success', 'Keuzedeel aangemaakt!');
    }

    // Keuzedeel bewerken formulier
    public function keuzedelenEdit($id)
    {
        $this->checkAdmin();

        $keuzedeel = Keuzedeel::findOrFail($id);

        return view('admin.keuzedelen.edit', compact('keuzedeel'));
    }

    // Keuzedeel updaten
    public function keuzedelenUpdate(Request $request, $id)
    {
        $this->checkAdmin();

        $keuzedeel = Keuzedeel::findOrFail($id);

        $request->validate([
            'code' => 'required|string|max:20',
            'keuzedeelcode' => 'required|regex:/^\d{5}K\d{4}$/|unique:keuzedelen,keuzedeelcode,' . $id,
            'naam' => 'required|string|max:255',
            'beschrijving' => 'nullable|string',
            'periode' => 'required|integer|min:1|max:4',
            'max_studenten' => 'required|integer|min:1',
            'min_studenten' => 'required|integer|min:1',
        ]);

        $keuzedeel->update([
            'code' => $request->code,
            'keuzedeelcode' => $request->keuzedeelcode,
            'naam' => $request->naam,
            'beschrijving' => $request->beschrijving,
            'periode' => $request->periode,
            'max_studenten' => $request->max_studenten,
            'min_studenten' => $request->min_studenten,
            'is_actief' => $request->has('is_actief'),
            'herhaalbaar' => $request->has('herhaalbaar'),
        ]);

        return redirect('/admin/keuzedelen')->with('success', 'Keuzedeel bijgewerkt!');
    }

    // Toggle keuzedeel actief/inactief
    public function keuzedelenToggle($id)
    {
        $this->checkAdmin();

        $keuzedeel = Keuzedeel::findOrFail($id);
        $keuzedeel->is_actief = !$keuzedeel->is_actief;
        $keuzedeel->save();

        $status = $keuzedeel->is_actief ? 'geactiveerd' : 'gedeactiveerd';
        return redirect('/admin/keuzedelen')->with('success', "Keuzedeel {$keuzedeel->naam} is {$status}!");
    }

    // Alle inschrijvingen bekijken
    public function inschrijvingenIndex()
    {
        $this->checkAdmin();

        $inschrijvingen = Inschrijving::with(['user', 'keuzedeel'])
            ->orderBy('created_at', 'desc')
            ->get();

        // Groepeer per keuzedeel voor overzicht
        $perKeuzedeel = Inschrijving::with(['user', 'keuzedeel'])
            ->where('status', 'accepted')
            ->get()
            ->groupBy('keuzedeel_id');

        return view('admin.inschrijvingen', compact('inschrijvingen', 'perKeuzedeel'));
    }
}
