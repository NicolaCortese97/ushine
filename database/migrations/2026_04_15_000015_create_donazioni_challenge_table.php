<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('donazioni_challenge', function (Blueprint $table) {
            $table->id();
            $table->foreignId('challenge_id')->constrained('challenges', 'challenge_id')->onDelete('cascade');
            $table->foreignId('sponsor_id')->constrained('sponsors', 'sponsor_id');
            $table->foreignId('talent_id')->constrained('talents', 'talent_id');
            $table->decimal('importo', 10, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donazioni_challenge');
    }
};