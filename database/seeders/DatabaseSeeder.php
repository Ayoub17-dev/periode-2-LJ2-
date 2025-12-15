<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Keuzedeel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Maak een admin account
        User::create([
            'name' => 'Admin',
            'email' => 'admin@school.nl',
            'password' => Hash::make('admin123'),
            'rol' => 'admin',
        ]);

        // Maak een test student
        User::create([
            'name' => 'Test Student',
            'email' => 'student@school.nl',
            'password' => Hash::make('student123'),
            'studentnummer' => '123456',
            'klas' => 'SD2A',
            'rol' => 'student',
        ]);

        // Maak wat keuzedelen aan
        Keuzedeel::create([
            'code' => 'K0001',
            'naam' => 'Verdieping Software',
            'beschrijving' => 'In dit keuzedeel leer je geavanceerde software development technieken. Je gaat aan de slag met frameworks, design patterns en best practices.',
            'periode' => 2,
            'max_studenten' => 30,
            'min_studenten' => 15,
            'is_actief' => true,
            'herhaalbaar' => true,
        ]);

        Keuzedeel::create([
            'code' => 'K0002',
            'naam' => 'Webdesign Basics',
            'beschrijving' => 'Leer de basis van webdesign. HTML, CSS en de principes van user experience design.',
            'periode' => 2,
            'max_studenten' => 25,
            'min_studenten' => 10,
            'is_actief' => true,
            'herhaalbaar' => false,
        ]);

        Keuzedeel::create([
            'code' => 'K0003',
            'naam' => 'Database Management',
            'beschrijving' => 'Alles over databases: SQL, normalisatie, en het ontwerpen van efficiënte datastructuren.',
            'periode' => 3,
            'max_studenten' => 20,
            'min_studenten' => 8,
            'is_actief' => true,
            'herhaalbaar' => false,
        ]);

        Keuzedeel::create([
            'code' => 'K0004',
            'naam' => 'Netwerkbeheer',
            'beschrijving' => 'Leer hoe je netwerken opzet, beheert en beveiligt.',
            'periode' => 3,
            'max_studenten' => 15,
            'min_studenten' => 5,
            'is_actief' => false, // Dit keuzedeel is uitgeschakeld
            'herhaalbaar' => false,
        ]);

        Keuzedeel::create([
            'code' => 'K0005',
            'naam' => 'Mobile App Development',
            'beschrijving' => 'Bouw mobiele apps voor Android en iOS met moderne frameworks.',
            'periode' => 4,
            'max_studenten' => 30,
            'min_studenten' => 12,
            'is_actief' => true,
            'herhaalbaar' => false,
        ]);
    }
}
