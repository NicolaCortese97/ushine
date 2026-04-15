<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id('post_id');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->enum('tipo', ['Testo', 'Foto', 'Video']);
            $table->text('contenuto');
            $table->enum('visibile_a', ['Tutti', 'Solo Premium', 'Solo Sponsor', 'Solo Talent'])->default('Tutti');
            $table->boolean('approvato')->default(false);
            $table->text('motivo_rifiuto')->nullable();
            $table->timestamps();
            $table->index('user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};