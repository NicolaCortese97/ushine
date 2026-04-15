<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('log_accessi', function (Blueprint $table) {
            $table->id('log_id');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('ip_address', 45)->nullable();
            $table->enum('tipo_accesso', ['Login', 'Logout', 'Registrazione']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('log_accessi');
    }
};