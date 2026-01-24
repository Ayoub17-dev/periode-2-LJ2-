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
    // Admin check
    private function checkAdmin()
    {
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Geen toegang.');
        }
    }

    // Upload pagina
    public function index()
    {
        $this->checkAdmin();
        return view('admin.csv-import');
    }

    // CSV verwerken
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

    // CSV verwerking
    private function processCSV($file)
    {
        $studenten = 0;
        $keuzedelen = 0;

        // CSV openen
        $content = file_get_contents($file);
        $lines = explode("\n", $content);
        
        if (count($lines) < 8) {
            return ['studenten' => 0, 'keuzedelen' => 0];
        }

        // Keuzedeelcodes rij
        $keuzedeelRow = str_getcsv($lines[4], ',');
        
        // Keuzedeelcodes vinden
        $keuzedeelCodes = [];
        
        for ($i = 0; $i < count($keuzedeelRow); $i++) {
            $code = trim($keuzedeelRow[$i]);
            // Code matching
            if (preg_match('/^\d{5}K\d{4}$/', $code) || preg_match('/^K\d{4}$/', $code)) {
                $keuzedeelCodes[$i] = $code;
            }
        }

        // Student rijen verwerken
        for ($row = 7; $row < count($lines); $row++) {
            $data = str_getcsv($lines[$row], ',');
            
            if (count($data) < 5) continue;

            // Kolom info: 
            // 1 = Roostergroep (klas)
            // 2 = studentnummer
            // 3 = naam
            // 4 = Opleidings Code
            $klas = trim($data[1] ?? '');
            $studentnummer = trim($data[2] ?? '');
            $naam = trim($data[3] ?? '');
            $opleiding = trim($data[4] ?? '');

            // Lege rijen skippen
            if (empty($studentnummer) || !is_numeric($studentnummer)) continue;

            // Email genereren
            $emailNaam = strtolower(str_replace(' ', '.', $naam));
            $emailNaam = preg_replace('/[^a-z0-9.]/', '', $emailNaam);
            $email = $emailNaam . '@student.tcr.nl';

            // Student aanmaken/updaten
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

            // Keuzedelen verwerken
            foreach ($keuzedeelCodes as $index => $keuzedeelcode) {
                $cijfer = trim($data[$index] ?? '');
                
                // Waarde check
                if (!empty($cijfer)) {
                    // Keuzedeel zoeken
                    $keuzedeel = Keuzedeel::where('keuzedeelcode', $keuzedeelcode)->first();
                    
                    if ($keuzedeel) {
                        // Inschrijving maken
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
                        
                        // Cijfer opslaan
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

    // Data verwijderen
    public function deleteOldInschrijvingen()
    {
        $this->checkAdmin();
        
        // Verwijder alle inschrijvingen en gedane keuzedelen
        Inschrijving::truncate();
        GedaanKeuzedeel::truncate();
        
        return redirect()->back()->with('success', 'Alle oude inschrijvingen en cijfers zijn verwijderd.');
    }
}
