<?php

namespace App\Http\Controllers;

use App\Models\Keuzedeel;
use App\Models\Inschrijving;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InschrijvingController extends Controller
{
    // Student inschrijven
    public function inschrijven($keuzedeel_id)
    {
        $user = Auth::user();
        $keuzedeel = Keuzedeel::findOrFail($keuzedeel_id);

        // Check keuzedeel gedaan
        if ($user->heeftKeuzedeelGedaan($keuzedeel->keuzedeelcode)) {
            return redirect()->back()->with('error', 'Je hebt dit keuzedeel al eerder afgerond.');
        }
        
        // Check inschrijfperiode
        if (!$keuzedeel->inschrijf_periode_open) {
            return back()->with('error', 'De inschrijfperiode voor dit keuzedeel is gesloten.');
        }

        // Check 1: Vol?
        if ($keuzedeel->is_vol) {
            return back()->with('error', 'Dit keuzedeel is vol. Je kunt je niet meer inschrijven.');
        }

        // Check 2: Actief?
        if (!$keuzedeel->is_actief) {
            return back()->with('error', 'Dit keuzedeel is niet actief.');
        }

        // Check 3: Al gekozen?
        $bestaandeInschrijving = Inschrijving::where('user_id', $user->id)
            ->where('status', '!=', 'rejected')
            ->first();

        if ($bestaandeInschrijving) {
            return back()->with('error', 'Je hebt al een keuzedeel gekozen. Je kunt maar één keuzedeel kiezen.');
        }

        // Check 4: Al gedaan?
        if (!$keuzedeel->herhaalbaar) {
            $alGedaan = Inschrijving::where('user_id', $user->id)
                ->where('keuzedeel_id', $keuzedeel->id)
                ->where('status', 'accepted')
                ->exists();

            if ($alGedaan) {
                return back()->with('error', 'Je hebt dit keuzedeel al gedaan en mag het niet nog een keer doen.');
            }
        }

        // Inschrijving maken
        Inschrijving::create([
            'user_id' => $user->id,
            'keuzedeel_id' => $keuzedeel->id,
            'periode' => $keuzedeel->periode,
            'status' => 'accepted'
        ]);
        
        // Check minimum
        $message = 'Je bent ingeschreven voor ' . $keuzedeel->naam;
        if (!$keuzedeel->heeftMinimumBereikt()) {
            $aantalNodig = $keuzedeel->min_studenten - $keuzedeel->aantal_inschrijvingen;
            $message .= '. Let op: dit keuzedeel heeft nog ' . $aantalNodig . ' inschrijvingen nodig om door te gaan.';
        }

        return redirect('/keuzedelen')->with('success', $message);
    }

    // Mijn inschrijvingen
    public function mijnInschrijvingen()
    {
        $inschrijvingen = Inschrijving::where('user_id', Auth::id())
            ->with('keuzedeel')
            ->get();

        return view('inschrijvingen.index', compact('inschrijvingen'));
    }
}
