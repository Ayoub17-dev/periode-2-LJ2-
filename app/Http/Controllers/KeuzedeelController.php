<?php

namespace App\Http\Controllers;

use App\Models\Keuzedeel;
use Illuminate\Http\Request;

class KeuzedeelController extends Controller
{
    // Toon alle keuzedelen
    public function index(Request $request)
    {
        $keuzedelen = Keuzedeel::withCount('inschrijvingen')
            ->with(['inschrijvingen' => function($query) {
                $query->where('status', 'accepted');
            }])
            ->where('is_actief', true)
            ->orderBy('periode', 'asc')  // Sorteer op periode
            ->orderBy('naam', 'asc')      // Dan op naam
            ->get()
            ->map(function($keuzedeel) {
                $keuzedeel->aantal_inschrijvingen = $keuzedeel->inschrijvingen->where('status', 'accepted')->count();
                $keuzedeel->is_vol = $keuzedeel->aantal_inschrijvingen >= $keuzedeel->max_studenten;
                return $keuzedeel;
            });

        return view('keuzedelen.index', compact('keuzedelen'));
    }

    // Toon details van 1 keuzedeel
    public function show($id)
    {
        $keuzedeel = Keuzedeel::findOrFail($id);

        return view('keuzedelen.show', compact('keuzedeel'));
    }
}
