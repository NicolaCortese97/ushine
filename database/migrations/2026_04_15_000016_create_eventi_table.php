<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('eventi', function (Blueprint $table) {
            $table->id('evento_id');
            $table->foreignId('talent_id')->constrained('talents', 'talent_id')->onDelete('cascade');
            $table->string('titolo', 200);
            $table->text('descrizione')->nullable();
            $table->dateTime('data_evento');
            $table->string('luogo', 200)->nullable();
            $table->string('link_partecipazione', 500)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('eventi');
    }
};