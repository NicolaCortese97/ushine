<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('visualizzazioni_profilo', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profilo_visto_id')->constrained('users');
            $table->foreignId('visitatore_id')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visualizzazioni_profilo');
    }
};