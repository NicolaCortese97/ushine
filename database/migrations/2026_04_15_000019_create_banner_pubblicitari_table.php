<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('banner_pubblicitari', function (Blueprint $table) {
            $table->id('banner_id');
            $table->string('titolo', 200);
            $table->string('immagine_url', 500);
            $table->string('link_destinazione', 500)->nullable();
            $table->date('data_inizio');
            $table->date('data_fine');
            $table->boolean('attivo')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('banner_pubblicitari');
    }
};