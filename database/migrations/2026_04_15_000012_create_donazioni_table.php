<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('donazioni', function (Blueprint $table) {
            $table->id('donazione_id');
            $table->foreignId('sponsor_id')->constrained('sponsors', 'sponsor_id');
            $table->foreignId('talent_id')->constrained('talents', 'talent_id');
            $table->decimal('importo', 10, 2);
            $table->integer('xp_equivalenti')->storedAs('CAST(importo AS UNSIGNED)');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donazioni');
    }
};