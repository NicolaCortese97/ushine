<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
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

        // 1. TABELLA USER (Modificata per Laravel standard)
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Standard Laravel: 'id' invece di 'user_id'
            $table->string('name'); // Campo standard Laravel
            $table->string('cognome', 100); // Campo aggiuntivo personalizzato
            $table->string('email', 255)->unique();
            $table->timestamp('email_verified_at')->nullable(); // Standard Laravel
            $table->string('password'); // Standard Laravel (invece di password_hash)
            $table->rememberToken(); // Standard Laravel
            $table->timestamps(); // created_at e updated_at
            
            // Campi personalizzati (tutti i tuoi campi)
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

        // 2. IMPOSTAZIONI PRIVACY (1:1 con User)
        Schema::create('impostazioni_privacy', function (Blueprint $table) {
            $table->foreignId('user_id')->primary()->constrained('users')->onDelete('cascade');
            $table->boolean('mostra_email')->default(false);
            $table->boolean('mostra_telefono')->default(false);
            $table->boolean('mostra_donazioni')->default(true);
            $table->boolean('mostra_xp')->default(true);
            $table->boolean('profilo_privato')->default(false);
        });

        // 3. TALENT
        Schema::create('talents', function (Blueprint $table) {
            $table->foreignId('talent_id')->primary()->constrained('users')->onDelete('cascade');
            $table->enum('categoria', ['Sport', 'Arte', 'Musica', 'Gamer', 'Letteratura', 'Danza', 'Altro']);
            $table->string('categoria_personalizzata', 100)->nullable();
            $table->text('biografia')->nullable();
            $table->text('obbiettivo')->nullable();
            $table->integer('obbiettivo_avanzamento')->default(0);
            $table->integer('xp_totali')->default(0)->index();
        });

        // 4. SPONSOR
        Schema::create('sponsors', function (Blueprint $table) {
            $table->foreignId('sponsor_id')->primary()->constrained('users')->onDelete('cascade');
            $table->integer('xp_donati_totali')->default(0)->index();
        });

        // 5. ADMIN
        Schema::create('admins', function (Blueprint $table) {
            $table->foreignId('admin_id')->primary()->constrained('users')->onDelete('cascade');
        });

        // 6. POST
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

        // 7. COMMENTO
        Schema::create('commenti', function (Blueprint $table) {
            $table->id('commento_id');
            $table->foreignId('post_id')->constrained('posts', 'post_id')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users');
            $table->text('testo');
            $table->timestamps();
        });

        // 8. REAZIONE
        Schema::create('reazioni', function (Blueprint $table) {
            $table->id('reazione_id');
            $table->foreignId('post_id')->constrained('posts', 'post_id')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users');
            $table->string('tipo_reazione', 50);
            $table->timestamps();
            $table->unique(['post_id', 'user_id']);
        });

        // 9. MESSAGGIO
        Schema::create('messaggi', function (Blueprint $table) {
            $table->id('messaggio_id');
            $table->foreignId('mittente_id')->constrained('users');
            $table->foreignId('destinatario_id')->constrained('users');
            $table->text('testo');
            $table->boolean('letto')->default(false);
            $table->timestamps();
        });

        // 10. DONAZIONE
        Schema::create('donazioni', function (Blueprint $table) {
            $table->id('donazione_id');
            $table->foreignId('sponsor_id')->constrained('sponsors', 'sponsor_id');
            $table->foreignId('talent_id')->constrained('talents', 'talent_id');
            $table->decimal('importo', 10, 2);
            $table->integer('xp_equivalenti')->storedAs('CAST(importo AS UNSIGNED)');
            $table->timestamps();
        });

        // Continua con le altre tabelle...
        // 11. CERTIFICATO
        Schema::create('certificati', function (Blueprint $table) {
            $table->id('certificato_id');
            $table->foreignId('sponsor_id')->constrained('sponsors', 'sponsor_id');
            $table->foreignId('talent_id')->nullable()->constrained('talents', 'talent_id');
            $table->integer('livello')->nullable();
            $table->string('tipo_certificato', 100);
            $table->string('url_pdf', 500)->nullable();
            $table->timestamps();
        });

        // 12. CHALLENGE
        Schema::create('challenges', function (Blueprint $table) {
            $table->id('challenge_id');
            $table->foreignId('sfidante_id')->constrained('talents', 'talent_id');
            $table->foreignId('sfidato_id')->constrained('talents', 'talent_id');
            $table->string('categoria', 50);
            $table->dateTime('data_inizio');
            $table->dateTime('data_fine');
            $table->foreignId('vincitore_id')->nullable()->constrained('talents', 'talent_id');
            $table->decimal('premio_totale', 10, 2)->default(0);
            $table->enum('stato', ['In corso', 'Completata', 'Annullata'])->default('In corso');
            $table->timestamps();
        });

        // 13. DONAZIONE CHALLENGE
        Schema::create('donazioni_challenge', function (Blueprint $table) {
            $table->id();
            $table->foreignId('challenge_id')->constrained('challenges', 'challenge_id')->onDelete('cascade');
            $table->foreignId('sponsor_id')->constrained('sponsors', 'sponsor_id');
            $table->foreignId('talent_id')->constrained('talents', 'talent_id');
            $table->decimal('importo', 10, 2);
            $table->timestamps();
        });

        // 14. EVENTO
        Schema::create('eventi', function (Blueprint $table) {
            $table->id('evento_id');
            $table->foreignId('talent_id')->constrained('talents', 'talent_id')->onDelete('cascade');
            $table->string('titolo', 200);
            $table->text('descrizione')->nullable();
            $table->dateTime('data_evento');
            $table->string('luogo', 200)->nullable();
            $table->string('link_partecipazione', 500)->nullable();
            $table->timestamps();
        });

        // 15. SPONSORIZZAZIONE
        Schema::create('sponsorizzazioni', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sponsor_id')->constrained('sponsors', 'sponsor_id');
            $table->foreignId('talent_id')->constrained('talents', 'talent_id');
            $table->date('data_inizio');
            $table->date('data_fine');
            $table->decimal('importo_totale', 10, 2);
            $table->timestamps();
        });

        // 16. BADGE
        Schema::create('badges', function (Blueprint $table) {
            $table->id('badge_id');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nome_badge', 100);
            $table->timestamps();
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
            $table->foreignId('profilo_visto_id')->constrained('users');
            $table->foreignId('visitatore_id')->nullable()->constrained('users');
            $table->timestamps();
        });

        // 19. LOG ACCESSO
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
        // Drop in ordine inverso
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