<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('gedane_keuzedelen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('keuzedeelcode');
            $table->string('naam');
            $table->string('cijfer')->nullable();
            $table->string('status')->nullable();
            $table->date('datum_afgerond')->nullable();
            $table->timestamps();
            
            $table->index(['user_id', 'keuzedeelcode']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('gedane_keuzedelen');
    }
};
