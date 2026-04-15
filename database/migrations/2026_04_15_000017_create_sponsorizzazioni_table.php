<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sponsorizzazioni', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sponsor_id')->constrained('sponsors', 'sponsor_id');
            $table->foreignId('talent_id')->constrained('talents', 'talent_id');
            $table->date('data_inizio');
            $table->date('data_fine');
            $table->decimal('importo_totale', 10, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sponsorizzazioni');
    }
};