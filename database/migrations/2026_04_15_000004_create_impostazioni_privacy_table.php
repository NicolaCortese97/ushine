<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('impostazioni_privacy', function (Blueprint $table) {
            $table->foreignId('user_id')->primary()->constrained('users')->onDelete('cascade');
            $table->boolean('mostra_email')->default(false);
            $table->boolean('mostra_telefono')->default(false);
            $table->boolean('mostra_donazioni')->default(true);
            $table->boolean('mostra_xp')->default(true);
            $table->boolean('profilo_privato')->default(false);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('impostazioni_privacy');
    }
};
