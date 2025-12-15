<?php

namespace App\Http\Controllers;

use App\Models\Keuzedeel;
use Illuminate\Http\Request;

class KeuzedeelController extends Controller
{
    // Toon alle actieve keuzedelen
    public function index(Request $request)
    {
        // Haal alle actieve keuzedelen op
        $query = Keuzedeel::where('is_actief', true);

        // Filter op periode als die is opgegeven
        if ($request->has('periode') && $request->periode != '') {
            $query->where('periode', $request->periode);
        }

        $keuzedelen = $query->get();

        return view('keuzedelen.index', compact('keuzedelen'));
    }

    // Toon details van 1 keuzedeel
    public function show($id)
    {
        $keuzedeel = Keuzedeel::findOrFail($id);

        return view('keuzedelen.show', compact('keuzedeel'));
    }
}
