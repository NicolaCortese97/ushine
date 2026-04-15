<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('cognome', 100);
            $table->string('email', 255)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            
            // Campi personalizzati
            $table->longText('bio')->nullable();
            $table->string('telefono', 20)->nullable();
            $table->string('prefisso_internazionale', 5)->nullable();
            $table->string('lingua_preferita', 2)->default('IT');
            $table->enum('tipo_utente', ['Guest', 'Talent', 'Sponsor', 'Admin', 'Visitatore']);
            $table->string('foto_profilo', 500)->nullable();
            $table->boolean('accetta_termini')->default(false);
            $table->boolean('premium')->default(false);
            $table->date('premium_scadenza')->nullable();
            $table->boolean('verificato_identita')->default(false);
            $table->boolean('bannato')->default(false);
            $table->date('ban_scadenza')->nullable();
            $table->text('motivo_ban')->nullable();
            
            // Indici
            $table->index('email');
            $table->index('tipo_utente');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};