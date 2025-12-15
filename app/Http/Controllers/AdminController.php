<?php

namespace App\Http\Controllers;

use App\Models\Keuzedeel;
use App\Models\Inschrijving;
use App\Models\User;
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

        return view('admin.index', compact('stats'));
    }

    // Keuzedelen beheren
    public function keuzedelen()
    {
        $this->checkAdmin();

        $keuzedelen = Keuzedeel::all();

        return view('admin.keuzedelen.index', compact('keuzedelen'));
    }

    // Nieuw keuzedeel formulier
    public function createKeuzedeel()
    {
        $this->checkAdmin();

        return view('admin.keuzedelen.create');
    }

    // Keuzedeel opslaan
    public function storeKeuzedeel(Request $request)
    {
        $this->checkAdmin();

        $request->validate([
            'code' => 'required|string|max:20',
            'naam' => 'required|string|max:255',
            'beschrijving' => 'nullable|string',
            'periode' => 'required|integer|min:1|max:4',
            'max_studenten' => 'required|integer|min:1',
            'min_studenten' => 'required|integer|min:1',
        ]);

        Keuzedeel::create([
            'code' => $request->code,
            'naam' => $request->naam,
            'beschrijving' => $request->beschrijving,
            'periode' => $request->periode,
            'max_studenten' => $request->max_studenten,
            'min_studenten' => $request->min_studenten,
            'is_actief' => $request->has('is_actief'),
            'herhaalbaar' => $request->has('herhaalbaar'),
        ]);

        return redirect('/admin/keuzedelen')->with('success', 'Keuzedeel aangemaakt!');
    }

    // Keuzedeel bewerken formulier
    public function editKeuzedeel($id)
    {
        $this->checkAdmin();

        $keuzedeel = Keuzedeel::findOrFail($id);

        return view('admin.keuzedelen.edit', compact('keuzedeel'));
    }

    // Keuzedeel updaten
    public function updateKeuzedeel(Request $request, $id)
    {
        $this->checkAdmin();

        $keuzedeel = Keuzedeel::findOrFail($id);

        $request->validate([
            'code' => 'required|string|max:20',
            'naam' => 'required|string|max:255',
            'beschrijving' => 'nullable|string',
            'periode' => 'required|integer|min:1|max:4',
            'max_studenten' => 'required|integer|min:1',
            'min_studenten' => 'required|integer|min:1',
        ]);

        $keuzedeel->update([
            'code' => $request->code,
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

    // Keuzedeel verwijderen
    public function deleteKeuzedeel($id)
    {
        $this->checkAdmin();

        $keuzedeel = Keuzedeel::findOrFail($id);
        $keuzedeel->delete();

        return redirect('/admin/keuzedelen')->with('success', 'Keuzedeel verwijderd!');
    }

    // Alle inschrijvingen bekijken
    public function inschrijvingen()
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
