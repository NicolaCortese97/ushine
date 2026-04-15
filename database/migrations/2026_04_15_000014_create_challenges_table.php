<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('challenges', function (Blueprint $table) {
            $table->id('challenge_id');
            $table->foreignId('sfidante_id')->constrained('talents', 'talent_id');
            $table->foreignId('sfidato_id')->constrained('talents', 'talent_id');
            $table->string('categoria', 50);
            $table->dateTime('data_inizio');
            $table->dateTime('data_fine');
            $table->foreignId('vincitore_id')->nullable()->constrained('talents', 'talent_id');
            $table->decimal('premio_totale', 10, 2)->default(0);
            $table->enum('stato', ['In corso', 'Completata', 'Annullata'])->default('In corso');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('challenges');
    }
};