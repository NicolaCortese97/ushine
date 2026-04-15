<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('talents', function (Blueprint $table) {
            $table->foreignId('talent_id')->primary()->constrained('users')->onDelete('cascade');
            $table->enum('categoria', ['Sport', 'Arte', 'Musica', 'Gamer', 'Letteratura', 'Danza', 'Altro']);
            $table->string('categoria_personalizzata', 100)->nullable();
            $table->text('biografia')->nullable();
            $table->text('obbiettivo')->nullable();
            $table->integer('obbiettivo_avanzamento')->default(0);
            $table->integer('xp_totali')->default(0)->index();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('talents');
    }
};