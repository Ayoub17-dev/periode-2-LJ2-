<?php

namespace App\Http\Controllers;

use App\Models\Keuzedeel;
use App\Models\Inschrijving;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InschrijvingController extends Controller
{
    // Schrijf een student in voor een keuzedeel
    public function inschrijven($keuzedeel_id)
    {
        $user = Auth::user();
        $keuzedeel = Keuzedeel::findOrFail($keuzedeel_id);

        // Check 1: Is het keuzedeel vol?
        if ($keuzedeel->is_vol) {
            return back()->with('error', 'Dit keuzedeel is vol. Je kunt je niet meer inschrijven.');
        }

        // Check 2: Is het keuzedeel actief?
        if (!$keuzedeel->is_actief) {
            return back()->with('error', 'Dit keuzedeel is niet actief.');
        }

        // Check 3: Is de student al ingeschreven voor een keuzedeel in deze periode?
        $bestaandeInschrijving = Inschrijving::where('user_id', $user->id)
            ->where('periode', $keuzedeel->periode)
            ->where('status', '!=', 'rejected')
            ->first();

        if ($bestaandeInschrijving) {
            return back()->with('error', 'Je bent al ingeschreven voor een keuzedeel in periode ' . $keuzedeel->periode);
        }

        // Check 4: Heeft de student dit keuzedeel al gedaan? (alleen als niet herhaalbaar)
        if (!$keuzedeel->herhaalbaar) {
            $alGedaan = Inschrijving::where('user_id', $user->id)
                ->where('keuzedeel_id', $keuzedeel->id)
                ->where('status', 'accepted')
                ->exists();

            if ($alGedaan) {
                return back()->with('error', 'Je hebt dit keuzedeel al gedaan en mag het niet nog een keer doen.');
            }
        }

        // Alles ok, maak de inschrijving aan
        Inschrijving::create([
            'user_id' => $user->id,
            'keuzedeel_id' => $keuzedeel->id,
            'periode' => $keuzedeel->periode,
            'status' => 'accepted', // Direct geaccepteerd (wie eerst komt...)
        ]);

        return redirect('/keuzedelen')->with('success', 'Je bent ingeschreven voor ' . $keuzedeel->naam . '!');
    }

    // Toon mijn inschrijvingen
    public function mijnInschrijvingen()
    {
        $inschrijvingen = Inschrijving::where('user_id', Auth::id())
            ->with('keuzedeel')
            ->get();

        return view('inschrijvingen.index', compact('inschrijvingen'));
    }
}
