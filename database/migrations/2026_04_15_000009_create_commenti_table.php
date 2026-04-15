<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('commenti', function (Blueprint $table) {
            $table->id('commento_id');
            $table->foreignId('post_id')->constrained('posts', 'post_id')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users');
            $table->text('testo');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('commenti');
    }
};