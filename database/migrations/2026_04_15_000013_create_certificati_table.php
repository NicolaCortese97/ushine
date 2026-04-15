<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('certificati', function (Blueprint $table) {
            $table->id('certificato_id');
            $table->foreignId('sponsor_id')->constrained('sponsors', 'sponsor_id');
            $table->foreignId('talent_id')->nullable()->constrained('talents', 'talent_id');
            $table->integer('livello')->nullable();
            $table->string('tipo_certificato', 100);
            $table->string('url_pdf', 500)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('certificati');
    }
};