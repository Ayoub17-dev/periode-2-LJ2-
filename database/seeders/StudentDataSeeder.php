<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Keuzedeel;
use App\Models\GedaanKeuzedeel;
use Illuminate\Support\Facades\Hash;

class StudentDataSeeder extends Seeder
{
    public function run()
    {
        // Create keuzedelen if they don't exist
        $keuzedelen = [
            ['keuzedeelcode' => '25604K0059', 'naam' => 'Duurzaamheid in het beroep A', 'opleiding' => '25604BOL', 'periode' => 1],
            ['keuzedeelcode' => '25604K0080', 'naam' => 'Verdieping software', 'opleiding' => '25604BOL', 'periode' => 1],
            ['keuzedeelcode' => '25604K0210', 'naam' => 'Voorbereiding HBO', 'opleiding' => '25604BOL', 'periode' => 2],
            ['keuzedeelcode' => '25604K0497', 'naam' => 'Ondernemend gedrag', 'opleiding' => '25604BOL', 'periode' => 2],
            ['keuzedeelcode' => '25604K0505', 'naam' => 'Oriëntatie op ondernemerschap', 'opleiding' => '25604BOL', 'periode' => 3],
            ['keuzedeelcode' => '25604K0722', 'naam' => 'Engels A2/B1', 'opleiding' => '25604BOL', 'periode' => 3],
            ['keuzedeelcode' => '25604K0730', 'naam' => 'Digitale vaardigheden gevorderd', 'opleiding' => '25604BOL', 'periode' => 4],
            ['keuzedeelcode' => '25998K0497', 'naam' => 'Ondernemend gedrag', 'opleiding' => '25998BOL', 'periode' => 1],
            ['keuzedeelcode' => '25998K0722', 'naam' => 'Engels A2/B1', 'opleiding' => '25998BOL', 'periode' => 2],
            ['keuzedeelcode' => '25998K0788', 'naam' => 'Duits A1/A2', 'opleiding' => '25998BOL', 'periode' => 3],
        ];

        foreach ($keuzedelen as $kd) {
            $keuzedeel = Keuzedeel::where('keuzedeelcode', $kd['keuzedeelcode'])->first();
            
            if (!$keuzedeel) {
                Keuzedeel::create([
                    'code' => 'KD' . substr($kd['keuzedeelcode'], -4),
                    'keuzedeelcode' => $kd['keuzedeelcode'],
                    'naam' => $kd['naam'],
                    'opleiding' => $kd['opleiding'],
                    'periode' => $kd['periode'],
                    'beschrijving' => 'Keuzedeel ' . $kd['naam'],
                    'max_studenten' => 30,
                    'min_studenten' => 15,
                    'is_actief' => true,
                    'inschrijving_open' => true
                ]);
            }
        }

        // Student data from Excel
        $students = [
            ['nummer' => '1234567', 'naam' => 'Alivia Williamson', 'opleiding' => '25604BOL', 'klas' => 'PALVSOD2F', 'grades' => ['25604K0080' => 8.0, '25604K0210' => 5]],
            ['nummer' => '1234568', 'naam' => 'Austin Padilla', 'opleiding' => '25998BOL', 'klas' => 'PALVSOD2F', 'grades' => ['25998K0497' => 6]],
            ['nummer' => '1234569', 'naam' => 'Cole Leon', 'opleiding' => '25604BOL', 'klas' => 'PALVSOD2F', 'grades' => ['25604K0505' => 6.3]],
            ['nummer' => '1234570', 'naam' => 'Dale O\'Ryan', 'opleiding' => '25998BOL', 'klas' => 'PALVSOD2F', 'grades' => []],
            ['nummer' => '1234571', 'naam' => 'Dawson Blankenship', 'opleiding' => '25998BOL', 'klas' => 'PALVSOD2F', 'grades' => ['25998K0788' => 9.5]],
            ['nummer' => '1234572', 'naam' => 'Dewey Rhodes', 'opleiding' => '25604BOL', 'klas' => 'PALVSOD2F', 'grades' => ['25604K0210' => 8]],
            ['nummer' => '1234573', 'naam' => 'Eileen Kelly', 'opleiding' => '25604BOL', 'klas' => 'PALVSOD2F', 'grades' => ['25604K0497' => 6, '25604K0722' => 6]],
            ['nummer' => '1234574', 'naam' => 'Ella-Louise Heath', 'opleiding' => '25998BOL', 'klas' => 'PALVSOD2F', 'grades' => ['25998K0722' => 6.4]],
            ['nummer' => '1234575', 'naam' => 'Ellie-Mae Trujillo', 'opleiding' => '25998BOL', 'klas' => 'PALVSOD2F', 'grades' => ['25998K0788' => 8.5]],
            ['nummer' => '1234576', 'naam' => 'Evie Campos', 'opleiding' => '25998BOL', 'klas' => 'PALVSOD2F', 'grades' => []],
            ['nummer' => '1234577', 'naam' => 'Gwen Bonner', 'opleiding' => '25998BOL', 'klas' => 'PALVSOD2F', 'grades' => ['25998K0497' => 8]],
            ['nummer' => '1234578', 'naam' => 'Joe Boyle', 'opleiding' => '25998BOL', 'klas' => 'PALVSOD2F', 'grades' => ['25998K0788' => 6.3]],
            ['nummer' => '1234579', 'naam' => 'Julia Adams', 'opleiding' => '25998BOL', 'klas' => 'PALVSOD2F', 'grades' => ['25998K0722' => 7.3]],
            ['nummer' => '1234580', 'naam' => 'Karen Richards', 'opleiding' => '25998BOL', 'klas' => 'PALVSOD2F', 'grades' => ['25998K0497' => 7]],
            ['nummer' => '1234581', 'naam' => 'Laura Ellis', 'opleiding' => '25998BOL', 'klas' => 'PALVSOD2F', 'grades' => ['25998K0497' => 6]],
            ['nummer' => '1234582', 'naam' => 'Leila Copeland', 'opleiding' => '25998BOL', 'klas' => 'PALVSOD2F', 'grades' => ['25998K0497' => 8.2]],
            ['nummer' => '1234583', 'naam' => 'Martina Roman', 'opleiding' => '25998BOL', 'klas' => 'PALVSOD2F', 'grades' => ['25998K0788' => 8.5]],
            ['nummer' => '1234584', 'naam' => 'Molly Cline', 'opleiding' => '25604BOL', 'klas' => 'PALVSOD2F', 'grades' => ['25604K0210' => 7.9]],
            ['nummer' => '1234585', 'naam' => 'Sarah Kemp', 'opleiding' => '25998BOL', 'klas' => 'PALVSOD2F', 'grades' => ['25998K0497' => 9]],
            ['nummer' => '1234586', 'naam' => 'Solomon Ball', 'opleiding' => '25998BOL', 'klas' => 'PALVSOD2F', 'grades' => ['25998K0497' => 9.9]],
            ['nummer' => '1234587', 'naam' => 'Victor Gilmore', 'opleiding' => '25604BOL', 'klas' => 'PALVSOD2F', 'grades' => []],
        ];

        foreach ($students as $studentData) {
            // Create or update student
            $nameParts = explode(' ', $studentData['naam']);
            $email = strtolower(str_replace(' ', '.', $studentData['naam'])) . '@student.tcr.nl';
            
            $user = User::firstOrCreate(
                ['studentnummer' => $studentData['nummer']],
                [
                    'name' => $studentData['naam'],
                    'email' => $email,
                    'password' => Hash::make($studentData['nummer']),
                    'rol' => 'student',
                    'opleiding' => $studentData['opleiding'],
                    'klas' => $studentData['klas']
                ]
            );

            // Add grades
            foreach ($studentData['grades'] as $keuzedeelcode => $cijfer) {
                GedaanKeuzedeel::firstOrCreate(
                    [
                        'user_id' => $user->id,
                        'keuzedeelcode' => $keuzedeelcode
                    ],
                    [
                        'cijfer' => $cijfer,
                        'datum_afgerond' => now()
                    ]
                );
            }
        }

        $this->command->info('Student data imported successfully!');
    }
}
