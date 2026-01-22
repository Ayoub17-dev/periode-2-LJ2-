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

        $totalKeuzedelen = Keuzedeel::count();
        $actieveKeuzedelen = Keuzedeel::where('is_actief', true)->count();
        $totalInschrijvingen = Inschrijving::count();
        $totalStudenten = User::where('rol', 'student')->count();
        $recenteInschrijvingen = Inschrijving::with(['user', 'keuzedeel'])
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();
            
        $inschrijvingenPerPeriode = Keuzedeel::selectRaw('keuzedelen.periode, COUNT(DISTINCT keuzedelen.id) as keuzedelen_count, COUNT(inschrijvingen.id) as inschrijvingen_count')
            ->leftJoin('inschrijvingen', 'keuzedelen.id', '=', 'inschrijvingen.keuzedeel_id')
            ->groupBy('keuzedelen.periode')
            ->orderBy('keuzedelen.periode')
            ->get();
            
        // Studenten met keuzedeel keuzes
        $studentenKeuzes = Inschrijving::with(['user', 'keuzedeel'])
            ->whereHas('user', function($query) {
                $query->where('rol', 'student');
            })
            ->orderBy('created_at', 'desc')
            ->get();
        

        return view('admin.index', compact(
            'totalKeuzedelen',
            'actieveKeuzedelen', 
            'totalInschrijvingen',
            'totalStudenten',
            'recenteInschrijvingen',
            'inschrijvingenPerPeriode',
            'studentenKeuzes'
        ));
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
            'inschrijving_start' => 'nullable|date',
            'inschrijving_eind' => 'nullable|date|after:inschrijving_start'
        ]);

        $validated['is_actief'] = $request->has('is_actief');
        $validated['herhaalbaar'] = $request->has('herhaalbaar');
        $validated['inschrijving_open'] = $request->has('inschrijving_open');

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
            'inschrijving_start' => 'nullable|date',
            'inschrijving_eind' => 'nullable|date|after:inschrijving_start'
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
            'inschrijving_open' => $request->has('inschrijving_open'),
            'inschrijving_start' => $request->inschrijving_start,
            'inschrijving_eind' => $request->inschrijving_eind
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
