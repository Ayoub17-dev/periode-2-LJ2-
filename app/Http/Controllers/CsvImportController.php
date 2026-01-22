<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\GedaanKeuzedeel;
use App\Models\Keuzedeel;
use App\Models\Inschrijving;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CsvImportController extends Controller
{
    // Check of gebruiker admin is
    private function checkAdmin()
    {
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Geen toegang.');
        }
    }

    // Toon upload pagina
    public function index()
    {
        $this->checkAdmin();
        return view('admin.csv-import');
    }

    // Verwerk CSV upload
    public function upload(Request $request)
    {
        $this->checkAdmin();

        $request->validate([
            'csv_files' => 'required',
            'csv_files.*' => 'required|mimes:csv,txt|max:10240'
        ]);

        $totalStudenten = 0;
        $totalKeuzedelen = 0;

        foreach ($request->file('csv_files') as $file) {
            $result = $this->processCSV($file);
            $totalStudenten += $result['studenten'];
            $totalKeuzedelen += $result['keuzedelen'];
        }

        return redirect()->back()->with('success', 
            "Import succesvol! $totalStudenten studenten en $totalKeuzedelen keuzedeel-inschrijvingen toegevoegd."
        );
    }

    // Verwerk een CSV bestand (specifiek voor TCR Excel export format)
    private function processCSV($file)
    {
        $studenten = 0;
        $keuzedelen = 0;

        // Open CSV bestand
        $content = file_get_contents($file);
        $lines = explode("\n", $content);
        
        if (count($lines) < 8) {
            return ['studenten' => 0, 'keuzedelen' => 0];
        }

        // Rij 5 (index 4) bevat de keuzedeelcodes
        $keuzedeelRow = str_getcsv($lines[4], ',');
        
        // Vind alle keuzedeelcodes en hun kolom posities
        // Elke keuzedeel heeft 4 kolommen: Res (cijfer), SP, Gepln, TotSP
        $keuzedeelCodes = [];
        
        for ($i = 0; $i < count($keuzedeelRow); $i++) {
            $code = trim($keuzedeelRow[$i]);
            // Match keuzedeelcodes zoals 25604K0059 of K0205
            if (preg_match('/^\d{5}K\d{4}$/', $code) || preg_match('/^K\d{4}$/', $code)) {
                $keuzedeelCodes[$i] = $code;
            }
        }

        // Verwerk elke student rij (vanaf rij 8, index 7)
        for ($row = 7; $row < count($lines); $row++) {
            $data = str_getcsv($lines[$row], ',');
            
            if (count($data) < 5) continue;

            // Kolom indeling: 
            // 1 = Roostergroep (klas)
            // 2 = studentnummer
            // 3 = naam
            // 4 = Opleidings Code
            $klas = trim($data[1] ?? '');
            $studentnummer = trim($data[2] ?? '');
            $naam = trim($data[3] ?? '');
            $opleiding = trim($data[4] ?? '');

            // Skip lege rijen of rijen zonder studentnummer
            if (empty($studentnummer) || !is_numeric($studentnummer)) continue;

            // Genereer email op basis van naam
            $emailNaam = strtolower(str_replace(' ', '.', $naam));
            $emailNaam = preg_replace('/[^a-z0-9.]/', '', $emailNaam);
            $email = $emailNaam . '@student.tcr.nl';

            // Maak of update student
            $user = User::updateOrCreate(
                ['studentnummer' => $studentnummer],
                [
                    'name' => $naam,
                    'email' => $email,
                    'klas' => $klas,
                    'opleiding' => $opleiding,
                    'password' => Hash::make($studentnummer),
                    'rol' => 'student'
                ]
            );
            $studenten++;

            // Check gedane keuzedelen en maak inschrijvingen
            foreach ($keuzedeelCodes as $index => $keuzedeelcode) {
                $cijfer = trim($data[$index] ?? '');
                
                // Check of er een waarde is (cijfer of andere marker)
                if (!empty($cijfer)) {
                    // Zoek het keuzedeel in de database
                    $keuzedeel = Keuzedeel::where('keuzedeelcode', $keuzedeelcode)->first();
                    
                    if ($keuzedeel) {
                        // Maak inschrijving aan voor deze student
                        Inschrijving::updateOrCreate(
                            [
                                'user_id' => $user->id,
                                'keuzedeel_id' => $keuzedeel->id
                            ],
                            [
                                'status' => 'accepted',
                                'periode' => $keuzedeel->periode
                            ]
                        );
                        
                        // Als het een cijfer is, sla het ook op in gedane_keuzedelen
                        if (is_numeric($cijfer)) {
                            GedaanKeuzedeel::updateOrCreate(
                                [
                                    'user_id' => $user->id,
                                    'keuzedeelcode' => $keuzedeelcode
                                ],
                                [
                                    'naam' => $keuzedeel->naam,
                                    'cijfer' => $cijfer,
                                    'status' => 'afgerond',
                                    'datum_afgerond' => now()
                                ]
                            );
                        }
                        
                        $keuzedelen++;
                    }
                }
            }
        }

        return ['studenten' => $studenten, 'keuzedelen' => $keuzedelen];
    }

    // Verwijder alle oude inschrijvingen
    public function deleteOldInschrijvingen()
    {
        $this->checkAdmin();
        
        // Verwijder alle inschrijvingen en gedane keuzedelen
        Inschrijving::truncate();
        GedaanKeuzedeel::truncate();
        
        return redirect()->back()->with('success', 'Alle oude inschrijvingen en cijfers zijn verwijderd.');
    }
}
