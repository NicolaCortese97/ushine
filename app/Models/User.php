<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id'; // Ora usi 'id' (standard Laravel)

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'cognome',
        'bio',
        'email',
        'password',
        'telefono',
        'prefisso_internazionale',
        'lingua_preferita',
        'tipo_utente',
        'foto_profilo',
        'accetta_termini',
        'premium',
        'premium_scadenza',
        'verificato_identita',
        'bannato',
        'ban_scadenza',
        'motivo_ban',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'accetta_termini' => 'boolean',
        'premium' => 'boolean',
        'verificato_identita' => 'boolean',
        'bannato' => 'boolean',
        'premium_scadenza' => 'date',
        'ban_scadenza' => 'date',
    ];

    /**
     * Get the user's full name.
     */
    public function getFullNameAttribute(): string
    {
        return $this->name . ' ' . $this->cognome;
    }

    /**
     * Relazione con impostazioni privacy
     */
    public function impostazioniPrivacy()
    {
        return $this->hasOne(ImpostazioniPrivacys::class, 'user_id', 'id');
    }

    /**
     * Relazione con talent (se l'utente è un talent)
     */
    public function talent()
    {
        return $this->hasOne(Talent::class, 'talent_id', 'id');
    }

    /**
     * Relazione con sponsor (se l'utente è uno sponsor)
     */
    public function sponsor()
    {
        return $this->hasOne(Sponsor::class, 'sponsor_id', 'id');
    }

    /**
     * Relazione con admin (se l'utente è un admin)
     */
    public function admin()
    {
        return $this->hasOne(Admin::class, 'admin_id', 'id');
    }

    /**
     * Relazione con posts
     */
    public function posts()
    {
        return $this->hasMany(Post::class, 'user_id', 'id');
    }

    /**
     * Relazione con commenti
     */
    public function commenti()
    {
        return $this->hasMany(Commento::class, 'user_id', 'id');
    }

    /**
     * Relazione con badge
     */
    public function badges()
    {
        return $this->hasMany(Badge::class, 'user_id', 'id');
    }
}