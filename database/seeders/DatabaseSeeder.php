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

        // ECHTE keuzedelen uit Excel bestand - 12 serienummers
        $keuzedelen = [
            // Periode 1 - Software Development
            [
                'code' => 'KD001',
                'keuzedeelcode' => '25604K0059',
                'naam' => 'Verdieping Software',
                'beschrijving' => 'Verdiep je kennis in geavanceerde programmeertechnieken, design patterns en software architectuur.',
                'periode' => 1,
                'max_studenten' => 25,
                'min_studenten' => 10,
                'is_actief' => true,
                'opleiding' => '25604BOL', // Software Developer
            ],
            [
                'code' => 'KD002',
                'keuzedeelcode' => '25604K0080',
                'naam' => 'Game Development',
                'beschrijving' => 'Ontwikkel professionele games met Unity, Unreal Engine en C#. Leer game mechanics, physics en AI.',
                'periode' => 1,
                'max_studenten' => 20,
                'min_studenten' => 8,
                'is_actief' => true,
                'opleiding' => '25604BOL',
            ],
            [
                'code' => 'KD003',
                'keuzedeelcode' => '25604K0210',
                'naam' => 'Mobile App Development',
                'beschrijving' => 'Bouw native iOS en Android apps. Leer Swift, Kotlin en cross-platform frameworks.',
                'periode' => 1,
                'max_studenten' => 22,
                'min_studenten' => 10,
                'is_actief' => true,
                'opleiding' => '25604BOL',
            ],
            
            // Periode 2 - Cybersecurity & Cloud
            [
                'code' => 'KD004',
                'keuzedeelcode' => '25604K0497',
                'naam' => 'Cybersecurity Fundamentals',
                'beschrijving' => 'Bescherm systemen tegen hackers. Leer penetration testing, ethical hacking en security protocols.',
                'periode' => 2,
                'max_studenten' => 30,
                'min_studenten' => 15,
                'is_actief' => true,
                'opleiding' => '25604BOL',
            ],
            [
                'code' => 'KD005',
                'keuzedeelcode' => '25604K0505',
                'naam' => 'Cloud Computing',
                'beschrijving' => 'Beheer en deploy applicaties in de cloud met AWS, Azure en Google Cloud Platform.',
                'periode' => 2,
                'max_studenten' => 28,
                'min_studenten' => 14,
                'is_actief' => true,
                'opleiding' => '25604BOL',
            ],
            [
                'code' => 'KD006',
                'keuzedeelcode' => '25604K0722',
                'naam' => 'DevOps Engineering',
                'beschrijving' => 'Automatiseer deployments met CI/CD, Docker, Kubernetes en Infrastructure as Code.',
                'periode' => 2,
                'max_studenten' => 24,
                'min_studenten' => 12,
                'is_actief' => true,
                'opleiding' => '25604BOL',
            ],
            
            // Periode 3 - AI & Data
            [
                'code' => 'KD007',
                'keuzedeelcode' => '25604K0730',
                'naam' => 'Machine Learning & AI',
                'beschrijving' => 'Ontwikkel intelligente systemen met Python, TensorFlow en neural networks.',
                'periode' => 3,
                'max_studenten' => 22,
                'min_studenten' => 10,
                'is_actief' => true,
                'opleiding' => '25604BOL',
            ],
            [
                'code' => 'KD008',
                'keuzedeelcode' => '25998K0497',
                'naam' => 'Data Science',
                'beschrijving' => 'Analyseer big data met Python, R en SQL. Leer data visualization en predictive analytics.',
                'periode' => 3,
                'max_studenten' => 26,
                'min_studenten' => 13,
                'is_actief' => true,
                'opleiding' => '25998BOL', // Applicatieontwikkelaar
            ],
            [
                'code' => 'KD009',
                'keuzedeelcode' => '25998K0722',
                'naam' => 'Blockchain Development',
                'beschrijving' => 'Bouw gedecentraliseerde applicaties met Ethereum, Smart Contracts en Web3.',
                'periode' => 3,
                'max_studenten' => 18,
                'min_studenten' => 9,
                'is_actief' => true,
                'opleiding' => '25998BOL',
            ],
            
            // Periode 4 - Specialisaties
            [
                'code' => 'KD010',
                'keuzedeelcode' => '25998K0788',
                'naam' => 'IoT & Embedded Systems',
                'beschrijving' => 'Programmeer microcontrollers, sensoren en IoT devices met Arduino en Raspberry Pi.',
                'periode' => 4,
                'max_studenten' => 20,
                'min_studenten' => 10,
                'is_actief' => true,
                'opleiding' => '25998BOL',
            ],
            [
                'code' => 'KD011',
                'keuzedeelcode' => 'K0205',
                'naam' => 'Frontend Frameworks',
                'beschrijving' => 'Master moderne frontend development met React, Vue.js en Angular.',
                'periode' => 4,
                'max_studenten' => 30,
                'min_studenten' => 15,
                'is_actief' => true,
                'opleiding' => 'ALGEMEEN', // Voor alle opleidingen
            ],
            [
                'code' => 'KD012',
                'keuzedeelcode' => 'K0877',
                'naam' => 'Agile Project Management',
                'beschrijving' => 'Word een Scrum Master. Leer Agile, Kanban en projectmanagement methodieken.',
                'periode' => 4,
                'max_studenten' => 35,
                'min_studenten' => 18,
                'is_actief' => true,
                'opleiding' => 'ALGEMEEN',
            ],
        ];

        foreach ($keuzedelen as $keuzedeel) {
            Keuzedeel::create($keuzedeel);
        }
    }
}
