<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('keuzedelen', function (Blueprint $table) {
            $table->id();
            $table->string('code');                    // Bijv: K0001
            $table->string('naam');                    // Naam van het keuzedeel
            $table->text('beschrijving')->nullable();  // Uitleg over het keuzedeel
            $table->integer('periode');                // Welke periode (1, 2, 3, 4)
            $table->integer('max_studenten')->default(30);  // Max 30 studenten
            $table->integer('min_studenten')->default(15);  // Min 15 om te starten
            $table->boolean('is_actief')->default(true);    // Aan/uit zetten
            $table->boolean('herhaalbaar')->default(false); // Mag je meerdere keren doen?
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keuzedelen');
    }
};
