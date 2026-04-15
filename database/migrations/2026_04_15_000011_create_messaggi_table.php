<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('messaggi', function (Blueprint $table) {
            $table->id('messaggio_id');
            $table->foreignId('mittente_id')->constrained('users');
            $table->foreignId('destinatario_id')->constrained('users');
            $table->text('testo');
            $table->boolean('letto')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('messaggi');
    }
};