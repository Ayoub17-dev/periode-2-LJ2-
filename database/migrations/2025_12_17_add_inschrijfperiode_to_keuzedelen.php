<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('keuzedelen', function (Blueprint $table) {
            $table->boolean('inschrijving_open')->default(true)->after('is_actief');
            $table->dateTime('inschrijving_start')->nullable()->after('inschrijving_open');
            $table->dateTime('inschrijving_eind')->nullable()->after('inschrijving_start');
        });
    }

    public function down()
    {
        Schema::table('keuzedelen', function (Blueprint $table) {
            $table->dropColumn(['inschrijving_open', 'inschrijving_start', 'inschrijving_eind']);
        });
    }
};
