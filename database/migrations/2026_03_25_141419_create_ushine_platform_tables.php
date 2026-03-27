<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
        // 1. TABELLA USER (Utente generico)
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id'); // INT IDENTITY(1,1)
            $table->string('nome', 100);
            $table->string('cognome', 100);
            $table->string('email', 255)->unique();
            $table->string('password_hash', 255);
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
            $table->timestamps(); // Sostituisce data_registrazione

            $table->index('email');
            $table->index('tipo_utente');
        });

        // 2. IMPOSTAZIONI PRIVACY (1:1 con User)
        Schema::create('impostazioni_privacy', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->primary();
            $table->boolean('mostra_email')->default(false);
            $table->boolean('mostra_telefono')->default(false);
            $table->boolean('mostra_donazioni')->default(true);
            $table->boolean('mostra_xp')->default(true);
            $table->boolean('profilo_privato')->default(false);
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        });

        // 3. TALENT
        Schema::create('talents', function (Blueprint $table) {
            $table->unsignedBigInteger('talent_id')->primary();
            $table->enum('categoria', ['Sport', 'Arte', 'Musica', 'Gamer', 'Letteratura', 'Danza', 'Altro']);
            $table->string('categoria_personalizzata', 100)->nullable();
            $table->text('biografia')->nullable();
            $table->text('obbiettivo')->nullable();
            $table->integer('obbiettivo_avanzamento')->default(0);
            $table->integer('xp_totali')->default(0)->index();
            $table->foreign('talent_id')->references('user_id')->on('users')->onDelete('cascade');
        });

        // 4. SPONSOR
        Schema::create('sponsors', function (Blueprint $table) {
            $table->unsignedBigInteger('sponsor_id')->primary();
            $table->integer('xp_donati_totali')->default(0)->index();
            $table->foreign('sponsor_id')->references('user_id')->on('users')->onDelete('cascade');
        });

        // 5. ADMIN
        Schema::create('admins', function (Blueprint $table) {
            $table->unsignedBigInteger('admin_id')->primary();
            $table->foreign('admin_id')->references('user_id')->on('users')->onDelete('cascade');
        });

        // 6. POST
        Schema::create('posts', function (Blueprint $table) {
            $table->id('post_id');
            $table->unsignedBigInteger('user_id');
            $table->enum('tipo', ['Testo', 'Foto', 'Video']);
            $table->text('contenuto');
            $table->enum('visibile_a', ['Tutti', 'Solo Premium', 'Solo Sponsor', 'Solo Talent'])->default('Tutti');
            $table->boolean('approvato')->default(false);
            $table->text('motivo_rifiuto')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->index('user_id');
        });

        // 7. COMMENTO
        Schema::create('commenti', function (Blueprint $table) {
            $table->id('commento_id');
            $table->unsignedBigInteger('post_id');
            $table->unsignedBigInteger('user_id');
            $table->text('testo');
            $table->timestamps();
            $table->foreign('post_id')->references('post_id')->on('posts')->onDelete('cascade');
            $table->foreign('user_id')->references('user_id')->on('users');
        });

        // 8. REAZIONE
        Schema::create('reazioni', function (Blueprint $table) {
            $table->id('reazione_id');
            $table->unsignedBigInteger('post_id');
            $table->unsignedBigInteger('user_id');
            $table->string('tipo_reazione', 50);
            $table->timestamps();
            $table->unique(['post_id', 'user_id']);
            $table->foreign('post_id')->references('post_id')->on('posts')->onDelete('cascade');
            $table->foreign('user_id')->references('user_id')->on('users');
        });

        // 9. MESSAGGIO
        Schema::create('messaggi', function (Blueprint $table) {
            $table->id('messaggio_id');
            $table->unsignedBigInteger('mittente_id');
            $table->unsignedBigInteger('destinatario_id');
            $table->text('testo');
            $table->boolean('letto')->default(false);
            $table->timestamps();
            $table->foreign('mittente_id')->references('user_id')->on('users');
            $table->foreign('destinatario_id')->references('user_id')->on('users');
        });

        // 10. DONAZIONE
        Schema::create('donazioni', function (Blueprint $table) {
            $table->id('donazione_id');
            $table->unsignedBigInteger('sponsor_id');
            $table->unsignedBigInteger('talent_id');
            $table->decimal('importo', 10, 2);
            // Colonna generata per XP (standard MySQL/MariaDB in Laragon)
            $table->integer('xp_equivalenti')->storedAs('CAST(importo AS UNSIGNED)');
            $table->timestamps();
            $table->foreign('sponsor_id')->references('sponsor_id')->on('sponsors');
            $table->foreign('talent_id')->references('talent_id')->on('talents');
        });

        // 11. CERTIFICATO
        Schema::create('certificati', function (Blueprint $table) {
            $table->id('certificato_id');
            $table->unsignedBigInteger('sponsor_id');
            $table->unsignedBigInteger('talent_id')->nullable();
            $table->integer('livello')->nullable(); // Vincolo 1,2,3 gestito a livello applicativo
            $table->string('tipo_certificato', 100);
            $table->string('url_pdf', 500)->nullable();
            $table->timestamps();
            $table->foreign('sponsor_id')->references('sponsor_id')->on('sponsors');
            $table->foreign('talent_id')->references('talent_id')->on('talents');
        });

        // 12. CHALLENGE
        Schema::create('challenges', function (Blueprint $table) {
            $table->id('challenge_id');
            $table->unsignedBigInteger('sfidante_id');
            $table->unsignedBigInteger('sfidato_id');
            $table->string('categoria', 50);
            $table->dateTime('data_inizio');
            $table->dateTime('data_fine');
            $table->unsignedBigInteger('vincitore_id')->nullable();
            $table->decimal('premio_totale', 10, 2)->default(0);
            $table->enum('stato', ['In corso', 'Completata', 'Annullata'])->default('In corso');
            $table->timestamps();
            $table->foreign('sfidante_id')->references('talent_id')->on('talents');
            $table->foreign('sfidato_id')->references('talent_id')->on('talents');
            $table->foreign('vincitore_id')->references('talent_id')->on('talents');
        });

        // 13. DONAZIONE CHALLENGE
        Schema::create('donazioni_challenge', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('challenge_id');
            $table->unsignedBigInteger('sponsor_id');
            $table->unsignedBigInteger('talent_id');
            $table->decimal('importo', 10, 2);
            $table->timestamps();
            $table->foreign('challenge_id')->references('challenge_id')->on('challenges')->onDelete('cascade');
            $table->foreign('sponsor_id')->references('sponsor_id')->on('sponsors');
            $table->foreign('talent_id')->references('talent_id')->on('talents');
        });

        // 14. EVENTO
        Schema::create('eventi', function (Blueprint $table) {
            $table->id('evento_id');
            $table->unsignedBigInteger('talent_id');
            $table->string('titolo', 200);
            $table->text('descrizione')->nullable();
            $table->dateTime('data_evento');
            $table->string('luogo', 200)->nullable();
            $table->string('link_partecipazione', 500)->nullable();
            $table->timestamps();
            $table->foreign('talent_id')->references('talent_id')->on('talents')->onDelete('cascade');
        });

        // 15. SPONSORIZZAZIONE
        Schema::create('sponsorizzazioni', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sponsor_id');
            $table->unsignedBigInteger('talent_id');
            $table->date('data_inizio');
            $table->date('data_fine');
            $table->decimal('importo_totale', 10, 2);
            $table->timestamps();
            $table->foreign('sponsor_id')->references('sponsor_id')->on('sponsors');
            $table->foreign('talent_id')->references('talent_id')->on('talents');
        });

        // 16. BADGE
        Schema::create('badges', function (Blueprint $table) {
            $table->id('badge_id');
            $table->unsignedBigInteger('user_id');
            $table->string('nome_badge', 100);
            $table->timestamps();
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        });

        // 17. BANNER PUBBLICITARIO
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

        // 18. VISUALIZZAZIONE PROFILO
        Schema::create('visualizzazioni_profilo', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('profilo_visto_id');
            $table->unsignedBigInteger('visitatore_id')->nullable();
            $table->timestamps();
            $table->foreign('profilo_visto_id')->references('user_id')->on('users');
            $table->foreign('visitatore_id')->references('user_id')->on('users');
        });

        // 19. LOG ACCESSO
        Schema::create('log_accessi', function (Blueprint $table) {
            $table->id('log_id');
            $table->unsignedBigInteger('user_id');
            $table->string('ip_address', 45)->nullable();
            $table->enum('tipo_accesso', ['Login', 'Logout', 'Registrazione']);
            $table->timestamps();
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop in ordine inverso per evitare errori di vincoli FK
        Schema::dropIfExists('log_accessi');
        Schema::dropIfExists('visualizzazioni_profilo');
        Schema::dropIfExists('banner_pubblicitari');
        Schema::dropIfExists('badges');
        Schema::dropIfExists('sponsorizzazioni');
        Schema::dropIfExists('eventi');
        Schema::dropIfExists('donazioni_challenge');
        Schema::dropIfExists('challenges');
        Schema::dropIfExists('certificati');
        Schema::dropIfExists('donazioni');
        Schema::dropIfExists('messaggi');
        Schema::dropIfExists('reazioni');
        Schema::dropIfExists('commenti');
        Schema::dropIfExists('posts');
        Schema::dropIfExists('admins');
        Schema::dropIfExists('sponsors');
        Schema::dropIfExists('talents');
        Schema::dropIfExists('impostazioni_privacy');
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};