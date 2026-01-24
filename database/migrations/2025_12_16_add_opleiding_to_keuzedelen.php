<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('keuzedelen', function (Blueprint $table) {
            $table->string('opleiding', 50)->nullable()->after('keuzedeelcode');
        });
    }

    public function down()
    {
        Schema::table('keuzedelen', function (Blueprint $table) {
            $table->dropColumn('opleiding');
        });
    }
};
