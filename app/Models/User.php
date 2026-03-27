<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Specifichiamo la chiave primaria personalizzata
    protected $primaryKey = 'user_id';

    // Diciamo a Laravel quali campi possono essere riempiti in massa
    protected $fillable = [
        'nome',
        'cognome',
        'email',
        'password_hash',
        'tipo_utente',
        'lingua_preferita',
        'accetta_termini',
    ];

    protected $hidden = [
        'password_hash',
        'remember_token',
    ];

    // IMPORTANTE: Laravel cerca la colonna 'password' di default.
    // Con questo metodo gli diciamo di usare 'password_hash'.
    public function getAuthPassword()
    {
        return $this->password_hash;
    }
}